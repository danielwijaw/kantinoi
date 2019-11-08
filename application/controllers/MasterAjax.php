<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterAjax extends CI_Controller {

	public function supplier()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$supply = $this->mastermodel->getjumlahbarangpersupplier();
			$total = $this->mastermodel->getdatasuppliercount('1');
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$link_prev)."`, `mastersupplierajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$i)."`, `mastersupplierajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$link_next)."`, `mastersupplierajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatasupplier('1',$datapage,'20');
			$data = array('data' => $data,'button'=>$button,'supply'=>$supply);
			$this->load->view('/master/ajaxsupplier', $data);
		}else{
			$this->load->model('mastermodel');
			$supply = $this->mastermodel->getjumlahbarangpersupplier();
			$total = $this->mastermodel->getdatasuppliercountsearch('1',$_GET['cari']);
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$link_prev)."`, `mastersupplierajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$i.'&cari='.$_GET['cari'])."`, `mastersupplierajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/supplier?page='.$link_next)."`, `mastersupplierajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatasuppliersearch('1',$datapage,'20',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button,'supply'=>$supply);
			$this->load->view('/master/ajaxsupplier', $data);
		}
	}

	public function jenisbarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatajenisbarangcount('1');
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$link_prev)."`, `masterjenisbarangajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$i)."`, `masterjenisbarangajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$link_next)."`, `masterjenisbarangajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatajenisbarang('1',$datapage,'20');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxjenisbarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatajenisbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$link_prev)."`, `masterjenisbarangajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterjenisbarangajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/jenisbarang?page='.$link_next)."`, `masterjenisbarangajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatajenisbarangsearch('1',$datapage,'20',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxjenisbarang', $data);
		}
	}

	public function stokbarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcount('1');
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$link_prev)."`, `masterstokbarangajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$i)."`, `masterstokbarangajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$link_next)."`, `masterstokbarangajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarang('1',$datapage,'20');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxstokbarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$link_prev)."`, `masterstokbarangajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterstokbarangajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/stokbarang?page='.$link_next)."`, `masterstokbarangajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarangsearch('1',$datapage,'20',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxstokbarang', $data);
		}
	}

	public function hargabarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatahargabarangcount('1');
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$link_prev)."`, `masterhargabarangajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$i)."`, `masterhargabarangajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$link_next)."`, `masterhargabarangajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatahargabarang('1',$datapage,'20');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxhargabarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatahargabarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$link_prev)."`, `masterhargabarangajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterhargabarangajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/hargabarang?page='.$link_next)."`, `masterhargabarangajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatahargabarangsearch('1',$datapage,'20',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxhargabarang', $data);
		}
	}

	public function pelanggan()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapelanggancount('1');
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$link_prev)."`, `masterpelangganajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$i)."`, `masterpelangganajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$link_next)."`, `masterpelangganajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatapelanggan('1',$datapage,'20');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxpelanggan', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapelanggancountsearch('1',$_GET['cari']);
			$row = ceil($total / 20);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$link_prev)."`, `masterpelangganajax`)' href='javascript:void(0)'>&laquo;</a></li>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$xxz.'&cari='.$_GET['cari'])."`, `masterpelangganajax`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "<li><a onclick='ajaxpaging(`".base_url('/masterajax/pelanggan?page='.$link_next)."`, `masterpelangganajax`)' href='javascript:void(0)'>&raquo;</a></li>";
			$button .= "</ul>";
			if($total <= 20){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatapelanggansearch('1',$datapage,'20',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/master/ajaxpelanggan', $data);
		}
	}
}
