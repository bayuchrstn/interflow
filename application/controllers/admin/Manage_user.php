<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Model_manage_user', 'manage_user');
        $this->load->model('Main_model', '', true);
        if (!$this->session->userdata('id')) {
            redirect('Login');
        }
    }
    public function index()
    {
        $data['title'] = 'Interflow | Dashboard';
        $data['judul'] = 'Agent';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/admin/user');
        $this->load->view('admin/footer');
    }

    function super_admin()
    {
        $data['title'] = 'Interflow | Super Admin';
        $data['judul'] = 'Super Admin';
        $form['opt_cabang'] = $this->manage_user->options_cabang();
        $footer['js'] = '<script src="'.base_url('assets/js/manage_user/super_admin.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/super_admin/super_admin', $form);
        $this->load->view('admin/footer', $footer);
    }

    function get_data_super_admin()
    {
        $this->manage_user->get_data_super_admin();
    }

    function admin_cabang()
    {
        $data['title'] = 'Interflow | Admin Cabang';
        $data['judul'] = 'Admin Cabang';
        $form['opt_cabang'] = $this->manage_user->options_cabang();
        $footer['js'] = '<script src="'.base_url('assets/js/manage_user/admin_cabang.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/admin_cabang/admin_cabang', $form);
        $this->load->view('admin/footer', $footer);
    }

    function get_data_admin_cabang()
    {
        $this->manage_user->get_data_admin_cabang();
    }

    function agent()
    {
        $data['title'] = 'Interflow | Property Consultant';
        $data['judul'] = 'Property Consultant';
        $form['opt_cabang'] = $this->manage_user->options_cabang();
        $footer['js'] = '<script src="'.base_url('assets/js/manage_user/agent.js?_='.rand()).'"></script>';
        $form['opt_ref_agent'] = $this->manage_user->options_referensi_agen();
        $form['opt_religion'] = array(
            '0' => "Pilih Agama",
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Budha' => 'Budha'
        );

        $this->load->view('admin/header', $data);
        $this->load->view('admin/agent/agent', $form);
        $this->load->view('admin/footer', $footer);
    }

    function get_data_agent()
    {
        $this->manage_user->get_data_agent();
    }

    function premium_investor()
    {
        $data['title'] = 'Interflow | Agent';
        $data['judul'] = 'Premium Investor';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_user/premium_investor.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/premium_investor/premium_investor');
        $this->load->view('admin/footer', $footer);
    }

    function get_data_premium_investor()
    {
        $this->manage_user->get_data_premium_investor();
    }




    function reset_password($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];
            $default_pass = md5('1234');
            
            $reset = $this->Main_model->process_data('manage_user', ['password' => $default_pass], $condition);
            $status = 1;
            $message = 'Reset password berhasil';

            $result = array(
                'status' => $status,
                'message' => $message
            );
            // return json result
            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function select2_cabang() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $search = $this->input->post('q');
            // get data customer from model
            $cabang = $this->manage_user->options_cabang($search);

            // create array to store data
            $arr = [];
            if ($cabang) {
                // loop data and push to array
                foreach ($cabang as $row) {
                    $arr[] = array(
                        'id' => $row->id,
                        'text' => $row->nama
                    );
                }
            }

            // echo array to json
            echo json_encode($arr);
        } else {
            show_404();
        }
    }




    function ajax_simpan_super_admin() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $telp = $this->input->post('telp');
            $username = $this->input->post('username');
            $password = md5('1234');
            $cabang = $this->input->post('cabang');
            $email = $this->input->post('email');
            $deskripsi = $this->input->post('deskripsi');
            $fullname = $this->input->post('fullname');

            /* $name = $_FILES['file_img']['name'];
            $acak = rand(000000, 999999);
            $nama_file = str_replace(' ', '', $acak.'-'.$name);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/media/users/super_admin';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size'] = 1024 * 8;

            $this->load->library('upload', $config);
            $full_path = $config['upload_path'].$nama_file; */
            

            
            if ($fullname == "" /* $first_name == "" || $last_name == "" */ || $tempat_lahir == "" /* || $tgl_lahir == "" || $alamat == "" */ || $telp == "" || $username == "" || $cabang == "" || $email == "" /* || $deskripsi == "" */) { // || !$this->upload->do_upload('file_img')
                $message = "";
                if ($fullname == "") $message.="* Nama Lengkap masih kosong <br>";
                /* if ($first_name == "") $message.="* Nama Depan masih kosong <br>";
                if ($last_name == "") $message.="* Nama Belakang masih kosong <br>"; */
                if ($tempat_lahir == "") $message.="* Tempat Lahir masih kosong <br>";
                // if ($tgl_lahir == "") $message.="* Tanggal Lahir masih kosong <br>";
                // if ($alamat == "") $message.="* Alamat masih kosong <br>";
                if ($telp == "") $message.="* Phone masih kosong <br>";
                if ($username == "") $message.="* Username masih kosong <br>";
                // if (!$this->upload->do_upload('file_img')) $message .= $this->upload->display_errors(); // "File belum dipilih <br>"
                if ($cabang == "") $message.="* Cabang belum dipilih <br>";
                if ($email == "") $message.="* Email masih kosong <br>";
                // if ($deskripsi == "") $message.="* Deskripsi masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                /* 'first_name' => $first_name,
                'last_name' => $last_name, */
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,  
                // 'foto' => $nama_file,                 
                'alamat' => $alamat,
                'email' => $email,       
                'tipe'  => 1, // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor
                'phone' => $telp,
                'cabang' => $cabang,   
                // 'tgl_lahir' => $this->Main_model->convert_tanggal($tgl_lahir),
                'tempat_lahir' => $tempat_lahir, 
                'deskripsi' => $deskripsi,
                'status' => 1
                /* 'status_id' => $ ,
                'approve_at' => $ ,
                'approve_by' => $  */
            ); 

            $check_username = $this->Main_model->view_by_id('manage_user', ['username' => $username], 'row');

            if (empty($id)) { 

                if (empty($check_username)) {
                    $data_h['insert_by'] = $this->session->userdata('id');
                    $save_h = $this->Main_model->proses_data('manage_user', $data_h);
                    $id = $save_h; 
                } else {
                    $respon = array('status' => FALSE, 'message' => 'Username <b>'.$username.'</b> sudah pernah digunakan');
                    echo json_encode($respon);exit;
                }

            } else {
                
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('id');

                $save_h = $this->Main_model->proses_data('manage_user', $data_h, array('id' => $id));
                $save_h = 1;

            }


            if ($save_h > 0) {
                $respon = array('status' => TRUE, 'message' => 'Simpan data sukses');
            } else {
                $respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
            }

            echo json_encode($respon);

        } else {
            show_404();
        }
    }


    function ajax_simpan_admin_cabang() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $telp = $this->input->post('telp');
            $username = $this->input->post('username');
            $password = md5('1234');
            $cabang = $this->input->post('cabang');
            $email = $this->input->post('email');
            $deskripsi = $this->input->post('deskripsi');
            $fullname = $this->input->post('fullname');

            /* $name = $_FILES['file_img']['name'];
            $acak = rand(000000, 999999);
            $nama_file = str_replace(' ', '', $acak.'-'.$name);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/media/users/admin_cabang';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size'] = 1024 * 8;

            $this->load->library('upload', $config);
            $full_path = $config['upload_path'].$nama_file; */
            

            if ($fullname == "" /* $first_name == "" || $last_name == "" */ || $tempat_lahir == "" /* || $tgl_lahir == "" || $alamat == "" */ || $telp == "" || $username == "" || $cabang == "" || $email == "" /* || $deskripsi == "" */) { // || !$this->upload->do_upload('file_img')
                $message = "";
                if ($fullname == "") $message.="* Nama Lengkap masih kosong <br>";
                /* if ($first_name == "") $message.="* Nama Depan masih kosong <br>";
                if ($last_name == "") $message.="* Nama Belakang masih kosong <br>"; */
                if ($tempat_lahir == "") $message.="* Tempat Lahir masih kosong <br>";
                // if ($tgl_lahir == "") $message.="* Tanggal Lahir masih kosong <br>";
                // if ($alamat == "") $message.="* Alamat masih kosong <br>";
                if ($telp == "") $message.="* Phone masih kosong <br>";
                if ($username == "") $message.="* Username masih kosong <br>";
                // if (!$this->upload->do_upload('file_img')) $message .= $this->upload->display_errors(); // "File belum dipilih <br>"
                if ($cabang == "") $message.="* Cabang belum dipilih <br>";
                if ($email == "") $message.="* Email masih kosong <br>";
                // if ($deskripsi == "") $message.="* Deskripsi masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                /* 'first_name' => $first_name,
                'last_name' => $last_name, */
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,  
                // 'foto' => $nama_file,                 
                'alamat' => $alamat,
                'email' => $email,       
                'tipe'  => 2, // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor
                'phone' => $telp,
                'cabang' => $cabang,   
                // 'tgl_lahir' => $this->Main_model->convert_tanggal($tgl_lahir),
                'tempat_lahir' => $tempat_lahir, 
                'deskripsi' => $deskripsi,
                'status' => 1
                /* 'status_id' => $ ,
                'approve_at' => $ ,
                'approve_by' => $  */
            ); 

            $check_username = $this->Main_model->view_by_id('manage_user', ['username' => $username], 'row');

            if (empty($id)) { 
            
                if (empty($check_username)) {
                    $data_h['insert_by'] = $this->session->userdata('id');
                    $save_h = $this->Main_model->proses_data('manage_user', $data_h);
                    $id = $save_h; 
                } else {
                    $respon = array('status' => FALSE, 'message' => 'Username <b>'.$username.'</b> sudah pernah digunakan');
                    echo json_encode($respon);exit;
                }

            } else {

                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('id');

                $save_h = $this->Main_model->proses_data('manage_user', $data_h, array('id' => $id));
                $save_h = 1;

            }


            if ($save_h > 0) {
                $respon = array('status' => TRUE, 'message' => 'Simpan data sukses');
            } else {
                $respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
            }

            echo json_encode($respon);

        } else {
            show_404();
        }
    }



    function ajax_simpan_agent() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $telp = $this->input->post('telp');
            $telp_2 = $this->input->post('telp_2');
            $username = $this->input->post('username');
            $password = md5('1234');
            $cabang = $this->input->post('cabang');
            $email = $this->input->post('email');
            $deskripsi = $this->input->post('deskripsi');
            $img_name = $this->input->post('img_name');
            $fullname = $this->input->post('fullname');
            $nickname = $this->input->post('nickname');
            
            $img_upload = $_FILES['file_img']['name'];
            $nama_file = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/img/consultant/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
		    $full_path = base_url('assets/img/consultant/');

            $upload_status = $this->upload->do_upload('file_img');
            
            $tgl_permohonan = $this->input->post('tgl_permohonan');
            $jns_identitas = $this->input->post('jns_identitas');
            $nmr_identitas = $this->input->post('nmr_identitas');
            $gender = $this->input->post('gender');
            $kode_area_telp = $this->input->post('kode_area_telp');
            $telp_rumah = $this->input->post('telp_rumah');
            $education = $this->input->post('education');
            $other_edu = $this->input->post('other_edu');
            $marital_status = $this->input->post('marital_status');
            $religion = $this->input->post('religion');
            $no_rek = $this->input->post('no_rek');
            $no_rek_atasnama = $this->input->post('no_rek_atasnama');
            $kcp = $this->input->post('kcp');
            $kelengkapan = $this->input->post('kelengkapan');
            $agent_ref = $this->input->post('agent_ref');
            $agent_id = $this->input->post('id_consultant');
            $motto = $this->input->post('motto');


            
            
            $data_h = array(
                /* 'first_name' => $first_name,
                'last_name' => $last_name, */
                'fullname' => $fullname,
                'nickname' => $nickname,
                'username' => $username,
                'password' => $password,  
                'host' => $full_path,
                'foto' => (!empty($img_upload)) ? $nama_file : $img_name,                
                'alamat' => $alamat,
                'email' => $email,       
                'tipe'  => 3, // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor
                'motto' => $motto,
                'phone' => $telp,
                'phone2' => $telp_2,
                'cabang' => $cabang,   
                // 'tgl_lahir' => $this->Main_model->convert_tanggal($tgl_lahir),
                'tempat_lahir' => $tempat_lahir, 
                'deskripsi' => $deskripsi,
                'status' => 1
                /* 'status_id' => $ ,
                'approve_at' => $ ,
                'approve_by' => $  */
            ); 

  
            $data_d = array(
                'id_agent' => $id,
                'jns_identitas' => $jns_identitas,    
                'nmr_identitas' => $nmr_identitas,           
                'gender' => $gender,           
                'kode_area_telp' => $kode_area_telp,       
                'telp_rumah' => $telp_rumah,              
                'mar_stat' => $marital_status,            
                'agama' => $religion,             
                'no_rek' => $no_rek,                  
                'no_rek_atasnama' => $no_rek_atasnama,       
                'kcp' => $kcp,
                'consultant_id' => $agent_id
            );

                          
            $data_h['tgl_lahir'] = !empty($tgl_lahir) ? $this->Main_model->convert_tanggal($tgl_lahir) : NULL; 
            $data_d['tgl_permohonan'] = !empty($tgl_permohonan) ? $this->Main_model->convert_tanggal($tgl_permohonan) : NULL; 
            $data_d['id_ref_agent'] = !empty($agent_ref) ? $agent_ref : 0;
            $data_d['agama'] = !empty($religion) ? $religion : 0;

            if (!empty($education)) {

                if ($education != 'other_edu') {
                    $data_d['last_education'] = $education;
                } else {
                    $data_d['last_education'] = $other_edu;
                }
            }



            $check_username = $this->Main_model->view_by_id('manage_user', ['username' => $username], 'row');

            if (empty($id)) { 

                if (empty($check_username)) {
                    $data_h['insert_by'] = $this->session->userdata('id');
                    
                    $fc_docs = '';  
                    if (!empty($kelengkapan)) {
                        $i = 0;

                        foreach ($kelengkapan as $checked_val) {

                            $fc_docs .= $checked_val;

                            if ($i != sizeof($kelengkapan) - 1) {
                                $fc_docs .= ' | ';
                            }
                            
                            $i++;
                        }

                        $fc_docs .= '';
                    } 

                    $data_d['kelengkapan'] = $fc_docs;

                    $save_h = $this->Main_model->process_data('manage_user', $data_h);
                    $id_agent = $save_h; 
                    $data_d['id_agent'] = $id_agent;
                    $this->Main_model->proses_data('detail_agent', $data_d);
                } else {
                    $respon = array('status' => FALSE, 'message' => 'Username <b>'.$username.'</b> sudah pernah digunakan');
                    echo json_encode($respon);exit;
                }

            } else {

                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('id');

                $fc_docs = '';  
                if (!empty($kelengkapan)) {
                    $i = 0;

                    foreach ($kelengkapan as $checked_val) {

                        $fc_docs .= $checked_val;

                        if ($i != sizeof($kelengkapan) - 1) {
                            $fc_docs .= ' | ';
                        }
                        
                        $i++;
                    }

                    $fc_docs .= '';

                    

                    /* for ($i=0; $i < sizeof($kelengkapan) ; $i++) { 
                        $fc_docs .= $kelengkapan[$i]. ' | ';
                    } */

                    /* $respon = array('status' => FALSE, 'message' => $fc_docs);
                    echo json_encode($respon);exit; */

                } 

                $data_d['kelengkapan'] = $fc_docs;


                $save_h = $this->Main_model->proses_data('manage_user', $data_h, array('id' => $id));
                $save_h = 1;
                $this->Main_model->proses_data('detail_agent', $data_d, array('id_agent' => $id));

            }


            if ($save_h > 0) {
                $respon = array('status' => TRUE, 'message' => 'Simpan data sukses');
            } else {
                $respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
            }

            echo json_encode($respon);

        } else {
            show_404();
        }
    }


    function ajax_simpan_premium_investor() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $telp = $this->input->post('telp');
            $username = $this->input->post('username');
            $password = md5('1234');
            $cabang = $this->input->post('cabang');
            $email = $this->input->post('email');
            $deskripsi = $this->input->post('deskripsi');
            $fullname = $this->input->post('fullname');


            if ($fullname == "" /* $first_name == "" || $last_name == "" */ || $tempat_lahir == "" /* || $tgl_lahir == "" || $alamat == "" */ || $telp == "" || $username == "" || $email == "" /* || $deskripsi == "" */) { // || !$this->upload->do_upload('file_img')
                $message = "";
                if ($fullname == "") $message.="* Nama Lengkap masih kosong <br>";
                /* if ($first_name == "") $message.="* Nama Depan masih kosong <br>";
                if ($last_name == "") $message.="* Nama Belakang masih kosong <br>"; */
                if ($tempat_lahir == "") $message.="* Tempat Lahir masih kosong <br>";
                // if ($tgl_lahir == "") $message.="* Tanggal Lahir masih kosong <br>";
                // if ($alamat == "") $message.="* Alamat masih kosong <br>";
                if ($telp == "") $message.="* Phone masih kosong <br>";
                if ($username == "") $message.="* Username masih kosong <br>";
                if ($email == "") $message.="* Email masih kosong <br>";
                // if ($deskripsi == "") $message.="* Deskripsi masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }
            $data_h = array(
                /* 'first_name' => $first_name,
                'last_name' => $last_name, */
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,            
                'alamat' => $alamat,
                'email' => $email,       
                'tipe'  => 4, // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor
                'phone' => $telp,
                'cabang' => $cabang,   
                // 'tgl_lahir' => $this->Main_model->convert_tanggal($tgl_lahir),
                'tempat_lahir' => $tempat_lahir, 
                'deskripsi' => $deskripsi,
                'status' => 1
                /* 'status_id' => $ ,
                'approve_at' => $ ,
                'approve_by' => $  */
            ); 

            $check_username = $this->Main_model->view_by_id('manage_user', ['username' => $username], 'row');

            if (empty($id)) { 
                if (empty($check_username)) {
                    $data_h['insert_by'] = $this->session->userdata('id');
                    $save_h = $this->Main_model->proses_data('manage_user', $data_h);
                    $id = $save_h; 
                } else {
                    $respon = array('status' => FALSE, 'message' => 'Username <b>'.$username.'</b> sudah pernah digunakan');
                    echo json_encode($respon);exit;
                }

            } else {
                
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('id');

                $save_h = $this->Main_model->proses_data('manage_user', $data_h, array('id' => $id));
                $save_h = 1;

            }


            if ($save_h > 0) {
                $respon = array('status' => TRUE, 'message' => 'Simpan data sukses');
            } else {
                $respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
            }

            echo json_encode($respon);

        } else {
            show_404();
        }
    }




    function get_user_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('manage_user', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }





    function hapus_user($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('manage_user', ['status' => 0], $condition);
            if ($hapus > 0) {
                $status = 1;
                $message = 'Data berhasil dihapus';
            } else {
                $status = 0;
                $message = 'Gagal menghapus data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );
            // return json result
            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function get_agent_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->manage_user->get_agent_profile($id)->row();
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function export_agent_form($id = '') {
        $data = $this->Main_model->view_by_id('manage_user', ['id' => $id], 'row');
        $profil['data'] = $this->manage_user->get_agent_profile($id)->row();
        // $profil['data'] = $this->Main_model->view_by_id('manage_user', ['id' => $id], 'row');

        $filename = 'Formulir Agent - '.$data->fullname;
        $this->load->view('admin/agent/print/form_agent', $profil);

        $html = $this->output->get_output();
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename, true, 'a4', 'portrait');
    }




    function ajax_resign_agent($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];
            $condition_agent = ['id_agent' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('manage_user', ['status' => 0], $condition);
            $resign = $this->Main_model->process_data('detail_agent', ['status_resign' => 1], $condition_agent);
            
            if ($hapus > 0) {
                $status = 1;
                $message = 'Data berhasil dihapus';
            } else {
                $status = 0;
                $message = 'Gagal menghapus data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );
            // return json result
            echo json_encode($result);
            
        } else {
            show_404();
        }
    }
    

}
