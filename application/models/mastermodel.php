<?php
class mastermodel extends CI_Model {

    public function getkasir($search)
    {
        $data = $this->db->query("select nip, nama, jabatan from tm_user where (nip like '%".$search."%' or nama like '%".$search."%' or jabatan like '%".$search."%') order by nip DESC limit 50");
        return $data->result_array();
    }

    public function getpelanggankasir($search)
    {
        $data = $this->db->query("select reg_pelanggan, pelanggan from tm_pelanggan where (reg_pelanggan like '%".$search."%' or pelanggan like '%".$search."%') order by reg_pelanggan DESC limit 50");
        return $data->result_array();
    }

    public function getjenisbaranglist($search)
    {
        $data = $this->db->query("select reg_jenisbarang, jenisbarang from tm_jenisbarang where reg_jenisbarang = '".$search."' order by reg_jenisbarang DESC limit 1");
        return $data->result_array();
    }

    public function getsupplierlist($search)
    {
        $data = $this->db->query("select reg_supplier, nama_supplier from tm_supplier where reg_supplier = '".$search."' order by reg_supplier DESC limit 1");
        return $data->result_array();
    }

    public function getjenisbarangsearch($search)
    {
        $data = $this->db->query("select reg_jenisbarang, jenisbarang from tm_jenisbarang where jenisbarang like '%".$search."%' and status_muncul = '1' order by reg_jenisbarang DESC limit 50");
        return $data->result_array();
    }

    public function getsuppliersearch($search)
    {
        $data = $this->db->query("select reg_supplier, nama_supplier from tm_supplier where nama_supplier like '%".$search."%' and status_muncul = '1' order by reg_supplier DESC limit 50");
        return $data->result_array();
    }

    public function getnamabarang($search)
    {
        $data = $this->db->query("select reg_stokbarang, stokbarang from tm_stokbarang where stokbarang like '%".$search."%' and status_muncul = '1' order by reg_stokbarang DESC limit 50");
        return $data->result_array();
    }

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

