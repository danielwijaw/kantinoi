<?php
class mastermodel extends CI_Model {

    public function getkelurahan($search)
    {
        $data = $this->db->query("select id_kelurahan, nama_provinsi, nama_kabupaten, nama_kecamatan, nama_kelurahan from t_lokasi where (nama_kelurahan like '%".$search."%' or nama_kecamatan like '%".$search."%' or nama_provinsi like '%".$search."%') order by id_kelurahan DESC limit 50");
        return $data->result_array();
    }

    public function getdatasuppliercount($validasi) {

        $this->db->select('count(reg_supplier) as allcount');
        $this->db->from('tm_supplier');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatasupplier($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.reg_supplier, a.nama_supplier, a.atas_nama, a.kontak_supplier, a.alamat, a.id_kelurahan, b.nama_provinsi, b.nama_kabupaten, b.nama_kecamatan, b.nama_kelurahan');
        $this->db->from('tm_supplier as a');
        $this->db->join('t_lokasi b', 'a.id_kelurahan = b.id_kelurahan', 'left');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $query = $this->db->get();
        return $query->result_array();
    }



}