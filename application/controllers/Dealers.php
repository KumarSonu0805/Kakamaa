<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealers extends MY_Controller {
	function __construct(){
		parent::__construct();
        //logrequest();
        checklogin();
	}
	
	public function index(){
        $data['title']="Add Dealer";
        //$data['subtitle']="Sample Subtitle";
        $data['breadcrumb']=array();
        $states=$this->master->getstates();
        $options=array(""=>"Select State");
        if(is_array($states)){
            foreach($states as $state){
                $options[$state['id']]=$state['name'];
            }
        }
        $data['states']=$options;
        
        $sales=$this->account->getusers();
        $options=array(""=>"Select Sales Person");
        if(is_array($sales)){
            foreach($sales as $sale){
                $options[$sale['id']]=$sale['name'];
            }
        }
        $data['sales']=$options;
        $data['tomselect']=true;
		$this->template->load('dealers','add',$data);
	}
	
	public function dealerlist(){
        $data['title']="Dealer List";
        //$data['subtitle']="Sample Subtitle";
        $data['breadcrumb']=array();
        $data['datatable']=true;
        //$data['dealers']=$this->dealer->getdealers(['t1.status'=>1]);
		$this->template->load('dealers','list',$data);
	}
    
	public function editdealer($id=NULL){
        if($id===NULL){
            redirect('dealers/dealerlist/');
        }
        $data['title']="Edit dealer";
        //$data['subtitle']="Sample Subtitle";
        $data['breadcrumb']=array();
        $dealer=$this->dealer->getdealers(array("md5(t2.id)"=>$id,'t1.status'=>1),"single");
        if(empty($dealer) || !is_array($dealer)){
            redirect('dealers/dealerlist/');
        }
        $data['dealer']=$dealer;
        $states=$this->common->getstates();
        $options=array(""=>"Select State");
        if(is_array($states)){
            foreach($states as $state){
                $options[$state['id']]=$state['name'];
            }
        }
        $data['states']=$options;
        
        $districts=$this->master->getdistricts($dealer['parent_id']);
        $options=array(""=>"Select District");
        if(is_array($districts)){
            foreach($districts as $district){
                $options[$district['id']]=$district['name'];
            }
        }
        $data['districts']=$options;
        
        $sales=$this->account->getusers(array("e_id!="=>NULL,'role'=>'sales'));
        $options=array(""=>"Select Sales Person");
        if(is_array($sales)){
            foreach($sales as $sale){
                $options[$sale['id']]=$sale['name'];
            }
        }
        $data['sales']=$options;
        
		$this->template->load('dealers','edit',$data);
	}
    
	public function map(){
        $data['title']="Map";
		$this->template->load('dealers','map',$data);
	}
	
    public function getdistricts(){
        $parent_id=$this->input->post('parent_id');
        $districts=$this->master->getdistricts($parent_id);
        $options=array(""=>"Select District");
        if(is_array($districts)){
            foreach($districts as $district){
                $options[$district['id']]=$district['name'];
            }
        }
        echo form_dropdown('area_id',$options,'',array('class'=>'form-control','id'=>'area_id','required'=>'true'));
    }
    
    public function adddealer(){
        if($this->input->post('adddealer')!==NULL){
            $data=$this->input->post();
            $userdata=array("username"=>$data['mobile'],'password'=>12345,'role'=>'dealer',
                            'name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email'],'status'=>1);
            
            unset($data['adddealer']);
            $result=$this->account->register($userdata);
            if($result['status']===true){
                $data['brand_id']=!empty($data['brand_id'])?implode(',',$data['brand_id']):'';
                $data['finance_id']=!empty($data['finance_id'])?implode(',',$data['finance_id']):'';
                
                $upload_path='./assets/images/dealers/';
                $allowed_types='gif|jpg|jpeg|png|svg';
                /*$upload=upload_file('aadhar',$upload_path,$allowed_types,$data['name'].'-aadhar');
                if($upload['status']===true){
                    $data['aadhar']=$upload['path'];
                }
                else{ $data['aadhar']=''; }

                $upload=upload_file('pan',$upload_path,$allowed_types,$data['name'].'-pan');
                if($upload['status']===true){
                    $data['pan']=$upload['path'];
                }
                else{ $data['pan']=''; }*/
            
                $data['user_id']=$result['user_id'];
                $result=$this->dealer->adddealer($data);
                if($result['status']===true){
                    $message ="You account has been created Successfully!<br>Login Details : <br> Email : ".$userdata['username']."<br>";
                    $message.="Password : ".$userdata['password']."<br>";
                    $message.=PROJECT_NAME;
                    //sendemail($data['email'],"Dealer Registration",$message);
                    $this->session->set_flashdata("msg",$result['message']);
                }
                else{
                    $this->session->set_flashdata("err_msg",$result['message']);
                }
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
        }
        redirect('dealers/');
    }
    
    public function updatedealer(){
        if($this->input->post('updatedealer')!==NULL){
            $data=$this->input->post();
            unset($data['updatedealer']);
            
            $upload_path='./assets/images/dealers/';
            $allowed_types='gif|jpg|jpeg|png|svg';
            $upload=upload_file('aadhar',$upload_path,$allowed_types,$data['name'].'-aadhar');
            if($upload['status']===true){
                $data['aadhar']=$upload['path'];
            }

            $upload=upload_file('pan',$upload_path,$allowed_types,$data['name'].'-pan');
            if($upload['status']===true){
                $data['pan']=$upload['path'];
            }
            
            $result=$this->dealer->updatedealer($data);
            if($result['status']===true){
                $this->session->set_flashdata("msg",$result['message']);
            }
            else{
                $this->session->set_flashdata("err_msg",$result['message']);
            }
        }
        redirect('dealers/dealerlist/');
    }
    
    public function approvedealer(){
        if($this->input->post('approvedealer')!==NULL){
            $enc_user_id=$this->input->post('id');
            $result=$this->account->updateuserstatus(['status'=>1],['md5(id)'=>$enc_user_id]);
            if($result['status']===true){
                $user=$this->account->getusers(['md5(id)'=>$enc_user_id],"single");
                $message ="You account has been Activated Successfully!<br>Login Details : <br> Email : ".$user['username']."<br>";
                $message.="Password : ".$user['vp']."<br>";
                $message.=PROJECT_NAME;
                sendemail($user['email'],"Dealer Registration",$message);
            }
            echo json_encode($result);
        }
    }
    
}