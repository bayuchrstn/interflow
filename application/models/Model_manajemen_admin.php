<?php

class Model_manajemen_admin extends CI_Model
{
    function get_menu()
    {
        $q = $this->db->query("SELECT * FROM admin_menu a WHERE a.`flag`=1 ORDER BY a.`parent` ASC,a.`order` ASC")->result();
        return $q;
    }

    function get_child($id)
    {
        $q = $this->db->query("SELECT * FROM admin_menu a WHERE a.`flag`=1 AND a.`parent` = $id ORDER BY a.`order` ASC")->result();
        return $q;
    }
}
