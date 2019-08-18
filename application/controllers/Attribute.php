<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends CI_Controller {

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
}
