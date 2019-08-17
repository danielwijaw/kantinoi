<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterAjax extends CI_Controller {

	public function stokbarang()
	{
		$this->load->model('mastermodel');
		$total = $this->mastermodel->getdatasuppliercount('1');
		$row = ceil($total / 5);
		$button = "<ul class='pagination'>";
		for ($x = 0; $x < $row; $x++) {
			$xz = $x + 1;
			$xxz = ($xz*5)-5;
		    $button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$xxz)."`)' href='javascript:void(0)'>$xz</a></li>";
		} 
		$button .= "</ul>";
		if($total <= 5){
			$button = '';
		}else{
			$button = $button;
		}
		$datapage = '';
		if(isset($_GET['page']))
		{
			$datapage = $_GET['page'];
		}
		$data = $this->mastermodel->getdatasupplier('1',$datapage,'5');
		$data = array('data' => $data,'button'=>$button);
		// $this->load->view('/front/suratmasuk', $data);
		print_r($data);
	}
}
