<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
    {
			parent::__construct();
			// doViews($_GET); kue go template
			$this->load->helper('dnl');
            if(null == $this->session->userdata('nip')){
            	redirect('/login/index/');
            	die();
            }
    }
	
	public function index()
	{
		$_GET['asdx'] = 'front/index';
		doViews($_GET);
	}

	
}
