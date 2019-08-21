<?php
class mastermodel extends CI_Model {

    public function getkelurahan($search)
    {
        $data = $this->db->query("select id_kelurahan, nama_provinsi, nama_kabupaten, nama_kecamatan, nama_kelurahan from t_lokasi where (nama_kelurahan like '%".$search."%' or nama_kecamatan like '%".$search."%' or nama_provinsi like '%".$search."%') order by id_kelurahan DESC limit 50");
        return $data->result_array();
    }

    public function getkelurahanlist($id)
    {
        $data = $this->db->query("select id_kelurahan, nama_provinsi, nama_kabupaten, nama_kecamatan, nama_kelurahan from t_lokasi where id_kelurahan = '".$id."' order by id_kelurahan DESC limit 1");
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
        $this->db->order_by('a.reg_supplier', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deletesupplier($id)
    {
        $data = array(
            'status_muncul' => '2',
            'deleted_at'  => date('Y-m-d H:i:s')
        );
        $this->db->where('reg_supplier', $id);
        $this->db->update('tm_supplier', $data);
        return true;
    }
    
    public function getdatasuppliercountsearch($validasi, $cari) {
        $where = "status_muncul = '".$validasi."' and (a.reg_supplier like '%".$cari."%' or a.nama_supplier like '%".$cari."%' or a.atas_nama like '%".$cari."%' or a.kontak_supplier like '%".$cari."%' or a.alamat like '%".$cari."%' or b.nama_provinsi like '%".$cari."%' or b.nama_kabupaten like '%".$cari."%' or b.nama_kecamatan like '%".$cari."%' or b.nama_kelurahan like '%".$cari."%') ";
        $this->db->select('count(a.reg_supplier) as allcount');
        $this->db->from('tm_supplier as a');
        $this->db->join('t_lokasi b', 'a.id_kelurahan = b.id_kelurahan', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatasuppliersearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (a.reg_supplier like '%".$cari."%' or a.nama_supplier like '%".$cari."%' or a.atas_nama like '%".$cari."%' or a.kontak_supplier like '%".$cari."%' or a.alamat like '%".$cari."%' or b.nama_provinsi like '%".$cari."%' or b.nama_kabupaten like '%".$cari."%' or b.nama_kecamatan like '%".$cari."%' or b.nama_kelurahan like '%".$cari."%') ";
        $this->db->select('a.reg_supplier, a.nama_supplier, a.atas_nama, a.kontak_supplier, a.alamat, a.id_kelurahan, b.nama_provinsi, b.nama_kabupaten, b.nama_kecamatan, b.nama_kelurahan');
        $this->db->from('tm_supplier as a');
        $this->db->join('t_lokasi b', 'a.id_kelurahan = b.id_kelurahan', 'left');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_supplier', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }



}