<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiC extends CI_Controller {

	public function __construct()
    {
			parent::__construct();
			// doViews($_GET); kue go template
			$this->load->helper('dnl');
			$this->load->model('transaksi');
        if(null == $this->session->userdata('nip')){
          redirect('/login/index/');
          die();
        }
    }

    public function stok()
	{
		$_GET['asdx'] = 'transaksi/stokbarang';
		doViews($_GET);
	}

	public function stokbarang()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/transaksiC/stokbarang?page='.$xxz)."`, `mastertransaksistokbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatapiutang('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/transaksiC/stokbarang?page='.$xxz.'&cari='.$_GET['cari'])."`, `mastertransaksistokbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatapiutangsearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarang', $data);
		}
	}

	public function retur(){
		$_GET['asdx'] = 'transaksi/retur';
		doViews($_GET);
	}

	public function returajax()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatareturcount();
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/transaksiC/returajax?page='.$xxz)."`, `returajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdataretur($datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxretur', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatareturcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/transaksiC/returajax?page='.$xxz.'&cari='.$_GET['cari'])."`, `returajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdataretursearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxretur', $data);
		}
	}

    public function hapusdatatransaksi()
    {
        if(isset($_GET['id'])){
            $this->load->model('transaksi');
			$getbarang = $this->transaksi->getransactionall($_GET['id']);
            foreach($getbarang as $key => $value){
                $dataupdatepenjualan[] = array(
                    'id_tr_penjualan' => $value['id_tr_penjualan'],
                    'status_muncul'   => '2',
                    'status_hold'     => '4',
                    'deleted_at'      => date('Y-m-d H:i:s')
                );
                // DELETED ITEM TRANSAKSI STOK BARANG
                $dataupdatestok[] = array(
                    'reg_stokbarang'  => $value['id_barang'],
                    'created_at'      => $value['created_at'],
                    'status_muncul'   => '2',
                    'deleted_at'      => date('Y-m-d H:i:s')
                );
                // MEMBALIKAN ITEM BARANG
                $backingitem[] = array(
                    'reg_stokbarang'  => $value['id_barang'],
                    'jumlahbarang'    => array( 'jumlahbarang +' . $value['jumlah_barang'] )
                );
            }
            $this->db->update_batch('tr_penjualan',$dataupdatepenjualan, 'id_tr_penjualan');
            $this->db->update_batch('tr_stokbarang',$dataupdatestok, 'created_at');
            $this->db->protect_identifiers(FALSE);
            $this->db->update_batch('tm_stokbarang',$backingitem, 'reg_stokbarang');
			redirect('/transaksic/retur/');
        }
	}
	
	public function stokfaktur()
	{
		$_GET['asdx'] = 'transaksi/stokbarangfak';
		doViews($_GET);
	}

	public function stokbarangfaktur()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountfak('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/transaksiC/stokbarangfaktur?page='.$xxz)."`, `mastertransaksistokbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatapiutangfak('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarangfak', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountsearchfak('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/transaksiC/stokbarangfaktur?page='.$xxz.'&cari='.$_GET['cari'])."`, `mastertransaksistokbarangajax`)' href='javascript:void(0)'>$xz</a></li>";
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
			$data = $this->mastermodel->getdatapiutangsearchfak('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarangfak', $data);
		}
	}
}