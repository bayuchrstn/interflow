<?php

class Model_login extends CI_Model {

    function cek($username = "", $password = "") {
        $this->db->select('a.`id` AS id, a.`username`, a.`first_name`, a.`fullname`,  
                            a.`email`, a.`tipe`, CONCAT(a.host, a.`foto`) AS foto,  
                            b.`id` AS id_cabang, b.`nama`'); 
        $this->db->where('a.`username`', $username);
        $this->db->where('a.`password`', md5($password));
        $this->db->where('a.`status`', 1);
        $this->db->from('manage_user a');
        $this->db->join('ms_cabang b','a.`cabang`=b.`id`','left');
        $this->db->group_by('a.id');
        return $this->db->get();
    }

    function update_user($username = "", $data = "") {
        $this->db->where('username', $username);
        $this->db->update('manage_user', $data);
    }
}
