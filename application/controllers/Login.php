<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper('dnl');
		if(null == $this->session->userdata('set_name_aps')){
			$this->setsession();
			$url = $_SERVER['HTTP_REFERER'];
			redirect($url);
			die();
		}
    }
	
	public function index()
	{
		if(null != $this->session->userdata('nip')){
        	redirect('/');
        	die();
        }
		if(null != $_POST){
			$this->load->model('dataletter');
			$post = array(
				'nip' => escapeString($_POST['nip']),
				'password' => md5(escapeString($_POST['password']))
			);
			$data = $this->dataletter->getlogin($post);
			if($data != null){
				$this->session->set_userdata($data[0]);
				redirect('/');
				die();
			}else{
				$_GET['data'] = array('data' => 'NIP / Password Anda Salah');
			}
		}
		$_GET['asdx'] = 'template/login';
		doViewsLogin($_GET);
	}

	public function setsession()
	{
		$this->load->model('setting');
		$this->load->model('dataletter');
		$data = $this->setting->getsession();
		$this->session->set_userdata($data);
		$post = array(
			'nip' => $this->session->userdata('nip'),
			'password' => $this->session->userdata('password')
		);
		$data = $this->dataletter->getlogin($post);
		$this->session->set_userdata($data[0]);
		// foreach($data as $keyaps => $valueaps){
		// 	echo "<p>Membuat Pengaturan ".$keyaps." = ".$valueaps['setting_val']."<br/></p>";
		// }
		echo "SET NEW SESSION";
		header('Refresh: 1; URL='.base_url('/'));
	}

	public function getsession()
	{
		print_r($_SESSION);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
