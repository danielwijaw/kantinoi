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

    // START DATA SUPPLIER

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

    public function hapusdatasuplier()
    {
        if(isset($_GET['id'])){
            $data = array(
                'status_muncul' => '2',
                'deleted_at'  => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_supplier', $_GET['id']);
            $this->db->update('tm_supplier', $data);
            redirect('/master/datasupplier/');
        }
    }

    // END DATA SUPPLIER

    // START JENIS BARANG

    public function insertdatajenisbarang()
    {
        if(isset($_POST)){
            $data = array(
                    'jenisbarang' 	=> escapeString($_POST['jenisbarang'])
            );

            $this->db->insert('tm_jenisbarang', $data);
            echo "Berhasil";
        }
    }

    public function updatedatajenisbarang()
    {
        if(isset($_POST)){
            $data = array(
                    'jenisbarang' 	=> escapeString($_POST['jenisbarang_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_jenisbarang', $_GET['id']);
            $this->db->update('tm_jenisbarang', $data);
            echo "Berhasil";
        }
    }

    public function hapusdatajenisbarang()
    {
        if(isset($_GET['id'])){
            $data = array(
                'status_muncul' => '2',
                'deleted_at'  => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_jenisbarang', $_GET['id']);
            $this->db->update('tm_jenisbarang', $data);
            redirect('/master/jenisbarang/');
        }
    }

    // END JENIS BARANG

    // START STOK BARANG

    public function insertdatastokbarang()
    {
        if(isset($_POST)){
            $data = array(
                    'stokbarang' 	=> escapeString($_POST['stokbarang'])
            );

            $this->db->insert('tm_stokbarang', $data);
            echo "Berhasil";
        }
    }

    public function updatedatastokbarang()
    {
        if(isset($_POST)){
            $data = array(
                    'stokbarang' 	=> escapeString($_POST['stokbarang_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_stokbarang', $_GET['id']);
            $this->db->update('tm_stokbarang', $data);
            echo "Berhasil";
        }
    }

    public function hapusdatastokbarang()
    {
        if(isset($_GET['id'])){
            $data = array(
                'status_muncul' => '2',
                'deleted_at'  => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_stokbarang', $_GET['id']);
            $this->db->update('tm_stokbarang', $data);
            redirect('/master/stokbarang/');
        }
    }

    // END STOK BARANG

    // START HARGA BARANG

    public function insertdatahargabarang()
    {
        if(isset($_POST)){
            $data = array(
                    'jenisbarang' 	=> escapeString($_POST['hargabarang'])
            );

            $this->db->insert('tm_jenisbarang', $data);
            echo "Berhasil";
        }
    }

    public function updatedatahargabarang()
    {
        if(isset($_POST)){
            $data = array(
                    'jenisbarang' 	=> escapeString($_POST['hargabarang_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_jenisbarang', $_GET['id']);
            $this->db->update('tm_jenisbarang', $data);
            echo "Berhasil";
        }
    }

    public function hapusdatahargabarang()
    {
        if(isset($_GET['id'])){
            $data = array(
                'status_muncul' => '2',
                'deleted_at'  => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_jenisbarang', $_GET['id']);
            $this->db->update('tm_jenisbarang', $data);
            redirect('/master/hargabarang/');
        }
    }

    // END JENIS BARANG

    // START PELANGGAN

    public function insertdatapelanggan()
    {
        if(isset($_POST)){
            $data = array(
                    'jenisbarang' 	=> escapeString($_POST['pelanggan'])
            );

            $this->db->insert('tm_jenisbarang', $data);
            echo "Berhasil";
        }
    }

    public function updatedatapelanggan()
    {
        if(isset($_POST)){
            $data = array(
                    'jenisbarang' 	=> escapeString($_POST['pelanggan_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_jenisbarang', $_GET['id']);
            $this->db->update('tm_jenisbarang', $data);
            echo "Berhasil";
        }
    }

    public function hapusdatapelanggan()
    {
        if(isset($_GET['id'])){
            $data = array(
                'status_muncul' => '2',
                'deleted_at'  => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_jenisbarang', $_GET['id']);
            $this->db->update('tm_jenisbarang', $data);
            redirect('/master/datapelanggan/');
        }
    }

    // END PELANGGAN
}
