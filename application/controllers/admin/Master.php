<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Master extends CI_Controller {

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

    function cabang() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Cabang';
        $footer['js'] = '<script src="'.base_url('assets/js/master/cabang.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/cabang');
        $this->load->view('admin/footer', $footer);
    }

    function feature() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master of Features';
        $footer['js'] = '<script src="'.base_url('assets/js/master/feature.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/feature');
        $this->load->view('admin/footer', $footer);
    }

    function fasilitas() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Fasilitas';
        $footer['js'] = '<script src="'.base_url('assets/js/master/fasilitas.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/fasilitas');
        $this->load->view('admin/footer', $footer);
    }

    function satuan() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Satuan';
        $footer['js'] = '<script src="'.base_url('assets/js/master/satuan.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/satuan');
        $this->load->view('admin/footer', $footer);
    }
    
    function category() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Jenis Properti';
        $footer['js'] = '<script src="'.base_url('assets/js/master/category.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/category');
        $this->load->view('admin/footer', $footer);
    }

    function status_properti() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Status Properti';
        $footer['js'] = '<script src="'.base_url('assets/js/master/status_properti.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/status_properti');
        $this->load->view('admin/footer', $footer);
    }

    function periode_sewa() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Periode Sewa';
        $footer['js'] = '<script src="'.base_url('assets/js/master/periode_sewa.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/periode_sewa');
        $this->load->view('admin/footer', $footer);
    }

    function album() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Album';
        $footer['js'] = '<script src="'.base_url('assets/js/master/album.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/album');
        $this->load->view('admin/footer', $footer);
    }
    
    function email_subscriber() {
        $data['title'] = 'Interflow | Master';
        $data['judul'] = 'Master Email Subscriber';
        $footer['js'] = '<script src="'.base_url('assets/js/master/email_subscriber.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/master/email_subscriber');
        $this->load->view('admin/footer', $footer);
    }

    function dt_cabang() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $cabang = $this->Master_Model->view_cabang()->result();
            $data = [];
            if ($cabang) {
                $no = 1;
                foreach ($cabang as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->nama;
                    $data['data'][$row][] = $val->kode;
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

    function dt_feature() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $feature = $this->Master_Model->view_feature()->result();
            $data = [];
            if ($feature) {
                $no = 1;
                foreach ($feature as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->nama;
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

    function dt_fasilitas() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $fasilitas = $this->Master_Model->view_fasilitas()->result();
            $data = [];
            if ($fasilitas) {
                $no = 1;
                foreach ($fasilitas as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->nama;
                    $data['data'][$row][] = $val->satuan;
                    $data['data'][$row][] = $val->logo;
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

    function dt_satuan() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $satuan = $this->Master_Model->view_satuan()->result();
            $data = [];
            if ($satuan) {
                $no = 1;
                foreach ($satuan as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->nama;
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
    
    function dt_category() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $satuan = $this->Master_Model->view_category()->result();
            $data = [];
            if ($satuan) {
                $no = 1;
                foreach ($satuan as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->category;
                    $data['data'][$row][] = $edit; // .'&nbsp'.$delete

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

    function dt_status_properti() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $satuan = $this->Master_Model->view_status_properti()->result();
            $data = [];
            if ($satuan) {
                $no = 1;
                foreach ($satuan as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->name_status;
                    $data['data'][$row][] = $edit; // .'&nbsp'.$delete

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

    function dt_periode_sewa() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $satuan = $this->Master_Model->view_periode_sewa()->result();
            $data = [];
            if ($satuan) {
                $no = 1;
                foreach ($satuan as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->periode;
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


    function dt_album() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $satuan = $this->Master_Model->view_album()->result();
            $data = [];
            if ($satuan) {
                $no = 1;
                foreach ($satuan as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->nama_album;
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



    function dt_email_subscriber() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $email = $this->Master_Model->view_email_subscriber()->result();
            $data = [];
            if ($email) {
                $no = 1;
                foreach ($email as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->email;
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


    
    function ajax_simpan_cabang() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $kode = $this->input->post('kode');
            
            if ($nama == "" || $kode == "") {
                $message = "";
                if ($nama == "") $message.="Nama Cabang masih kosong <br>";
                if ($kode == "") $message.="Kode Cabang masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'nama' => $nama,
                'kode' => $kode
            ); 
            
            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_cabang', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_cabang', $data_h, array('id' => $id));
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



    function ajax_simpan_feature() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');

            if ($nama == "") {
                $message = "";
                if ($nama == "") $message.="Nama Feature masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'nama' => $nama
            ); 

            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_feature', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_feature', $data_h, array('id' => $id));
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

    function ajax_simpan_fasilitas() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $satuan = $this->input->post('satuan');
            $icon = $this->input->post('icon');

            if ($nama == "") {
                $message = "";
                if ($nama == "") $message.="Nama Fasilitas masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'nama' => $nama,
                'satuan' => $satuan,
                'logo' => $icon
            ); 

            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_fasilitas', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_fasilitas', $data_h, array('id' => $id));
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

    function ajax_simpan_satuan() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');

            if ($nama == "") {
                $message = "";
                if ($nama == "") $message.="Nama Satuan masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }
            
            $data_h = array(
                'nama' => $nama
            ); 

            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_satuan', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_satuan', $data_h, array('id' => $id));
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
    
    function ajax_simpan_category() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $kategori = $this->input->post('kategori');
            
            if ($kategori == "") {
                $message = "";
                if ($kategori == "") $message.="Kategori masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'category' => $kategori
            ); 
                
            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_category', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_category', $data_h, array('id' => $id));
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

    function ajax_simpan_status_properti() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            
            if ($nama == "") {
                $message = "";
                if ($nama == "") $message.="Status Properti masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'name_status' => $nama
            ); 
                
            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_status_property', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_status_property', $data_h, array('id' => $id));
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

    function ajax_simpan_periode_sewa() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            
            if ($nama == "") {
                $message = "";
                if ($nama == "") $message.="Periode masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'periode' => $nama
            ); 
                
            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_periode_sewa', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_periode_sewa', $data_h, array('id' => $id));
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

    function ajax_simpan_album() {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            
            if ($nama == "") {
                $message = "";
                if ($nama == "") $message.="Nama Album masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'nama_album' => $nama
            ); 
                
            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_album', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_album', $data_h, array('id' => $id));
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


    function ajax_simpan_email_subscriber() {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $id = $this->input->post('id');
            $email = $this->input->post('email');

            if ($email == "") {
                $message = "";
                if ($email == "") $message.="Email masih kosong <br>";
                $respon = array('status' => FALSE, 'message' => $message);
                echo json_encode($respon);exit;
            }

            $data_h = array(
                'email' => $email
            ); 

            if (empty($id)) { 
                $save_h = $this->Main_model->proses_data('ms_email_subscriber', $data_h);
                $id = $save_h;
            } else {
                $save_h = $this->Main_model->proses_data('ms_email_subscriber', $data_h, array('id' => $id));
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

    function cabang_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_cabang', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function feature_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_feature', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function fasilitas_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_fasilitas', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function satuan_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_satuan', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }
    
    function category_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_category', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function status_properti_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_status_property', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    function periode_sewa_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_periode_sewa', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }
    
    function album_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_album', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function email_subscriber_id($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $data = $this->Main_model->view_by_id('ms_email_subscriber', ['id' => $id], 'row');
            echo json_encode($data);
        } else {
            show_404();
        }

    }


    function hapus_cabang($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_cabang', ['status' => 0], $condition);
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

    function hapus_feature($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_feature', ['status' => 0], $condition);
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

    function hapus_fasilitas($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_fasilitas', ['status' => 0], $condition);
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

    function hapus_satuan($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_satuan', ['status' => 0], $condition);
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

    function hapus_category($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_category', ['status' => 0], $condition);
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

    function hapus_status_properti($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_status_property', ['status' => 0], $condition);
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

    function hapus_periode_sewa($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_periode_sewa', ['status' => 0], $condition);
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
    
    function hapus_album($id = '') {
        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_album', ['status' => 0], $condition);
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

    
    function hapus_email_subscriber($id = '') {
        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {
            $condition = ['id' => $id];

            // update status to 0
            $hapus = $this->Main_model->process_data('ms_email_subscriber', ['status' => 0], $condition);
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

?>