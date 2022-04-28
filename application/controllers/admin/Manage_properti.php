<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Manage_properti extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Model_manage_properti', 'manage_properti');
        $this->load->model('Main_model', '', true);

        $this->css_include = '';
        $this->js_include = '';
        if (!$this->session->userdata('username')) {
            redirect('Login');
        }
    }
    public function index()
    {
        $data['title'] = 'Interflow | Manage Properti';
        $data['judul'] = 'Manage Properti';
        
        $level = $this->session->userdata('level'); 
        // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

        if ($level != 3) {
            $form['opt_kontak'] = $this->manage_properti->options_kontak_agen();
        } else {
            $user_id = $this->session->userdata('id');
            $form['opt_kontak'] = $this->manage_properti->options_kontak_one_agent($user_id);
        }

        $form['opt_kategori'] = $this->manage_properti->options_jenis_properti();
        $form['opt_status'] = $this->manage_properti->options_status_properti();
        $form['opt_fasilitas'] = $this->manage_properti->options_fasilitas();
        $form['opt_fasilitas_2'] = $this->manage_properti->options_fasilitas_2();
        $form['opt_features'] = $this->manage_properti->options_features();
        $form['opt_periode'] = $this->manage_properti->options_periode_sewa();
        $footer['js'] = '<script src="' . base_url('assets/js/manage_properti/properti.js?_=' . rand()) . '"></script>';

        $status = $this->input->get('status');
        // print_r($status); 
        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $form['filter_status'] = array(
            '-2' => '- Pilih Status -', 
            '-1' => 'All Status',
            '0' => 'Proses', 
            '1' => 'Sudah Aktif',
            '9' => 'Tidak Aktif',
            '8' => 'Ditolak',
            '11' => 'Input Baru (Hari ini)',
            '12' => 'Due Date (Minggu ini)'

        );

        if (empty($status)) {
            $form['status_val'] = '-1';
        } else {

            switch ($status) {
                case 'aktif':
                    $form['status_val'] = '1';
                    break;
                case 'proses':
                    $form['status_val'] = '0';
                    break;
                    case 'new':
                        $form['status_val'] = '11';
                        break;
                    case 'due_date':
                        $form['status_val'] = '12';
                        break;
                default:
                    $form['status_val'] = '-1';
                break; 
            }

        }
        
        

        $this->load->view('admin/header', $data);
        $this->load->view('admin/properti/properti', $form);
        $this->load->view('admin/footer', $footer);
        $this->load->view('admin/properti/js_new');
    }

    function approval(){
        $data['title'] = 'Interflow | Approval Properti';
        $data['judul'] = 'Approval Properti';
        
        $level = $this->session->userdata('level'); 

        // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
        
        $cabang = $this->session->userdata('id_cabang');
        // print_r($cabang);
        // exit();
        if ($level != 3) {
            $form['opt_kontak'] = $this->manage_properti->options_kontak_agen();
        } 
        // else if{

        // }
        else {
            $user_id = $this->session->userdata('id');
            $form['opt_kontak'] = $this->manage_properti->options_kontak_one_agent($user_id);
        }

        $form['opt_kategori'] = $this->manage_properti->options_jenis_properti();
        $form['opt_status'] = $this->manage_properti->options_status_properti();
        $form['opt_fasilitas'] = $this->manage_properti->options_fasilitas();
        $form['opt_fasilitas_2'] = $this->manage_properti->options_fasilitas_2();
        $form['opt_features'] = $this->manage_properti->options_features();
        $form['opt_periode'] = $this->manage_properti->options_periode_sewa();
        $footer['js'] = '<script src="' . base_url('assets/js/manage_properti/properti_approval.js?_=' . rand()) . '"></script>';

        $status = $this->input->get('status');
        // print_r($status); 
        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $form['filter_status'] = array(
            '-2' => '- Pilih Status -', 
            '-1' => 'All Status',
            '0' => 'Proses', 
            '1' => 'Sudah Aktif',
            '8' => 'Ditolak',
            '11' => 'Input Baru (Hari ini)',
            '12' => 'Due Date (Minggu ini)'

        );

        if (empty($status)) {
            $form['status_val'] = '-1';
        } else {

            switch ($status) {
                case 'aktif':
                    $form['status_val'] = '1';
                    break;
                case 'proses':
                    $form['status_val'] = '0';
                    break;
                    case 'new':
                        $form['status_val'] = '11';
                        break;
                    case 'due_date':
                        $form['status_val'] = '12';
                        break;
                default:
                    $form['status_val'] = '-1';
                break; 
            }

        }
        
        

        $this->load->view('admin/header', $data);
        $this->load->view('admin/properti/properti', $form);
        $this->load->view('admin/footer', $footer);
        $this->load->view('admin/properti/js_new');
    }

    function jatuh_tempo(){
        $data['title'] = 'Interflow | Properti Akan Jatuh Tempo';
        $data['judul'] = 'Properti Akan Jatuh Tempo';
        
        $level = $this->session->userdata('level'); 
        // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
        
        $cabang = $this->session->userdata('id_cabang');
        // print_r($cabang);
        // exit();
       
        $footer['js'] = '<script src="' . base_url('assets/js/manage_properti/jatuh_tempo.js?_=' . rand()) . '"></script>';

        $status = $this->input->get('status');
        // print_r($status); 
        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $form['filter_status'] = array(
            '-1' => '',

        );

        if (empty($status)) {
            $form['status_val'] = '-1';
        }
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/properti/jatuhtempo', $form);
        $this->load->view('admin/footer', $footer);
        $this->load->view('admin/properti/js_new');
    }
    
    function get_data_bangunan()
    {
        $id_cabang = $this->session->userdata('id_cabang'); 
        $level = $this->session->userdata('level'); 
        // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

        $status = $this->input->post('status');

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $condition = "";
        
        switch ($status) {
            case '-1':
                $condition = ""; // a.`status` != '9'
                break;
            case '0':
                $condition = "a.`status` = '0'";
                break;
            case '1':
                $condition = "a.`status` = '1'";
                break;
            case '8':
                $condition = "a.`status` = '8'";
                break;
            case '11':
                $condition = "DATE_FORMAT(a.`insert_at`, '%Y-%m-%d') = CURDATE()";
                break;
            case '12':
                $condition = "a.`due_date` >= CURDATE() AND
                                CURDATE() BETWEEN DATE_SUB(a.`due_date`, INTERVAL 6 DAY) AND a.`due_date`";
                break;
            case '9':
                $condition = "a.`status` = '9'"; 
                break;
        }
        
        if ($level != 3) {
			// if ($level == 2) {
				// $condition .= " AND g.cabang='".$id_cabang."'";
			// }
            $this->manage_properti->get_data_bangunan($condition);
        } else {
            $user_id = $this->session->userdata('id');
            $this->manage_properti->get_data_bangunan_by_agent($user_id, $condition);
        }
        
    }

    function get_data_jatuhtempo(){
        $level = $this->session->userdata('level'); 
        // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

        $status = $this->input->post('status');

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $condition = "";
        
        switch ($status) {
            case '-1':
                $condition = "a.`status` = '1'";
                break;
            case '0':
                $condition = "a.`status` = '0'";
                break;
            case '1':
                $condition = "a.`status` = '1'";
                break;
            case '8':
                $condition = "a.`status` = '8'";
                break;
            case '11':
                $condition = "DATE_FORMAT(a.`insert_at`, '%Y-%m-%d') = CURDATE()";
                break;
            case '12':
                $condition = "a.`due_date` >= CURDATE() AND
                                CURDATE() BETWEEN DATE_SUB(a.`due_date`, INTERVAL 6 DAY) AND a.`due_date`";
                break;
        }
        
        if ($level != 3) {
            $this->manage_properti->get_data_jatuhtempo($condition);
        } else {
            $user_id = $this->session->userdata('id');
            $this->manage_properti->get_data_bangunan_by_agent($user_id, $condition);
        }
    }

    function get_data_approval()
    {
        $level = $this->session->userdata('level'); 
        // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

        $status = $this->input->post('status');
        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif

        $condition = "";
        
        switch ($status) {
            case '-1':
                $condition = "a.`status` = '0'";
                break;
            // case '-1':
            //     $condition = "a.`status` != '9'";
            //     break;
            // case '0':
            //     $condition = "a.`status` = '0'";
            //     break;
            // case '1':
            //     $condition = "a.`status` = '1'";
            //     break;
            // case '8':
            //     $condition = "a.`status` = '8'";
            //     break;
            case '11':
                $condition = "DATE_FORMAT(a.`insert_at`, '%Y-%m-%d') = CURDATE()";
                break;
            case '12':
                $condition = "a.`due_date` >= CURDATE() AND
                                CURDATE() BETWEEN DATE_SUB(a.`due_date`, INTERVAL 6 DAY) AND a.`due_date`";
                break;
        }
        //  if ($level != 3) {
        //      $this->manage_properti->get_data_bangunan($condition);
        //  } else {
        //      $user_id = $this->session->userdata('id');
        //      $this->manage_properti->get_data_bangunan_by_agent($user_id, $condition);
        //  }
        
        
        if ($level == 3) {
            $user_id = $this->input->post('id');
            $this->manage_properti->get_data_aprov_by_agent($user_id, $condition);
        }else if($level == 2){
             $cabang = $this->session->userdata('id_cabang');
             $this->manage_properti->get_cabang($cabang,$condition);
        }else {
            $this->manage_properti->get_data_aprov($condition);
        }
        
    }

    function get_image()
    {
        $img = $this->input->post('img');
    }

    function upload_image()
    {
        $source = $now = '';
        $now = date('Y-m-d H:i:s');
        $noww = date('d-m-Y_H:i:s');

        $this->load->library('upload');

        $config['upload_path'] = './assets/img/property/'; //path folder
        // $config['upload_path'] = FCPATH . 'assets/img/property/'; 
        $prefix = time().'_'.$noww;

        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['file_name'] = $prefix.$_FILES['filefoto']['name'];

        $this->upload->initialize($config);

        
        /* echo "<pre>";
            print_r($this->upload->data()); exit;
        echo "</pre>"; */
        
        if ($this->upload->do_upload('filefoto')) {

            // if (!empty($_FILES['filefoto']['name'])) {

            // if ($upload_status === TRUE) {
            $gbr = $this->upload->data();
            // print_r($gbr); exit;
            //Compress Image
            /* $config['image_library'] = 'gd2';
                $config['source_image'] = $source . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '80%';
                $config['new_image'] = $source . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize(); */
            // $data = array(
            //     'img_url' => base_url('assets/img/property/') . $gbr['file_name'],
            //     'img_name' => $gbr['file_name'],
            //     'status' => 1,
            //     'insert_at' => $now,
            //     'insert_by' => $this->session->userdata('id'),
            // );
            echo $gbr['file_name'];
        } else {
            echo $prefix."Image yang diupload kosong";
        }
    }

    function upload_video()
    {
        $source = $now = '';
        $now = date('Y-m-d H:i:s');
        if (!empty($this->input->post('nama'))) {
            $source = './assets/media/' . $this->input->post('nama') . '/';
        } else {
            $source = './assets/media/';
        }

        $config['upload_path'] = './assets/videos/'; //path folder
        $config['allowed_types'] = 'mp4||jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

        $this->upload->initialize($config);
        if (!empty($_FILES['file_video']['name'])) {

            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();
                $data = array(
                    'url' => $source . $gbr['file_name'],
                    'status' => 1,
                    'insert_at' => $now,
                    'insert_by' => $this->session->userdata('id'),
                );
                $this->manage_properti->simpan_upload_video($data);
            }
        }
    }

    function ajax_save_properti()
    {

        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $luas_bangunan = $this->input->post('luas_bangunan');
        $luas_tanah = $this->input->post('luas_tanah');
        $legal = $this->input->post('legal');
        $telp = $this->input->post('telp');
        $jns_property = $this->input->post('jns_property');
        $status_property = $this->input->post('status_property');
        $harga_user = $this->input->post('harga_user');
        $harga_jual = $this->input->post('harga_jual');
        $harga_sewa = $this->input->post('harga_sewa'); 
        $deskripsi = $this->input->post('deskripsi');
        $deskripsi_area_lahan = $this->input->post('deskripsi_area_lahan');
        $deskripsi_area_bangunan = $this->input->post('deskripsi_area_bangunan');
        $deskripsi_legalitas = $this->input->post('deskripsi_legalitas');
        $deskripsi_fasilitas = $this->input->post('deskripsi_fasilitas');
        $fasilitas_opt = $this->input->post('fasilitas_opt');
        $fasilitas_lbl = $this->input->post('fasilitas_lbl');
        $koordinat = $this->input->post('koordinat');
        $jml_lantai = $this->input->post('jml_lantai');
        $video_url = $this->input->post('url_video');
        $no_hp = $this->input->post('no_hp');
        $pic = $this->input->post('pic');
        $periode_sewa = $this->input->post('periode_sewa');
        $flag = $this->input->post('flag');
        $status = $this->input->post('status');

        $id_facility = $this->input->post('id_facility');
        $fasilitas_opt = $this->input->post('fasilitas_opt');
        $features = $this->input->post('features');
        $tipe_jual_tanah = $this->input->post('options_type');
        $nama_jalan = $this->input->post('nama_jalan');
        $nmr_jalan = $this->input->post('nmr_jalan');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        

        $img_1 = $this->input->post('Dropzone1');
        $img_2 = $this->input->post('Dropzone2');
        $img_3 = $this->input->post('Dropzone3');
        $img_4 = $this->input->post('Dropzone4');
        $img_5 = $this->input->post('Dropzone5');


        $location = explode(',', $koordinat); // lat + ',' + lng     

        if ($koordinat != "") {
            $latitude = $location[0];
            $longitude = $location[1];
        }


        $start_date = $this->input->post('start_date');
        $due_date = $this->input->post('due_date');
        $full_furnish = $this->input->post('full_furnish');

        $start_date_rent = $this->input->post('start_date_rent');
        $due_date_rent = $this->input->post('due_date_rent');
        $deskripsi_length = strlen(str_replace(array("\n", "\r\n", "\r"), '', $full_furnish));

        if (
            $nama == "" || $alamat == "" || $nama_jalan == "" ||/* $luas_bangunan == "" ||  $luas_tanah == "" || $legal == "" || */ $telp == "" ||
            $jns_property == "" || $status_property == "" /* || $harga_user == ""  */ /* || $harga_jual == "" */ || 
            ($harga_jual == "" && ($status_property == "1" || $status_property == "3")) || 
            ($harga_sewa == "" && ($status_property == "2" || $status_property == "4")) ||
            (($harga_jual == "" || $harga_sewa == "") && $status_property == "5") ||
            /* $deskripsi_area_lahan == "" || $deskripsi_area_bangunan == "" || $deskripsi_legalitas == "" || $deskripsi_fasilitas == "" || */
            $koordinat == "" /* || $jml_lantai == ""  || ($fasilitas_opt == "" || $fasilitas_lbl == "") */ /* || $features == "" */ 
            || $img_1 == "" /*  || $img_2 == "" || $img_3 == "" || $img_4 == "" || $img_5 == "" */  || ($jns_property == "3" && $tipe_jual_tanah == "") || 
            ($status_property == "2" && $periode_sewa == "") || $deskripsi_length > 160 /* || strlen($full_furnish) > 0 */ /*|| $start_date == "" || $due_date == ""*/
        ) {
            $message = "";
            if ($nama == "") $message .= "* Nama masih kosong <br>";
            if ($alamat == "") $message .= "* Alamat masih kosong <br>";
            if ($nama_jalan == "") $message .= "* Nama Jalan masih kosong <br>";
            // if ($luas_bangunan == "") $message .= "* Luas Bangunan masih kosong <br>";
            // if ($luas_tanah == "") $message .= "* Luas Tanah masih kosong <br>";
            // if ($jml_lantai == "") $message .= "* Jumlah Lantai masih kosong <br>";
            // if ($legal == "") $message .= "* Legalitas masih kosong <br>";
            if ($telp == "") $message .= "* Kontak Agen belum dipilih <br>";
            if ($jns_property == "") $message .= "* Jenis Property belum dipilih <br>";
            if ($status_property == "") $message .= "* Status Property belum dipilih <br>";
            // if ($harga_user == "") $message .= "* Harga User masih kosong <br>";
            if ($jns_property == "3" && $tipe_jual_tanah == "") $message.="* Tipe Jual Tanah belum dipilih <br>";
            /* if ($harga_jual == "") {

                if ($status_property == "1" || $status_property == "3") {
                    $message .= "* Harga Jual masih kosong <br>";    
                } else if ($status_property == "2" || $status_property == "4") {
                    $message .= "* Harga Sewa masih kosong <br>";    
                } else if ($status_property == "5") {
                    $message .= "* Harga Jual / Harga Sewa masih kosong <br>";   
                }else {
                    $message .= "* Harga Jual masih kosong <br>";  
                }
                
            } */ 


            if ($harga_jual == "" && ($status_property == "1" || $status_property == "3")) {
                $message .= "* Harga Jual masih kosong <br>";    
            } 
    
    
            if ($harga_sewa == "" && ($status_property == "2" || $status_property == "4")) {
                $message .= "* Harga Sewa masih kosong <br>"; 
            }
    
            if (($harga_jual == "" || $harga_sewa == "") && $status_property == "5") { 
                if ($harga_jual == "" && $status_property == "5") $message .= "* Harga Jual masih kosong <br>";
                if ($harga_sewa == "" && $status_property == "5") $message .= "* Harga Sewa masih kosong <br>";
            }

            
            if ($deskripsi_length > 160) $message .= "* Deskripsi E-Brosur tidak boleh melebihi 460 karakter <br>";

            // if ($start_date == "") $message .= "* Start Date masih kosong <br>";
            // if ($due_date == "") $message .= "* Due Date masih kosong <br>";
            
            if ($status_property == "2" && $periode_sewa == "") $message.="* Periode Sewa belum dipilih <br>";
            // if ($harga_jual == "") $message .= "* Harga Jual masih kosong <br>";
            /* if ($deskripsi_area_lahan == "") $message.="* Deskripsi Area Lahan masih kosong <br>";
			if ($deskripsi_area_bangunan == "") $message.="* Deskripsi Area Bangunan masih kosong <br>";
			if ($deskripsi_legalitas == "") $message.="* Deskripsi Legalitas masih kosong <br>";
            if ($deskripsi_fasilitas == "") $message.="* Deskripsi Fasilitas masih kosong <br>"; */
            // if ($fasilitas == "") $message.="* Fasilitas masih kosong <br>";
            if ($koordinat == "") $message .= "* Lokasi belum dipilih <br>";
            

            $message_img = "";

            // if (empty($id) || !empty($id)) {
            // if ($img_1 == "" || $img_2 == "" || $img_3 == "" || $img_4 == "" || $img_5 == "") { 

            if ($img_1 == "") $message_img .= "* Foto 1 (COVER) belum dipilih <br>";
            /*      if ($img_2 == "") $message_img .= "* Foto 2 belum dipilih <br>";
                    if ($img_3 == "") $message_img .= "* Foto 3 belum dipilih <br>";
                    if ($img_4 == "") $message_img .= "* Foto 4 belum dipilih <br>";
                    if ($img_5 == "") $message_img .= "* Foto 5 belum dipilih <br>"; */
            // }

            // }

            $respon = array('status' => FALSE, 'message' => $message, 'message_img' => $message_img);
            echo json_encode($respon);
            exit;
        }


         // replace uang rupiah
         $harga_jual = str_replace(',','.',str_replace('.','',$harga_jual));
         $harga_sewa = str_replace(',','.',str_replace('.','',$harga_sewa));

         $search_url = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
         $replace_url = 'youtube.com/embed/$1';
         $embed_url = preg_replace($search_url, $replace_url, $video_url);
         $embed_link = explode('&',$embed_url);
         $embed_url_fixed = $embed_link[0];

        $data_h = array(
            'id_agent' => $telp,
            'nama' => $nama,
            'alamat' => $alamat,
            'nama_jalan' => $nama_jalan,
            'nmr_jalan' => $nmr_jalan,
            'rt' => $rt,
            'rw' => $rw,
            'luas_bangunan' => $luas_bangunan,
            'luas_tanah' => $luas_tanah,
            'legalitas' => $legal,
            'phone' => $no_hp,
            'pic' => $pic,
            // 'harga_user' => $harga_user,
            'harga_jual' => $harga_jual,
            'harga_sewa' => $harga_sewa,
            'tanggal' => date('Y-m-d'),
            'deskripsi' => $deskripsi,
            'luas_bangunan' => $luas_bangunan,
            'luas_tanah' => $luas_tanah,
            'jml_lantai' => $jml_lantai,
            'legalitas' => $legal,
            'lat' => $latitude,
            'lang' => $longitude,
            'video_url' => (empty($video_url)) ? $video_url : $embed_url_fixed,
            'id_category' => $jns_property,
            'id_status_property' => $status_property,
            'id_periode_sewa' => $periode_sewa,
            'start_date' => $this->Main_model->convert_tanggal($start_date),
            'due_date' => $this->Main_model->convert_tanggal($due_date),
            'full_furnish' => $full_furnish,
            'flag' => $flag,
            'status' => 0
            // 'start_sewa' => $this->Main_model->convert_tanggal($start_date_rent),
            // 'due_sewa' => $this->Main_model->convert_tanggal($due_date_rent)
        );


        if (empty($id)) {
            $data_h['insert_by'] = $this->session->userdata('username');

            if ($jns_property == "3" && $tipe_jual_tanah != "") {
                $data_h['id_tipe_jual_tanah'] = $tipe_jual_tanah;
            }
            if($status_property == "4" && $start_date_rent !==""  && $due_date_rent !==""){
                $data_h['start_sewa'] = $this->Main_model->convert_tanggal($start_date_rent);
                $data_h['due_sewa'] = $this->Main_model->convert_tanggal($due_date_rent);
            }
            
            $save_h = $this->Main_model->process_data('manage_properti', $data_h);
            $id = $save_h;

            $dt_deskripsi = array(
                'id_rumah' => $id,
                'area_lahan' => $deskripsi_area_lahan,
                'area_bangunan' => $deskripsi_area_bangunan,
                'legalitas' => $deskripsi_legalitas,
                'fasilitas' => $deskripsi_fasilitas
            );

            $this->Main_model->process_data('tb_deskripsi', $dt_deskripsi);

            // $dt_sewa = array(
            //     'id_rumah' => $id,
            //     'start_date' => $this->Main_model->convert_tanggal($start_date_rent),
            //     'due_date' => $this->Main_model->convert_tanggal($due_date_rent),
            // );
            // $this->Main_model->process_data('tb_sewa_rented', $dt_sewa);

            if (!empty($fasilitas_opt)) {

                for ($i = 0; $i < sizeof($fasilitas_opt); $i++) {
                    $data_fasilitas = array(
                        'id_rumah' => $id,
                        'id_fasilitas' => $fasilitas_opt[$i],
                        'label' => $fasilitas_lbl[$i]
                    );

                    $this->Main_model->proses_data('tb_properti_fasilitas', $data_fasilitas);
                }
            }

            if (!empty($features)) {

                for ($j = 0; $j < sizeof($features); $j++) {
                    $data_features = array(
                        'id_rumah' => $id,
                        'id_feature' => $features[$j]
                    );

                    $this->Main_model->proses_data('tb_properti_feature', $data_features);
                }
            }

            $dt_img_1 = array(
                'id_rumah' => $id,
                'img_url' => base_url('assets/img/property/') . $img_1,
                'img_name' => $img_1,
                'cover' => 1,
                'insert_by' => $this->session->userdata('username'),
            );

            $dt_img_2 = array(
                'id_rumah' => $id,
                'img_url' => base_url('assets/img/property/') . $img_2,
                'img_name' => $img_2,
                'insert_by' => $this->session->userdata('username'),
            );

            $dt_img_3 = array(
                'id_rumah' => $id,
                'img_url' => base_url('assets/img/property/') . $img_3,
                'img_name' => $img_3,
                'insert_by' => $this->session->userdata('username'),
            );

            $dt_img_4 = array(
                'id_rumah' => $id,
                'img_url' => base_url('assets/img/property/') . $img_4,
                'img_name' => $img_4,
                'insert_by' => $this->session->userdata('username'),
            );

            $dt_img_5 = array(
                'id_rumah' => $id,
                'img_url' => base_url('assets/img/property/') . $img_5,
                'img_name' => $img_5,
                'insert_by' => $this->session->userdata('username'),
            );

            
            if (!empty($img_1)) {
                $this->Main_model->process_data('ms_photo', $dt_img_1);
            }

            if (!empty($img_2)) {
                $this->Main_model->process_data('ms_photo', $dt_img_2);
            }

            if (!empty($img_3)) {
                $this->Main_model->process_data('ms_photo', $dt_img_3);
            }

            if (!empty($img_4)) {
                $this->Main_model->process_data('ms_photo', $dt_img_4);
            }

            if (!empty($img_5)) {
                $this->Main_model->process_data('ms_photo', $dt_img_5);
            }
                        
        } else {

            $data_h['update_at'] = date('Y-m-d H:i:s');
            $data_h['update_by'] = $this->session->userdata('username');

            if ($status_property == "1") { // Buy
                $data_h['id_periode_sewa'] = NULL;
            }

            if ($jns_property == "3" && $tipe_jual_tanah != "") {
                $data_h['id_tipe_jual_tanah'] = $tipe_jual_tanah;
            }

            if($status_property == "4" && $start_date_rent !==""  && $due_date_rent !==""){
                $data_h['start_sewa'] = $this->Main_model->convert_tanggal($start_date_rent);
                $data_h['due_sewa'] = $this->Main_model->convert_tanggal($due_date_rent);
            }

            $save_h = $this->Main_model->proses_data('manage_properti', $data_h, array('id' => $id));
            $save_h = 1;


            $dt_deskripsi = array(
                'area_lahan' => $deskripsi_area_lahan,
                'area_bangunan' => $deskripsi_area_bangunan,
                'legalitas' => $deskripsi_legalitas,
                'fasilitas' => $deskripsi_fasilitas
            );

            $this->Main_model->proses_data('tb_deskripsi', $dt_deskripsi, array('id_rumah' => $id));
            // if ($status_property == 4 || $status_property == 2){

            //     $dt_sewa = array(
            //         'start_date' => $this->Main_model->convert_tanggal($start_date_rent),
            //         'due_date' => $this->Main_model->convert_tanggal($due_date_rent)
            //     );

            //     $this->Main_model->proses_data('tb_sewa_rented', $dt_sewa, array('id_rumah' => $id));
            // }
            for ($i = 0; $i < sizeof($id_facility); $i++) {

                if (!empty($fasilitas_opt[$i])) {

                    $data_fasilitas = array(
                        'id_rumah' => $id,
                        'id_fasilitas' => $fasilitas_opt[$i],
                        'label' => $fasilitas_lbl[$i]
                    );

                    if (!empty($id_facility[$i])) {
                        $this->Main_model->proses_data('tb_properti_fasilitas', $data_fasilitas, array('id' => $id_facility[$i]));
                    } else {
                        $this->Main_model->proses_data('tb_properti_fasilitas', $data_fasilitas);
                    }
                }
            }





            if (!empty($features)) {

                $this->db->query("DELETE FROM tb_properti_feature WHERE id_rumah = '$id' ");

                for ($j = 0; $j < sizeof($features); $j++) {
                    $data_features = array(
                        'id_rumah' => $id,
                        'id_feature' => $features[$j]
                    );

                    $this->Main_model->proses_data('tb_properti_feature', $data_features);
                }
            }


            $dt_img_1 = array(
                'img_url' => base_url('assets/img/property/') . $img_1,
                'img_name' => $img_1,
                'cover' => 1,
                'status' => 1
            );

            $dt_img_2 = array(
                'img_url' => base_url('assets/img/property/') . $img_2,
                'img_name' => $img_2,
                'status' => 1
            );

            $dt_img_3 = array(
                'img_url' => base_url('assets/img/property/') . $img_3,
                'img_name' => $img_3,
                'status' => 1
            );

            $dt_img_4 = array(
                'img_url' => base_url('assets/img/property/') . $img_4,
                'img_name' => $img_4,
                'status' => 1
            );

            $dt_img_5 = array(
                'img_url' => base_url('assets/img/property/') . $img_5,
                'img_name' => $img_5,
                'status' => 1
            );

            $foto_properti = $this->db->query("SELECT * FROM ms_photo WHERE id_rumah = '$id' ")->result();

            if (!empty($foto_properti) || empty($foto_properti)) {

                $img_one = $this->manage_properti->get_image_1($id)->row();
                $img_two = $this->manage_properti->get_image_2($id)->row();
                $img_three = $this->manage_properti->get_image_3($id)->row();
                $img_four = $this->manage_properti->get_image_4($id)->row();
                $img_five = $this->manage_properti->get_image_5($id)->row();


                if (!empty($img_one)) {
                    $dt_img_1['update_by'] = $this->session->userdata('username'); 
                    $dt_img_1['update_at'] = date('Y-m-d H:i:s'); 
                    $this->Main_model->process_data('ms_photo', $dt_img_1, ['id' => $img_one->id]);
                } else {

                    if (!empty($img_1)) {
                        $dt_img_1['id_rumah'] = $id;
                        $dt_img_1['insert_by'] = $this->session->userdata('username');
                        $dt_img_1['insert_at'] = date('Y-m-d H:i:s'); 
                        $this->Main_model->process_data('ms_photo', $dt_img_1);
                    }

                }

                if (!empty($img_two)) {
                    $dt_img_2['update_by'] = $this->session->userdata('username'); 
                    $dt_img_2['update_at'] = date('Y-m-d H:i:s'); 
                    $this->Main_model->process_data('ms_photo', $dt_img_2, ['id' => $img_two->id]);
                    // $img_condition = "Image 2 exists on database";
                } else {

                    if (!empty($img_2)) {
                        $dt_img_2['id_rumah'] = $id;
                        $dt_img_2['insert_by'] = $this->session->userdata('username');
                        $dt_img_2['insert_at'] = date('Y-m-d H:i:s'); 
                        $this->Main_model->process_data('ms_photo', $dt_img_2);
                        // $img_condition = "Image 2 not exists on database";
                    }

                }

                

                // print_r($img_one); exit;
                // print_r($img_1); exit;
                // print_r($img_two); exit;
                // print_r($img_condition); exit;
                // print_r($dt_img_2); exit;
                // print_r($insert); exit;
                

                if (!empty($img_three)) {
                    $dt_img_3['update_by'] = $this->session->userdata('username'); 
                    $dt_img_3['update_at'] = date('Y-m-d H:i:s'); 
                    $this->Main_model->process_data('ms_photo', $dt_img_3, ['id' => $img_three->id]);
                } else {

                    if (!empty($img_3)) {
                        $dt_img_3['id_rumah'] = $id; 
                        $dt_img_3['insert_by'] = $this->session->userdata('username');
                        $dt_img_3['insert_at'] = date('Y-m-d H:i:s');
                        $this->Main_model->process_data('ms_photo', $dt_img_3);
                    }

                }

                if (!empty($img_four)) {
                    $dt_img_4['update_by'] = $this->session->userdata('username'); 
                    $dt_img_4['update_at'] = date('Y-m-d H:i:s'); 
                    $this->Main_model->process_data('ms_photo', $dt_img_4, ['id' => $img_four->id]);
                } else {

                    if (!empty($img_4)) {
                        $dt_img_4['id_rumah'] = $id; 
                        $dt_img_4['insert_by'] = $this->session->userdata('username');
                        $dt_img_4['insert_at'] = date('Y-m-d H:i:s');
                        $this->Main_model->process_data('ms_photo', $dt_img_4);
                    }

                }

                if (!empty($img_five)) {
                    $dt_img_5['update_by'] = $this->session->userdata('username'); 
                    $dt_img_5['update_at'] = date('Y-m-d H:i:s'); 
                    $this->Main_model->process_data('ms_photo', $dt_img_5, ['id' => $img_five->id]);
                } else {

                    if (!empty($img_5)) {
                        $dt_img_5['id_rumah'] = $id; 
                        $dt_img_5['insert_by'] = $this->session->userdata('username');
                        $dt_img_5['insert_at'] = date('Y-m-d H:i:s');
                        $this->Main_model->process_data('ms_photo', $dt_img_5);
                    }

                }

                // $this->Main_model->proses_data('ms_photo', array('status' => 0), array('id_rumah' => $id));

                /* if (!empty($img_1)) {
                    $this->Main_model->process_data('ms_photo', $dt_img_1);
                }

                if (!empty($img_2)) {
                    $this->Main_model->process_data('ms_photo', $dt_img_2);
                }

                if (!empty($img_3)) {
                    $this->Main_model->process_data('ms_photo', $dt_img_3);
                }

                if (!empty($img_4)) {
                    $this->Main_model->process_data('ms_photo', $dt_img_4);
                }

                if (!empty($img_5)) {
                    $this->Main_model->process_data('ms_photo', $dt_img_5);
                } */
            }
            
        }






        if ($save_h > 0) {
            $respon = array('status' => TRUE, 'message' => 'Simpan data sukses');
        } else {
            $respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
        }

        echo json_encode($respon);
    }

    function get_properti_id($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->manage_properti->get_bangunan_id($id)->row();

            $data_feature = $this->Main_model->view_by_id('tb_properti_feature',['id_rumah'=>$id],'result');
            $respon = [
                        'header' => $data,
                        'feature' => $data_feature
                    ];
            echo json_encode($respon);
        } else {
            show_404();
        }
    }

    // function get_properti_id($id = '')
    // {
    //     $is_ajax = $this->input->is_ajax_request();

    //     if ($is_ajax) {
    //         $data = $this->manage_properti->get_bangunan_id($id)->row();
    //         echo json_encode($data);
    //     } else {
    //         show_404();
    //     }
    // }

    function get_fasilitas_by_property($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $fasilitas = $this->manage_properti->view_fasilitas_by_property($id)->result();
            $opt_fasilitas = $this->manage_properti->options_fasilitas();

            $list = '';
            if (!empty($fasilitas)) {

                foreach ($fasilitas as $row => $val) {
                    $list .= '<input type="hidden" name="id_facility[]" value="' . $val->id . '">
                    <div class="form-group row count_class">    
                        <label class="col-form-label col-lg-4">' . $val->nama . ' </label>
                        <input type="hidden" name="fasilitas_opt[]" value="'. $val->id_fasilitas .'">
                        
                        <div class="col-lg-8">
                            <div class="input-group">
                                <input type="text" name="fasilitas_lbl[]" class="form-control" value="' . $val->label . '" placeholder="Jumlah" autocomplete="off">
                            </div> 
                        </div>
                    </div>';
                    // $list .= '<input type="hidden" name="id_facility[]" value="' . $val->id . '">
                    //             <div class="form-group row count_class" style="width: 120%;">    
                    //                 <label class="col-form-label col-lg-2" style="max-width: 2.5%;"> </label>
                    //                 <div class="col-lg-5">
                    //                     <div class="input-group">' .
                    //     form_dropdown('fasilitas_opt[]', $opt_fasilitas, $val->id_fasilitas, ' class="form-control select2_facility" ') .
                    //     '</div>
                    //                 </div>
                    //                 <div class="col-lg-2">
                    //                     <div class="input-group">
                    //                         <input type="text" name="fasilitas_lbl[]" class="form-control" value="' . $val->label . '" placeholder="Jumlah" autocomplete="off">
                    //                     </div> 
                    //                 </div>
                    //             </div>';
                }
            } else {
                $list .= '';
            }

            echo $list;
        } else {
            show_404();
        }
    }

    function get_fasilitas_by_property_disabled($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $fasilitas = $this->manage_properti->view_fasilitas_by_property($id)->result();
            $opt_fasilitas = $this->manage_properti->options_fasilitas();

            $list = '';
            if (!empty($fasilitas)) {
                
                foreach ($fasilitas as $row => $val) {
                    $list .= '<input type="hidden" name="id_facility[]" value="' . $val->id . '">
                    <div class="form-group row count_class">    
                        <label class="col-form-label col-lg-4">' . $val->nama . ' </label>
                        <input type="hidden" name="fasilitas_opt[]" value="'. $val->id_fasilitas .'">
                        
                        <div class="col-lg-8">
                            <div class="input-group">
                                <input type="text" name="fasilitas_lbl[]" class="form-control" value="' . $val->label . '" placeholder="Jumlah" autocomplete="off" disabled>
                            </div> 
                        </div>
                    </div>';
                }

            } else {
                $list .= '';
            }

            echo $list;
        } else {
            show_404();
        }

    }

    function get_features_by_property($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $features = $this->manage_properti->view_features_by_property($id)->result();

            $data = [];
            if (!empty($features)) {

                foreach ($features as $row => $val) {
                    $data[] = $val->id_feature;
                }
            } else {
                $data = [];
            }

            echo json_encode($data);
        } else {
            show_404();
        }
    }

    function get_features_name_by_property($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $features = $this->manage_properti->view_features_by_property($id)->result();

            $data = [];
            if (!empty($features)) {
                
                foreach ($features as $row => $val) {
                   $data[] = '- '.$val->nama.'<br>'; // $val->id_feature
                }

            } else {
                $data = '-';
            }
            
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function new_fasilitas_property()
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $opt_fasilitas = $this->manage_properti->options_fasilitas();

            foreach($opt_fasilitas as $row){
            
                $list = '
                <input type="hidden" name="id_facility[]" >
                    <div class="container">
                        <div class="form-group row count_class">  
                            <label class="col-form-label col-lg-4">'.$row['nama'].'</label>
                            <input type="hidden" name="fasilitas_opt[]" value="'.$row['id'].'">
                            <div class="col-lg-8">
                            <input type="text" name="fasilitas_lbl[]" class="form-control" placeholder=" '.$row['satuan'].'">
                            </div>
                            </div>
                            </div>
                        ';
               
                // $list = '<input type="hidden" name="id_facility[]" >
                //         <div class="form-group row count_class" style="width: 120%;">    
                //             <label class="col-form-label col-lg-2" style="max-width: 2.5%;"> </label>
                //             <div class="col-lg-5">
                //                 <div class="input-group">' .
                //     form_dropdown('fasilitas_opt[]', $opt_fasilitas, '0', ' class="form-control select2_facility" ') .
                //     '</div>
                //             </div>
                //             <div class="col-lg-2">
                //                 <div class="input-group">
                //                     <input type="text" name="fasilitas_lbl[]" class="form-control" placeholder="Jumlah / Keterangan">
                //                 </div> 
                //             </div>
                //         </div>';
    
                echo $list;
            }
        } else {
            show_404();
        }
    }


    function hapus_properti($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 9
            $hapus = $this->Main_model->process_data('manage_properti', ['status' => 9], $condition);
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


    function approval_setuju($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 1
            $verif = $this->Main_model->process_data('manage_properti', ['status' => 1], $condition);

            $this->manage_properti->update_counter_properti_aktif($id);

            $properti = $this->Main_model->view_by_id('manage_properti', ['id' => $id], 'row');
            $active_count = $properti->aktif_count;

            if ($active_count == 1) {
                broadcast_mail($id);
            } 
            
            $data = array(
                'id_rumah' => $id,
                'tanggal_aktivasi' => date('Y-m-d H:i:s'),
                'tanggal_end' => date('Y-m-d H:i:s', strtotime('+6 months')), // Jika disetujui, properti Expired otomatis (6 bulan).
                'tanggal' => date('Y-m-d'),
                'status' => 1,
                'insert_by' => $this->session->userdata('username'),
                'insert_at' => date('Y-m-d H:i:s')
            );

            $this->Main_model->proses_data('ms_show', $data);

            if ($verif > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
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


    function approval_tolak($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];
            $note = $this->input->post('note_alasan');

            /* if ($note == "") {
                $message ="Note masih kosong <br>";
                $respon = array('status' => 0, 'message' => $message);
                echo json_encode($respon);exit;
            }  */

            // update status to 8 and send note to Agent
            $data = [
                'status' => 8,
                'note_approval' => $note
            ];
            $verif = $this->Main_model->process_data('manage_properti', $data, $condition);

            if ($verif > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
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



    function set_recommended($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 1
            // $set = $this->Main_model->process_data('manage_properti', ['recommended' => 1], $condition);
            $set = $this->Main_model->process_data('manage_properti', ['star' => 1], $condition);
            if ($set > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($result);
        } else {
            show_404();
        }
    }


    function set_premium($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 1
            $set = $this->Main_model->process_data('manage_properti', ['premium' => 1], $condition);
            if ($set > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($result);
        } else {
            show_404();
        }
    }


    function unset_recommended($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            // $unset = $this->Main_model->process_data('manage_properti', ['recommended' => 0], $condition);
            $unset = $this->Main_model->process_data('manage_properti', ['star' => 0], $condition);
            if ($unset > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($result);
        } else {
            show_404();
        }
    }


    function unset_premium($id = '')
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $unset = $this->Main_model->process_data('manage_properti', ['premium' => 0], $condition);
            if ($unset > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($result);
        } else {
            show_404();
        }
    }


    function ajax_delete_img()
    {
        $is_ajax = $this->input->is_ajax_request();
        $status = 0;
        if ($is_ajax) {
            $image_name = $this->input->post('img_name');
            $full_path = FCPATH . 'assets/img/property/' . $image_name;
            if (is_file($full_path)) {
                unlink($full_path);
                $status = 1;
                
                $condition = ['img_name' => $image_name];
                $this->db->query("DELETE FROM ms_photo WHERE img_name = '$image_name' ");
                // $this->Main_model->process_data('ms_photo', ['status' => 0], $condition);
            }

            $condition = ['img_name' => $image_name];
            $this->db->query("DELETE FROM ms_photo WHERE img_name = '$image_name' ");
            // $this->Main_model->process_data('ms_photo', ['status' => 0], $condition);

            echo $status;
        } else {
            show_404();
        }
    }



    function select2_kontak_agen()
    {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $search = $this->input->post('q');
            // get data customer from model
            $kontak = $this->manage_properti->options_kontak_agen($search);

            // create array to store data
            $arr = [];
            if ($kontak) {
                // loop data and push to array
                foreach ($kontak as $row) {
                    $arr[] = array(
                        'id' => $row->id,
                        'text' => $row->phone . ' | ' . $row->first_name . ' ' . $row->last_name
                    );
                }
            }

            // echo array to json
            echo json_encode($arr);
        } else {
            show_404();
        }
    }

    function ajax_img_1($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->manage_properti->get_image_1($id)->row();
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    function ajax_img_2($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->manage_properti->get_image_2($id)->row();
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    function ajax_img_3($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->manage_properti->get_image_3($id)->row();
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    function ajax_img_4($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->manage_properti->get_image_4($id)->row();
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    function ajax_img_5($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->manage_properti->get_image_5($id)->row();
            echo json_encode($data);
        } else {
            show_404();
        }
    }


    function update_sold($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 1
            $unset = $this->Main_model->process_data('manage_properti', ['status_transaksi' => 1], $condition);
            if ($unset > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );
            
            echo json_encode($result);
            
        } else {
            show_404();
        }
    }

    function update_rented($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 2
            $unset = $this->Main_model->process_data('manage_properti', ['status_transaksi' => 2], $condition);
            if ($unset > 0) {
                $status = 1;
                $message = 'Data berhasil disimpan';
            } else {
                $status = 0;
                $message = 'Gagal menyimpan data';
            }

            $result = array(
                'status' => $status,
                'message' => $message
            );
            
            echo json_encode($result);
            
        } else {
            show_404();
        }
    }
    

    
    function ebrosur_preview($id = '') {
        /* $properti['data'] = $this->manage_properti->get_bangunan_id($id)->row();
        $properti['foto'] = $this->manage_properti->get_image_cover($id)->row();
        $properti['fasilitas'] = $this->manage_properti->view_fasilitas_by_property($id)->result();
        $properti['kontak'] = $this->manage_properti->kontak_agen_by_properti($id)->row(); */
        
        $this->generate_ebrosur_pdf($id);
        $this->load->view('admin/properti/print/ebrosur'); // , $properti
    }

    function generate_ebrosur_image() {
        $is_ajax = $this->input->is_ajax_request(); 

        if ($is_ajax) {

            $id = $this->input->post('id');
            $img_file = $this->input->post('image');
            $img_file = str_replace('data:image/png;base64,', '', $img_file);
            $img_file = str_replace(' ', '+', $img_file);

            $file = base64_decode($img_file);
            $img_name = 'Interflow_Property_Brosur_'.$id.'.png';
            $full_path = FCPATH . 'assets/ebrosur/' . $img_name;
            // print_r($img_file); exit;

            if (!is_file($full_path)) {

                $img_write = file_put_contents($full_path, $file);

                if ($img_write !== FALSE) {
                    $respon = 'E-Brochure has been generated';
                } else {
                    $respon = 'E-Brochure could not be generated';
                }

            } else {
                $respon = 'E-Brochure already exists';
            }

            echo $respon;

        } else {
            show_404();
        }

    }
    
    function generate_ebrosur_pdf($id = '') {
        /* $is_ajax = $this->input->is_ajax_request(); 

        if ($is_ajax) { */

        // $id = $this->input->post('id');
        $properti['data'] = $this->manage_properti->get_bangunan_id($id)->row();
        $properti['foto'] = $this->manage_properti->get_image_cover($id)->row();
        $properti['fasilitas'] = $this->manage_properti->view_fasilitas_not_empty_by_property($id)->result();
        $properti['kontak'] = $this->manage_properti->kontak_agen_by_properti($id)->row();
        $properti['sewa'] = $this->manage_properti->periode_sewa_properti($id)->row();

        $filename = 'Interflow_Property_Brosur_'.$properti['data']->id;
        $html = $this->load->view('admin/properti/print/ebrosur_pdf', $properti, TRUE);

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        // $config['cacheable']    = true; //boolean, the default is true
        // $config['cachedir']     = './assets/'; //string, the default is application/cache/
        // $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/ebrosur/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name='qr_'.$properti['data']->id.'.png'; //buat name dari qr code
        $params['data'] = base_url('Main/detail_property?q='.$properti['data']->id); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE


        // $this->load->view('admin/properti/print/ebrosur_pdf', $properti);
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate_ebrosur($html, $filename, FALSE, 'a4', 'landscape');

        /* $respon = 'E-Brochure has been generated';
        echo $respon;

        } else {
            show_404();
        } */

    }


    function tes_ebrosur($id = '') {
        $properti['data'] = $this->manage_properti->get_bangunan_id($id)->row();
        $properti['foto'] = $this->manage_properti->get_image_cover($id)->row();
        $properti['fasilitas'] = $this->manage_properti->view_fasilitas_by_property($id)->result();
        $properti['kontak'] = $this->manage_properti->kontak_agen_by_properti($id)->row();
        $properti['sewa'] = $this->manage_properti->periode_sewa_properti($id)->row();

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = './assets/ebrosur/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //integer, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name='qr_'.$properti['data']->id.'.png'; //buat name dari qr code
        $params['data'] = base_url('Main/detail_property?q='.$properti['data']->id); //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        
       /*  echo "<pre>";
            print_r($properti); exit;
        echo "</pre>"; */
        


        $this->load->view('admin/properti/print/ebrosur_html', $properti);
    }


	function cronjob_premium(){
		
		$get = $this->Main_model->get_premium();
		foreach($get as $row){
			
			$condition = ['id' => $row->id];
            $verif = $this->Main_model->process_data('manage_properti', ['premium' => 0], $condition);
			
		}
		
    }
    

    function properti_agen_resign() {
        $data['title'] = 'Interflow | Manage Properti';
        $data['judul'] = 'Properti - Consultant Resign';
        // $body['row_table'] = $this->get_properti_agen_resign(); 
        $footer['js'] = '<script src="'.base_url('assets/js/manage_properti/agen_resign.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/properti/properti_agen_resign'); // , $body
        $this->load->view('admin/footer', $footer);
    }

    function detail_properti_agen_resign($id = '') {
        $data['title'] = 'Interflow | Manage Properti';
        $employee = $this->manage_properti->get_agen_id($id);
        $data['judul'] = $employee->consultant_id.' - '.$employee->fullname;
        $body['id_agent'] = $id; 
        $body['opt_kontak'] = $this->manage_properti->options_kontak_agen_aktif();
        $body['opt_kontak_all'] = $this->manage_properti->options_kontak_agen();
        $body['opt_kategori'] = $this->manage_properti->options_jenis_properti();
        $body['opt_status'] = $this->manage_properti->options_status_properti();
        $body['opt_fasilitas'] = $this->manage_properti->options_fasilitas();
        $body['opt_fasilitas_2'] = $this->manage_properti->options_fasilitas_2();
        $body['opt_features'] = $this->manage_properti->options_features();
        $body['opt_periode'] = $this->manage_properti->options_periode_sewa();
        $footer['js'] = '<script src="'.base_url('assets/js/manage_properti/agen_resign.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/properti/properti_agen_resign_detail', $body); 
        $this->load->view('admin/footer', $footer);
    }


    function get_properti_agen_resign() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $agen_resign = $this->manage_properti->view_agen_resign();
            $data = [];
            
            if ($agen_resign) {

                
                $no = 1;
                $table = '';
                $str = '';
                $count = 1;

                foreach ($agen_resign as $row => $val) {

                    $id_user = $val->id_user;
                    $btn_detail = '<a href="' . base_url('admin/Manage_properti/detail_properti_agen_resign/' . $id_user) . '" class="btn btn-sm btn-primary">
                                        <span class="icon-list-unordered"> </span> Lihat Property
                                    </a>'; // target="_blank"

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->consultant_id;
                    $data['data'][$row][] = $val->fullname;
                    $data['data'][$row][] = $btn_detail;
                   
                              

                    
                    $no++;



                }
            } else {
                $data['data'] = [];
            }

           
            echo json_encode($data);
        } else {
            show_404();
        }
        
    }



    function get_detail_properti_agen_resign($id) {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $properti = $this->manage_properti->view_properti_agen_resign($id);
            $data = [];
            
            if ($properti) {

                $no = 1;

                foreach ($properti as $row => $val) {

                    $id_property = $val->id_property;

                    $btn_agen = '<a href="javascript:;" onclick="get_id('.$id_property.')" class="btn btn-sm bg-purple">
                                        <span class="icon-user"> </span> Ganti Agen
                                    </a>';
                    $btn_detail = '<a href="javascript:;" onclick="view_detail('.$id_property.')" class="btn btn-sm btn-primary">
                        <span class="icon-home2"> </span> Detail Property
                    </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->nama_properti;
                    $data['data'][$row][] = $val->alamat;
                    $data['data'][$row][] = $val->category;
                    $data['data'][$row][] = $val->status_name;
                    // $data['data'][$row][] = $val->agent_fullname;
                    $data['data'][$row][] = $btn_agen.'&nbsp'.$btn_detail;
                   
                              

                    
                    $no++;
                }

            } else {
                $data['data'] = [];
            }


                echo json_encode($data);
            } else {
                show_404();
            }
        }


        
        function ajax_property_id_agen_resign($id = '') {
            $is_ajax = $this->input->is_ajax_request();

            if ($is_ajax) {
                $data = $this->manage_properti->get_properti_by_id_agen_resign($id)->row();
                echo json_encode($data);
            } else {
                show_404();
            }
        }


}
