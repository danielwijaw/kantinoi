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
                    'jumlah_barang'                 => ((int) escapeString($_POST['jumlah_barang']) + $getbarang['jumlah_barang'] )
                );
                $this->db->where('id_tr_penjualan', $getbarang['id_tr_penjualan']);
                $this->db->update('tr_penjualan', $datains);
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
            }
            $datastok = array(
                'reg_stokbarang'                => escapeString($_POST['kode_barang']),
                'stok_awal'                     => escapeString($_POST['jumlah_barang_stok']),
                'stok_perbarui'                 => ((int) escapeString($_POST['jumlah_barang_stok']) - escapeString($_POST['jumlah_barang']) )
            );
            $this->db->insert('tr_stokbarang', $datastok);
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
                'status_hold'   => '2'
            );
            $this->db->where('nomor_tr_penjualan', $_GET['id']);
            $this->db->update('tr_penjualan', $dataupdate);
            echo "Berhasil";
        }
    }
}
