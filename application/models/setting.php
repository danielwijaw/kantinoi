<?php
class setting extends CI_Model {

    public function getsetting()
    {
        $data = $this->db->query("SELECT * FROM t_setting");
        $datax = $data->result_array();
        foreach($datax as $key => $value){
            $rsz[$value['setting_key']] = $value;
        }
        return $rsz;
    }

}