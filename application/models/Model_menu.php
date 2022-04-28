<?php

class Model_menu extends CI_Model
{

    function insert_dataapp($data = "")
    {
        $this->db->insert('tb_user_app', $data);
    }

    function insert_datamenu($data = "")
    {
        $this->db->insert('tb_menu', $data);
    }

    function insert_datadrafmenu($data = "")
    {
        $this->db->insert('draf_tb_menu', $data);
    }


    function update_datadrafmenu($data = "", $id = "")
    {
        $this->db->where('id', $id);
        $this->db->update('draf_tb_menu', $data);
    }

    function delete_datadrafmenu($id = "", $kode = "")
    {
        $this->db->where('id', $id);
        $this->db->where('id_app', $kode);
        $this->db->delete('draf_tb_menu');
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

    function check_urutan($kode = "", $parent = "", $level = "")
    {
        $this->db->select('urutan');
        $this->db->where('id_app', $kode);
        $this->db->where('parent', $parent);
        $this->db->where('level', $level);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function check_urutan2($id = "")
    {
        $this->db->select('urutan');
        $this->db->where('id', $id);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function get_user()
    {
        $this->db->select('*');
        $this->db->join('users', 'tb_user_app.usr_id=users.usr_id', 'left');
        $this->db->from('tb_user_app');

        return $this->db->get();
    }

    function get_parent($id = "", $level = "", $kode = "", $kod = "")
    {
        $this->db->select('id,label,parent');
        $this->db->where('id_app', $id);
        $this->db->where('level', $level);
        $this->db->where('id !=', $kod);
        $this->db->like('label', $kode);
        $this->db->from('draf_tb_menu');
        $this->db->LiMIT(5);
        return $this->db->get();
    }

    function get_parent1($kode = "", $level = "", $kod = "")
    {
        $this->db->select('id,label,parent');
        $this->db->where('level', $level);
        $this->db->where('id !=', $kod);
        $this->db->where('id_app', $kode);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function get_app($kode = "")
    {
        $this->db->select('*');
        $this->db->like('nama_app', $kode);
        $this->db->from('master');
        $this->db->LIMIT(5);

        return $this->db->get();
    }

    function get_app2()
    {
        $this->db->select('*');
        $this->db->from('master');

        return $this->db->get();
    }

    function get_allapp()
    {
        return $this->db->query("SELECT DISTINCT(tb_menu.`id_app`),master.`nama_app`,master.`platform` 
        FROM MASTER INNER JOIN tb_menu ON tb_menu.`id_app`=master.`id_app`")->result();
    }

    function get_child($id = "", $parent = "", $level = "")
    {
        $this->db->select('*');
        $this->db->where('parent', $parent);
        $this->db->where('id_app', $id);
        $this->db->where('level', $level);
        $this->db->from('tb_menu');

        return $this->db->get();
    }

    function get_child2($id = "", $parent = "", $level = "")
    {
        $this->db->select('*');
        $this->db->where('parent', $parent);
        $this->db->where('id_app', $id);
        $this->db->where('level', $level);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function get_menu2()
    {
        $this->db->select('id,label');
        $this->db->from('draf_tb_menu');
        return $this->db->get();
    }

    function get_menu1($kode)
    {
        $this->db->select('id,label');
        $this->db->like('label', $kode);
        $this->db->from('draf_tb_menu');
        $this->db->LiMIT(5);

        return $this->db->get();
    }

    function get_app_byid($id)
    {
        $this->db->select('*');
        $this->db->where('id_app', $id);
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

    function get_view($user_id = '', $parent = '', $level = '')
    {
        $this->db->select('*,COALESCE(parent,0) AS hitung');
        $this->db->where('id_app', $user_id);
        $this->db->where('parent', $parent);
        $this->db->where('level', $level);
        $this->db->from('tb_menu');

        return $this->db->get();
    }

    function get_view2($user_id = '', $parent = '', $level = '')
    {
        $this->db->select('*,COALESCE(parent,0) AS hitung');
        $this->db->where('id_app', $user_id);
        $this->db->where('parent', $parent);
        $this->db->where('level', $level);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function hapus_draf()
    {
        $this->db->empty_table('draf_tb_menu');
    }

    function get_delmenu2($id = "", $level = "")
    {
        $this->db->select('id,label');
        $this->db->where('id_app', $id);
        $this->db->where('level', $level);
        $this->db->from('draf_tb_menu');
        return $this->db->get();
    }

    function get_delmenu1($id = "", $level = "", $kode = "")
    {
        $this->db->select('id,label');
        $this->db->where('id_app', $id);
        $this->db->where('level', $level);
        $this->db->like('label', $kode);
        $this->db->from('draf_tb_menu');
        $this->db->LiMIT(5);

        return $this->db->get();
    }

    function get_drafmenu_byid($id = "")
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function get_label($kode = "")
    {
        $this->db->select('label');
        $this->db->where('id', $kode);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }
    function get_alldraf()
    {
        $this->db->select('*');
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function check_deldraf($id)
    {
        $this->db->select('*,COALESCE(parent,0) AS hitung');
        $this->db->where('id', $id);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function check_child($id)
    {
        $this->db->select('COUNT(id) AS hasil');
        $this->db->where('parent', $id);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }

    function get_parent_edit($id = "", $level = "", $kode = "", $kod = "", $parent = "")
    {
        $this->db->select('id,label,parent');
        $this->db->where('id_app', $id);
        $this->db->where('level', $level);
        $this->db->where('id !=', $kod);
        $this->db->where('parent >', $parent);
        $this->db->like('label', $kode);
        $this->db->from('draf_tb_menu');
        $this->db->LiMIT(5);
        return $this->db->get();
    }

    function get_parent1_edit($kode = "", $level = "", $kod = "", $parent = "")
    {
        $this->db->select('id,label,parent');
        $this->db->where('level', $level);
        $this->db->where('id !=', $kod);
        $this->db->where('parent >', $parent);
        $this->db->where('id_app', $kode);
        $this->db->from('draf_tb_menu');

        return $this->db->get();
    }
}
