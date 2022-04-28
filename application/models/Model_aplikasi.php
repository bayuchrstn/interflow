<?php

class Model_aplikasi extends CI_Model
{

    function insert_dataapp($data = "")
    {
        $this->db->insert('tb_user_app', $data);
    }

    function insert_datamenu($data = "")
    {
        $this->db->insert('tb_user_menu', $data);
    }

    function update_dataapp($data = "", $id = "")
    {
        $this->db->where('usr_id', $id);
        $this->db->update('tb_user_app', $data);
    }

    function delete_data1($kode = "")
    {
        $this->db->where('usr_id', $kode);
        $this->db->delete('tb_user_menu');
    }

    function tampilmenu_by_id($kode = "")
    {
        $this->db->select('*');
        $this->db->where('usr_id', $kode);
        $this->db->from('tb_user_menu');

        return $this->db->get();
    }

    function tampilapp_by_id($kode = "")
    {
        $this->db->select('*');
        $this->db->join('tb_user_app', 'tb_user_app.usr_id=users.usr_id');
        $this->db->from('users');
        $this->db->where('tb_user_app.usr_id', $kode);

        return $this->db->get();
    }

    function get_user()
    {
        $this->db->select('*');
        $this->db->join('users', 'tb_user_app.usr_id=users.usr_id', 'left');
        $this->db->from('tb_user_app');

        return $this->db->get();
    }

    function get_parent($id = "")
    {
        $this->db->select('parent');
        $this->db->where('id', $id);
        $this->db->from('tb_menu');

        return $this->db->get();
    }

    function get_app($id = "")
    {
        $this->db->select('*');
        $this->db->where('usr_id', $id);
        $this->db->from('tb_user_app');

        return $this->db->get();
    }

    function get_allmenu($level = "")
    {
        $this->db->select('*');
        $this->db->where('parent=0');
        $this->db->where('level', $level);
        $this->db->from('tb_menu');
        $this->db->order_by("id", "asc");

        return $this->db->get();
    }

    function get_child($id = "")
    {
        $this->db->select('*');
        $this->db->where('parent', $id);
        $this->db->from('tb_menu');

        return $this->db->get();
    }

    function get_users()
    {
        $this->db->select('*');
        $this->db->join('users', 'tb_user_app.usr_id=users.usr_id');
        $this->db->from('tb_user_app');

        return $this->db->get();
    }

    function get_users1($kode)
    {
        $this->db->select('*');
        $this->db->join('users', 'tb_user_app.usr_id=users.usr_id');
        $this->db->from('tb_user_app');
        $this->db->like('users.usr_name', $kode);
        $this->db->LiMIT(5);

        return $this->db->get();
    }

    function get_menu_byusers($id)
    {
        $this->db->select('*');
        $this->db->where('usr_id', $id);
        $this->db->from('tb_user_menu');

        return $this->db->get();
    }

    function get_menu_byusers2($id)
    {
        $this->db->select('*');
        $this->db->join('users', 'tb_user_menu.usr_id=users.usr_id');
        $this->db->where('usr_id', $id);
        $this->db->from('tb_user_menu');

        return $this->db->get();
    }

    function get_menu1($kode)
    {
        $this->db->select('*');
        $this->db->like('kota', $kode);
        $this->db->from('ms_kota');

        return $this->db->get();
    }

    function get_app2()
    {
        $this->db->select('*');
        $this->db->from('master');

        return $this->db->get();
    }

    function get_app1($kode)
    {
        $this->db->select('*');
        $this->db->where('usr_id', $kode);
        $this->db->from('tb_user_app');

        return $this->db->get();
    }

    function get_menu($user_id = '', $parent = '', $level = '')
    {
        return $this->db->query("SELECT a.*, COALESCE(tb_user_menu.`parent`,0) AS hitung,
                                    CASE WHEN (c.id_menu <> '') THEN TRUE ELSE FALSE END AS checked 
                                    FROM tb_menu a
                                    LEFT JOIN (
                                        SELECT parent, COUNT(*) AS jml
                                            FROM tb_menu
                                            GROUP BY parent
                                    ) tb_user_menu ON a.`id`=tb_user_menu.`parent`
                                    LEFT JOIN (
                                        SELECT id_menu FROM tb_user_menu
                                            WHERE usr_id='$user_id'
                                    ) AS c ON c.`id_menu` = a.`id`
                                    WHERE a.`level`='$level'
                                    AND a.`status`=1
                                    AND a.`parent`='$parent'
                                    GROUP BY a.`id`")->result();
    }
}
