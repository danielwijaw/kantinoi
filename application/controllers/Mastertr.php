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
            $row = $this->db->query('SELECT (MAX(reg_stokbarang)+1) AS `maxid` FROM `tm_stokbarang`')->row();
            if(is_null($row->maxid) or $row->maxid == ''){
                $row->maxid = '1';
            }
            if(!isset($_POST['reg_stokbarang'])){
                $data = array(
                    'stokbarang' => escapeString($_POST['stokbarang']),
                    'jumlahbarang' 	=> escapeString($_POST['jumlahbarang']),
                    'satuan' 	=> strtolower(escapeString($_POST['satuan'])),
                    'reg_supplier' 	=> escapeString($_POST['reg_supplier']),
                    'reg_jenisbarang' 	=> escapeString($_POST['reg_jenisbarang']),
                    'reg_stokbarang'    => $row->maxid
                );
            }else{
                $data = array(
                    'reg_stokbarang' => escapeString($_POST['reg_stokbarang']),
                    'stokbarang' => escapeString($_POST['stokbarang']),
                    'jumlahbarang' 	=> escapeString($_POST['jumlahbarang']),
                    'satuan' 	=> strtolower(escapeString($_POST['satuan'])),
                    'reg_supplier' 	=> escapeString($_POST['reg_supplier']),
                    'reg_jenisbarang' 	=> escapeString($_POST['reg_jenisbarang']),
                );
            }

            $this->db->insert('tm_stokbarang', $data);

            $hargabarang = array(
                'tanggal' => date('Y-m-d H:i:s'),
				'nofak' => escapeString($_POST['nofak']),
                'jumlah_barang' => escapeString($_POST['jumlahbarang']),
                'harga_barang' => escapeString($_POST['reg_hargabarang']),
                'ppn_barang' => escapeString($_POST['reg_ppnbarang']),
                'diskon_barang' => escapeString($_POST['reg_diskonbarang']),
            );
			
			
			if($_POST['reg_stokbarang']==''){
                $datax = array(
                'stok_awal'         => '0',
                'stok_perbarui' 	=> escapeString($_POST['jumlahbarang']),
                'reg_stokbarang' 	=> $row->maxid,
                'piutang'           => escapeString($_POST['piutang']),
                'harga_default'     => json_encode($hargabarang)
				);
            }else{
				$datax = array(
                'stok_awal'         => '0',
                'stok_perbarui' 	=> escapeString($_POST['jumlahbarang']),
                'reg_stokbarang' 	=> escapeString($_POST['reg_stokbarang']),
                'piutang'           => escapeString($_POST['piutang']),
                'harga_default'     => json_encode($hargabarang)
				);
            }

            //$datax = array(
                //'stok_awal'         => '0',
                //'stok_perbarui' 	=> escapeString($_POST['jumlahbarang']),
                //'reg_stokbarang' 	=> $row->maxid,
                //'piutang'           => escapeString($_POST['piutang']),
                //'harga_default'     => json_encode($hargabarang)
            //);

            $this->db->insert('tr_stokbarang', $datax);
            echo "Berhasil";
        }
    }

    public function updatedatastokbarang()
    {
        if(isset($_POST)){
            if($_GET['status']=='update'){
                $data = array(
                        'reg_stokbarang' => escapeString($_POST['reg_stokbarang_updated_'.$_GET['id']]),
                        'stokbarang' 	=> escapeString($_POST['stokbarang_updated_'.$_GET['id']]),
                        'jumlahbarang' 	=> escapeString($_POST['jumlahbarang_updated_'.$_GET['id']]),
                        'satuan' 	=> strtolower(escapeString($_POST['satuan_updated_'.$_GET['id']])),
                        'reg_supplier' 	=> escapeString($_POST['reg_supplier_updated_'.$_GET['id']]),
                        'reg_jenisbarang' 	=> escapeString($_POST['reg_jenisbarang_updated_'.$_GET['id']]),
                        'status_muncul'     => '1',
                        'updated_at'        => date('Y-m-d H:i:s')
                );
                $this->db->where('reg_stokbarang', $_GET['id']);
                $this->db->update('tm_stokbarang', $data);
                
                $datax = array(
                    'stok_awal'         => escapeString($_POST['jumlahbarangawal_updated_'.$_GET['id']]),
                    'stok_perbarui' 	=> escapeString($_POST['jumlahbarang_updated_'.$_GET['id']]),
                    'reg_stokbarang' 	=> $_GET['id'],
                    'piutang' 	        => escapeString($_POST['piutang_updated_'.$_GET['id']])
                );

                $this->db->insert('tr_stokbarang', $datax);
            }else{
                $hargabarang = array(
                    'tanggal' => date('Y-m-d H:i:s'),
					'nofak' => escapeString($_POST['nofak_updated_'.$_GET['id']]),
                    'jumlah_barang' => escapeString($_POST['jumlahbarangdatang_updated_'.$_GET['id']]),
                    'harga_barang' => escapeString($_POST['hargabarangdatang_updated_'.$_GET['id']]),
                    'ppn_barang' => escapeString($_POST['ppnbarangdatang_updated_'.$_GET['id']]),
                    'diskon_barang' => escapeString($_POST['diskonbarangdatang_updated_'.$_GET['id']]),
                );
                $data = array(
                    'jumlahbarang' 	    => escapeString($_POST['jumlahawaldatang_updated_'.$_GET['id']])+escapeString($_POST['jumlahbarangdatang_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
                );
                $this->db->where('reg_stokbarang', $_GET['id']);
                $this->db->update('tm_stokbarang', $data);
                
                $datax = array(
                    'stok_awal'         => escapeString($_POST['jumlahawaldatang_updated_'.$_GET['id']]),
                    'stok_perbarui' 	=> escapeString($_POST['jumlahawaldatang_updated_'.$_GET['id']])+escapeString($_POST['jumlahbarangdatang_updated_'.$_GET['id']]),
                    'reg_stokbarang' 	=> $_GET['id'],
                    'piutang' 	        => escapeString($_POST['piutangdatang_updated_'.$_GET['id']]),
                    'harga_default'     => json_encode($hargabarang)
                );

                $this->db->insert('tr_stokbarang', $datax);
            }
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
            // CEK ID
            $cekid = $this->mastermodel->getnamabarangid($_POST['reg_stokbarang']);
            $data = array(
                    'reg_stokbarang' 	    => escapeString($_POST['reg_stokbarang']),
                    'hargabarang_grosir' 	=> escapeString($_POST['hargabarang_grosir']),
                    'hargabarang_retail' 	=> escapeString($_POST['hargabarang_retail']),
            );
            if(empty($cekid)){
                $this->db->insert('tm_hargabarang', $data);
                echo "Berhasil";
            }else{
                echo "HARGA STOK BARANG SUDAH DIINPUT";
            }
        }
    }

    public function updatedatahargabarang()
    {
        if(isset($_POST)){
            $data = array(
                    'hargabarang_grosir' 	=> escapeString($_POST['hargabarang_retail_updated_'.$_GET['id']]),
                    'hargabarang_retail'    => escapeString($_POST['hargabarang_grosir_updated_'.$_GET['id']]),
                    'status_muncul'         => '1',
                    'updated_at'            => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_hargabarang', $_GET['id']);
            $this->db->update('tm_hargabarang', $data);

            $datax = array(
                'reg_hargabarang'               => $_GET['id'],
                'hargabarang_grosir_awal' 	    => escapeString($_POST['hargabarang_awal_retail_updated_'.$_GET['id']]),
                'hargabarang_retail_awal'       => escapeString($_POST['hargabarang_awal_grosir_updated_'.$_GET['id']]),
                'hargabarang_grosir_perbarui' 	=> escapeString($_POST['hargabarang_retail_updated_'.$_GET['id']]),
                'hargabarang_retail_perbarui'   => escapeString($_POST['hargabarang_grosir_updated_'.$_GET['id']])
            );
            $this->db->insert('tr_hargabarang', $datax);

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
            $this->db->where('reg_hargabarang', $_GET['id']);
            $this->db->update('tm_hargabarang', $data);
            redirect('/master/hargabarang/');
        }
    }

    // END JENIS BARANG

    // START PELANGGAN

    public function insertdatapelanggan()
    {
        if(isset($_POST)){
            if(empty($_POST['reg_pelanggan'])){
                $data = array(
                    'reg_pelanggan' => rand(1231, 1230981),
                    'pelanggan' 	=> escapeString($_POST['pelanggan'])
                );
            }else{
                $data = array(
                    'reg_pelanggan' => escapeString($_POST['reg_pelanggan']),
                    'pelanggan' 	=> escapeString($_POST['pelanggan'])
                );
            }

            $this->db->insert('tm_pelanggan', $data);
            echo "Berhasil";
        }
    }

    public function updatedatapelanggan()
    {
        if(isset($_POST)){
            $data = array(
                    'reg_pelanggan' 	=> escapeString($_POST['reg_pelanggan_updated_'.$_GET['id']]),
                    'pelanggan' 	=> escapeString($_POST['pelanggan_updated_'.$_GET['id']]),
                    'status_muncul'     => '1',
                    'updated_at'        => date('Y-m-d H:i:s')
            );
            $this->db->where('reg_pelanggan', $_GET['id']);
            $this->db->update('tm_pelanggan', $data);
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
            $this->db->where('reg_pelanggan', $_GET['id']);
            $this->db->update('tm_pelanggan', $data);
            redirect('/master/datapelanggan/');
        }
    }

    // END PELANGGAN
    // START PIUTANG

    public function updatepiutang()
    {
        if(isset($_POST)){
            $row = $this->db->query('SELECT piutang-'.escapeString($_POST['piutang_deleted_'.$_GET['id']]).' AS `piutang`, piutang_clear FROM `tr_stokbarang` where `id_tr_stokbarang` = '.$_GET['id'].' ')->row();
            $row->piutang_clear = json_decode($row->piutang_clear, true);
            $row->piutang_clear[date('Y-m-d H:i:s')] = escapeString($_POST['piutang_deleted_'.$_GET['id']]);
            // print_r($row);
            // die();
            $piutang_clear = json_encode($row->piutang_clear);
            $data = array(
                'piutang' 	=> $row->piutang,
                'piutang_clear' => $piutang_clear
            );
            $this->db->where('id_tr_stokbarang', $_GET['id']);
            $this->db->update('tr_stokbarang', $data);
            echo "Berhasil";
        }
    }

    public function updatepiutangfaktur()
    {
        if(isset($_GET['id'])){
            $query = $this->db->query("
            SELECT
              id_tr_stokbarang, harga_default, piutang, piutang_clear
            FROM
              tr_stokbarang
            WHERE
              JSON_EXTRACT(harga_default, \"$.nofak\") = \"".$_GET['id']."\"
            ");
            $row = new stdClass();
            $result = $query->result_array();
            foreach($result as $key => $value){
                $row->piutang_clear = json_decode($value['piutang_clear'], true);
                $row->piutang_clear[date('Y-m-d H:i:s')] = $value['piutang'];
                $piutang_clear = json_encode($row->piutang_clear);
                $data = array(
                    'piutang' 	=> $row->piutang,
                    'piutang_clear' => $piutang_clear
                );
                $this->db->where('id_tr_stokbarang', $value['id_tr_stokbarang']);
                $this->db->update('tr_stokbarang', $data);
            }
            redirect('/transaksiC/stokfaktur/');
        }
    }
}
