<?php
class transaksi extends CI_Model {

    public function getnomorpenjualandaily()
    {
        $data = $this->db->query("select coalesce((max(nomor_tr_penjualan)+1),1) as nomor_transaksi_penjualan from tr_penjualan where status_hold != '1' and status_muncul = '1' and created_at like '".date('Y-m-d')."%'");
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

    public function getransactionnow($notrans)
    {
        $data = $this->db->query("select ROW_NUMBER() OVER (ORDER BY id_tr_penjualan) AS no, id_tr_penjualan, nama_barang, harga_fix, jumlah_barang, satuan, (harga_fix * jumlah_barang) as jumlah, id_pelanggan, id_barang, created_at from tr_penjualan where nomor_tr_penjualan = '".$notrans."' and status_muncul = '1' order by created_at ASC");
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

}