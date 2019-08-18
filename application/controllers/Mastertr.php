<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mastertr extends CI_Controller {

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

    public function updatedatasupplier()
    {
        if(isset($_POST)){
            $data = array(
                    'nama_supplier' 	=> escapeString($_POST['nama_supplier_updated_'.$_GET['id']]),
                    'atas_nama' 		=> escapeString($_POST['atas_nama_updated_'.$_GET['id']]),
                    'kontak_supplier' 	=> escapeString($_POST['kontak_nama_updated_'.$_GET['id']]),
                    'alamat' 			=> escapeString($_POST['alamat_supplier_updated_'.$_GET['id']]),
                    'id_kelurahan' 		=> escapeString($_POST['kelurahan_supplier_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_supplier', $_GET['id']);
            $this->db->update('tm_supplier', $data);
            echo "Berhasil";
        }
    }

    public function insertdatasupplier()
    {
        if(isset($_POST)){
            $data = array(
                    'nama_supplier' 	=> escapeString($_POST['nama_supplier']),
                    'atas_nama' 		=> escapeString($_POST['atas_nama']),
                    'kontak_supplier' 	=> escapeString($_POST['kontak_nama']),
                    'alamat' 			=> escapeString($_POST['alamat_supplier']),
                    'id_kelurahan' 		=> escapeString($_POST['kelurahan_supplier'])
            );

            $this->db->insert('tm_supplier', $data);
            echo "Berhasil";
        }
    }

    public function hapusdatasuplier()
    {
        if(isset($_GET['id'])){
            $data = $this->mastermodel->deletesupplier($_GET['id']);
            redirect('/master/datasupplier/');
        }
    }
}
