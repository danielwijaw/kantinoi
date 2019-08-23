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

    // START DATA SUPPLIER

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

    // END DATA SUPPLIER

    // START DATA JENIS BARANG

    public function getdatajenisbarangcount($validasi) {

        $this->db->select('count(reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatajenisbarang($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatajenisbarangcountsearch($validasi, $cari) {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('count(a.reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatajenisbarangsearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA JENIS BARANG

    // START DATA STOK BARANG

    public function getdatastokbarangcount($validasi) {

        $this->db->select('count(reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatastokbarang($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatastokbarangcountsearch($validasi, $cari) {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('count(a.reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatastokbarangsearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA STOK BARANG

    // START DATA HARGA BARANG

    public function getdatahargabarangcount($validasi) {

        $this->db->select('count(reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatahargabarang($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatahargabarangcountsearch($validasi, $cari) {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('count(a.reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatahargabarangsearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA HARGA BARANG

    // START DATA PELANGGAN

    public function getdatapelanggancount($validasi) {

        $this->db->select('count(reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatapelanggan($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatapelanggancountsearch($validasi, $cari) {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('count(a.reg_jenisbarang) as allcount');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatapelanggansearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (a.reg_jenisbarang like '%".$cari."%' or a.jenisbarang like '%".$cari."%')";
        $this->db->select('a.reg_jenisbarang, a.jenisbarang');
        $this->db->from('tm_jenisbarang as a');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_jenisbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA PELANGGAN



}