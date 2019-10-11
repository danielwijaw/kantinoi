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

      $nomorpl = $this->transaksi->getpelanggan($data['nomor_transaksi_penjualan']);
      $_GET['val'] = $nomorpl['reg_pelanggan'];
      $_GET['text'] = $nomorpl['pelanggan'];

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
      sleep(1);
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
              <td><a href=\"".base_url('/kasir/grosir')."\"><button id=\"reset_kasir\" class=\"btn btn-primary btn-sm\">Reset</button></a></td>
            </tr>";
      echo "</table>";
    }

    public function finished()
    {
      $holding = $this->transaksi->getfinished();
      echo "<table class=\"table\" width=\"100%\">";
      echo "<tr>
              <td style=\"font-weight: bold\">Nomor Transaksi</td>
              <td style=\"font-weight: bold;text-align:center\">Aksi</td>
            </tr>";
      foreach($holding as $key => $value){
        echo "<tr>
                <td width=\"95%\">".$value['nomor_tr_penjualan']."</td>
                <td width=\"5%\" style=\"text-align:center\"><a target=\"_blank\" href=\"".base_url('/kasir/printout?number=').$value['nomor_tr_penjualan']."\"><button class=\"btn btn-primary btn-sm\"><i class=\"fa fa-check\"></i></button></a></td>
              </tr>";
      }
      echo "</table>";
    }

    public function printout()
    {
      sleep(1);
      if(isset($_GET['number'])){
        $datax = $this->transaksi->getdatatransaction($_GET['number']);
        if(!isset($_GET['rupiah'])){
          $_GET = json_decode($datax[0]['pembayaran_terakhir'], true);
          $_GET['number'] = $_GET['id'];
        }else{
          $_GET = $_GET;
        }
        $data = array(
          '_GET' => $_GET,
          'data' => $datax
        );
        $this->load->view('/kasir/printout', $data);
      }
    }

    public function stokbarang()
    {
      if(isset($_GET['faktur'])){
        $data = array(
          'nomor_faktur' => $_GET['faktur']
        );
      }else{
        $data = array(
          'nomor_faktur' => ""
        );
      }
      $_GET['data'] = $data;
      $_GET['asdx'] = 'kasir/stokbarang';
      doViews($_GET);
    }

    public function stokbarangtransaction()
    {
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
        AND harga_default != ''
	      AND JSON_EXTRACT(harga_default, \"$.nofak\") = \"".$_GET['nofak']."\"
      ");
      $result = $query->result_array();
      $data = [
        'result' => $result
      ];
      $this->load->view('/report/pembelianout', $data);
    }
}