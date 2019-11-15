<?php
class transaksi extends CI_Model {

    public function getnomorpenjualandaily()
    {
        $data = $this->db->query("select coalesce((max(nomor_tr_penjualan)+1),1) as nomor_transaksi_penjualan from tr_penjualan where status_hold != '1' and (status_muncul = '1' or status_hold = 3) and created_at like '".date('Y-m-d')."%'");
        $dataecho = $data->row_array();
        if(strlen($dataecho['nomor_transaksi_penjualan']) < 10 ){
            $datafix = array(
                'nomor_transaksi_penjualan' => date('ymd')."000".$dataecho['nomor_transaksi_penjualan']
            );
        }else{
            $datafix = $dataecho;
        }
        return $datafix;
    }

    public function getransactionnow($notrans)
    {
        $data = $this->db->query("select ROW_NUMBER() OVER (ORDER BY id_tr_penjualan) AS no, id_tr_penjualan, nama_barang, harga_fix, jumlah_barang, satuan, (harga_fix * jumlah_barang) as jumlah, id_pelanggan, id_barang, created_at from tr_penjualan where nomor_tr_penjualan = '".$notrans."' and status_muncul = '1' order by created_at DESC");
        $dataecho = $data->result_array();
        return $dataecho;
    }

    public function getbarang($nomortr, $idbarang)
    {
        $data = $this->db->query("select id_tr_penjualan, jumlah_barang from tr_penjualan where nomor_tr_penjualan = '".$nomortr."' and id_barang = '".$idbarang."' and status_muncul = '1' ");
        $dataecho = $data->row_array();
        return $dataecho;
    }

    public function getholding()
    {
        $data = $this->db->query("select nomor_tr_penjualan from tr_penjualan where status_hold != '3' and status_muncul != '2' group by nomor_tr_penjualan");
        $dataecho = $data->result_array();
        return $dataecho;
    }

    public function getfinished()
    {
        $data = $this->db->query("select nomor_tr_penjualan from tr_penjualan where status_hold = '3' and status_muncul = '2' and payment_method = 'tunai' group by nomor_tr_penjualan order by nomor_tr_penjualan DESC");
        $dataecho = $data->result_array();
        return $dataecho;
    }

    public function getdatatransaction($get)
    {
        $data = $this->db->query("select nomor_tr_penjualan, id_barang, nama_barang, jumlah_barang, harga_fix, satuan, pembayaran_terakhir from tr_penjualan where nomor_tr_penjualan = '".$get."' and status_hold = '3'");
        $dataecho = $data->result_array();
        return $dataecho;
    }

    public function getpelanggan($id){
        $data = $this->db->query("
        SELECT
            a.id_pelanggan AS reg_pelanggan,
            b.pelanggan 
        FROM
            tr_penjualan a,
            tm_pelanggan b 
        WHERE
            a.id_pelanggan = b.reg_pelanggan 
            AND a.status_muncul != '2'
            AND a.nomor_tr_penjualan = '".$id."'
        ORDER BY a.id_pelanggan DESC
        ");
        $dataecho = $data->row_array();
        return $dataecho;
    }

    public function getransactionall($notrans)
    {
        $data = $this->db->query("select ROW_NUMBER() OVER (ORDER BY id_tr_penjualan) AS no, id_tr_penjualan, nama_barang, harga_fix, jumlah_barang, satuan, (harga_fix * jumlah_barang) as jumlah, id_pelanggan, id_barang, created_at from tr_penjualan where nomor_tr_penjualan = '".$notrans."' order by created_at ASC");
        $dataecho = $data->result_array();
        return $dataecho;
    }

    public function getnomorfaktur()
    {
        $data = $this->db->query("select coalesce((max(nomor_tr_penjualan)+1),1) as nomor_transaksi_penjualan from tr_penjualan where status_hold != '1' and (status_muncul = '1' or status_hold = 3) and created_at like '".date('Y-m-d')."%'");
        $dataecho = $data->row_array();
        if(strlen($dataecho['nomor_transaksi_penjualan']) < 7 ){
            $datafix = array(
                'nomor_transaksi_penjualan' => date('ymd').$dataecho['nomor_transaksi_penjualan']
            );
        }else{
            $datafix = $dataecho;
        }
        return $datafix;
    }

}