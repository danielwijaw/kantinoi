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
}
