<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Manage_menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Main_model', '', true);
        $this->load->model('Model_admin', 'model_admin');
        
        $this->css_include = '';
        $this->js_include = '';
        if (!$this->session->userdata('username')) {
            redirect('Login');
        }
    }
    public function index()
    {
        $data['title'] = 'Interflow | Manage Menu';
        $data['judul'] = 'Manage Menu';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_menu/menu.js?_='.rand()).'"></script>';
        // $menu['list_menu'] = json_decode($this->buildTree($this->model_admin->get_menu()));
        $form['master_role'] = $this->model_admin->get_roles_id();
        $js['tree_menu'] = $this->model_admin->array_menu($this->model_admin->ms_menu_tree());

        $this->load->view('admin/header', $data);
        $this->load->view('admin/menu/menu', $form); 
        $this->load->view('admin/footer', $footer);
        $this->load->view('admin/menu/js', $js);
    }


    function list_menu_role() {

        if($this->input->method() == 'post') {
            $role_id = $this->input->post('role');
            $menu_by_role = $this->model_admin->menu_tree__role($role_id);

            $data = [
                'role' => $this->model_admin->get_roles_id($role_id),
                'menu' => $this->model_admin->array_menu($menu_by_role)
            ];

            echo json_encode($data);
            // $this->json_print(200, $data);
            // print_r($data); exit;
        } else {
            show_404();
        }


    }






    public function delete_menu_role()
    {
        if($this->input->method() == 'post')
        {
            $rules = [
                [
                    'field' => 'menu_id', 'rules' => 'required'
                ],
                [
                    'field' => 'role', 'rules' => 'required'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if($this->form_validation->run() == false)
            {
                $message = [
                    'title' => 'Error',
                    'text' => 'Gagal menghapus menu',
                    'type' => 'error'
                ];

            } else {
                $menu_id = $this->input->post('menu_id');
                $roles_id = $this->input->post('role');

                $feed = $this->model_admin->delete_menu_role($menu_id, $roles_id);

                $role = $this->model_admin->get_roles_id($roles_id);
                $menu = $this->model_admin->array_menu($this->model_admin->menu_tree__role($roles_id));

                if($feed == '1') {
                    $message = [
                        'title' => 'Success',
                        'text' => 'Menu sudah dihapus',
                        'type' => 'success',
                        'role' => $role,
                        'menu' => $menu
                    ];

                } else {
                    $message = [
                        'title' => 'Error',
                        'text' => 'Gagal menghapus menu',
                        'type' => 'error',
                        'role' => $role,
                        'menu' => $menu
                    ];

                }
            }

            echo json_encode($message);

        } else {
            show_404();
        }

    }



    function store_permission() {
        if($this->input->method() == 'post' && $this->input->is_ajax_request()) {
            $roles_id = $this->input->post('role');

            foreach ($this->input->post('menus') as $menu_id) {

                $this->model_admin->store_permission($roles_id, $menu_id);

            }

            $data = [
                'role' => $this->model_admin->get_roles_id($roles_id),
                'menu' => $this->model_admin->array_menu($this->model_admin->menu_tree__role($roles_id))
            ];

            echo json_encode($data);
        } else {
            show_404();
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
        $list = $this->model_admin->get_child($parent);
        foreach ($list as $row) {
            $check = $this->model_admin->get_child($row->id);
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

?>