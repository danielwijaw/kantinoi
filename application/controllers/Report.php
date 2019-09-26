<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
	
	public function transaksikasir()
	{
		$_GET['asdx'] = 'report/kasir';
		doViews($_GET);
	}
	
	public function transaksipiutang()
	{
		$_GET['asdx'] = 'report/piutang';
		doViews($_GET);
	}
	
	public function transaksikasirout()
	{
		$_GET['tanggal'] = explode(" - ", $_GET['date']);
		$tanggalawal 	= $_GET['tanggal'][0];
		$tanggalakhir 	= $_GET['tanggal'][1];
		if($_GET['admin']!='null'){
			$admin = " AND created_by = '".$_GET['admin']."'";
		}else{
			$admin = "";
		}
		$query = $this->db->query("
		SELECT
			* 
		FROM
			tr_penjualan 
		WHERE
			payment_method = 'tunai' 
			AND nomor_tr_penjualan != ''
			AND SUBSTR( deleted_at, 1, 10 ) >= '".$tanggalawal."' 
			AND SUBSTR( deleted_at, 1, 10 ) <= '".$tanggalakhir."'
			".$admin."
		ORDER BY nomor_tr_penjualan
		");
		$result = $query->result_array();
		$data = [
			'result' => $result
		];
		$this->load->view('/report/kasirout', $data);
	}
	
	public function transaksipiutangout()
	{
		$_GET['tanggal'] = explode(" - ", $_GET['date']);
		$tanggalawal 	= $_GET['tanggal'][0];
		$tanggalakhir 	= $_GET['tanggal'][1];
		$query = $this->db->query("
		SELECT
			tr_stokbarang.*,
			tm_stokbarang.stokbarang
		FROM
			tr_stokbarang, tm_stokbarang 
		WHERE
			nomor_tr = '0' 
			AND tm_stokbarang.reg_stokbarang = tr_stokbarang.reg_stokbarang
			AND SUBSTR( tr_stokbarang.created_at, 1, 10 ) >= '".$tanggalawal."' 
			AND SUBSTR( tr_stokbarang.created_at, 1, 10 ) <= '".$tanggalakhir."'
		");
		$result = $query->result_array();
		$data = [
			'result' => $result
		];
		$this->load->view('/report/piutangout', $data);
	}


	
}