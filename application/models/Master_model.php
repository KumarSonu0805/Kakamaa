<?php
class Master_model extends CI_Model{
	
	function __construct(){
		parent::__construct(); 
		$this->db->db_debug = false;
	}
    
    public function savestate($data){
        if($this->db->get_where('states',['LOWER(name)'=>strtolower($data['name'])])->num_rows()==0){
            $data['added_on']=$data['updated_on']=date('Y-m-d H:i:s');
            if($this->db->insert('states',$data)){
                return array("status"=>true,"message"=>"State Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"State Already Added!");
        }
    }

    public function getstates($where=array(),$type="all",$order_by="id"){
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('states t1');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatestate($data){
        if($this->db->get_where('states',['LOWER(name)'=>strtolower($data['name']),'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            $data['updated_on']=date('Y-m-d H:i:s');
            logupdateoperations('states',$data,$where);
            if($this->db->update('states',$data,$where)){
                return array("status"=>true,"message"=>"State Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"State Already Added!");
        }
    }

    public function savedistrict($data){
        if($this->db->get_where('districts',['LOWER(name)'=>strtolower($data['name']),'state_id'=>$data['state_id']])->num_rows()==0){
            $data['added_on']=$data['updated_on']=date('Y-m-d H:i:s');
            if($this->db->insert('districts',$data)){
                return array("status"=>true,"message"=>"District Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"District Already Added!");
        }
    }

    public function getdistricts($where=array(),$type="all",$order_by="t1.id",$columns=false){
        if($columns===false){
            $columns="t1.*,t2.name as state_name";
        }
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('districts t1');
        $this->db->join('states t2','t1.state_id=t2.id');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatedistrict($data){
        if($this->db->get_where('districts',['LOWER(name)'=>strtolower($data['name']),'state_id'=>$data['state_id'],'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            $data['updated_on']=date('Y-m-d H:i:s');
            logupdateoperations('districts',$data,$where);
            if($this->db->update('districts',$data,$where)){
                return array("status"=>true,"message"=>"District Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"District Already Added!");
        }
    }

    public function savearea($data){
        if($this->db->get_where('areas',['LOWER(name)'=>strtolower($data['name']),'state_id'=>$data['state_id'],'district_id'=>$data['district_id']])->num_rows()==0){
            $data['added_on']=$data['updated_on']=date('Y-m-d H:i:s');
            if($this->db->insert('areas',$data)){
                return array("status"=>true,"message"=>"Area Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Area Already Added!");
        }
    }

    public function getareas($where=array(),$type="all",$order_by="t1.id",$columns=false){
        if($columns===false){
            $columns="t1.*,t2.name as state_name,t3.name as district_name";
        }
        $this->db->select($columns);
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('areas t1');
        $this->db->join('states t2','t1.state_id=t2.id');
        $this->db->join('districts t3','t1.district_id=t3.id');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatearea($data){
        if($this->db->get_where('areas',['LOWER(name)'=>strtolower($data['name']),'state_id'=>$data['state_id'],'district_id'=>$data['district_id'],'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            $data['updated_on']=date('Y-m-d H:i:s');
            logupdateoperations('areas',$data,$where);
            if($this->db->update('areas',$data,$where)){
                return array("status"=>true,"message"=>"Area Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Area Already Added!");
        }
    }

    public function savebank($data){
        if($this->db->get_where('banks',['LOWER(name)'=>strtolower($data['name'])])->num_rows()==0){
            if($this->db->insert('banks',$data)){
                return array("status"=>true,"message"=>"Bank Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Bank Already Added!");
        }
    }

    public function getbanks($where=array(),$type="all",$order_by="id"){
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('banks t1');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatebank($data){
        if($this->db->get_where('banks',['LOWER(name)'=>strtolower($data['name']),'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            logupdateoperations('banks',$data,$where);
            if($this->db->update('banks',$data,$where)){
                return array("status"=>true,"message"=>"Bank Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Bank Already Added!");
        }
    }

    public function savefinance($data){
        if($this->db->get_where('finance_companies',['LOWER(name)'=>strtolower($data['name'])])->num_rows()==0){
            if($this->db->insert('finance_companies',$data)){
                return array("status"=>true,"message"=>"Finance Company Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Finance Company Already Added!");
        }
    }

    public function getfinances($where=array(),$type="all",$order_by="id"){
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('finance_companies t1');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatefinance($data){
        if($this->db->get_where('finance_companies',['LOWER(name)'=>strtolower($data['name']),'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            logupdateoperations('finance_companies',$data,$where);
            if($this->db->update('finance_companies',$data,$where)){
                return array("status"=>true,"message"=>"Finance Company Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Finance Company Already Added!");
        }
    }
    
    public function savebrand($data){
        if($this->db->get_where('brands',['LOWER(name)'=>strtolower($data['name'])])->num_rows()==0){
            if($this->db->insert('brands',$data)){
                return array("status"=>true,"message"=>"Brand Added Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Brand Already Added!");
        }
    }

    public function getbrands($where=array(),$type="all",$order_by="id"){
        $this->db->where($where);
        $this->db->order_by($order_by);
        $this->db->from('brands t1');
        $query=$this->db->get();
        if($type=='all'){
            $array=$query->result_array();
        }
        else{
            $array=$query->unbuffered_row('array');
        }
        return $array;
    }
    
    public function updatebrand($data){
        if($this->db->get_where('brands',['LOWER(name)'=>strtolower($data['name']),'id!='=>$data['id']])->num_rows()==0){
            $where=array('id'=>$data['id']);
            unset($data['id']);
            logupdateoperations('brands',$data,$where);
            if($this->db->update('brands',$data,$where)){
                return array("status"=>true,"message"=>"Brand Updated Successfully!");
            }
            else{
                $error=$this->db->error();
                return array("status"=>false,"message"=>$error['message']);
            }
        }
        else{
            return array("status"=>false,"message"=>"Brand Already Added!");
        }
    }

}
