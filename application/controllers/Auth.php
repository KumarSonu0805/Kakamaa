<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	function __construct(){
		parent::__construct();
        //$this->require_role('admin');
	}
    
    public function index(){
        $data['title']='Login';
        $this->template->load('auth','login',$data,'auth');
    }
    
	public function validatelogin(){
        if($this->input->post('login')!==NULL){
            $validation=$this->form_validation->run('login');
            $errors=$this->form_validation->error_array();
            if ($validation === FALSE && !empty($errors)) {
                // Handle validation errors
                $errors=$this->form_validation->error_array();
                $errors=implode('<br>',$errors);
                $this->set_flash('logerr',$errors);
            }
            else{
                $data=$this->input->post();
                unset($data['login']);
                $result=$this->account->login($data);
                //print_pre($result,true);
                if($result['status']===true){
                    $user=$result['user'];
                    if($user['role']=='admin' || $user['role']=='member'){
                        $this->session->unset_userdata('sess_type');
                        $this->startsession($user);
                        loginredirect();
                    }
                    else{ 
                        $this->set_flash('logerr',"Wrong Username or Password!");
                        redirect('login/');
                    }
                }
                else{ 
                    $this->set_flash('logerr',$result['message']);
                    redirect('login/');
                }
            }
        }
        redirect('login/');
	}
}