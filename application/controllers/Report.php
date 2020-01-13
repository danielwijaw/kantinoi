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
	
	public function rekappembelian()
	{
		$_GET['asdx'] = 'report/rekappembelian';
		doViews($_GET);
	}
	
	public function stokopname()
	{
		$_GET['asdx'] = 'report/stokopname';
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
			tr_penjualan.*, tr_stokbarang.harga_default 
		FROM
			tr_penjualan
		INNER JOIN tr_stokbarang
			ON tr_penjualan.id_barang = tr_stokbarang.reg_stokbarang and tr_stokbarang.nomor_tr = '0' and tr_stokbarang.stok_perbarui != '0' and tr_stokbarang.harga_default != ''
		WHERE
			payment_method = 'tunai' 
			AND tr_penjualan.status_hold != '4'
			AND tr_penjualan.nomor_tr_penjualan != ''
			AND tr_penjualan.deleted_at >= '".$tanggalawal." 00:00:00' 
			AND tr_penjualan.deleted_at <= '".$tanggalakhir." 23:59:59'
			".$admin."
		GROUP BY tr_penjualan.id_tr_penjualan
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
		$cari = "";
		if(!empty($_GET['cari'])){
			$cari = "
				AND (JSON_EXTRACT(harga_default, \"$.nofak\") like \"%".$_GET['cari']."%\"
				or tm_stokbarang.stokbarang like '%".$_GET['cari']."%')
			";
		}
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
			AND harga_default != ''
			".$cari."
		");
		$result = $query->result_array();
		$data = [
			'result' => $result
		];
		$this->load->view('/report/piutangout', $data);
	}

	public function stokopnameout()
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
			AND harga_default = ''
		");
		$result = $query->result_array();
		$data = [
			'result' => $result
		];
		$this->load->view('/report/stokopnameout', $data);
	}
	
	public function transaksipembelianout()
	{
		$_GET['tanggal'] = explode(" - ", $_GET['date']);
		$tanggalawal 	= $_GET['tanggal'][0];
		$tanggalakhir 	= $_GET['tanggal'][1];
		$cari = "";
		if(!empty($_GET['cari'])){
			$cari = "
				AND (JSON_EXTRACT(harga_default, \"$.nofak\") like \"%".$_GET['cari']."%\"
				or tm_stokbarang.stokbarang like '%".$_GET['cari']."%'
				or tm_supplier.nama_supplier like '%".$_GET['cari']."%')
			";
		}
		$query = $this->db->query("
		SELECT
			tr_stokbarang.*,
			tm_stokbarang.stokbarang,
			tm_supplier.nama_supplier
		FROM
			tr_stokbarang, tm_stokbarang, tm_supplier
		WHERE
			nomor_tr = '0' 
			AND tm_stokbarang.reg_stokbarang = tr_stokbarang.reg_stokbarang
			AND tm_stokbarang.reg_supplier = tm_supplier.reg_supplier
			AND SUBSTR( tr_stokbarang.created_at, 1, 10 ) >= '".$tanggalawal."' 
			AND SUBSTR( tr_stokbarang.created_at, 1, 10 ) <= '".$tanggalakhir."'
			AND harga_default != ''
			".$cari."
		");
		$result = $query->result_array();
		$data = [
			'result' => $result
		];
		$this->load->view('/report/pembelianout', $data);
	}


	
}
