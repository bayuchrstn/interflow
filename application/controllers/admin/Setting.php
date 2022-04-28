<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Main_model', '', true);
        $this->load->model('Setting_Model', '', true);
        
        $this->css_include = '';
        $this->js_include = '';
        if (!$this->session->userdata('username')) {
            redirect('Login');
        }
    }

    
    function account_setting() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Account Settings';
        $footer['js'] = '<script src="'.base_url('assets/js/setting/account_setting.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/setting/account_setting');
        $this->load->view('admin/footer', $footer);
    }

    function ajax_change_password() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            
            if ($old_password == "" || $new_password == "" || $confirm_password == "" || $new_password != $confirm_password) {
                $message = "";
                if ($old_password == "") $message.="Password Lama masih kosong <br>";
                if ($new_password == "") $message.="Password Baru masih kosong <br>";
                if ($confirm_password == "") $message.="Konfirmasi Password Baru masih kosong <br>";

                if ($old_password != "" && $new_password != "" && $confirm_password != "") {

                    if ($new_password != $confirm_password) 
                        $message.="Konfirmasi Password salah <br>";

                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'password' => md5($confirm_password)
            ); 

            $cek_pass = $this->Setting_Model->check_old_pass($id, $old_password);

            if (!empty($cek_pass)) {
                $save_h = $this->Main_model->proses_data('manage_user', $data_h, array('id' => $id));
            } else {
                $message ="Password Lama salah";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }
            
                


            if ($save_h > 0 || $save_h == 0) {
                $respon = array('status' => TRUE, 'message' => 'Password berhasil diganti');
            } else {
                $respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
            }

            echo json_encode($respon);

        } else {
            show_404();
        }
    }



}



?>