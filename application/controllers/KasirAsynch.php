<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KasirAsynch extends CI_Controller {

	public function __construct()
    {
			parent::__construct();
            $this->load->helper(array('form', 'url', 'dnl'));
            // if(null == $this->session->userdata('nip')){
            // 	redirect('/login/index/');
            // 	die();
            // }
    }

    public function insert_not_empty_getbarang_update_tr_penjualan()
    {
        $this->db->where('id_tr_penjualan', $_GET['getbarang']['id_tr_penjualan']);
        $this->db->update('tr_penjualan', $_GET['datains']);
    }

    public function insert_not_empty_getbarang_update_tr_stokbarang()
    {
        $this->db->where('nomor_tr', $_GET['post']['nomor_transaksi_penjualan']);
        $this->db->where('reg_stokbarang', $_GET['post']['kode_barang']);
        $this->db->set('stok_perbarui', 'stok_perbarui-'.escapeString($_GET['post']['jumlah_barang']), FALSE);
        $this->db->set('created_at', date('Y-m-d H:i:s'));
        $this->db->update('tr_stokbarang');
    }

    public function insert_empty_tr_penjualan()
    {
        $this->db->insert('tr_penjualan', $_GET['datains']);
    }

    public function insert_empty_tr_stokbarang()
    {
        $this->db->insert('tr_stokbarang', $_GET['datastok']);
    }

    public function insert_update_stok_barang()
    {
        $this->db->where('reg_stokbarang', $_GET['post']['kode_barang']);
        $this->db->update('tm_stokbarang', $_GET['dataupdate']);
    }

}
