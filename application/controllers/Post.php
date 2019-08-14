<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
        	$this->load->helper('dnl');
            if(null == $this->session->userdata('nip')){
            	redirect('/login/index/');
            	die();
            }
    }

	public function insertsurat()
	{

		$alert = '';
		// LOWERCASE Extension
		$imageFileType = strtolower(pathinfo($_FILES["file_surat"]["name"],PATHINFO_EXTENSION));
		// DIRECTORY
		$target_dir = $_SERVER['SCRIPT_FILENAME'].'/../static/';
		$target_file = $target_dir . date('Y-m-d__H-i-s').'__'.$_POST['melalui_surat'].'.'.$imageFileType;
		$target_filex = $_SERVER['HTTP_HOST'] .'/ndaletter/static/'. date('Y-m-d__H-i-s').'__'.$_POST['melalui_surat'].'.'.$imageFileType;
		// VALIDASI
		$uploadOk = 1;
		// CEK UKURAN
		if ($_FILES["file_surat"]["size"] > 5000000) {
		    $alert .= "File Lebih Dari 5MB<br/>";
		    $uploadOk = 0;
		}
		// CEK FORMAT
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "pdf" ) {
			$alert .= "Hanya Diperbolehkan Upload File Berekstensi jpg, png, jpeg, gif, pdf<br/>";
		    $uploadOk = 0;
		}
		// VALIDASI
		if ($uploadOk == 0) {
		   $alert .= "File Tidak Terupload<br/>";
		} else {
		    if (move_uploaded_file($_FILES["file_surat"]["tmp_name"], $target_file)) {
		        // echo "The file ". basename( $_FILES["file_surat"]["name"]). " has been uploaded.";
		        $alert .= "Berhasil";
		    } else {
		   		$alert .= "Error Pada Saat Upload File<br/>";
		    }
		}


		$data = array(
		        'nomor_surat' 	=> escapeString($_POST['nomor_surat']),
		        'perihal' 		=> escapeString($_POST['perihal_surat']),
		        'file' 			=> $target_filex,
		        'dari' 			=> escapeString($_POST['dari_surat']),
		        'melalui' 		=> escapeString($_POST['melalui_surat']),
		        'ke' 			=> escapeString($_POST['ke_surat']),
		        'validasi' 		=> escapeString($_POST['inisurat']),
		);

		$this->db->insert('tb_history', $data);

		echo $alert;

	}
}
