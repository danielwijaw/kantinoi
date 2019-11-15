<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasirtr extends CI_Controller {

	public function __construct()
    {
			parent::__construct();
			$this->load->helper('dnl');
            $this->load->model('mastermodel');
            $this->load->library('dnllibrary');
            if(null == $this->session->userdata('nip')){
            	redirect('/login/index/');
            	die();
            }
    }

    public function insert()
    {
        error_reporting(0);
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
                $url = base_url()."kasirasynch/insert_not_empty_getbarang_update_tr_penjualan";
                $param = array(
                    'getbarang' => $getbarang,
                    'datains'   => $datains
                );
                $this->dnllibrary->do_in_background($url, $param);

                $url1 = base_url()."kasirasynch/insert_not_empty_getbarang_update_tr_stokbarang";
                $param1 = array(
                    'post' => $_POST
                );
                $this->dnllibrary->do_in_background($url1, $param1);
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
                $url = base_url()."kasirasynch/insert_empty_tr_penjualan";
                $param = array(
                    'datains' => $datains
                );
                $this->dnllibrary->do_in_background($url, $param);

                $datastok = array(
                    'nomor_tr'                      => escapeString($_POST['nomor_transaksi_penjualan']),
                    'reg_stokbarang'                => escapeString($_POST['kode_barang']),
                    'stok_awal'                     => escapeString($_POST['jumlah_barang_stok']),
                    'stok_perbarui'                 => ((int) escapeString($_POST['jumlah_barang_stok']) - escapeString($_POST['jumlah_barang']) )
                );
                $url1 = base_url()."kasirasynch/insert_empty_tr_stokbarang";
                $param1 = array(
                    'datastok' => $datastok
                );
                $this->dnllibrary->do_in_background($url1, $param1);
            }
            $dataupdate = array(
                'jumlahbarang'                  => ((int) escapeString($_POST['jumlah_barang_stok']) - escapeString($_POST['jumlah_barang']) ),
                'updated_at'                    => date('Y-m-d H:i:s')
            );
            $urlx = base_url()."kasirasynch/insert_update_stok_barang";
            $paramx = array(
                'dataupdate' => $dataupdate,
                'post'       => $_POST
            );
            $this->dnllibrary->do_in_background($urlx, $paramx);
            if(isset($_POST['pelanggan_kasir'])){
                $this->db->query("
                UPDATE tr_penjualan 
                SET harga_fix = harga_grosir,
                id_pelanggan = '".escapeString($_POST['pelanggan_kasir'])."' 
                WHERE
                    nomor_tr_penjualan = '".escapeString($_POST['nomor_transaksi_penjualan'])."' 
                    AND status_muncul = '1'
                ");
            };
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
            $this->db->trans_start();
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
            $this->db->set('jumlahbarang', 'jumlahbarang+'.$_GET['jumlah_barang']);
            $this->db->where('reg_stokbarang', $_GET['id_barang']);
            $this->db->update('tm_stokbarang');
            echo "Berhasil";
            $this->db->trans_complete();
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

    public function accepttransaction()
    {
        if(isset($_GET['id'])){
            $dataupdate = array(
                'status_hold'       => '3',
                'status_muncul'     => '2',
                'deleted_at'        => date('Y-m-d H:i:s'),
                'payment_method'    => $_GET['method'],
                'pembayaran_terakhir' => json_encode($_GET)
            );
            $this->db->where('nomor_tr_penjualan', $_GET['id']);
            $this->db->where('status_muncul', '1');
            $this->db->update('tr_penjualan', $dataupdate);
            $data = array(
                'alert' => "Berhasil",
                'url'   => base_url('/Kasir/printout/?number=').$_GET['id']
            );
            echo json_encode($data);
        }else{
            $data = array(
                'alert' => "Tidak Bisa Mendapatkan ID"
            );
            echo json_encode($data);
        }
    }

    public function nginsertdatastokbarangsu()
    {
        $hargabarang = array(
            'tanggal' => date('Y-m-d H:i:s'),
            'nofak' => escapeString($_POST['nofak']),
            'jumlah_barang' => escapeString($_POST['jumlah_barang']),
            'harga_barang' => escapeString($_POST['total_harga']),
            'ppn_barang' => escapeString($_POST['ppn_total']),
            'diskon_barang' => escapeString($_POST['diskon_total']),
        );
        $updatebatch = array();
        $data = array(
            'jumlahbarang' 	    => escapeString($_POST['barang_awal'])+escapeString($_POST['jumlah_barang']),
            'status_muncul'     => '1',
            'updated_at'        => date('Y-m-d H:i:s')
        );
        $this->db->where('reg_stokbarang', escapeString($_POST['id_barang']));
        $this->db->update('tm_stokbarang', $data);
        
        $datax = array(
            'stok_awal'         => escapeString($_POST['barang_awal']),
            'stok_perbarui' 	=> escapeString($_POST['barang_awal'])+escapeString($_POST['jumlah_barang']),
            'reg_stokbarang' 	=> escapeString($_POST['id_barang']),
            'piutang' 	        => escapeString($_POST['piyutang_total']),
            'harga_default'     => json_encode($hargabarang)
        );

        if($this->db->insert('tr_stokbarang', $datax)){
            
        if($_POST['ppn_total']!=""){
            $query = $this->db->query("
            SELECT
              id_tr_stokbarang, harga_default, piutang, piutang_clear
            FROM
              tr_stokbarang
            WHERE
              JSON_EXTRACT(harga_default, \"$.nofak\") = \"".$_POST['nofak']."\"
            ");
            $result = $query->result_array();
            foreach($result as $key => $value){
                $barangecuk = json_decode($value['harga_default'], true);
                $barangecuk['ppn_barang'] = (int)escapeString($_POST['ppn_total']);
                $barangecuk['diskon_barang'] = (int)escapeString($_POST['diskon_total']) / count($result);
                $updatebatch[] = array(
                        'id_tr_stokbarang'  => $value['id_tr_stokbarang'],
                        'piutang'           => escapeString($_POST['piyutang_total']) / count($result),
                        'harga_default'     => json_encode($barangecuk)
                );
            };
            $this->db->update_batch('tr_stokbarang', $updatebatch, 'id_tr_stokbarang');
        }
            $dataalert = array(
                'echo' => 'Berhasil',
                'url'  => base_url('/kasir/stokbarang/?faktur='.escapeString($_POST['nofak']))
            ); 
        }else{
            $dataalert = array(
                'echo' => 'Gagal'
            );
        };
        echo json_encode($dataalert);
    }

    public function ngitungtokjud()
    {
        $query = $this->db->query("
        SELECT
            id_tr_stokbarang, harga_default, piutang, piutang_clear
        FROM
            tr_stokbarang
        WHERE
            JSON_EXTRACT(harga_default, \"$.nofak\") = \"".$_POST['nofak']."\"
        ");
        $result = $query->result_array();
        foreach($result as $key => $value){
            $barangecuk = json_decode($value['harga_default'], true);
            $barangecuk['ppn_barang'] = (int)escapeString($_POST['ppn_total']);
            $barangecuk['diskon_barang'] = (int)escapeString($_POST['diskon_total']) / count($result);
            $updatebatch[] = array(
                    'id_tr_stokbarang'  => $value['id_tr_stokbarang'],
                    'piutang'           => escapeString($_POST['piyutang_total']) / count($result),
                    'harga_default'     => json_encode($barangecuk)
            );
        };
        $this->db->update_batch('tr_stokbarang', $updatebatch, 'id_tr_stokbarang');
        $dataalert = array(
            'echo' => 'Berhasil',
            'url'  => base_url('/kasir/stokbarang/?faktur='.escapeString($_POST['nofak']))
        ); 
        echo json_encode($dataalert);
    }

    public function deletetransaksifaktur(){
        $this->db->where('reg_stokbarang', $_GET['idbarang']);
		$this->db->set('jumlahbarang', 'jumlahbarang-'.$_GET['val'], FALSE);
        $this->db->update('tm_stokbarang');
        
        $this->db->where('id_tr_stokbarang', $_GET['id']);
        $this->db->delete('tr_stokbarang');

        redirect('/kasir/stokbarang/?faktur='.$_GET['nofak']);
    }
}
