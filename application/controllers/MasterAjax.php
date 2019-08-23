<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterAjax extends CI_Controller {

	public function supplier()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatasuppliercount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$xxz)."`, `mastersupplierajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$this->load->view('/master/ajaxsupplier', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatasuppliercountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$xxz.'&cari='.$_GET['cari'])."`, `mastersupplierajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatasuppliersearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxsupplier', $data);
		}
	}

	public function jenisbarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatajenisbarangcount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$xxz)."`, `masterjenisbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatajenisbarang('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxjenisbarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatajenisbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterjenisbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatajenisbarangsearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxjenisbarang', $data);
		}
	}

	public function stokbarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$xxz)."`, `masterstokbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatastokbarang('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxstokbarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterstokbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatastokbarangsearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxstokbarang', $data);
		}
	}

	public function hargabarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatahargabarangcount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$xxz)."`, `masterhargabarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatahargabarang('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxhargabarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatahargabarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterhargabarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatahargabarangsearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxhargabarang', $data);
		}
	}

	public function pelanggan()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapelanggancount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$xxz)."`, `masterpelangganajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatapelanggan('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxpelanggan', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapelanggancountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterpelangganajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatapelanggansearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxpelanggan', $data);
		}
	}
}
