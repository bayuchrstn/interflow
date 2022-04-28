<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Career extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Main_model', '', true);
        $this->load->model('Career_Model', '', true);
        
        $this->css_include = '';
        $this->js_include = '';
        if (!$this->session->userdata('username')) {
            redirect('Login');
        }
    }

    function lowongan_kerja() {
        $data['title'] = 'Interflow | Career';
        $data['judul'] = 'Lowongan Kerja';
        $footer['js'] = '<script src="'.base_url('assets/js/career/lowongan_kerja.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/career/lowongan_kerja');
        $this->load->view('admin/footer', $footer);
    }

    function pelamar() {
        $data['title'] = 'Interflow | Career';
        $data['judul'] = 'Pelamar';
        $footer['js'] = '<script src="'.base_url('assets/js/career/pelamar.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/career/pelamar');
        $this->load->view('admin/footer', $footer);
    }

    function image_career() {
        $data['title'] = 'Interflow | Image Career';
        $data['judul'] = 'Image Career';
        $footer['js'] = '<script src="'.base_url('assets/js/career/imagekarir.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/career/image_career');
        $this->load->view('admin/footer', $footer);
    }

    function dt_lowongan_kerja() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $lowongan = $this->Career_Model->view_lowongan_kerja()->result();
            $data = [];
            if ($lowongan) {
                $no = 1;
                foreach ($lowongan as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no; 
                    $data['data'][$row][] = $val->posisi_pekerjaan;
                    $data['data'][$row][] = nl2br($val->keterangan);
                    $data['data'][$row][] = nl2br($val->persyaratan);
                    $data['data'][$row][] = $edit.'&nbsp'.$delete;

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

    function dt_pelamar() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $pelamar = $this->Career_Model->view_pelamar()->result();
            $data = [];
            if ($pelamar) {
                $no = 1;
                foreach ($pelamar as $row => $val) {
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $jns_kelamin = $val->jenis_kelamin;

                    switch ($jns_kelamin) {
                        case 'L':
                            $gender = 'Laki-laki';
                            break;
                        case 'P':
                            $gender = 'Perempuan';
                            break;
                        default:
                            $gender = '';
                            break;
                    }

                    $data['data'][$row][] = $no; 
                    $data['data'][$row][] = $val->nama;
                    $data['data'][$row][] = $val->email;
                    $data['data'][$row][] = $val->notelp;
                    $data['data'][$row][] = $val->alamat;
                    $data['data'][$row][] = $gender;
                    $data['data'][$row][] = $val->tempat_lahir;
                    $data['data'][$row][] = $this->Main_model->tanggal_indo($val->tanggal_lahir);
                    $data['data'][$row][] = '<a href="'.$val->pdf_url.'" target="_blank" class="btn btn-sm btn-danger">
                                                <span class="icon-file-pdf"> </span> PDF 
                                            </a>';
                    $data['data'][$row][] = $val->posisi_pekerjaan;
                    $data['data'][$row][] = $delete; 

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


    function dt_image(){
        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Career_Model->view_imagecr()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    // $data['data'][$row][] = $val->img_name;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->img_url.'" data-name="'.$val->img_name.'" 

                                                                        class="openImageDialog thumbnail" data-toggle="modal">

                                                                        <img src="'.$val->img_url.'" width="100px">

                                            </a>';

                    $data['data'][$row][] = $edit.'&nbsp'.$delete;



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

    function ajax_simpan_lowongan() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $posisi_kerja = $this->input->post('posisi_kerja');
            $keterangan = $this->input->post('keterangan');
            $persyaratan = $this->input->post('persyaratan');

            if ($posisi_kerja == "" || $keterangan == "" || $persyaratan == "") {
                $message = "";
                if ($posisi_kerja == "") $message.="Posisi Pekerjaan masih kosong <br>";
                if ($keterangan == "") $message.="Keterangan masih kosong <br>";
                if ($persyaratan == "") $message.="Persyaratan masih kosong <br>";

                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'posisi_pekerjaan' => $posisi_kerja,
                'keterangan' => $keterangan,
                'persyaratan' => $persyaratan
            ); 


            if (empty($id)) { 
                $data_h['insert_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_lowongan_kerja', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_lowongan_kerja', $data_h, array('id' => $id));
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

    function ajax_simpan_image(){
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $img_name = $this->input->post('img_name');

            // Image Upload
            $img_upload = $_FILES['file_img']['name'];
            $nama_file_img = str_replace(' ', '', $img_upload);
            $config['file_name'] = $nama_file_img;
            $config['upload_path'] = './assets/img/karir/';
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
                $full_path_img = base_url('assets/img/karir/'.$nama_file_img);
            } else {
                $full_path_img = base_url('assets/img/karir/'.$img_name);
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
                $save_h = $this->Main_model->proses_data('tb_image_karir', $data_h);
                $id = $save_h; 
            } else {
                $data_h['update_at'] = date('Y-m-d H:i:s');
                $data_h['update_by'] = $this->session->userdata('username');
                $save_h = $this->Main_model->proses_data('tb_image_karir', $data_h, array('id' => $id));
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

    function get_lowongan_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_lowongan_kerja', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function get_image_by_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('tb_image_karir', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function hapus_lowongan($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_lowongan_kerja', ['status' => 0], $condition);
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

    function hapus_pelamar($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_pendaftar', ['status' => 0], $condition);
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

    function hapus_image($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('tb_image_karir', ['status' => 0], $condition);
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

}