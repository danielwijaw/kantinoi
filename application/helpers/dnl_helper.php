<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if ( ! function_exists('escapeString'))
    {
        function escapeString($val)
        {
            $db = get_instance()->db->conn_id;
		    $val = mysqli_real_escape_string($db, $val);
		    return $val;
        }

        function doViews($GET) 
        {
            $CI = &get_instance();
            if(!isset($GET['data'])){
                $GET['data'] = array('data' => '');
            }else{
                $GET['data'] = $GET['data'];
            }
            if(!isset($GET['ajax'])){
                $CI->load->view('template/header');
            }
            if(isset($GET['asdx'])){
                $CI->load->view($GET['asdx'], $GET['data']);
            }
            if(!isset($GET['ajax'])){
                $CI->load->view('template/footer');
            }
        }

        function doViewsLogin($GET) 
        {
            $CI = &get_instance();
            if(!isset($GET['data'])){
                $GET['data'] = array('data' => '');
            }else{
                $GET['data'] = $GET['data'];
            }
            if(!isset($GET['ajax'])){
                $CI->load->view('template/headerlogin');
            }
            if(isset($GET['asdx'])){
                $CI->load->view($GET['asdx'], $GET['data']);
            }
            if(!isset($GET['ajax'])){
                $CI->load->view('template/footerlogin');
            }
        }
    }