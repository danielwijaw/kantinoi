<?php
class dataletter extends CI_Model {

    public function getletter_notif()
    {
        $data = $this->db->query("SELECT * FROM tb_history where view = '1' and ke = '".$this->session->userdata('nip')."' order by id_history DESC limit 4");
        return $data->result_array();
    }

    public function skipnotif()
    {
    	$this->db->set('view', '2');
    	$this->db->update('tb_history');
    }

    public function getlogin($login)
    {
        $data = $this->db->get_where('tm_user', array('nip' => $login['nip'], 'password' => $login['password']));
        return $data->result_array();
    }

    public function getuser()
    {
        $data = $this->db->get('tm_user');
        return $data->result_array();
    }

    public function getdatasurat($validasi, $rowno, $rowperpage)
    {
        $this->db->select('a.*, b.nama as nama_dari, c.nama as nama_ke');
        $this->db->from('tb_history as a');
        $this->db->join('tm_user b', 'a.dari = b.nip', 'left');
        $this->db->join('tm_user c', 'a.ke = c.nip', 'left');
        $this->db->where('validasi =', $validasi);
        $this->db->limit($rowperpage, $rowno);  
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdatasuratcount($validasi) {

        $this->db->select('count(*) as allcount');
        $this->db->from('tb_history');
        $this->db->where('validasi =', $validasi);
        $query = $this->db->get();
        $result = $query->result_array();
     
        return $result[0]['allcount'];
    }

}