    public function getjumlahbarangpersupplier()
    {
        $this->db->select('sum(jumlahbarang) as jumlahbarang, reg_supplier');
        $this->db->from('tm_stokbarang');
        $this->db->group_by('reg_supplier');
        $this->db->order_by('reg_supplier', 'DESC');
        $query = $this->db->get();
        foreach($query->result_array() as $key => $value){
            $datax[$value['reg_supplier']]['jumlahbarang'] = $value['jumlahbarang'];
        }
        if(isset($datax)){
            $datax = $datax;
        }else{
            $datax = 0;
        }
        return $datax;
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

        $this->db->select('allcount');
        $this->db->from('v_countstokbarang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
        if(isset($result[0]['allcount'])){
            $result[0]['allcount'] = $result[0]['allcount'];
        }else{
            $result[0]['allcount'] = 0;
        }
        return $result[0]['allcount'];
    }
    
    public function getdatastokbarang($validasi, $rowno, $rowperpage)
    {
        $this->db->select('*');
        $this->db->from('v_stokbarang');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('reg_stokbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatastokbarangcountsearch($validasi, $cari) {
        error_reporting(0);
        $where = "status_muncul = '".$validasi."' and (reg_stokbarang like '%".$cari."%' or stokbarang like '%".$cari."%' or jumlahbarang like '%".$cari."%' or satuan like '%".$cari."%' or nama_supplier like '%".$cari."%' or jenisbarang like '%".$cari."%')";
        $this->db->select('allcount');
        $this->db->from('v_countstokbarang');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }
    
    public function getdatastokbarangsearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (reg_stokbarang like '%".$cari."%' or stokbarang like '%".$cari."%' or jumlahbarang like '%".$cari."%' or satuan like '%".$cari."%' or nama_supplier like '%".$cari."%' or jenisbarang like '%".$cari."%')";
        $this->db->select('*');
        $this->db->from('v_stokbarang');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('reg_stokbarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA STOK BARANG

    // START DATA HARGA BARANG

    public function getnamabarangid($id)
    {
        $data = $this->db->query("select * from tm_hargabarang where reg_hargabarang = '".$id."' ");
        return $data->result_array();
    }

    public function getdatahargabarangcount($validasi) {

        $this->db->select('allcount');
        $this->db->from('v_counthargabarang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
        if(isset($result[0]['allcount'])){
            $result[0]['allcount'] = $result[0]['allcount'];
        }else{
            $result[0]['allcount'] = 0;
        }
        return $result[0]['allcount'];
    }
    
    public function getdatahargabarang($validasi, $rowno, $rowperpage)
    {
        $this->db->select('*');
        $this->db->from('v_hargabarang');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('reg_hargabarang', 'DESC');
        $query = $this->db->get();
        if(isset($result[0]['allcount'])){
            $result[0]['allcount'] = $result[0]['allcount'];
        }else{
            $result[0]['allcount'] = 0;
        }
        return $query->result_array();
    }
    
    public function getdatahargabarangcountsearch($validasi, $cari) {
        error_reporting(0);
        $where = "status_muncul = '".$validasi."' and (stokbarang like '%".$cari."%' or hargabarang_grosir like '%".$cari."%' or hargabarang_retail like '%".$cari."%')";
        $this->db->select('allcount');
        $this->db->from('v_counthargabarang');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }
    
    public function getdatahargabarangsearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (stokbarang like '%".$cari."%' or hargabarang_grosir like '%".$cari."%' or hargabarang_retail like '%".$cari."%')";
        $this->db->select('*');
        $this->db->from('v_hargabarang');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('reg_hargabarang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA HARGA BARANG

    // START DATA PELANGGAN

    public function getdatapelanggancount($validasi) {

        $this->db->select('count(reg_pelanggan) as allcount');
        $this->db->from('tm_pelanggan');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatapelanggan($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.reg_pelanggan, a.pelanggan');
        $this->db->from('tm_pelanggan as a');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_pelanggan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatapelanggancountsearch($validasi, $cari) {
        $where = "status_muncul = '".$validasi."' and (a.reg_pelanggan like '%".$cari."%' or a.pelanggan like '%".$cari."%')";
        $this->db->select('count(a.reg_pelanggan) as allcount');
        $this->db->from('tm_pelanggan as a');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }
    
    public function getdatapelanggansearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (a.reg_pelanggan like '%".$cari."%' or a.pelanggan like '%".$cari."%')";
        $this->db->select('a.reg_pelanggan, a.pelanggan');
        $this->db->from('tm_pelanggan as a');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $this->db->order_by('a.reg_pelanggan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA PELANGGAN

    // START DATA PIUTANG

    public function getdatapiutangcount($validasi) {

        $this->db->select('allcount');
        $this->db->from('v_countpiutang');
        $this->db->where('status_muncul =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
        if(isset($result[0]['allcount'])){
            $result[0]['allcount'] = $result[0]['allcount'];
        }else{
            $result[0]['allcount'] = 0;
        }
        return $result[0]['allcount'];
    }
    
    public function getdatapiutang($validasi, $rowno, $rowperpage)
    {
        $this->db->select('*');
        $this->db->from('v_piutang');
        $this->db->where('status_muncul =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getdatapiutangcountsearch($validasi, $cari) {
        error_reporting(0);
        $where = "status_muncul = '".$validasi."' and (reg_stokbarang like '%".$cari."%' or stokbarang like '%".$cari."%' or satuan like '%".$cari."%' or nama_supplier like '%".$cari."%' or jenisbarang like '%".$cari."%' or piutang like '%".$cari."%' or stok_awal like '%".$cari."%' or stok_perbarui like '%".$cari."%')";
        $this->db->select('allcount');
        $this->db->from('v_countpiutang');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }
    
    public function getdatapiutangsearch($validasi, $rowno, $rowperpage, $cari)
    {
        $where = "status_muncul = '".$validasi."' and (reg_stokbarang like '%".$cari."%' or stokbarang like '%".$cari."%' or satuan like '%".$cari."%' or nama_supplier like '%".$cari."%' or jenisbarang like '%".$cari."%' or piutang like '%".$cari."%' or stok_awal like '%".$cari."%' or stok_perbarui like '%".$cari."%')";
        $this->db->select('*');
        $this->db->from('v_piutang');
        $this->db->where($where);
        $this->db->limit($rowperpage, $rowno);  
        $query = $this->db->get();
        return $query->result_array();
    }

    // END DATA PIUTANG



}