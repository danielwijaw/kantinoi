<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

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

    public function grosir()
    {
      if(isset($_GET['tr'])){
        $data = array(
          'nomor_transaksi_penjualan' => $_GET['tr']
        );
      }else{
        $nomortr = $this->transaksi->getnomorpenjualandaily();
        $data = array(
          'nomor_transaksi_penjualan' => $nomortr['nomor_transaksi_penjualan']
        );
      }
      $_GET['data'] = $data;
      $_GET['asdx'] = 'kasir/grosir';
      doViews($_GET);
    }
    
    public function retail()
    {
      $_GET['asdx'] = 'kasir/retail';
      doViews($_GET);
    }

    public function transaction()
    {
      $transaction = $this->transaksi->getransactionnow($_GET['number_transaction']);
      $data = array(
        'transaction' => $transaction
      );
      $this->load->view('/kasir/transaction', $data);
    }
}