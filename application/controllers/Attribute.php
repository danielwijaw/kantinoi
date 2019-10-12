<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends CI_Controller {

	public function getbarang()
	{
		if(isset($_GET['kodebarang'])){
			// print_r($_GET);
			$this->load->model('dataletter');
			$datax = $this->dataletter->getsokbarangbyid($_GET['kodebarang']);
			if($datax['jumlahbarang']=='0'){
				$datax = array(
					'reg_stokbarang' 	=> $datax['reg_stokbarang'],
					'stokbarang'		=> $datax['stokbarang'],
					'jumlahbarang'		=> 'HABIS'
				);
			}
			array_push($_GET, $datax);
			echo json_encode($_GET);
		}
	}

	public function getpelanggan()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = 'a';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getpelanggankasir($_GET['search']);
		foreach($data as $key => $value){
			$list[$key]['id'] = $value['reg_pelanggan'];
			$list[$key]['text'] = $value['pelanggan']." (".$value['reg_pelanggan'].")";
		};
		echo json_encode($list);
	}
	
	public function getjenisbarangupdated()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = '';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getjenisbarangsearch($_GET['search']);
		$datax = $this->mastermodel->getjenisbaranglist($_GET['reg']);
		$list[0]['id'] = $datax[0]['reg_jenisbarang'];
		$list[0]['text'] = $datax[0]['jenisbarang'];
		foreach($data as $key => $value){
			$list[$key+1]['id'] = $value['reg_jenisbarang'];
			$list[$key+1]['text'] = $value['jenisbarang'];
		};
		echo json_encode($list);
	}

	public function getsupplierupdated()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = '';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getsuppliersearch($_GET['search']);
		$datax = $this->mastermodel->getsupplierlist($_GET['reg']);
		$list[0]['id'] = $datax[0]['reg_supplier'];
		$list[0]['text'] = $datax[0]['nama_supplier'];
		foreach($data as $key => $value){
			$list[$key+1]['id'] = $value['reg_supplier'];
			$list[$key+1]['text'] = $value['nama_supplier'];
		};
		echo json_encode($list);
	}

	public function getjenisbarang()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = '';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getjenisbarangsearch($_GET['search']);
		foreach($data as $key => $value){
			$list[$key]['id'] = $value['reg_jenisbarang'];
			$list[$key]['text'] = $value['jenisbarang'];
		};
		echo json_encode($list);
	}

	public function getsupplier()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = '';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getsuppliersearch($_GET['search']);
		foreach($data as $key => $value){
			$list[$key]['id'] = $value['reg_supplier'];
			$list[$key]['text'] = $value['nama_supplier'];
		};
		echo json_encode($list);
	}

	public function getnamabarang()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = '';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getnamabarang($_GET['search']);
		foreach($data as $key => $value){
			$list[$key]['id'] = $value['reg_stokbarang'];
			$list[$key]['text'] = $value['stokbarang'];
		};
		echo json_encode($list);
	}

	public function getkelurahan()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = 'jawa tengah';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getkelurahan($_GET['search']);
		foreach($data as $key => $value){
			$list[$key]['id'] = $value['id_kelurahan'];
			$list[$key]['text'] = "Desa / Kel. ".$value['nama_kelurahan'].", Kec. ".$value['nama_kecamatan'].", Kab. ".$value['nama_kabupaten'].", Prov. ".$value['nama_provinsi'];
		};
		echo json_encode($list);
	}

	public function getkelurahanlist()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = 'jawa tengah';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getkelurahan($_GET['search']);
		$datax = $this->mastermodel->getkelurahanlist($_GET['kel']);
		$list[0]['id'] = $datax[0]['id_kelurahan'];
		$list[0]['text'] = "Desa / Kel. ".$datax[0]['nama_kelurahan'].", Kec. ".$datax[0]['nama_kecamatan'].", Kab. ".$datax[0]['nama_kabupaten'].", Prov. ".$datax[0]['nama_provinsi'];
		foreach($data as $key => $value){
			$list[$key+1]['id'] = $value['id_kelurahan'];
			$list[$key+1]['text'] = "Desa / Kel. ".$value['nama_kelurahan'].", Kec. ".$value['nama_kecamatan'].", Kab. ".$value['nama_kabupaten'].", Prov. ".$value['nama_provinsi'];
		};
		echo json_encode($list);
	}

	public function getkasir()
	{
		if(!isset($_GET['search'])){
			$_GET['search'] = 'a';
		}else{
			$_GET['search'] = $_GET['search'];
		}
		$this->load->model('mastermodel');
		$data = $this->mastermodel->getkasir($_GET['search']);
		foreach($data as $key => $value){
			$list[$key]['id'] = $value['nip'];
			$list[$key]['text'] = $value['nama']." (".$value['jabatan'].")";
		};
		echo json_encode($list);
	}

	public function barangkasir()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/attribute/barangkasir?page='.$xxz)."`, `barang_here`)' href='javascript:void(0)'>$xz</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 5){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarang('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/kasir/ajaxstokbarang', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/attribute/barangkasir?page='.$xxz)."`, `barang_here`)' href='javascript:void(0)'>$xz</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 5){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarangsearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/kasir/ajaxstokbarang', $data);
		}
	}

	public function stokbarangoi()
	{
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcount('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/attribute/stokbarangoi?page='.$xxz)."`, `ngenehbarange`)' href='javascript:void(0)'>$xz</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 5){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarang('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/kasir/ajaxstokbarangoi', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/attribute/stokbarangoi?page='.$xxz.'&cari='.$_GET['cari'])."`, `ngenehbarange`)' href='javascript:void(0)'>$xz</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 5){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarangsearch('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/kasir/ajaxstokbarangoi', $data);
		}
	}

	public function getdatahargabelicuk(){
		$query = $this->db->query("
            SELECT
              *
            FROM
              tr_stokbarang
            WHERE
				reg_stokbarang = \"".$_GET['id']."\"
				AND harga_default != ''
			ORDER BY
				id_tr_stokbarang DESC
            ");
		$result = $query->row_array();
		$harga = json_decode($result['harga_default'], true);   
		echo "<label>Harga Barang Pembelian</label>";
		echo "<input readonly='readonly' type='text' class='form-control' value='".rupiah($harga['harga_barang'])." * ".$harga['jumlah_barang']." = ".rupiah($harga['harga_barang'] * $harga['jumlah_barang'])."'>";
		echo "<br/><label>PPN & Diskon Barang Pembelian</label>";
		echo "<input readonly='readonly' type='text' class='form-control' value='".$harga['ppn_barang']."% & ".rupiah($harga['diskon_barang'])."'>";
		echo "<br/><label>Total Harga Beli per ".$harga['tanggal']."</label>";
		echo "<input readonly='readonly' type='text' class='form-control' value='".rupiah(($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100)) )." / ".rupiah((($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100))) / $harga['jumlah_barang'])."'><br/>";
	}

	public function nomorfakturcuk(){
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountfak('1');
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/attribute/nomorfakturcuk?page='.$xxz)."`, `nangkene`)' href='javascript:void(0)'>$xz</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 5){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatapiutangfak('1',$datapage,'5');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarangfakx', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountsearchfak('1',$_GET['cari']);
			$row = ceil($total / 5);
			$button = "<ul class='pagination'>";
			for ($x = 0; $x < $row; $x++) {
				$xz = $x + 1;
				$xxz = ($xz*5)-5;
				$button .= "<li><a onclick='ajaxpaging(`".base_url('/attribute/nomorfakturcuk?page='.$xxz.'&cari='.$_GET['cari'])."`, `nangkene`)' href='javascript:void(0)'>$xz</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 5){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatapiutangsearchfak('1',$datapage,'5',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarangfakx', $data);
		}
	}

	public function listbarangefaktur(){
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
		$this->load->view('/transaksi/listbarangout', $data);
	}

	public function databarangbyid(){
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
			AND id_tr_stokbarang = \"".$_GET['id']."\"
		");
		$result = $query->row_array();
		echo "<label>Jumlah Stok Di Retur</label>";
		echo "<input id='stokretur' type='text' class='form-control'>";
		echo "<br/><button onclick='submitdatabarang(`".$_GET['id']."`, `".$result['reg_stokbarang']."`)' class='btn btn-primary'>Submit</button>";
	}

	public function processs(){
		$retur = [
			'jumlah' => $_GET['val'],
			'tanggal'	=> date('Y-m-d H:i:s')
		];
		$returnya = json_encode($retur);
		$data = array(
			'retur_barang' => $returnya
		);
		$this->db->where('id_tr_stokbarang', $_GET['id']);
		$this->db->update('tr_stokbarang', $data);

		$this->db->where('reg_stokbarang', $_GET['idbarang']);
		$this->db->set('jumlahbarang', 'jumlahbarang+'.$_GET['val'], FALSE);
		$this->db->update('tm_stokbarang');
	}

	public function printfaktur(){
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
		$this->load->view('/transaksi/printfaktur', $data);
	}
}
