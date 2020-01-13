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
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/attribute/barangkasir?page='.$i)."`, `barang_here`)' href='javascript:void(0)'>$i</a></li>";
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
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/attribute/barangkasir?cari='.$_GET['cari'].'&page='.$i)."`, `barang_here`)' href='javascript:void(0)'>$i</a></li>";
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
			$row = ceil($total / 10);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/attribute/stokbarangoi?page='.$i)."`, `ngenehbarange`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 10){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarang('1',$datapage,'10');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/kasir/ajaxstokbarangoi', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatastokbarangcountsearch('1',$_GET['cari']);
			$row = ceil($total / 10);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/attribute/stokbarangoi?page='.$i.'&cari='.$_GET['cari'])."`, `ngenehbarange`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 10){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatastokbarangsearch('1',$datapage,'10',$_GET['cari']);
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/kasir/ajaxstokbarangoi', $data);
		}
	}

	public function getdatahargabelicuk(){
		error_reporting(0);
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
		if(isset($_GET['jsononly'])){
			echo (($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100))) / $harga['jumlah_barang'];
		}else{
			echo "<label>Harga Barang Pembelian</label>";
			echo "<input readonly='readonly' type='text' class='form-control' value='".rupiah($harga['harga_barang'])." * ".$harga['jumlah_barang']." = ".rupiah($harga['harga_barang'] * $harga['jumlah_barang'])."'>";
			echo "<br/><label>PPN & Diskon Barang Pembelian</label>";
			echo "<input readonly='readonly' type='text' class='form-control' value='".$harga['ppn_barang']."% & ".rupiah($harga['diskon_barang'])."'>";
			echo "<br/><label>Total Harga Beli per ".$harga['tanggal']."</label>";
			echo "<input readonly='readonly' type='text' class='form-control' value='".rupiah(($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100)) )." / ".rupiah((($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100))) / $harga['jumlah_barang'])."'><br/>";
		}   
	}

	public function nomorfakturcuk(){
		if(!isset($_GET['cari'])){
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountfak('1');
			$row = ceil($total / 10);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/attribute/nomorfakturcuk?page='.$i)."`, `nangkene`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 10){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatapiutangfak('1',$datapage,'10');
			$data = array('data' => $data,'button'=>$button);
			$this->load->view('/transaksi/ajaxstokbarangfakx', $data);
		}else{
			$this->load->model('mastermodel');
			$total = $this->mastermodel->getdatapiutangcountsearchfak('1',$_GET['cari']);
			$row = ceil($total / 10);
			$page = (isset($_GET['page']))? $_GET['page'] : 1;
			$jumlah_number = 3;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
			$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number        
			$end_number = ($page < ($row - $jumlah_number))? $page + $jumlah_number : $row;
			$link_prev = ($page > 1)? $page - 1 : 1;
			$link_next = ($page < $row)? $page + 1 : $row;
			$button = "<ul class='pagination'>";
			for ($i = $start_number; $i <= $end_number; $i++) {
				$link_active = ($page == $i)? ' class="active"' : '';
				$button .= "<li ".$link_active."><a onclick='ajaxpaging(`".base_url('/attribute/nomorfakturcuk?page='.$i.'&cari='.$_GET['cari'])."`, `nangkene`)' href='javascript:void(0)'>$i</a></li>";
			} 
			$button .= "</ul>";
			if($total <= 10){
				$button = '';
			}else{
				$button = $button;
			}
			$datapage = '';
			if(isset($_GET['page']))
			{
				$datapage = $_GET['page'];
			}
			$data = $this->mastermodel->getdatapiutangsearchfak('1',$datapage,'10',$_GET['cari']);
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
		$query = $this->db->get_where('tr_stokbarang', array('id_tr_stokbarang' => $_GET['id']));
		$row = $query->row_array();
		$retur = json_decode($row['retur_barang'], true);
		$harga_default = json_decode($row['harga_default'], true);

		$retur[date('Y-m-d H:i:s')] = [
			'jumlah' => $_GET['val'],
			'tanggal'	=> date('Y-m-d H:i:s')
		];
		$harga_default['jumlah_barang'] = $harga_default['jumlah_barang']-$_GET['val'];
		$returnya = json_encode($retur);
		$data = array(
			'retur_barang' => $returnya,
			'stok_perbarui' => $row['stok_perbarui']-$_GET['val'],
			'harga_default'	=> json_encode($harga_default),
			'piutang'		=> ($row['piutang']-($_GET['val']*$harga_default['harga_barang']))-((($_GET['val']*$harga_default['harga_barang']))*$harga_default['ppn_barang']/100)
		);
		$this->db->where('id_tr_stokbarang', $_GET['id']);
		$this->db->update('tr_stokbarang', $data);

		$this->db->where('reg_stokbarang', $_GET['idbarang']);
		$this->db->set('jumlahbarang', 'jumlahbarang-'.$_GET['val'], FALSE);
		$this->db->update('tm_stokbarang');
	}

	public function printfaktur(){
		error_reporting(0);
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

	public function changetypedata(){
		// tm_hargabarang
		echo "Start Hargabarang";
		$harga_barang = $this->db->query('ALTER TABLE tm_hargabarang CHANGE reg_stokbarang reg_stokbarang BIGINT(64) NOT NULL');
		if($harga_barang){
			echo "Start Jenisbarang";
			$jenis_barang = $this->db->query('ALTER TABLE tm_jenisbarang CHANGE reg_jenisbarang reg_jenisbarang BIGINT(64) NOT NULL');
			if($jenis_barang){
				echo "Start Pelanggan";
				$pelanggan = $this->db->query('ALTER TABLE tm_pelanggan CHANGE reg_pelanggan reg_pelanggan BIGINT(64) NOT NULL');
				if($pelanggan){
					echo "Start Stokbarang";
					$stokbarang = $this->db->query('ALTER TABLE tm_stokbarang CHANGE reg_stokbarang reg_stokbarang BIGINT(64) NOT NULL, CHANGE reg_supplier reg_supplier BIGINT(64) NOT NULL, CHANGE reg_jenisbarang reg_jenisbarang BIGINT(64) NOT NULL');
					if($stokbarang){
						echo "Start Supplier";
						$supplier = $this->db->query('ALTER TABLE tm_supplier CHANGE reg_supplier reg_supplier BIGINT(64) NOT NULL');
						if($supplier){
							echo "Start User";
							$user = $this->db->query('ALTER TABLE tm_user CHANGE nip nip BIGINT(64) NOT NULL');
							if($user){
								echo "Start Transaction hargabarang";
								$tr_hargabarang = $this->db->query('ALTER TABLE tr_hargabarang CHANGE id_tr_hargabarang id_tr_hargabarang BIGINT(64) NOT NULL, CHANGE reg_hargabarang reg_hargabarang BIGINT(64) NOT NULL');
								if($tr_hargabarang){
									echo "Start Transaction penjualan";
									$tr_penjualan = $this->db->query('ALTER TABLE tr_penjualan CHANGE id_tr_penjualan id_tr_penjualan BIGINT(64) NOT NULL, CHANGE nomor_tr_penjualan nomor_tr_penjualan BIGINT(64) NOT NULL, CHANGE id_barang id_barang BIGINT(64) NOT NULL, CHANGE id_pelanggan id_pelanggan BIGINT(64) NOT NULL');
									if($tr_penjualan){
										echo "Start Transaction stokbarang";
										$tr_stokbarang = $this->db->query('ALTER TABLE tr_stokbarang CHANGE id_tr_stokbarang id_tr_stokbarang BIGINT(64) NOT NULL, CHANGE nomor_tr nomor_tr BIGINT(64) NOT NULL, CHANGE reg_stokbarang reg_stokbarang BIGINT(64) NOT NULL, CHANGE stok_awal stok_awal BIGINT(64) NOT NULL, CHANGE stok_perbarui stok_perbarui BIGINT(64) NOT NULL');	
										if($tr_stokbarang){
											echo "Finished Change Type Data";
										}else{
											echo "Updating field tr_stokbarang failed";
										}
									}else{
										echo "Updating field tr_penjualan failed";
									}
								}else{
									echo "Updating field tr_hargabarang failed";
								}
							}else{
								echo "Updating field user failed";
							}
						}else{
							echo "Updating field supplier failed";
						}
					}else{
						echo "Updating field stokbarang failed";
					}
				}else{
					echo "Updating field pelanggan failed";
				}
			}else{
				echo "Updating field Jenisbarang failed";
			}
		}else{
			echo "Updating field hargabarang failed";
		}

	}

	public function recoverytrpenjualan(){
		if(isset($_GET['limit'])){
			$limit = $_GET['limit'];
		}else{
			$limit = 50;
		}
		if(isset($_GET['offset'])){
			$offset = $_GET['offset'];
		}else{
			$offset = 0;
		}
		$query = $this->db->query("
			SELECT
			a.id_tr_penjualan,
			a.nomor_tr_penjualan,
			a.id_barang,
			a.nama_barang,
			b.stokbarang,
			b.reg_stokbarang 
		FROM
			tr_penjualan AS a,
			tm_stokbarang AS b 
		WHERE
			a.nama_barang = b.stokbarang and
			a.id_barang = '2147483647' 
		GROUP BY
			nama_barang 
		ORDER BY
			id_tr_penjualan ASC 
			LIMIT ".$limit."
			OFFSET ".$offset."
		")->result_array();
		foreach($query as $key => $value){
			$data[] = [
				'nama_barang' 		=> $value['nama_barang'],
				'id_barang'			=> $value['reg_stokbarang'],
			];
		}
		$offsetfix = $offset+$limit;
		echo $offsetfix;
		$this->db->update_batch('tr_penjualan', $data, 'nama_barang');
		header( "refresh:10;url=".base_url('attribute/recoverytrpenjualan?offset=0') );
	}

	public function recoverytrstokbarang(){
		if(isset($_GET['limit'])){
			$limit = $_GET['limit'];
		}else{
			$limit = 50;
		}
		if(isset($_GET['offset'])){
			$offset = $_GET['offset'];
		}else{
			$offset = 0;
		}
		$query = $this->db->query("
		SELECT
			a.id_tr_stokbarang,
			a.nomor_tr,
			a.reg_stokbarang,
			a.created_at,
			b.nama_barang,
			c.reg_stokbarang as reg_stokbarangfix
		FROM
			tr_stokbarang AS a,
			tr_penjualan AS b,
			tm_stokbarang as c
		WHERE
			a.reg_stokbarang = '2147483647' and
			a.nomor_tr = b.nomor_tr_penjualan and
			a.created_at = b.created_at and
			b.id_barang = c.reg_stokbarang
		ORDER BY
			a.id_tr_stokbarang ASC 
		LIMIT ".$limit."
		OFFSET ".$offset."
		")->result_array();
		foreach($query as $key => $value){
			$data[] = [
				'id_tr_stokbarang' 		=> $value['id_tr_stokbarang'],
				'reg_stokbarang'		=> $value['reg_stokbarangfix'],
			];
		}
		$offsetfix = $offset+$limit;
		echo $offsetfix;
		$this->db->update_batch('tr_stokbarang', $data, 'id_tr_stokbarang');
		header( "refresh:10;url=".base_url('attribute/recoverytrstokbarang?offset=0') );
	}

	public function createindex_stokbarang(){
		$query = $this->db->query("
			CREATE INDEX stokbarang On tr_stokbarang(`harga_default`(50), `stok_perbarui`, `nomor_tr`, `reg_stokbarang`)
		");

		print_r($query);
	}

	public function createindex_penjualan(){
		$query = $this->db->query("
			CREATE INDEX penjualan On tr_penjualan(`id_barang`, `deleted_at`, `nomor_tr_penjualan`, `status_hold`, `payment_method`, `id_tr_penjualan`)
		");

		print_r($query);
	}
}
