<?php
class Employee_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function addemployee($data){
        $mobile =$data['mobile'];
        $this->db->where(array('mobile'=>$mobile));
        $query=$this->db->get('employees');
        if($query->num_rows() ==0){
            $insert=$this->db->insert('employees',$data);
            if($insert){
                $e_id=$this->db->insert_id();
                $userdata=array("username"=>$data['mobile'],'password'=>random_string('numeric'),'role'=>'dso',
                                'name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email'],'e_id'=>$e_id,
                                'status'=>1);
                $this->account->adduser($userdata);
                return array("status"=>true,"message"=>"Employee Added Successfully!");
            }else{
                $err=$this->db->error();
                return array("status"=>false,"message"=>$err['message']);
            }
        }else{
            return array("status"=>false,"message"=>"Employee Already Added!");
        }

    }
    
    public function getemployees($where=array(),$type="all",$orderby="t1.id"){
        $default=file_url('assets/images/default.jpg');
        $columns="t1.*, t2.username,t2.vp as password, case when t1.photo='' then '$default' else concat('".file_url()."',t1.photo) end as photo";
        $this->db->select($columns);
        $this->db->from("employees t1");
        $this->db->join("users t2","t1.user_id=t2.id","left");
        $this->db->where($where);
        $this->db->order_by($orderby);
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updateemployee($data){
        $id=$data['id'];
        unset($data['id']);
        $where=array("id"=>$id);
        if($this->db->get_where('employees',array('mobile'=>$data['mobile'],"id!="=>$id))->num_rows()==0){
            if($this->db->update("employees",$data,$where)){
                if(isset($data['photo']) && $data['photo']!=''){
                    $employee=$this->db->get_where('employees',array("id"=>$id))->unbuffered_row('array');
                    if($employee['user_id']!==NULL){
                        $this->db->update("users",['photo'=>$data['photo']],['id'=>$employee['user_id']]);
                    }
                }
                $message="Employees Updated Successfully!";
                $user_id=$this->db->get_where("employees",$where)->unbuffered_row()->user_id;
                if(isset($data['status']) && $data['status']==0 ){
                    $this->db->update("users",['status'=>0],['id'=>$user_id]);
                    $message="Employees Delete Successfully!";
                }
                return array("status"=>true,"message"=>$message,"message2"=>$result['message']);
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Employee Mobile No. Already Added!");
        }
    }
    
    public function savesalary($data){
        $emp_id=$data['emp_id'];
        $getsalary=$this->db->get_where("salary",["emp_id"=>$emp_id,"status"=>1]);
        $insert=true;
        $message="Employee Salary Added Successfully!";
        if($getsalary->num_rows()>0){
            $salary=$getsalary->unbuffered_row()->salary;
            if($salary!=$data['salary']){
                $query=$this->db->update("salary",array("status"=>0),["emp_id"=>$emp_id]);
            }
            else{
                $insert=false;
                $message="No Changes Done!";
                $query=true;
            }
        }
        if($insert){
            $query=$this->db->insert("salary",$data);
        }
        if($query){
            return array("status"=>true,"message"=>$message);
        }
        else{
            $error=$this->db->error();
            return array("status"=>false,"message"=>$error['message']);
        }
    }
    
    public function savebeatassignment($data){
        $this->db->where(array('date'=>$data['date'],'emp_id'=>$data['emp_id']));
        $query=$this->db->get('beat_assigned');
        if($query->num_rows() ==0){
            $this->db->where(array('date'=>$data['date'],'beat_id'=>$data['beat_id']));
            $query=$this->db->get('beat_assigned');
            if($query->num_rows() ==0){
                $insert=$this->db->insert('beat_assigned',$data);
                if($insert){
                    return array("status"=>true,"message"=>"Beat Assigned Successfully!");
                }else{
                    $err=$this->db->error();
                    return array("status"=>false,"message"=>$err['message']);
                }
            }else{
                return array("status"=>false,"message"=>"This Beat is Already Assigned to different DSO!");
            }
        }else{
            return array("status"=>false,"message"=>"Beat Already Assigned to This DSO!");
        }

    }
    
    public function getsalarydetails($array){
        if(isset($array['id'])){
            $where=array("t1.id"=>$array['id']);
        }
        else{
            $where=$array;
        }
        $columns = "t1.id,t1.name,t1.designation,t1.mobile,t1.email,t1.date_of_join,t2.salary as basic_salary";
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->from("employees t1");
        $this->db->join("salary t2","t1.id=t2.emp_id and t2.status=1");
        $query=$this->db->get();
        $array=$query->unbuffered_row('array');
        return $array;
    }
    
    public function getmonthlysalary($array){
        $emp_id=$array['emp_id'];
        
        if(isset($array['month'])){
            $month=date('m',strtotime($array['month']));
            $year=date('Y',strtotime($array['month']));
            $first_date=date('Y-m-01',strtotime($array['month']));
        }
        else{
            $month=date('m');
            $year=date('Y');
            $first_date=date('Y-m-01');
        }
        $basic_salary=0;
        $this->db->order_by("added_on desc");
        $getsalary=$this->db->get_where("salary","emp_id='$emp_id' and date(added_on)<'$first_date'");
        if($getsalary->num_rows()==0){
            $basic_salary=$this->db->get_where('employees',array("id"=>$emp_id))->unbuffered_row()->basic_salary;
        }
        else{
            $basic_salary=$getsalary->unbuffered_row()->salary;
        }
        return $basic_salary;
    }
    
    public function salarypayment($data){
        $data['date']=date('Y-m-d');
        $data['added_on']=date('Y-m-d H:i:s');
        
        $month=date('m',strtotime($data['pay_month']));
        $year=date('Y',strtotime($data['pay_month']));
        $where="emp_id='$data[emp_id]' and month(pay_month)='$month' and year(pay_month)='$year'";
        if($this->db->get_where("salary_payment",$where)->num_rows()==0){
            if($this->db->insert("salary_payment",$data)){
                return array("status"=>true,"message"=>"Salary Payment Done!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Salary Already Paid!");
        }
    }
    
    public function getsalaryreport($where=array(),$type="all",$orderby="t1.id",$col=false){
        if($col===false){
            $columns="t1.*, t2.name, t2.mobile, t2.email";
        }
        else{
            $columns="t1.id, t1.`date`, t1.`emp_id`, t1.`name`, t2.mobile, t2.email, t1.`pay_month`, t1.`salary`,t1.`deduction`, t1.`net_salary`";
        }
        $this->db->select($columns);
        $this->db->from("salary_payment t1");
        $this->db->join("employees t2","t1.emp_id=t2.id","left");
        $this->db->where($where);
        $this->db->order_by($orderby);
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
}