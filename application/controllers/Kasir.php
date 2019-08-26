<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

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

    public function grosir()
    {
		$_GET['asdx'] = 'kasir/grosir';
		doViews($_GET);
    }
    public function retail()
    {
		$_GET['asdx'] = 'kasir/retail';
		doViews($_GET);
    }
}