<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

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

	public function stokbarang()
	{
		$_GET['asdx'] = 'master/stokbarang';
		doViews($_GET);
	}

	public function datasupplier()
	{
		$_GET['asdx'] = 'master/datasupplier';
		doViews($_GET);
	}

	public function datapelanggan()
	{
		$_GET['asdx'] = 'master/datapelanggan';
		doViews($_GET);
	}

	public function hargabarang()
	{
		$_GET['asdx'] = 'master/hargabarang';
		doViews($_GET);
	}

	public function jenisbarang()
	{
		$_GET['asdx'] = 'master/jenisbarang';
		doViews($_GET);
	}
}
