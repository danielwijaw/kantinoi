<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasirtr extends CI_Controller {

	public function __construct()
    {
			parent::__construct();
			$this->load->helper('dnl');
            $this->load->model('mastermodel');
            if(null == $this->session->userdata('nip')){
            	redirect('/login/index/');
            	die();
            }
    }

    public function insert()
    {
        error_reporting(0);
        // die();
        if(isset($_POST)){
            $this->load->model('transaksi');
            $getbarang = $this->transaksi->getbarang($_POST['nomor_transaksi_penjualan'], $_POST['kode_barang']);
            
            if(isset($_POST['pelanggan_kasir'])){
                $hargafix = escapeString($_POST['diskon_harga']);
            }else{
                $hargafix = escapeString($_POST['harga_barang_retail']);
            }
            if(!empty($getbarang)){
                $datains = array(
                    'jumlah_barang'                 => ((int) escapeString($_POST['jumlah_barang']) + $getbarang['jumlah_barang'] ),
                    'created_at'                    => date('Y-m-d H:i:s')
                );
                $this->db->where('id_tr_penjualan', $getbarang['id_tr_penjualan']);
                $this->db->update('tr_penjualan', $datains);

                $this->db->where('nomor_tr', $_POST['nomor_transaksi_penjualan']);
                $this->db->where('reg_stokbarang', $_POST['kode_barang']);
                $this->db->set('stok_perbarui', 'stok_perbarui-'.escapeString($_POST['jumlah_barang']), FALSE);
                $this->db->set('created_at', date('Y-m-d H:i:s'));
                $this->db->update('tr_stokbarang');
            }else{
                $datains = array(
                    'nomor_tr_penjualan'            => escapeString($_POST['nomor_transaksi_penjualan']),
                    'id_barang' 	                => escapeString($_POST['kode_barang']),
                    'nama_barang'           	    => escapeString($_POST['nama_barang_stok']),
                    'jumlah_barang'         	    => escapeString($_POST['jumlah_barang']),
                    'satuan' 	                    => escapeString($_POST['satuan_barang_stok']),
                    'harga_retail'        	        => escapeString($_POST['harga_barang_retail']),
                    'harga_grosir'        	        => escapeString($_POST['harga_barang_grosir']),
                    'created_by' 	                => escapeString($_POST['admin_transaksi_penjualan']),
                    'id_pelanggan' 	                => escapeString($_POST['pelanggan_kasir']),
                    'harga_fix' 	                => $hargafix,
                );
                $this->db->insert('tr_penjualan', $datains);
                $datastok = array(
                    'nomor_tr'                      => escapeString($_POST['nomor_transaksi_penjualan']),
                    'reg_stokbarang'                => escapeString($_POST['kode_barang']),
                    'stok_awal'                     => escapeString($_POST['jumlah_barang_stok']),
                    'stok_perbarui'                 => ((int) escapeString($_POST['jumlah_barang_stok']) - escapeString($_POST['jumlah_barang']) )
                );
                $this->db->insert('tr_stokbarang', $datastok);
            }
            $dataupdate = array(
                'jumlahbarang'                  => ((int) escapeString($_POST['jumlah_barang_stok']) - escapeString($_POST['jumlah_barang']) ),
                'updated_at'                    => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_stokbarang', $_POST['kode_barang']);
            $this->db->update('tm_stokbarang', $dataupdate);
            echo "Berhasil";
        }
    }

    public function holdingpayment()
    {
        if(isset($_GET['id'])){
            $dataupdate = array(
                'status_hold'   => '2',
                'updated_at'    => date('Y-m-d H:i:s')
            );
            $this->db->where('nomor_tr_penjualan', $_GET['id']);
            $this->db->update('tr_penjualan', $dataupdate);
            echo "Berhasil";
        }
    }

    public function deleteditemkasir()
    {
        if(isset($_GET['id'])){
            // DELETED TRANSAKSI PENJUALAN
            $dataupdatepenjualan = array(
                'status_muncul'   => '2',
                'deleted_at'      => date('Y-m-d H:i:s')
            );
            $this->db->where('id_tr_penjualan', $_GET['id']);
            $this->db->update('tr_penjualan', $dataupdatepenjualan);
            // DELETED ITEM TRANSAKSI STOK BARANG
            $dataupdatestok = array(
                'status_muncul'   => '2',
                'deleted_at'      => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_stokbarang', $_GET['id_barang']);
            $this->db->where('created_at', $_GET['created_at']);
            $this->db->update('tr_stokbarang', $dataupdatestok);
            // MEMBALIKAN ITEM BARANG
            $this->db->where('reg_stokbarang', $_GET['id_barang']);
            $this->db->set('jumlahbarang', 'jumlahbarang+'.$_GET['jumlah_barang'], FALSE);
            $this->db->update('tm_stokbarang');
            echo "Berhasil";
        }
    }

    public function deletedtransaction()
    {
        if(isset($_GET['id'])){
            $this->load->model('transaksi');
            $getbarang = $this->transaksi->getransactionnow($_GET['id']);
            foreach($getbarang as $key => $value){
                $dataupdatepenjualan[] = array(
                    'id_tr_penjualan' => $value['id_tr_penjualan'],
                    'status_muncul'   => '2',
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

        }
            
        print_r($getbarang);
    }
}
