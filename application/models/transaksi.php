<?php
class transaksi extends CI_Model {

    public function getnomorpenjualandaily()
    {
        $data = $this->db->query("select coalesce((max(nomor_tr_penjualan)+1),1) as nomor_transaksi_penjualan from tr_penjualan where status_hold = '3' and created_at like '".date('Y-m-d')."%'");
        return $data->row_array();
    }

}