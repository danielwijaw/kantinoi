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

    public function holding()
    {
      $holding = $this->transaksi->getholding();
      echo "<table class=\"table\" width=\"100%\">";
      echo "<tr>
              <td style=\"font-weight: bold\">Nomor Transaksi</td>
              <td style=\"font-weight: bold;text-align:center\">Aksi</td>
            </tr>";
      foreach($holding as $key => $value){
        echo "<tr>
                <td width=\"95%\">".$value['nomor_tr_penjualan']."</td>
                <td width=\"5%\" style=\"text-align:center\"><a href=\"".base_url('/kasir/grosir?tr=').$value['nomor_tr_penjualan']."\"><button class=\"btn btn-primary btn-sm\"><i class=\"fa fa-check\"></i></button></a></td>
              </tr>";
      }
      echo "<tr>
              <td>&nbsp;</td>
              <td><a href=\"".base_url('/kasir/grosir')."\"><button class=\"btn btn-primary btn-sm\">Reset</button></a></td>
            </tr>";
      echo "</table>";
    }

    public function printout()
    {
      sleep(1);
      if(isset($_GET['number'])){
        $datax = $this->transaksi->getdatatransaction($_GET['number']);
        $data = array(
          'data' => $datax
        );
        $this->load->view('/kasir/printout', $data);
      }
    }
}