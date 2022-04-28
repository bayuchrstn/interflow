<?php

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Manage_content extends CI_Controller {

    

    public function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->library('form_validation');

        $this->load->model('Main_model', '', true);

        $this->load->model('Content_Model', '', true);

        

        $this->css_include = '';

        $this->js_include = '';

        if (!$this->session->userdata('username')) {

            redirect('Login');

        }

    }





    function home_slider() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Home Slider';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/home_slider.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/home_slider');

        $this->load->view('admin/footer', $footer);

    }



    function about_us() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'About Us';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/about_us.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/about_us');

        $this->load->view('admin/footer', $footer);

    }

	function milestones() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Milestones';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/milestones.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/milestones');

        $this->load->view('admin/footer', $footer);

    }

    function contact_us() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Contact Us - Message from Web Visitors';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/contact_us.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/contact_us');

        $this->load->view('admin/footer', $footer);

    }



    function developer() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Developer';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/developer.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/developer');

        $this->load->view('admin/footer', $footer);

    }


	function why_us() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Why Us';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/why_us.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/why_us');

        $this->load->view('admin/footer', $footer);

    }
	

    function partner() {
        $data['title'] = 'Interflow | Manage Content';
        $data['judul'] = 'Partner';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/partner.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/partner');
        $this->load->view('admin/footer', $footer);

    }



    function gallery() {
        $data['title'] = 'Interflow | Manage Content';
        $data['judul'] = 'Gallery';
        $form['opt_album'] = $this->Content_Model->options_album();
        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/gallery.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/gallery', $form);
        $this->load->view('admin/footer', $footer);
    }



    function news() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'News';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/news.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/news');

        $this->load->view('admin/footer', $footer);

    }



    function testimoni() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Testimoni';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/testimoni.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/testimoni');

        $this->load->view('admin/footer', $footer);

    }



    function footer() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'Footer';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/footer.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/footer');

        $this->load->view('admin/footer', $footer);

    }



    function faq() {

        $data['title'] = 'Interflow | Manage Content';

        $data['judul'] = 'FAQ - Frequently Asked Questions';

        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/faq.js?_='.rand()).'"></script>';



        $this->load->view('admin/header', $data);

        $this->load->view('admin/content/faq');

        $this->load->view('admin/footer', $footer);

    }

    function loan_service() {
        $data['title'] = 'Interflow | Manage Content';
        $data['judul'] = 'Service Loan';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/loan_service.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/loan_service');
        $this->load->view('admin/footer', $footer);
    }

    function image_loans(){
        $data['title'] = 'Interflow | Manage Content';
        $data['judul'] = 'Image Loan';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/image_loan.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/image_loan');
        $this->load->view('admin/footer', $footer);
    }

    function founder(){
        $data['title'] = 'Interflow | Executive Founder';
        $data['judul'] = 'Executive Founder';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/founder.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/founder');
        $this->load->view('admin/footer', $footer);
    }

    function home_video() {
        $data['title'] = 'Interflow | Manage Content';
        $data['judul'] = 'Home Video';
        $footer['js'] = '<script src="'.base_url('assets/js/manage_content/home_video.js?_='.rand()).'"></script>';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/home_video');
        $this->load->view('admin/footer', $footer);
    }



    function dt_home_slider() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_home_slider()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->file_url.'" data-name="'.$val->file_name.'" 

                                                                        class="openImageDialog thumbnail" data-toggle="modal">

                                                                        <img src="'.$val->file_url.'" width="100px">

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

    

    function dt_about_us() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_about_us()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->img_url_profil.'" data-name="'.$val->img_profil.'" 

                                                                        class="openImageDialog thumbnail" data-toggle="modal">

                                                                        <img src="'.$val->img_url_profil.'" width="100px">

                                                                    </a>';

                    $data['data'][$row][] = nl2br($val->profil_perusahaan);

                    $data['data'][$row][] = nl2br($val->nmr_siup);

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
	
	function dt_milestones() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_milestones()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->title;

                    $data['data'][$row][] = $val->counter;

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

    

    function dt_contact_us() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $level = $this->session->userdata('level'); 
            // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

            if ($level != 3) {
                $content = $this->Content_Model->view_contact_us()->result();
            } else {
                $user_id = $this->session->userdata('id');
                $content = $this->Content_Model->view_contact_us_by_agent($user_id)->result();
            }

            $data = [];

            if ($content) {
                $no = 1;

                foreach ($content as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $this->Main_model->tanggal_indo($val->insert_at);
                    $data['data'][$row][] = $val->name;
                    $data['data'][$row][] = $val->phone;
                    $data['data'][$row][] = $val->email;
                    $data['data'][$row][] = $val->subject;
                    $data['data'][$row][] = nl2br($val->message);
                    $data['data'][$row][] = $delete; // $edit.'&nbsp'.



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

    

    function dt_developer() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_developer()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';


                    if (!empty($val->pdf_url) && !empty($val->pdf_name)) {

                        $link_pdf = '<a href="'.$val->pdf_url.$val->pdf_name.'" target="_blank" class="btn btn-sm btn-danger">
                                        <span class="icon-file-pdf"> </span> PDF 
                                    </a>';

                    } else {
                        $link_pdf = '<span class="badge badge-warning"> Belum Upload PDF </span>';;
                    }

                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->name_tag;

                    $data['data'][$row][] = $val->name;

                    $data['data'][$row][] = $val->address;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->img_url.'" data-name="'.$val->img_name.'" 

                                                                        class="openImageDialog thumbnail" data-toggle="modal">

                                                                        <img src="'.$val->img_url.'" width="100px">

                                            </a>';

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->image_url.'" data-name="'.$val->image.'" 

                                                                        class="openImageDialog thumbnail" data-toggle="modal">

                                                                        <img src="'.$val->image_url.'" width="100px">

                                            </a>';

                    $data['data'][$row][] = $link_pdf;

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
	
	function dt_why_us() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $content = $this->Content_Model->view_whyus()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->title;

                    $data['data'][$row][] = $val->text;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->img_url.'" data-name="'.$val->img.'" class="openImageDialog thumbnail" data-toggle="modal">

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

    

    function dt_partner() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_partner()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->name;

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

    

    function dt_gallery() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_gallery()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->file_url.'" data-name="'.$val->file_name.'" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="'.$val->file_url.'" width="100px">

                                            </a>';

                    $data['data'][$row][] = $val->title;

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

    

    function dt_news() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_news()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

  

                    $date = $this->Main_model->tanggal_indo($val->tanggal);

                    $time = date('H:i', strtotime($val->insert_at)).' WIB';

                    $date_and_time = $date.' '.$time;



                    $data['data'][$row][] = $no; 

                    $data['data'][$row][] = $date_and_time;

                    $data['data'][$row][] = $val->judul;

                    $data['data'][$row][] = nl2br($val->berita);

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

    

    function dt_testimoni() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_testimoni()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->name;

                    $data['data'][$row][] = '<a href="#picture" data-id="'.$val->img_url.'" data-name="'.$val->img_name.'" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="'.$val->img_url.'" width="100px">

                                            </a>';

                    $data['data'][$row][] = $val->title;

                    $data['data'][$row][] = nl2br($val->testimony);

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

    

    function dt_footer() {

        $is_ajax = $this->input->is_ajax_request();


        if ($is_ajax) {
            $content = $this->Content_Model->view_footer()->result();
            $data = [];

            if ($content) {
                $no = 1;

                foreach ($content as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = $val->alamat;
                    $data['data'][$row][] = nl2br($val->phone);
                    $data['data'][$row][] = $val->email;
                    $data['data'][$row][] = '<a href="'.$val->facebook_url.'" target="_blank">'.$val->facebook_url.'</a>';
                    $data['data'][$row][] = '<a href="'.$val->instagram_url.'" target="_blank">'.$val->instagram_url.'</a>';
                    $data['data'][$row][] = $val->email_name;
                    $data['data'][$row][] = $val->facebook_name;
                    $data['data'][$row][] = $val->instagram_name;
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



    function dt_faq() {



        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_faq()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->question;

                    $data['data'][$row][] = nl2br($val->answer);

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

    function dt_loan_service() {

        $is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {

            $content = $this->Content_Model->view_loan_service()->result();
            $data = [];
            if ($content) {
                $no = 1;
                foreach ($content as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';

                    $data['data'][$row][] = $no;
                    // $data['data'][$row][] = '<a href="#picture" data-id="'.$val->img_url.$val->img_name.'" data-name="'.$val->img_name.'" 
                    //                                 class="openImageDialog thumbnail" data-toggle="modal">
                    //                                 <img src="'.$val->img_url.$val->img_name.'" width="100px">
                    //                         </a>';
                    $data['data'][$row][] = $val->judul;
                    $data['data'][$row][] = $val->deskripsi;
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

    function dt_image_loan() {
        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_image_loan()->result();

            $data = [];

            if ($content) {

                $no = 1;

                foreach ($content as $row => $val) {

                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';

                    $delete = '<a title="Hapus" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-trash text-danger"></i> </a>';



                    $data['data'][$row][] = $no;

                    $data['data'][$row][] = $val->judul;

                    $data['data'][$row][] = $val->deskripsi;

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

    function dt_founder(){
        $is_ajax = $this->input->is_ajax_request();

        

        if ($is_ajax) {



            $content = $this->Content_Model->view_founder()->result();

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


    function dt_home_video() {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax) {

            $content = $this->Content_Model->view_home_video()->result();
            $data = [];
            if ($content) {
                $no = 1;
                foreach ($content as $row => $val) {
                    $edit = '<a title="Edit" style="min-width: 40px;" href="javascript:;" onclick="get_id('.$val->id.')" > <i class="icon-pencil position-left"></i> </a>';
                   

                    if ($val->status == 1) {
                        $status = '<span class="badge badge-success"> Aktif </span>';
                        $btn_publish = '<a title="Hide" style="min-width: 40px;" href="javascript:;" onclick="delete_data('.$val->id.')"> <i class="icon-dropbox text-grey"></i> </a>';
                    } else {
                        $status = '<span class="badge badge-danger"> Tidak Aktif </span>';
                        $btn_publish = '<a title="Publish" style="min-width: 40px;" href="javascript:;" onclick="set_active('.$val->id.')"> <i class="icon-upload text-success"></i> </a>';
                    }
                            
                    $data['data'][$row][] = $no;
                    $data['data'][$row][] = '<a href="'.$val->video_url.'" target="_blank">'.$val->video_url.'</a>';
                    $data['data'][$row][] = nl2br($val->description);
                    $data['data'][$row][] = $status;
                    $data['data'][$row][] = $edit.'&nbsp'.$btn_publish;

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



}

?>