<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	if(!function_exists('print_pre')) {
  		function print_pre($data,$die=false) {
            echo '<pre>'; print_r($data); echo "</pre>";
            if($die){ die; }
		}  
	}

	if(!function_exists('success_msg')) {
  		function success_msg($key='msg') {
            $CI = get_instance();
            $message=$CI->session->flashdata($key);
            $message=$message??'';
            return $message;
		}  
	}

	if(!function_exists('error_msg')) {
  		function error_msg($key='err_msg') {
            $CI = get_instance();
            $message=$CI->session->flashdata($key);
            $message=$message??'';
            return $message;
		}  
	}
