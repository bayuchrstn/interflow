<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_admin', $id);
        $this->db->delete('admin');
    }

    public function check_pass($password, $old_password)
    {
        $password = $this->session->userdata('password');
        $old_password = $this->input->post('old_password');
        if ($password == $old_password) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_admin', $id);
        $this->db->update('admin', $data);
    }

    public function checkOldPass($old_password)
    {
        $id = $this->input->post('id');
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('id_admin', $id);
        $this->db->where('password', $old_password);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    public function saveNewPass($new_pass)
    {
        $data = array(
            'password' => $new_pass
        );
        $this->db->where('id_admin', $this->input->post('id'));
        $this->db->update('users', $data);
        return true;
    }

    function setHistory($aksi = '', $keterangan = '')
    {
        $username = $this->session->userdata('user_id')['username'];
        $data = array(
            'user' => $username,
            'aksi' => $aksi,
            'keterangan' => $keterangan,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'mac_address' => $_SERVER['REMOTE_ADDR'],
            'nama_host' => gethostname()
        );
        $this->db->insert('t_history', $data);
    }

    public function get_text_log($id)
    {
        $this->db->select('judul');
        $this->db->from('text');
        $this->db->where('id_admin', $id);

        return $this->db->get();
    }
    public function get_admin()
    {
        $this->db->select('*');
        $this->db->from('admin');
        return $this->db->get();
    }
    public function select_admin_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id_admin', $id);
        return $this->db->get();
    }
    public function cek_data($username, $password)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get();
    }
    public function get_admin_username($username)
    {
        $this->db->where('username', $username);
        $this->db->from('admin');
        return $this->db->get();
    }
    public function insert_user($data)
    {
        $this->db->insert('admin', $data);
    }

    function count()
    {
        $this->db->select('count(id_admin) AS mmbr');
        $this->db->from('admin');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function get_menu($role_id = '')
    {
        $sql = "SELECT b.*
                FROM admin_menu_management a
                    INNER JOIN admin_menu b ON a.menu_id = b.id
                WHERE a.roles_id = '$role_id' AND b.flag = '1'
                    ORDER BY b.order ASC";

        $q = $this->db->query($sql)->result();

        // $q = $this->db->query("SELECT * FROM admin_menu a WHERE a.`flag`=1 ORDER BY a.`parent` ASC,a.`order` ASC")->result();
        return $q;
    }

    function get_child($id = '', $role_id = '')
    {

        $sql = "SELECT b.*
                FROM admin_menu_management a
                    INNER JOIN admin_menu b ON a.menu_id = b.id
                WHERE a.roles_id = '$role_id' AND b.parent = '$id' AND 
                    b.flag = '1' 
                    ORDER BY b.order ASC";

        $q = $this->db->query($sql)->result();

        /* $sql = "SELECT a.* 
                FROM admin_menu a 
                    INNER JOIN admin_menu_management b ON a.id = b.menu_id
                WHERE a.`flag`= '1' AND a.`parent` = '$id' AND 
                    b.roles_id = '$role_id' 
                ORDER BY a.`order` ASC"; */

        // $q = $this->db->query("SELECT * FROM admin_menu a WHERE a.`flag`=1 AND a.`parent` = $id ORDER BY a.`order` ASC")->result();

        return $q;
    }



    function get_roles_id($id = null) {
		if($id == false) {
			$q = $this->db->query("SELECT * FROM ms_role ORDER BY id ASC");
			return $q->result();
		} else {
			$q = $this->db->query("SELECT * FROM ms_role WHERE id = '$id'");
			return $q->row();
		}
    }

    function menu_tree__role($role_id) {
        $data = [];
        $sql = "SELECT b.id, b.name AS text, 
                    CASE 
                        WHEN b.icon = '' OR b.icon IS NULL THEN 'icon-folder'
                        ELSE b.icon
                    END AS icon, b.parent AS parent_id
                FROM admin_menu_management a
                    INNER JOIN admin_menu b ON a.menu_id = b.id
                WHERE a.roles_id = '$role_id' AND b.flag = '1'
                    ORDER BY b.order ASC";

		$q = $this->db->query($sql)->result();

		foreach($q as $id => $object)
		{
			foreach($object as $key => $value)
			{
				$data[$id][$key] = $value;
			}
			$data[$id]['state'] = [
				'opened' => true,
				'disabled' => false,
				'selected' => false
			];
		}

		return $data;
    }
    
    function array_menu($array,$parent_id = 0) {
        $temp_array = [];

      foreach($array as $element) {

          if($element['parent_id'] == $parent_id) {
              $element['children'] = $this->array_menu($array,$element['id']);
              $temp_array[] = $element;
          }
        }
        
        return $temp_array;
    }


    function ms_menu_tree() {
        $data = [];
        
        $sql = "SELECT b.id, b.name AS text, 
                    CASE 
                        WHEN b.icon = '' OR b.icon IS NULL THEN 'icon-folder'
                        ELSE b.icon
                    END AS icon, b.parent AS parent_id
                FROM admin_menu b
                WHERE b.flag = '1'
                    ORDER BY b.order ASC";

		$q = $this->db->query($sql)->result();

		foreach($q as $id => $object)
		{
			foreach($object as $key => $value)
			{
				$data[$id][$key] = $value;
			}
			$data[$id]['state'] = [
				'opened' => true,
				'disabled' => false,
				'selected' => false
			];
		}

		return $data;
	}


    function delete_menu_role($menu_id, $roles_id) {
        $sql = "DELETE a
                FROM admin_menu_management a
                    INNER JOIN admin_menu b ON a.menu_id = b.id
                 WHERE a.roles_id = '$roles_id'
                    AND (
                        a.menu_id = '$menu_id'
                        OR b.parent = '$menu_id'
                    )";

		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return "1";
		} else {
			return "0";
		}
    }
    


    function store_permission($roles_id, $menu_id) {
		/* $check = $this->db->select('COUNT(*) AS total')
					->from('admin_menu_management')
					->where('roles_id', $roles_id)
					->where('menu_id', $menu_id)
                    ->get()->row_array(); */
                    


        $sql = "SELECT COUNT(*) AS total 
                FROM admin_menu_management 
                WHERE roles_id = '$roles_id' AND 
                    menu_id = '$menu_id'";

        $check = $this->db->query($sql)->row_array();

		if ($check['total'] == 0) {
			$this->db->insert('admin_menu_management', [
				'roles_id' => $roles_id,
				'menu_id' => $menu_id
			]);
        }
    }

}
