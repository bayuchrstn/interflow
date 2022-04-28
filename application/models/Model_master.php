<?php

class Model_master extends CI_Model
{

    function insert_data($data = "")
    {
        $this->db->insert('master', $data);
    }

    function update_data($data = "", $id = "")
    {
        $this->db->where('id_app', $id);
        $this->db->update('master', $data);
    }

    function delete_data($kode = "")
    {
        $this->db->where('id_app', $kode);
        $this->db->delete('master');
    }

    function tampil_by_id($kode = "")
    {
        $this->db->select('*');
        $this->db->where('id_app', $kode);
        $this->db->from('master');

        return $this->db->get();
    }
    function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('master');

        return $this->db->get();
    }
}
