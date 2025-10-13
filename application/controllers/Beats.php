<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beats extends MY_Controller {
	function __construct(){
		parent::__construct();
        //logrequest();
        checklogin();
	}
	
	public function index(){
        if($this->session->role!='dso'){
            redirect('/');
        }
        if($this->input->get('type')===NULL){
            $data['title']="Beat Wise Dealer List";
            //$data['subtitle']="Sample Subtitle";
            $data['breadcrumb']=array();
            $data['tabulator']=true;
            $data['user']=getuser();
            $this->template->load('beats','dealerlist',$data);         
        }
        else{
            $dealers=array();
            $where=array('t1.status'=>1);
            $user=getuser();
            if($this->session->role!='dso'){
                $where['t1.emp_user_id']=$user['id'];
            }
            $beat_id=$this->input->get('beat_id');
            if(!empty($beat_id)){
                $where['t1.beat_id']=$beat_id;
                $dealers=$this->dealer->getdealers($where);
            }
            
            echo json_encode($dealers);
        }
	}
    
	public function assignedbeats(){
        if($this->session->role!='dso'){
            redirect('/');
        }
        if($this->input->get('type')===NULL){
            $data['title']="Beat Assigned";
            //$data['subtitle']="Sample Subtitle";
            $data['breadcrumb']=array();
            $data['tabulator']=true;
            $data['user']=getuser();
            $this->template->load('beats','assignedbeats',$data);         
        }
        else{
            $beats=array();
            $user=getuser();
            $where=array('a.emp_id'=>$user['e_id']);
            $beats=$this->employee->getassignedbeats($where);
            
            echo json_encode($beats);
        }
	}
    
}
    