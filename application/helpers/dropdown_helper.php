<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
    if(!function_exists('state_dropdown')){
        function state_dropdown($where=array('status'=>1)){
            $CI = get_instance();
            $options=array(''=>'Select State');
            $states=$CI->master->getstates($where);
            if(!empty($states)){
                foreach($states as $state){
                    $options[$state['id']]=$state['name'];
                }
            }
            return $options;
        }
    }

    if(!function_exists('district_dropdown')){
        function district_dropdown($where=array('t1.status'=>1)){
            $CI = get_instance();
            $options=array(''=>'Select District');
            $districts=$CI->master->getdistricts($where);
            if(!empty($districts)){
                foreach($districts as $district){
                    $options[$district['id']]=$district['name'];
                }
            }
            return $options;
        }
    }

    if(!function_exists('area_dropdown')){
        function area_dropdown($where=array('t1.status'=>1)){
            $CI = get_instance();
            $options=array(''=>'Select Area');
            $areas=$CI->master->getareas($where);
            if(!empty($areas)){
                foreach($areas as $area){
                    $options[$area['id']]=$area['name'];
                }
            }
            return $options;
        }
    }