<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login');
        $this->load->model('Model_admin', 'model_admin');
    }
    public function index()
    {
        if ($this->session->userdata('user_id')) {
            redirect('admin/Dashboard');
        } else {
            $this->load->view('login');
        }
    }

    public function user_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->Model_login->cek($username, $password);
        if ($result->num_rows() == 1) :

            foreach ($result->result() as $data)
                $sess_array = array(
                    'id'        => $data->id,
                    'username'  => $data->username,
                    'nama'      => $data->fullname, // first_name
                    'email'     => $data->email,
                    'level'     => $data->tipe,
                    'cabang'    => $data->nama,
                    'id_cabang' => $data->id_cabang,
                    'foto'      => $data->foto,
                    'menu'      => json_decode($this->buildTree($this->model_admin->get_menu($data->tipe)))
                );
            /*$user = $this -> users -> get($login);*/
            $this->session->set_userdata('user_id', $sess_array);
            /*redirect(site_url('home'));*/
            echo 1;
        else :
            echo 0;
        endif;
    }

    function login_auth()
    {
        if ($this->session->userdata('user_id')) {
            $session_data = $this->session->userdata('user_id');
            $data['id'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $data['nama'] = $session_data['nama'];
            $data['email'] = $session_data['email'];
            $data['level'] = $session_data['level'];
            $data['menu'] = $session_data['menu'];
            $data['cabang'] = $session_data['cabang'];
            $data['id_cabang'] = $session_data['id_cabang'];
            $data['foto'] = $session_data['foto'];
            $this->session->set_userdata($data);
            redirect('admin/Dashboard', 'refresh');
        } else {
            //If no session, redirect to login page
            redirect('Login', 'refresh');
        }
    }

    function buildTree($elements)
    {
        $branch = $child = array();
        foreach ($elements as $row) {
            // pre($parentId);
            if ($row->parent == 0) {
                $child = $this->get_child($row->id);
            } else {
                $child = array();
            }
            $branch[] = array(
                'id' => $row->id,
                'parent' => $row->parent,
                'kategori' => $row->categories,
                'label' => $row->name,
                'url' => $row->url,
                'icon' => $row->icon,
                'order' => $row->order,
                'child' => $child
            );
        }

        return json_encode($branch);
    }

    function get_child($parent)
    {
        $list = $check = null;
        $child = $data = array();
        
        $username= $this->input->post('username');
        $password = $this->input->post('password');
        $user_login = $this->Model_login->cek($username, $password)->row();
        $level = $user_login->tipe;
        
        // $level = $this->session->userdata('level');
        $list = $this->model_admin->get_child($parent,$level);
        foreach ($list as $row) {
            $check = $this->model_admin->get_child($row->id, $level);
            if (!empty($check)) {
                $child = $this->get_child($row->id);
            } else {
                $child = array();
            }
            $data[] = array(
                'id' => $row->id,
                'parent' => $row->parent,
                'kategori' => $row->categories,
                'label' => $row->name,
                'url' => $row->url,
                'icon' => $row->icon,
                'order' => $row->order,
                'child' => $child
            );
        }
        return $data;
    }
}
