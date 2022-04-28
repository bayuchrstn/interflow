<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Content_trx extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Main_model', '', true);
        $this->load->model('Master_Model', '', true);

        $this->css_include = '';
        $this->js_include = '';
        if (!$this->session->userdata('username')) {
            redirect('Login');
        }
    }


    function ajax_simpan_about_us() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $profil = $this->input->post('profil');
            $no_siup = $this->input->post('no_siup');
            $img_name = $this->input->post('img_name');

            $img_upload = $_FILES['file_img']['name'];
            $nama_file = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729; 


            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!empty($img_upload)) {
                $full_path = base_url('assets/img/'.$nama_file);
            } else {
                $full_path = base_url('assets/img/'.$img_name);
            }

            $upload_status = $this->upload->do_upload('file_img');

            if ($profil == "" || $no_siup == "" || ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_status === FALSE) ) { 
                $message = "";
                if ($profil == "") $message.="Profil Perusahaan masih kosong <br>";
                if ($no_siup == "") $message.="Nomor SIUP masih kosong <br>";

                if (!empty($img_upload) && $upload_status === FALSE) {
                    $message .= '<br>'.$this->upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "File belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'profil_perusahaan' => $profil,
                'nmr_siup' => $no_siup,
                'img_profil' => (!empty($img_upload)) ? $nama_file : $img_name,
                'img_url_profil' => $full_path
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_about_us', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_about_us', $data_h, array('id' => $id));
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
	
	function ajax_simpan_milestones() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $counter = $this->input->post('counter');
			
            if ($title == "" || $counter == "") { 
                $message = "";
                if ($title == "") $message.="Profil Perusahaan masih kosong <br>";
                if ($counter == "") $message.="Nomor SIUP masih kosong <br>";

               
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'title' => $title,
                'counter' => $counter
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_milestones', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_milestones', $data_h, array('id' => $id));
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


    function ajax_simpan_contact_us() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $alamat = $this->input->post('alamat');
            $kontak = $this->input->post('kontak');
            $email = $this->input->post('email');

            if ($alamat == "" || $kontak == "" || $email == "") {
                $message = "";
                if ($alamat == "") $message.="Alamat masih kosong <br>";
                if ($kontak == "") $message.="Kontak masih kosong <br>";
                if ($email == "") $message.="Email masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'alamat' => $alamat,
                'kontak' => $kontak,
                'email' => $email
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_contact_us', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_contact_us', $data_h, array('id' => $id));
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


    function ajax_simpan_developer() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $name_tag = $this->input->post('name_tag');
            $fullname = $this->input->post('fullname');
            $alamat = $this->input->post('alamat');
            $img_name = $this->input->post('img_name');
            $image = $this->input->post('image');
            $pdf_name = $this->input->post('pdf_name');

            // Image Upload
            $img_upload = $_FILES['file_img']['name'];
            $nama_file_img = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file_img;
            $config['upload_path'] = './assets/img/developer/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            // $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            /* $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729;  */

            $this->load->library('upload', $config, 'img_upload'); // Create custom object for Image upload
            $this->img_upload->initialize($config);

            // Image Upload
            $img_upload2 = $_FILES['file_image']['name'];
            $nama_file_img2 = str_replace(' ', '', $img_upload2);
            $config['file_name'] = $nama_file_img2;
            $config['upload_path'] = './assets/img/developer/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            // $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            /* $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729;  */

            $this->load->library('upload', $config, 'img_upload2'); // Create custom object for Image upload
            $this->img_upload2->initialize($config);

            // PDF Upload
            $pdf_upload = $_FILES['file_pdf']['name'];
            $nama_file_pdf = str_replace(' ', '', $pdf_upload);
            $config['file_name'] = $nama_file_pdf;
            $config['upload_path'] = './assets/img/developer/';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 4250; // in KiloBytes
            
            $this->load->library('upload', $config, 'pdf_upload'); // Create custom object for PDF upload
            $this->pdf_upload->initialize($config);


            if (!empty($img_upload)) {
                $full_path_img = base_url('assets/img/developer/'.$nama_file_img);
            } else {
                $full_path_img = base_url('assets/img/developer/'.$img_name);
            }

            if (!empty($img_upload2)) {
                $full_path_img2 = base_url('assets/img/developer/'.$nama_file_img2);
            } else {
                $full_path_img2 = base_url('assets/img/developer/'.$image);
            }

            if (!empty($pdf_upload)) {
                $full_path_pdf = base_url('assets/img/developer/'); // .$nama_file_pdf
            } else {
                $full_path_pdf = base_url('assets/img/developer/'); // .$pdf_name
            }

            $upload_img_status = $this->img_upload->do_upload('file_img');
            $upload_img_status2 = $this->img_upload2->do_upload('file_image');
            $upload_pdf_status = $this->pdf_upload->do_upload('file_pdf');

            if ($name_tag == "" || $fullname == "" || $alamat == "" || ($id == "" && empty($img_upload)) || ($id == "" && empty($img_upload2)) || (!empty($img_upload) && $upload_img_status === FALSE) || (!empty($img_upload2) && $upload_img_status2 === FALSE)/* || ($id == "" && empty($pdf_upload)) */ || (!empty($pdf_upload) && $upload_pdf_status === FALSE) ) { 
                $message = "";
                if ($name_tag == "") $message.="* Name Tag masih kosong <br>";
                if ($fullname == "") $message.="* Developer Name masih kosong <br>";
                if ($alamat == "") $message.="* Address masih kosong <br>";

                if (!empty($img_upload) && $upload_img_status === FALSE) {
                    $message .= '<br>'.$this->img_upload->display_errors(); 
                }

                if (!empty($img_upload2) && $upload_img_status2 === FALSE) {
                    $message .= '<br>'.$this->img_upload2->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "* File Logo belum dipilih <br>"; 
                }

                if (!empty($pdf_upload) && $upload_pdf_status === FALSE) {
                    $message .= '<br>'.$this->pdf_upload->display_errors(); 
                }

                /* if (($id == "" && empty($pdf_upload))) {
                    $message .= "* File PDF belum dipilih <br>"; 
                } */

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'name_tag' => $name_tag,
                'name' => $fullname,
                'address' => $alamat,
                'img_name' => (!empty($img_upload)) ? $nama_file_img : $img_name,
                'image' => (!empty($img_upload2)) ? $nama_file_img2 : $image,
                'pdf_name' => (!empty($pdf_upload)) ? $nama_file_pdf : $pdf_name,
                'img_url' => $full_path_img,
                'image_url' => $full_path_img2,
                'pdf_url' => $full_path_pdf
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_developer', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_developer', $data_h, array('id' => $id));
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
	
	function ajax_simpan_whyus() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $text = $this->input->post('text');
            $img_name = $this->input->post('img_name');
            $image = $this->input->post('image');

            // Image Upload
            $img_upload = $_FILES['file_img']['name'];
            $nama_file_img = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file_img;
            $config['upload_path'] = './assets/img/whyus/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            // $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            /* $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729;  */

            $this->load->library('upload', $config, 'img_upload'); // Create custom object for Image upload
            $this->img_upload->initialize($config);

            
            if (!empty($img_upload)) {
                $full_path_img = base_url('assets/img/whyus/'.$nama_file_img);
            }

            $upload_img_status = $this->img_upload->do_upload('file_img');
            
            if ($title == "" || $text == "") { 
                $message = "";
                if ($title == "") $message.="* Title masih kosong <br>";
                if ($text == "") $message.="* Deskripsi masih kosong <br>";
				
                if (!empty($img_upload) && $upload_img_status === FALSE) {
                    $message .= '<br>'.$this->img_upload->display_errors(); 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'title' => $title,
                'text' => $text,
                'img' => $nama_file_img,
                'img_url' => $full_path_img
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_why_us', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_why_us', $data_h, array('id' => $id));
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


    function ajax_simpan_partner() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $fullname = $this->input->post('fullname');
            $img_name = $this->input->post('img_name');

            // Image Upload
            $img_upload = $_FILES['file_img']['name'];
            $nama_file_img = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file_img;
            $config['upload_path'] = './assets/img/partner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            /* $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729;  */

            $this->load->library('upload', $config, 'img_upload'); // Create custom object for Image upload
            $this->img_upload->initialize($config);


            if (!empty($img_upload)) {
                $full_path_img = base_url('assets/img/partner/'.$nama_file_img);
            } else {
                $full_path_img = base_url('assets/img/partner/'.$img_name);
            }


            $upload_img_status = $this->img_upload->do_upload('file_img');

            if ($fullname == ""|| ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_img_status === FALSE) ) { 
                $message = "";
                if ($fullname == "") $message.="* Partner Name masih kosong <br>";

                if (!empty($img_upload) && $upload_img_status === FALSE) {
                    $message .= '<br>'.$this->img_upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "* File Logo belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'name' => $fullname,
                'img_name' => (!empty($img_upload)) ? $nama_file_img : $img_name,
                'img_url' => $full_path_img
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_partner', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_partner', $data_h, array('id' => $id));
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


    function ajax_simpan_news() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $berita = $this->input->post('berita');
            $img_name = $this->input->post('img_name');

            $img_upload = $_FILES['file_img']['name'];
            $nama_file = str_replace(' ', '', $img_upload);

            $this->load->library('upload');
            $config['file_name'] = $nama_file;
            $config['upload_path'] = FCPATH.'assets/img/news/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            $this->upload->initialize($config);




            if (!empty($img_upload)) {
                $full_path = base_url('assets/img/news/'.$nama_file);
            } else {
                $full_path = base_url('assets/img/news/'.$img_name);
            }

            $upload_status = $this->upload->do_upload('file_img');

            if ($judul == "" || $berita == "" || ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_status === FALSE) ) { 
                $message = "";
                if ($judul == "") $message.="Judul masih kosong <br>";
                if ($berita == "") $message.="Berita masih kosong <br>";

                if (!empty($img_upload) && $upload_status === FALSE) {
                    $message .= '<br>'.$this->upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "File belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'judul' => $judul,
                'berita' => $berita,
                'img_name' => (!empty($img_upload)) ? $nama_file : $img_name,
                'img_url' => $full_path
            ); 


            if (empty($id)) { 
                $data_h['tanggal'] = date('Y-m-d');
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_news', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_news', $data_h, array('id' => $id));
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


    function ajax_simpan_testimoni() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $judul = $this->input->post('judul');
            $testimoni = $this->input->post('testimoni');
            $img_name = $this->input->post('img_name');

            $img_upload = $_FILES['file_img']['name'];
            $nama_file = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/img/testimoni/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes


            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!empty($img_upload)) {
                $full_path = base_url('assets/img/testimoni/'.$nama_file);
            } else {
                $full_path = base_url('assets/img/testimoni/'.$img_name);
            }

            $upload_status = $this->upload->do_upload('file_img');

            if ($judul == "" || $testimoni == "" || ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_status === FALSE) ) { 
                $message = "";
                if ($nama == "") $message.="Nama masih kosong <br>";
                if ($judul == "") $message.="Judul masih kosong <br>";
                if ($testimoni == "") $message.="Testimoni masih kosong <br>";

                if (!empty($img_upload) && $upload_status === FALSE) {
                    $message .= '<br>'.$this->upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "File belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'name' => $nama,
                'title' => $judul,
                'testimony' => $testimoni,
                'img_name' => (!empty($img_upload)) ? $nama_file : $img_name,
                'img_url' => $full_path
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_testimony', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_testimony', $data_h, array('id' => $id));
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


    function ajax_simpan_footer() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $alamat = $this->input->post('alamat');
            $kontak = $this->input->post('kontak');
            $email = $this->input->post('email');
            $facebook = $this->input->post('facebook');
            $instagram = $this->input->post('instagram');
            $email_name = $this->input->post('email_name');
            $facebook_name = $this->input->post('facebook_name');
            $instagram_name = $this->input->post('instagram_name');

            if ($alamat == "" || $kontak == "" || $email == "" || $facebook == "" || $instagram == "" || $email_name == "" || $facebook_name == "" || $instagram_name == "") {
                $message = "";
                if ($alamat == "") $message.="* Alamat masih kosong <br>";
                if ($kontak == "") $message.="* Kontak masih kosong <br>";
                if ($email == "") $message.="* Email masih kosong <br>";
                if ($facebook == "") $message.="* Link Facebook masih kosong <br>";
                if ($instagram == "") $message.="* Link Instagram masih kosong <br>";
                if ($email_name == "") $message.="* Nama Email masih kosong <br>";
                if ($facebook_name == "") $message.="* Nama Facebook masih kosong <br>";
                if ($instagram_name == "") $message.="* Nama Instagram masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'alamat' => $alamat,
                'phone' => $kontak,
                'email' => $email,
                'facebook_url' => $facebook,
                'instagram_url' => $instagram,
                'email_name' => $email_name,
                'facebook_name' => $facebook_name,
                'instagram_name' => $instagram_name
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_footer', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_footer', $data_h, array('id' => $id));
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



    function ajax_simpan_faq() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');

            if ($question == "" || $answer == "") {
                $message = "";
                if ($question == "") $message.="Pertanyaan masih kosong <br>";
                if ($answer == "") $message.="Jawaban masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'question' => $question,
                'answer' => $answer
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_faq', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_faq', $data_h, array('id' => $id));
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


    function slider_upload_images() {

            $config['upload_path'] = './assets/img/slider/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['overwrite'] = FALSE;
            $config['max_size'] = 250; // in KiloBytes
            $config['min_width'] = 1920;
            $config['min_height'] = 1000;
            $config['max_width'] = 1920;
            $config['max_height'] = 1000; 

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $upload_status = $this->upload->do_upload('file_slider');
            $file_name = preg_replace('/\s+/', '_', $this->upload->data('file_name')); 
            $full_path = base_url('assets/img/slider/'.$file_name);

            $data = array(
                'file_name' => $file_name,
                'file_url' => $full_path,
                'insert_by' => $this->session->userdata('username')
            );
            
            if ($upload_status === TRUE) {
                $this->Main_model->proses_data('tb_home_slider', $data);
            }

    }

    function gallery_upload_images() {

            $config['upload_path'] = './assets/img/gallery/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $upload_status = $this->upload->do_upload('file_gallery');
            $file_name = preg_replace('/\s+/', '_', $this->upload->data('file_name')); 
            $full_path = base_url('assets/img/gallery/'.$file_name);

            $data = array(
                'file_name' => $file_name,
                'file_url' => $full_path,
                'insert_by' => $this->session->userdata('username'),
                'id_album' => 1
            );

            if ($upload_status === TRUE) {
                $this->Main_model->proses_data('tb_gallery', $data);
            }

    }


    function ajax_simpan_home_slider() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $img_name = $this->input->post('img_name');

            $img_upload = $_FILES['file_img']['name'];
            $nama_file = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/img/slider/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = FALSE; // TRUE
            $config['max_size'] = 250; // in KiloBytes
            $config['min_width'] = 1920;
            $config['min_height'] = 1000;
            $config['max_width'] = 1920;
            $config['max_height'] = 1000; 


            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!empty($img_upload)) {
                $full_path = base_url('assets/img/slider/'.$nama_file);
            } else {
                $full_path = base_url('assets/img/slider/'.$img_name);
            }

            $upload_status = $this->upload->do_upload('file_img');
            
            if (($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_status === FALSE) ) { 
                $message = "";

                if (!empty($img_upload) && $upload_status === FALSE) {
                    $message .= '<br>'.$this->upload->display_errors(); 
                }
                
                if (($id == "" && empty($img_upload))) {
                    $message .= "File belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'file_name' => (!empty($img_upload)) ? $nama_file : $img_name,
                'file_url' => $full_path
            ); 


            if (empty($id)) { 
                $data_h['tanggal'] = date('Y-m-d');
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_home_slider', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_home_slider', $data_h, array('id' => $id));
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


    function ajax_simpan_gallery() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $img_name = $this->input->post('img_name');
            $album = $this->input->post('album_name');

            $img_upload = $_FILES['file_img']['name'];
            $nama_file = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file;
            $config['upload_path'] = './assets/img/gallery/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes


            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!empty($img_upload)) {
                $full_path = base_url('assets/img/gallery/'.$nama_file);
            } else {
                $full_path = base_url('assets/img/gallery/'.$img_name);
            }

            $upload_status = $this->upload->do_upload('file_img');

            if ($judul == "" || ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_status === FALSE) || $album == "") { 
                $message = "";
                if ($judul == "") $message.="* Judul masih kosong <br>";

                if (!empty($img_upload) && $upload_status === FALSE) {
                    $message .= '<br>'.$this->upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "* File belum dipilih <br>"; 
                }

                if ($album == "") $message.="* Album belum dipilih <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'title' => $judul,
                'file_name' => (!empty($img_upload)) ? $nama_file : $img_name,
                'file_url' => $full_path,
                'id_album' => $album
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_gallery', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_gallery', $data_h, array('id' => $id));
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



    function ajax_simpan_loan_service() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $deskripsi = $this->input->post('deskripsi');
            // $img_name = $this->input->post('img_name');

            // $img_upload = $_FILES['file_img']['name'];
            // $nama_file = str_replace(' ', '', $img_upload);
            // $config['file_name'] = $nama_file;
            // $config['upload_path'] = './assets/img/service_loan/';
            // $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            // $config['overwrite'] = TRUE;
            // $config['max_size'] = 1500; // in KiloBytes
            

            // $this->load->library('upload', $config);
            // $this->upload->initialize($config);

            // if (!empty($img_upload)) {
            //     $full_path = base_url('assets/img/service_loan/');
            // } else {
            //     $full_path = base_url('assets/img/service_loan/');
            // }

            // $upload_status = $this->upload->do_upload('file_img');
            // $img_width = $this->upload->data('image_width');
            // $img_height = $this->upload->data('image_height');

            // if (!empty($img_upload)) {
            //     $ratio_width = $img_width / $img_height;
            //     $ratio_height = $img_height / $img_width;

            //     $aspect_ratio = $ratio_width / $ratio_height;
            //     $is_square = ($aspect_ratio == 1) ? TRUE : FALSE;
            // } else {
            //     $is_square = FALSE;
            // }

            
            /* echo "<pre>";
            print_r ($this->upload->data()); exit;
            echo "</pre>"; */
            
            
            
            // if ($judul == "" || ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_status === FALSE) || (!empty($img_upload) && $is_square == FALSE) ) { 
            //     $message = "";
            //     if ($judul == "") $message.="Judul masih kosong <br>".$is_square;

            //     if (!empty($img_upload) && $upload_status === FALSE) {
            //         $message .= '<br>'.$this->upload->display_errors(); 
            //     }

            //     if (($id == "" && empty($img_upload))) {
            //         $message .= "File belum dipilih <br>"; 
            //     }

            //     if (!empty($img_upload) && $is_square == FALSE) $message.="Aspect Ratio Foto harus 1:1 <br>";
            //     // $message .= "Image width = ".$img_width.", Image height = ".$img_height.". Calc dimension = ".$ratio_width.".<br>Calc dimension 2 = ".$ratio_height;

            //     $respon = array('status' => FALSE, 'message' => $message);
            //     echo json_encode($respon);exit;
            // }

            $data_h = array(
                'judul' => $judul,
                'deskripsi' => $deskripsi
                // 'img_name' => (!empty($img_upload)) ? $nama_file : $img_name,
                // 'img_url' => $full_path
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                // $save_h = $this->Main_model->proses_data('tb_service_loan', $data_h);
                $save_h = $this->Main_model->proses_data('tb_data_loan_service', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                // $save_h = $this->Main_model->proses_data('tb_service_loan', $data_h, array('id' => $id));
                $save_h = $this->Main_model->proses_data('tb_data_loan_service', $data_h, array('id' => $id));
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


    function ajax_simpan_image_loan(){
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $deskripsi = $this->input->post('deskripsi');
            $img_name = $this->input->post('img_name');

            // Image Upload
            $img_upload = $_FILES['file_img']['name'];
            $nama_file_img = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file_img;
            $config['upload_path'] = './assets/img/image_loan/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 250; // in KiloBytes
            /* $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729;  */

            $this->load->library('upload', $config, 'img_upload'); // Create custom object for Image upload
            $this->img_upload->initialize($config);


            if (!empty($img_upload)) {
                $full_path_img = base_url('assets/img/image_loan/'.$nama_file_img);
            } else {
                $full_path_img = base_url('assets/img/image_loan/'.$img_name);
            }


            $upload_img_status = $this->img_upload->do_upload('file_img');

            if ($judul == ""|| ($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_img_status === FALSE) ) { 
                $message = "";
                if ($judul == "") $message.="* Judul Image masih kosong <br>";

                if (!empty($img_upload) && $upload_img_status === FALSE) {
                    $message .= '<br>'.$this->img_upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "* File Image belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'img_name' => (!empty($img_upload)) ? $nama_file_img : $img_name,
                'img_url' => $full_path_img
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_image_loan', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_image_loan', $data_h, array('id' => $id));
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


    function ajax_simpan_home_video() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $video_url = $this->input->post('video_url');
            $description = $this->input->post('description');

            if ($video_url == "" || $description == "") {
                $message = "";
                if ($video_url == "") $message.="Link Youtube masih kosong <br>";
                if ($description == "") $message.="Deskripsi masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $search_url = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
            $replace_url = 'youtube.com/embed/$1';
            $embed_url = preg_replace($search_url, $replace_url, $video_url);
            $embed_link = explode('&',$embed_url);
            $embed_url_fixed = $embed_link[0];

            $data_h = array(
                'file_url' => $embed_url_fixed,
                'description' => $description
            ); 

            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('tb_home_video', $data_h);
                $id = $save_h;
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_home_video', $data_h, array('id' => $id));
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

    function get_home_slider_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_home_slider', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_about_us_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_about_us', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }
	
	function get_milestones_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_milestones', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_contact_us_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_contact_us', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_developer_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_developer', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }
	
	function get_whyus_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_why_us', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_partner_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_partner', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_gallery_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_gallery', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_news_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_news', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_testimoni_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_testimony', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_footer_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_footer', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_faq_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_faq', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function get_loan_service_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            // $data = $this->Main_model->view_by_id('tb_service_loan', ['id' => $id], 'row');
            $data = $this->Main_model->view_by_id('tb_data_loan_service', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function get_imageloan_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_image_loan', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function get_founder_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_image_founder', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function get_home_video_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_home_video', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }



    function hapus_home_slider($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_home_slider', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_about_us($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_about_us', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }
	
	function hapus_milestones($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_milestones', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_contact_us($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_contact_us', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }



    function hapus_developer($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_developer', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }
	
	function hapus_whyus($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_why_us', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_partner($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_partner', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_gallery($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_gallery', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }



    function hapus_news($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_news', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_testimoni($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_testimony', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_footer($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_footer', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_faq($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_faq', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }


    function hapus_loan_service($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_service_loan', ['status' => 0], $condition);
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
            
            echo json_encode($result);
            
        } else {
            show_404();
        }
    }

    function hapus_founder($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_image_founder', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }

    function hapus_imageloan($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_image_loan', ['status' => 0], $condition);
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

            echo json_encode($result);

        } else {
            show_404();
        }
    }

    function hapus_home_video($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_home_video', ['status' => 0], $condition);
            if ($hapus > 0) {
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

    
    function set_active_video($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 1
            $simpan = $this->Main_model->process_data('tb_home_video', ['status' => 1], $condition);
            if ($simpan > 0) {
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

    
    function ajax_simpan_founder(){
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $img_name = $this->input->post('img_name');

            // Image Upload
            $img_upload = $_FILES['file_img']['name'];
            $nama_file_img = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file_img;
            $config['upload_path'] = './assets/img/founder/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['overwrite'] = TRUE;
            $config['max_size'] = 500; // in KiloBytes
            /* $config['min_width'] = 667;
            $config['min_height'] = 729;
            $config['max_width'] = 667;
            $config['max_height'] = 729;  */

            $this->load->library('upload', $config, 'img_upload'); // Create custom object for Image upload
            $this->img_upload->initialize($config);


            if (!empty($img_upload)) {
                $full_path_img = base_url('assets/img/founder/'.$nama_file_img);
            } else {
                $full_path_img = base_url('assets/img/founder/'.$img_name);
            }


            $upload_img_status = $this->img_upload->do_upload('file_img');

            if (($id == "" && empty($img_upload)) || (!empty($img_upload) && $upload_img_status === FALSE) ) { 
                $message = "";
                

                if (!empty($img_upload) && $upload_img_status === FALSE) {
                    $message .= '<br>'.$this->img_upload->display_errors(); 
                }

                if (($id == "" && empty($img_upload))) {
                    $message .= "* File Image belum dipilih <br>"; 
                }

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'img_name' => (!empty($img_upload)) ? $nama_file_img : $img_name,
                'img_url' => $full_path_img
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_image_founder', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_image_founder', $data_h, array('id' => $id));
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



    /* function ajax_simpan_() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $ = $this->input->post('');
            $ = $this->input->post('');
            $ = $this->input->post('');


            
            if ($ == "" || $ == "" || $ == "" ) {
                $message = "";
                if ($ == "") $message.="*  masih kosong <br>";
                if ($ == "") $message.="*  masih kosong <br>";
                if ($ == "") $message.="*  masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }
            $data_h = array(
                '' => $,
                '' => $e
            );


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_', $data_h, array('id' => $id));
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
    } */


    
}

?>