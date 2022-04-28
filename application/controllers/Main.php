<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Model_user');
	}



	public function index()
	{
		$this->Main_model->get_visitor();

		$data['home']    = 'active';
		$data['title']   = 'Home';
		$data['title_2'] = 'Home';

		$data['app']     = 'front/home.js';
		$data['data_slider'] = $this->Main_model->data_slider();
		$data['data_testimoni'] = $this->Main_model->data_testimoni_random();
		$data['opt_type'] = $this->Main_model->opt_type();
		$data['opt_status'] = $this->Main_model->opt_status();

		$data['price'] = $this->Main_model->get_max_price_property();
		// $data['price'][0] = array('max_price' => 'Rp 500M','min_price' => 'Rp 0');
		$data['video'] = $this->Main_model->get_video();
		$data['dt_video'] = $this->Main_model->get_data_video();

		$data['about_us'] = $this->Main_model->get_about_us();
		$data['why_us'] = $this->Main_model->get_why_us();
		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/home', $data);
		$this->load->view('footer', $data);
	}



	public function gallery()
	{
		$data['gallery'] = 'active';
		$data['title']   = 'Gallery';

		$data['title_2'] = 'Gallery';

		$data['app']     = 'front/gallery.js';
		$data['data_album'] = $this->Main_model->data_album();
		$data['data_gallery'] = $this->Main_model->data_gallery(0, 12);

		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/gallery', $data);
		$this->load->view('footer', $data);
	}



	public function developer()
	{
		$data['developer'] = 'active';
		$data['title']   = 'Developer';

		$data['title_2'] = 'List Of Developer';

		$data['app']     = 'front/developer.js';

		$data['data']    = $this->Main_model->data_developer();

		$data['footer'] = $this->Main_model->get_footer();

		if ($this->session->userdata('user_id_lgn')) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/developer', $data);

		$this->load->view('footer', $data);
	}



	public function detail_developer()

	{
		$data['developer'] = 'active';
		$id = $this->input->get('q');

		$data['title']   = 'Detail Developer';

		$data['title_2'] = 'Detail Developer';

		$data['app']     = 'front/detail_developer.js';

		$data['detail']  = $this->Main_model->data_developer_id($id);

		$data['random_developer'] = $this->Main_model->data_developer_random();

		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/detail_developer', $data);

		$this->load->view('footer', $data);
	}



	public function news()

	{
		$data['news'] = 'active';
		$this->load->library('pagination');

		$data['title']   = 'News';

		$data['title_2'] = 'News';

		$data['app']     = 'front/news.js';

		$jumlah_data = $this->Main_model->jumlah_data_news();

		$config['base_url']   = base_url() . '/Main/news/';

		$config['total_rows'] = $jumlah_data;

		$config['per_page']   = 12;



		$config['first_link']       = '';

		$config['last_link']        = '';

		$config['next_link']        = '<i class="fa fa-angle-right"></i>';

		$config['prev_link']        = '<i class="fa fa-angle-left"></i>';

		$config['full_tag_open']    = '<div class="pagination-box hidden-mb-45 text-center">

										<nav aria-label="Page navigation example"><ul class="pagination">';

		$config['full_tag_close']   = '</ul></nav></div>';



		$config['num_tag_open']     = '<li class="page-item">';

		$config['num_tag_close']    = '</li>';



		$config['cur_tag_open']     = '<li class="page-item"><a class="page-link active">';

		$config['cur_tag_close']    = '</a></li>';



		$config['next_tag_open']    = '<li class="page-item">';

		$config['next_tagl_close']  = '</li>';



		$config['prev_tag_open']    = '<li class="page-item">';

		$config['prev_tagl_close']  = '</li>';



		$config['first_tag_open']   = '<li class="page-item"><a class="page-link">';

		$config['first_tagl_close'] = '</a></li>';

		$config['last_tag_open']    = '<li class="page-item"><a class="page-link">';

		$config['last_tagl_close']  = '</a></li>';



		$from = $this->uri->segment(3);

		$this->pagination->initialize($config);



		$data['data_news'] = $this->Main_model->data_news($config['per_page'], $from);

		$data['data_page'] = $this->pagination->create_links();

		$data['footer'] = $this->Main_model->get_footer();



		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/news', $data);

		$this->load->view('footer', $data);
	}



	public function detail_news()

	{
		$data['news'] = 'active';
		$id = $this->input->get('q');

		$data['title']   = 'Detail News';

		$data['title_2'] = 'Detail News';

		$data['detail']  = $this->Main_model->data_news_id($id);

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$data['footer'] = $this->Main_model->get_footer();

		$this->load->view('pages/detail_news', $data);

		$this->load->view('footer', $data);
	}



	public function about_us()

	{
		$data['about_uss'] = 'active';
		$data['title']   = 'About Us';

		$data['title_2'] = 'About Us';

		$data['app']     = 'front/about_us.js';

		$data['data']    = $this->Main_model->data_about_us();

		$data['data_testimoni'] = $this->Main_model->data_testimoni_random();

		$data['about_us'] = $this->Main_model->get_about_us();
		$data['milestones'] = $this->Main_model->get_milestones();
		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/about_us', $data);

		$this->load->view('footer', $data);
	}



	public function consultant()

	{
		$data['consultant'] = 'active';
		$data['title']   = 'Consultant';

		$data['title_2'] = 'List Of Property Consultant';

		$data['app']     = 'front/consultant.js';

		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/consultant', $data);

		$this->load->view('footer', $data);
	}



	public function detail_consultant()

	{
		$data['consultant'] = 'active';
		$id = $this->input->get('q');

		$data['title']   = 'Detail Consultant';

		$data['title_2'] = 'Detail Consultant';

		$data['app']     = 'front/detail_consultant.js';

		$data['detail']  = $this->Main_model->data_consultant_id($id);

		$data['opt_type']   = $this->Main_model->opt_type();

		$data['opt_status'] = $this->Main_model->opt_status();

		$data['data_feature'] = $this->Main_model->data_feature();

		$data['id_agent'] = $id;

		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/detail_consultant', $data);

		$this->load->view('footer', $data);
	}



	public function faq()

	{
		$data['faq'] = 'active';
		$data['title']   = 'FAQ';

		$data['title_2'] = 'FAQ';

		$data['app']     = 'front/faq.js';

		$data['data_faq'] = $this->Main_model->data_faq();

		$data['footer'] = $this->Main_model->get_footer();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/faq', $data);

		$this->load->view('footer', $data);
	}


	public function premium_properti()
	{
		$data['premium_properti'] = 'active';
		$data['title']   = 'Premium Property';

		$data['title_2'] = 'Premium Property';

		$data['app']     = 'front/premium_properti.js';

		$data['opt_type'] = $this->Main_model->opt_type();

		$data['opt_status'] = $this->Main_model->opt_status();

		$data['price'] = $this->Main_model->get_max_price_property();

		$data['address'] = $this->input->get('address');

		$data['status']  = $this->input->get('status');

		$data['type']    = $this->input->get('type');

		if (!empty($this->input->get('min_price'))) {
			$data['min_price'] = str_replace(",", "", substr($this->input->get('min_price'), 3));
		}
		if (!empty($this->input->get('max_price'))) {
			$data['max_price'] = str_replace(",", "", substr($this->input->get('max_price'), 3));
		}

		$data['footer'] = $this->Main_model->get_footer();

		$premium = $this->input->get('pre');

		if ($premium != '') {

			if ($premium != '0') {

				if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

					redirect('Main/premium_properti?pre=1');
				}
			}
		}

		$data['pre'] = $premium;

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/premium_properti', $data);

		$this->load->view('footer', $data);
	}

	public function list_property()

	{
		$data['list_property'] = 'active';
		$data['title']   = 'Property';

		$data['title_2'] = 'List Of Property';

		$data['app']     = 'front/list_property.js';

		$data['opt_type'] = $this->Main_model->opt_type();

		$data['opt_status'] = $this->Main_model->opt_status();

		$data['price'] = $this->Main_model->get_max_price_property();

		$data['address'] = $this->input->get('address');

		$data['status']  = $this->input->get('status');

		$data['type']    = $this->input->get('type');
		if (!empty($this->input->get('min_price'))) {
			$data['min_price'] = str_replace(",", "", substr($this->input->get('min_price'), 3));
		}
		if (!empty($this->input->get('max_price'))) {
			$data['max_price'] = str_replace(",", "", substr($this->input->get('max_price'), 3));
		}
		$data['footer'] = $this->Main_model->get_footer();

		// $premium = $this->input->get('pre');

		// if ($premium != '') {

		// 	if ($premium != '1') {

		// 		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi')==1) {

		// 			redirect('Main/list_property?pre=1');
		// 		}
		// 	}
		// }

		// $data['pre'] = $premium;

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$this->load->view('pages/list_property', $data);

		$this->load->view('footer', $data);
	}



	public function detail_property()

	{
		$data['list_property'] = 'active';
		$id = $this->input->get('q');

		$data['title']   = 'Detail Property';

		$data['title_2'] = 'Detail Property';

		$data['app']     = 'front/detail_property.js';

		$data['detail']  = $this->Main_model->data_property_id($id);

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$data['footer'] = $this->Main_model->get_footer();

		$this->load->view('pages/detail_property', $data);

		$this->load->view('footer', $data);
	}



	public function contact_us()

	{

		$data['title']   = 'Contact Us';

		$data['title_2'] = 'Contact Us';

		$data['app']     = 'front/contact_us.js';

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {

			$data['nama'] = $this->session->userdata('nama');

			$this->load->view('header_premi', $data);
		} else {

			$this->load->view('header', $data);
		}

		$data['footer'] = $this->Main_model->get_footer();

		$this->load->view('pages/contact_us', $data);

		$this->load->view('footer', $data);
	}

	public function service_loan()
	{
		$data['service_loan'] = 'active';
		$data['title']   = 'Loan Service';
		$data['title_2'] = 'Loan Service';
		$data['app']     = 'front/service_loan.js';
		//$data['list_data'] = $this->Main_model->data_service_loan();
		$data['data_loan'] = $this->Main_model->data_service_loan();
		// echo $data['data_loan'];exit;
		$data['data'] = $this->Main_model->data_image_loan();
		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {
			$data['nama'] = $this->session->userdata('nama');
			$this->load->view('header_premi', $data);
		} else {
			$this->load->view('header', $data);
		}

		$data['footer'] = $this->Main_model->get_footer();
		$this->load->view('pages/service_loan', $data);
		$this->load->view('footer', $data);
	}
	function imgloan()
	{
		$id = $this->input->post('id');
		$this->Main_model->get_loan($id);
	}
	public function karir()
	{
		$this->load->library('pagination');
		$data['karir']   = 'active';
		$data['title']   = 'Career';
		$data['title_2'] = 'Career';
		$data['app']     = 'front/karir.js';
		$data['opt_posisi'] = $this->Main_model->opt_data_lowongan_kerja();

		$jumlah_data = $this->Main_model->jumlah_data_karir();

		$config['base_url']   = base_url() . '/Main/karir/';

		$config['total_rows'] = $jumlah_data;

		$config['per_page']   = 4;

		$config['first_link']       = '';

		$config['last_link']        = '';

		$config['next_link']        = '<i class="fa fa-angle-right"></i>';

		$config['prev_link']        = '<i class="fa fa-angle-left"></i>';

		$config['full_tag_open']    = '<div class="pagination-box hidden-mb-45 text-center">

										<nav aria-label="Page navigation example"><ul class="pagination">';

		$config['full_tag_close']   = '</ul></nav></div>';



		$config['num_tag_open']     = '<li class="page-item">';

		$config['num_tag_close']    = '</li>';



		$config['cur_tag_open']     = '<li class="page-item"><a class="page-link active">';

		$config['cur_tag_close']    = '</a></li>';



		$config['next_tag_open']    = '<li class="page-item">';

		$config['next_tagl_close']  = '</li>';



		$config['prev_tag_open']    = '<li class="page-item">';

		$config['prev_tagl_close']  = '</li>';



		$config['first_tag_open']   = '<li class="page-item"><a class="page-link">';

		$config['first_tagl_close'] = '</a></li>';

		$config['last_tag_open']    = '<li class="page-item"><a class="page-link">';

		$config['last_tagl_close']  = '</a></li>';



		$from = $this->uri->segment(3);

		$this->pagination->initialize($config);



		$data['data_karir'] = $this->Main_model->data_lowongan_kerja($config['per_page'], $from);

		$data['data_page'] = $this->pagination->create_links();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {
			$data['nama'] = $this->session->userdata('nama');
			$this->load->view('header_premi', $data);
		} else {
			$this->load->view('header', $data);
		}

		$data['footer'] = $this->Main_model->get_footer();
		$this->load->view('pages/karir', $data);
		$this->load->view('footer', $data);
	}

	public function karir_front()
	{
		$data['karir']   = 'active';
		$data['title']   = 'Career';
		$data['title_2'] = 'Career';
		$data['data']    = $this->Main_model->data_karir();

		if (!empty($this->session->userdata('id')) && $this->session->userdata('premi') == 1) {
			$data['nama'] = $this->session->userdata('nama');
			$this->load->view('header_premi', $data);
		} else {
			$this->load->view('header', $data);
		}

		$data['footer'] = $this->Main_model->get_footer();
		$this->load->view('pages/karir_front', $data);
		$this->load->view('footer', $data);
	}



	// ---------- Home ---------- //

	function ajax_data_hot_property_random()

	{

		$this->Main_model->ajax_function();

		$data = $this->Main_model->data_property_random();

		echo json_encode($data);
	}



	function ajax_data_consultant_random()

	{

		$this->Main_model->ajax_function();

		$data = $this->Main_model->data_consultant_random();

		echo json_encode($data);
	}



	function ajax_data_news_random()

	{

		$this->Main_model->ajax_function();

		$data = $this->Main_model->data_news_random();

		echo json_encode($data);
	}



	function ajax_data_partner()

	{

		$this->Main_model->ajax_function();

		$data = $this->Main_model->data_partner();

		echo json_encode($data);
	}



	function ajax_recent_property()

	{

		$data = $this->Main_model->data_recent_property();

		echo json_encode($data);
	}

	// ---------- End Home ---------- //



	// ---------- Gallery ---------- //

	function ajax_data_gallery()

	{

		$this->Main_model->ajax_function();

		$start = $this->input->post('start');
		$limit = $this->input->post('limit');

		$data = $this->Main_model->data_gallery($start, $limit);

		echo $data;
	}

	// ---------- End Gallery ---------- //



	// ---------- Consultant ---------- //

	function ajax_data_consultant()

	{

		$this->Main_model->ajax_function();

		$data = $this->Main_model->data_consultant();

		echo json_encode($data);
	}



	function ajax_send_contact_agent()

	{

		$this->Main_model->ajax_function();

		$id_agent = $this->input->post('id_agent');

		$name    = $this->input->post('name');

		$email   = $this->input->post('email');

		$subject = $this->input->post('subject');

		$message = $this->input->post('message');



		if ($name == '' || $email == '' || $subject == '' || $message == '') {

			$notif = '<div class="alert alert-info bold" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

			if ($name == '') $notif .= 'Form Name harus di isi <br>';

			if ($email == '') $notif .= 'Form Email harus di isi <br>';

			if ($subject == '') $notif .= 'Form Subject harus di isi <br>';

			if ($message == '') $notif .= 'Form Message harus di isi <br>';

			$notif .= '</div>';

			$respon = array('status' => FALSE, 'message' => $notif);

			echo json_encode($respon);

			exit;
		}



		$secret_key = "6Lfz1LcUAAAAAOAryxtOfo51X4-LlXjjjeAkVDpq";

		$res_captcha = $_POST['g-recaptcha-response'];

		$url    	= 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $res_captcha;

		$rest_api 	= $this->validasi_captcha($url);

		$rest_api   = json_decode($rest_api);

		$success    = isset($rest_api->success) ? $rest_api->success : '';

		if ($success != TRUE) {

			$respon  = array('status' => FALSE, 'message' => '<div class="alert alert-info bold" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Please Check The Captcha</div>');

			echo json_encode($respon);

			exit;
		}



		$data = array(

			'id_agent'  => $id_agent,

			'name' 		=> $name,

			'email' 	=> $email,

			'subject' 	=> $subject,

			'message' 	=> $message

		);


		$agent_info = $this->Model_user->get_agent_email($id_agent)->row();
		$to = isset($agent_info->email) ? $agent_info->email : ''; // Email consultant/agent 
		// $to = 'kristian_adhi96@yahoo.co.id';

		$cc = 'interflow.property@gmail.com'; // Email pusat
		// $cc = 'tian.z@hotmail.co.id'; 

		$from = $email;
		$sender_name = $name . ' - [Interflow Web Visitor]';

		$this->Main_model->process_data('tb_contact_us', $data);
		$this->Model_user->kirim_email($to, $cc, nl2br($message), $subject, $from, $sender_name);

		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-success bold" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Terima kasih, Pesan anda berhasil terkirim ke agent Consultant kami.</div>');

		echo json_encode($respon);

		exit;
	}

	// ---------- End Consultant ---------- //



	// ---------- Contact Us ---------- //

	function ajax_send_contact()
	{

		$this->Main_model->ajax_function();

		$name    = $this->input->post('name');
		$phone   = $this->input->post('phone');
		$email   = $this->input->post('email');

		$subject = $this->input->post('subject');

		$message = $this->input->post('message');



		if ($name == '' || $email == '' || $phone == '' || $subject == '' || $message == '') {

			$notif = '<div class="alert alert-info bold" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

			if ($name == '') $notif .= 'Form Name harus di isi <br>';
			if ($email == '') $notif .= 'Form No Telephone harus di isi <br>';
			if ($email == '') $notif .= 'Form Email harus di isi <br>';

			if ($subject == '') $notif .= 'Form Subject harus di isi <br>';

			if ($message == '') $notif .= 'Form Message harus di isi <br>';

			$notif .= '</div>';

			$respon = array('status' => FALSE, 'message' => $notif);

			echo json_encode($respon);

			exit;
		}



		$secret_key = "6Lfz1LcUAAAAAOAryxtOfo51X4-LlXjjjeAkVDpq";

		$res_captcha = $_POST['g-recaptcha-response'];

		$url    	= 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $res_captcha;

		$rest_api 	= $this->validasi_captcha($url);

		$rest_api   = json_decode($rest_api);

		$success    = isset($rest_api->success) ? $rest_api->success : '';

		if ($success != TRUE) {

			$respon  = array('status' => FALSE, 'message' => '<div class="alert alert-info bold" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Please Check The Captcha</div>');

			echo json_encode($respon);

			exit;
		}



		$data = array(

			'name' 		=> $name,
			'phone' 	=> $phone,
			'email' 	=> $email,

			'subject' 	=> $subject,

			'message' 	=> $message

		);


		$to = 'interflow.property@gmail.com';
		// $to = 'kristian_adhi96@yahoo.co.id';

		$cc = '';
		$from = $email;
		$sender_name = $name . ' - [Interflow Web Visitor]';

		$this->Main_model->process_data('tb_contact_us', $data);
		$this->Model_user->kirim_email($to, $cc, nl2br($message), $subject, $from, $sender_name);


		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-success bold" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Terima kasih, Pesan anda berhasil terkirim</div>');

		echo json_encode($respon);

		exit;
	}



	function validasi_captcha($url = '')

	{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);

		return $output;
	}

	// ---------- End Contact Us ---------- //



	// ---------- Property ---------- //

	function ajax_data_property_recommended()

	{

		$this->Main_model->ajax_function();

		$search = $this->input->get('search');

		$status = $this->input->get('status');

		$type   = $this->input->get('type');

		$category  = $this->input->get('category');

		$min_price = str_replace(",", "", $this->input->get('min_price'));

		$max_price = str_replace(",", "", $this->input->get('max_price'));

		$premium   = $this->input->get('premium');

		$sort_order = $this->input->get('sort_order');



		$condition = "";

		$arr = array();



		if ($status != '') {

			$arr[] = " a.id_status_property='$status' ";
		}



		if ($type != '' && $category == '') {

			$arr[] = " a.id_category='$type' ";
		}



		if (($category != '' && $category != 'undefined') && $type == '') {

			$arr[] = " a.id_category='$category' ";
		}



		if (($category != '' && $category != 'undefined') && $type != '') {

			if ($category == $type) {

				$arr[] = " a.id_category='$category' ";
			}
		}



		if ($premium != '' && $premium != 'undefined') {

			$arr[] = " a.premium='$premium' ";
		} else {

			if (empty($this->session->userdata('user_id_lgn'))) {

				$arr[] = " a.premium='0' ";
			}
		}



		if (!empty($arr)) {
			$condition .= " AND ";
		}

		$condition .= build_condition($arr, 'AND');



		if ($min_price != '' && $max_price != '') {

			$condition .= " AND a.harga_jual BETWEEN '$min_price' AND '$max_price' ";
		}



		if (($category != '' && $category != 'undefined') && $type != '') {

			if ($category != $type) {

				$condition .= " AND (a.id_category='$category' OR a.id_category='$type') ";
			}
		}



		$ordering  = " ORDER BY RAND() ";

		if ($sort_order != '') {

			if ($sort_order == 'ASC') {

				$ordering = " ORDER BY a.id ASC ";
			}



			if ($sort_order == 'DESC') {

				$ordering = " ORDER BY a.id DESC ";
			}



			if ($sort_order == 'HtoL') {

				$ordering = " ORDER BY a.harga_jual DESC ";
			}



			if ($sort_order == 'LtoH') {

				$ordering = " ORDER BY a.harga_jual ASC ";
			}
		}



		$min_price = $this->input->get('min_price');

		$max_price = $this->input->get('max_price');



		$data = $this->Main_model->data_property_recommended($condition, $search, $ordering);

		echo json_encode($data);
	}

	function ajax_data_premium($start = '')

	{

		$this->Main_model->ajax_function();



		$search = $this->input->get('search');

		$status = $this->input->get('status');

		$type   = $this->input->get('type');

		$category = $this->input->get('category');

		$min_price = str_replace(",", "", substr($this->input->get('min_price'), 3));

		$max_price = str_replace(",", "", substr($this->input->get('max_price'), 3));

		$premium   = $this->input->get('premium');

		$sort_order = $this->input->get('sort_order');



		$condition = "";

		$arr = array();



		if ($status != '') {

			$arr[] = " a.id_status_property='$status' ";
		}



		if ($type != '' && $category == '') {

			$arr[] = " a.id_category='$type' ";
		}



		if (($category != '' && $category != 'undefined') && $type == '') {

			$arr[] = " a.id_category='$category' ";
		}



		if (($category != '' && $category != 'undefined') && $type != '') {

			if ($category == $type) {

				$arr[] = " a.id_category='$category' ";
			}
		}



		if ($premium != '' && $premium != 'undefined') {

			$arr[] = " a.premium='$premium' ";
		} else {

			if (empty($this->session->userdata('user_id_lgn'))) {

				$arr[] = " a.premium='0' ";
			}
		}



		if (!empty($arr)) {
			$condition .= " AND ";
		}

		$condition .= build_condition($arr, 'AND');



		if ($min_price != '' && $max_price != '') {

			$condition .= " AND a.harga_jual BETWEEN '$min_price' AND '$max_price' ";
		}



		if (($category != '' && $category != 'undefined') && $type != '') {

			if ($category != $type) {

				$condition .= " AND (a.id_category='$category' OR a.id_category='$type') ";
			}
		}



		$ordering  = "";

		if ($sort_order != '') {

			if ($sort_order == 'ASC') {

				$ordering = " ORDER BY a.id ASC ";
			}



			if ($sort_order == 'DESC') {

				$ordering = " ORDER BY a.id DESC ";
			}



			if ($sort_order == 'HtoL') {

				$ordering = " ORDER BY a.harga_jual DESC ";
			}



			if ($sort_order == 'LtoH') {

				$ordering = " ORDER BY a.harga_jual ASC ";
			}
		}



		$this->load->library('pagination');



		$limit    = '6';

		if ($start != 0) {

			$start = ($start - 1) * $limit;
		}



		$get_data = $this->Main_model->data_premium_properti($start, $limit, $condition, $search, $ordering);

		//  set pagination //

		$config['base_url']         = base_url() . 'Main/ajax_data_premium';

		$config['use_page_numbers'] = TRUE;

		$config['per_page']         = $limit;

		$config['total_rows']       = $get_data['total_data'];



		$config['next_link']        = '<i class="fa fa-angle-right"></i>';

		$config['prev_link']        = '<i class="fa fa-angle-left"></i>';

		$config['full_tag_open']    = '<div class="pagination-box hidden-mb-45 text-center">

										<nav aria-label="Page navigation example"><ul class="pagination">';

		$config['full_tag_close']   = '</ul></nav></div>';



		$config['num_tag_open']     = '<li class="page-item">';

		$config['num_tag_close']    = '</li>';



		$config['cur_tag_open']     = '<li class="page-item"><a class="page-link active">';

		$config['cur_tag_close']    = '</a></li>';



		$config['next_tag_open']    = '<li class="page-item">';

		$config['next_tagl_close']  = '</li>';



		$config['prev_tag_open']    = '<li class="page-item">';

		$config['prev_tagl_close']  = '</li>';



		$config['first_tag_open']   = '<li class="page-item"><a class="page-link">';

		$config['first_tagl_close'] = '</a></li>';

		$config['last_tag_open']    = '<li class="page-item"><a class="page-link">';

		$config['last_tagl_close']  = '</a></li>';



		$this->pagination->initialize($config);



		$result = array(

			'data' 		 => $get_data['data'],

			'pagination' => $this->pagination->create_links()

		);



		echo json_encode($result);
	}

	function ajax_data_property_list($start = '')

	{

		$this->Main_model->ajax_function();



		$search = $this->input->get('search');

		$status = $this->input->get('status');

		$type   = $this->input->get('type');

		$category = $this->input->get('category');
		if (!empty($min_price) || substr($this->input->get('min_price'), 0, 2) == 'Rp') {
			$min_price = str_replace(",", "", substr($this->input->get('min_price'), 3));
		} else {
			$min_price = $this->input->get('min_price');
		}
		if (!empty($max_price) || substr($this->input->get('max_price'), 0, 2) == 'Rp') {
			$max_price = str_replace(",", "", substr($this->input->get('max_price'), 3));
		} else {
			$max_price = $this->input->get('max_price');
		}
		// $premium   = $this->input->get('premium');

		$sort_order = $this->input->get('sort_order');



		$condition = "";

		$arr = array();



		if ($status != '') {

			$arr[] = " a.id_status_property='$status' ";
		}



		if ($type != '' && $category == '') {

			$arr[] = " a.id_category='$type' ";
		}



		if (($category != '' && $category != 'undefined') && $type == '') {

			$arr[] = " a.id_category='$category' ";
		}



		if (($category != '' && $category != 'undefined') && $type != '') {

			if ($category == $type) {

				$arr[] = " a.id_category='$category' ";
			}
		}



		// if ($premium != '' && $premium != 'undefined') {

		// 	$arr[] = " a.premium='$premium' ";
		// } else {

		// 	if (empty($this->session->userdata('user_id'))) {

		$arr[] = " a.premium='0' ";
		// 	}
		// }



		if (!empty($arr)) {
			$condition .= " AND ";
		}

		$condition .= build_condition($arr, 'AND');



		$condition .= " AND a.harga_jual BETWEEN '$min_price' AND '$max_price' ";



		if (($category != '' && $category != 'undefined') && $type != '') {

			if ($category != $type) {

				$condition .= " AND (a.id_category='$category' OR a.id_category='$type') ";
			}
		}



		$ordering  = " ORDER BY a.id DESC";

		if ($sort_order != '') {

			if ($sort_order == 'ASC') {

				$ordering = " ORDER BY a.id ASC ";
			}



			if ($sort_order == 'DESC') {

				$ordering = " ORDER BY a.id DESC ";
			}



			if ($sort_order == 'HtoL') {

				$ordering = " ORDER BY a.harga_jual DESC ";
			}



			if ($sort_order == 'LtoH') {

				$ordering = " ORDER BY a.harga_jual ASC ";
			}
		}



		$this->load->library('pagination');



		$limit    = '6';

		if ($start != 0) {

			$start = ($start - 1) * $limit;
		}



		$get_data = $this->Main_model->data_property_list_property($start, $limit, $condition, $search, $ordering);

		//  set pagination //

		$config['base_url']         = base_url() . 'Main/ajax_data_property_list';

		$config['use_page_numbers'] = TRUE;

		$config['per_page']         = $limit;

		$config['total_rows']       = $get_data['total_data'];



		$config['next_link']        = '<i class="fa fa-angle-right"></i>';

		$config['prev_link']        = '<i class="fa fa-angle-left"></i>';

		$config['full_tag_open']    = '<div class="pagination-box hidden-mb-45 text-center">

										<nav aria-label="Page navigation example"><ul class="pagination">';

		$config['full_tag_close']   = '</ul></nav></div>';



		$config['num_tag_open']     = '<li class="page-item">';

		$config['num_tag_close']    = '</li>';



		$config['cur_tag_open']     = '<li class="page-item"><a class="page-link active">';

		$config['cur_tag_close']    = '</a></li>';



		$config['next_tag_open']    = '<li class="page-item">';

		$config['next_tagl_close']  = '</li>';



		$config['prev_tag_open']    = '<li class="page-item">';

		$config['prev_tagl_close']  = '</li>';



		$config['first_tag_open']   = '<li class="page-item"><a class="page-link">';

		$config['first_tagl_close'] = '</a></li>';

		$config['last_tag_open']    = '<li class="page-item"><a class="page-link">';

		$config['last_tagl_close']  = '</a></li>';



		$this->pagination->initialize($config);



		$result = array(

			'data' 		 => $get_data['data'],

			'pagination' => $this->pagination->create_links()

		);



		echo json_encode($result);
	}



	function ajax_data_property_list_agent($start = '')

	{

		$this->Main_model->ajax_function();



		$search = $this->input->get('search');

		$status = $this->input->get('status');

		$type   = $this->input->get('type');

		$id_agent  = $this->input->get('id_agent');

		$bedrooms  = $this->input->get('bedrooms');

		$bathrooms = $this->input->get('bathrooms');

		$arr_features = $this->input->get('features');

		$min_price = str_replace(",", "", $this->input->get('min_price'));

		$max_price = str_replace(",", "", $this->input->get('max_price'));

		$sort_order = $this->input->get('sort_order');



		$condition = "";

		$arr = array();

		if (empty($this->session->userdata('user_id_lgn'))) {

			$arr[] = " a.premium='0' ";
		}

		if ($status != '') {

			$arr[] = " a.id_status_property='$status' ";
		}



		if ($type != '') {

			$arr[] = " a.id_category='$type' ";
		}



		if ($id_agent != '') {

			$arr[] = " a.id_agent='$id_agent' ";
		}



		if ($bedrooms != '') {

			$arr[] = " fas.bedrooms >= $bedrooms ";
		}



		if ($bathrooms != '') {

			$arr[] = " fas.bathrooms >= $bathrooms ";
		}



		if (!empty($arr)) {
			$condition .= " AND ";
		}

		$condition .= build_condition($arr, 'AND');



		if ($min_price != '' && $max_price != '') {

			$condition .= " AND a.harga_jual BETWEEN '$min_price' AND '$max_price' ";
		}



		$ordering  = "";

		if ($sort_order != '') {

			if ($sort_order == 'HtoL') {

				$ordering = " ORDER BY a.harga_jual DESC ";
			}



			if ($sort_order == 'LtoH') {

				$ordering = " ORDER BY a.harga_jual ASC ";
			}
		}



		$features = '';

		if (!empty($arr_features)) {

			$features .= ' AND EXISTS ( SELECT id_rumah, id_feature 

										FROM tb_properti_feature

										WHERE id_rumah=a.id';

			$features .= ' AND ( ';

			for ($i = 0; $i < count($arr_features); $i++) {

				$id_features = $arr_features[$i];

				$features .= " id_feature='$id_features' ";

				if (end($arr_features) != $id_features) {

					$features .= ' OR ';
				} else {

					$features .= ' ';
				}
			}

			$features .= ' ) ) ';
		}



		$this->load->library('pagination');



		$limit    = '8';

		if ($start != 0) {

			$start = ($start - 1) * $limit;
		}



		$get_data = $this->Main_model->data_property_list_property($start, $limit, $condition, $search, $ordering, $features);

		//  set pagination //

		$config['base_url']         = base_url() . 'Main/ajax_data_property_list';

		$config['use_page_numbers'] = TRUE;

		$config['per_page']         = $limit;

		$config['total_rows']       = $get_data['total_data'];



		$config['next_link']        = '<i class="fa fa-angle-right"></i>';

		$config['prev_link']        = '<i class="fa fa-angle-left"></i>';

		$config['full_tag_open']    = '<div class="pagination-box hidden-mb-45 text-center">

										<nav aria-label="Page navigation example"><ul class="pagination">';

		$config['full_tag_close']   = '</ul></nav></div>';



		$config['num_tag_open']     = '<li class="page-item">';

		$config['num_tag_close']    = '</li>';



		$config['cur_tag_open']     = '<li class="page-item"><a class="page-link active">';

		$config['cur_tag_close']    = '</a></li>';



		$config['next_tag_open']    = '<li class="page-item">';

		$config['next_tagl_close']  = '</li>';



		$config['prev_tag_open']    = '<li class="page-item">';

		$config['prev_tagl_close']  = '</li>';



		$config['first_tag_open']   = '<li class="page-item"><a class="page-link">';

		$config['first_tagl_close'] = '</a></li>';

		$config['last_tag_open']    = '<li class="page-item"><a class="page-link">';

		$config['last_tagl_close']  = '</a></li>';



		$this->pagination->initialize($config);



		$result = array(

			'data' 		 => $get_data['data'],

			'pagination' => $this->pagination->create_links()

		);



		echo json_encode($result);
	}

	// ---------- End Property ---------- //

	// ---------- Karir ---------- //
	function ajax_kirim_lamaran()
	{
		$this->Main_model->ajax_function();
		$nama   = $this->input->post('nama_lengkap');
		$email  = $this->input->post('email');
		$notelp = $this->input->post('notelp');
		$alamat = $this->input->post('alamat');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tempat_lahir  = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$posisi_kerja  = $this->input->post('posisi_kerja');

		$this->load->library('upload');

		$nmfile = "cv_" . time();
		$config['upload_path']   = './assets/cv/';
		$config['allowed_types'] = 'PDF|pdf';
		$config['file_name']     = $nmfile;
		$this->upload->initialize($config);

		$file_pdf = $this->upload->do_upload('file_pdf');
		$fileinfo = $this->upload->data();

		if (
			$nama == '' || $email == '' || $notelp == '' || $alamat == '' || $jenis_kelamin == '' || $tempat_lahir == ''
			|| $tanggal_lahir == '' || empty($file_pdf) || $posisi_kerja == ''
		) {
			$message = '<div class="alert alert-info">';
			if ($nama == '') $message .= 'Form Nama lengkap harus di isi. <br>';
			if ($email == '') $message .= 'Form Email harus di isi. <br>';
			if ($notelp == '') $message .= 'Form No Telepon harus di isi. <br>';
			if ($alamat == '') $message .= 'Form Alamat harus di isi. <br>';
			if ($jenis_kelamin == '') $message .= 'Form Jenis kelamin harus di isi. <br>';
			if ($tempat_lahir == '') $message .= 'Form Tempat lahir harus di isi. <br>';
			if ($tanggal_lahir == '') $message .= 'Form Tanggal lahir harus di isi. <br>';
			if (empty($file_pdf)) $message .= 'Form CV harus di isi. <br>';
			if ($posisi_kerja == '') $message .= 'Form Posisi yang akan di pilih harus di isi. <br>';
			$message .= '</div>';
			$respon = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);
			exit;
		}

		// validasi captcha //
		$secret_key = "6Lfz1LcUAAAAAOAryxtOfo51X4-LlXjjjeAkVDpq";
		$res_captcha = $_POST['g-recaptcha-response'];
		$url    	= 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $res_captcha;
		$rest_api 	= $this->validasi_captcha($url);
		$rest_api   = json_decode($rest_api);
		$success    = isset($rest_api->success) ? $rest_api->success : '';
		if ($success != TRUE) {
			$respon  = array('status' => FALSE, 'message' => '<div class="alert alert-info">Please Check The Captcha</div>');
			echo json_encode($respon);
			exit;
		}

		$data = array(
			'nama'   => $nama,
			'email'  => $email,
			'notelp' => $notelp,
			'alamat' => $alamat,
			'jenis_kelamin' => $jenis_kelamin,
			'tempat_lahir'  => $tempat_lahir,
			'tanggal_lahir' => $this->Main_model->convert_tanggal($tanggal_lahir),
			'id_posisi'     => $posisi_kerja
		);

		if (!empty($file_pdf)) {
			$data['host'] = base_url() . '/assets/cv/';
			$data['pdf_name'] = $fileinfo['file_name'];
		}

		$posisi = $this->Main_model->view_by_id('tb_lowongan_kerja', ['id' => $posisi_kerja], 'row');
		$job_position = $posisi->posisi_pekerjaan;


		$simpan = $this->Main_model->process_data('tb_pendaftar', $data);
		if ($simpan) {
			$respon = array('status' => TRUE, 'message' => '<div class="alert alert-info">Data anda berhasil terkirim.</div>');

			$pdf_url = $data['host'] . $data['pdf_name'];
			$subject = '[Lamaran - ' . $job_position . '] ' . $nama;

			$message = "Kepada Yth.
			<br>Bapak/Ibu HRD Interflow Property
			<br>JL. Lamper Tengah No.C-12A
			<br>Semarang
		
			<br><br>Dengan Hormat,
			<br>Berdasarkan informasi lowongan kerja yang saya baca di situs <a href='" . base_url() . "' target='_blank'>Interflow</a>, 
			<br>Interflow Property sedang membutuhkan " . $job_position . ",<br>maka dengan ini saya: 	
				<br><br>
				<table border='0'>
					<tr>
						<td> Nama lengkap </td>
						<td> : </td>
						<td>" . $nama . "</td>
					</tr>
					<tr>
						<td> No. Telp/HP </td>
						<td> : </td>
						<td>" . $notelp . "</td>
					</tr>
					<tr>
						<td> Email </td>
						<td> : </td>
						<td>" . $email . "</td>
					</tr>
					<tr>
						<td> Alamat </td>
						<td> : </td>
						<td>" . $alamat . "</td>
					</tr>
					<tr>
						<td> Link CV </td>
						<td> : </td>
						<td> <a href='" . $pdf_url . "' target='_blank'> Klik Disini </a> </td>
					</tr>
				</table> 

				<br>Mengajukan lamaran pekerjaan sebagai " . $job_position . " di Interflow Property, dan bersama ini saya lampirkan file CV.
				<br>Atas perhatiannya, saya ucapkan terima kasih. 
				<br><br>Hormat saya,
				<br><br>" . $nama;

			$to = 'interflow.property@gmail.com';
			// $to = 'kristian_adhi96@yahoo.co.id'; // tian.z@hotmail.co.id kristian.kurniawan@gmedia.co.id

			$cc = '';
			$from = $email;
			$sender_name = $nama;

			$this->Model_user->kirim_email($to, $cc, $message, $subject, $from, $sender_name, $pdf_url);

			echo json_encode($respon);
			exit;
		} else {
			$respon = array('status' => FALSE, 'message' => '<div class="alert alert-danger">Maaf, terjadi kesalahan sistem.</div>');
			echo json_encode($respon);
			exit;
		}
	}
	// ---------- End Karir ---------- //



	// ---------- Login ----------------//

	public function user_login()

	{

		$username = $this->input->post('username');

		$password = $this->input->post('password');



		$result = $this->Main_model->cek($username, $password);

		if ($result->num_rows() == 1) :



			foreach ($result->result() as $data)

				$sess_array = array(

					'id'        => $data->id,

					'nama'        => $data->first_name,

					'username' => $data->username,

					'email'        => $data->email,

					'premi' => 1

				);

			/*$user = $this -> users -> get($login);*/

			$this->session->set_userdata('user_id_lgn', $sess_array);

			/*redirect(site_url('home'));*/

			echo 1;

		else :

			echo 0;

		endif;
	}



	function login_auth()

	{

		if ($this->session->userdata('user_id_lgn')) {

			$session_data = $this->session->userdata('user_id_lgn');

			$data['id'] = $session_data['id'];

			$data['username'] = $session_data['username'];

			$data['nama'] = $session_data['nama'];

			$data['email'] = $session_data['email'];

			$data['premi'] = $session_data['premi'];

			$this->session->set_userdata($data);

			redirect('Main/premium_properti', 'refresh');
		} else {

			//If no session, redirect to login page

			redirect('Main', 'refresh');
		}
	}



	function logout()
	{
		//remove all session data
		$session_data = $this->session->userdata('user_id_lgn');

		// $this->session->unset_userdata($session_data);
		$this->session->sess_destroy($session_data);

		redirect(base_url('Main'), 'refresh');
	}

	// ---------- End Login ------------//



	function ajax_subscribe_email()
	{
		$this->Main_model->ajax_function();

		$email = $this->input->post('email_subs');
		$data_h = ['email' => $email];
		$valid_mail = filter_var($email, FILTER_VALIDATE_EMAIL);

		if ($email == "" || $valid_mail == FALSE) {
			$message = "";

			if ($email == "") $message .= "Email harus diisi <br>";
			if ($email != "" && $valid_mail == FALSE) $message .= "Format email salah. Mohon periksa kembali alamat email Anda. <br>";

			$respon = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);
			exit;
		}

		if (!empty($email)) {
			$save_h = $this->Main_model->proses_data('ms_email_subscriber', $data_h);
			$save_h = 1;
		} else {
			$save_h = 0;
		}


		if ($save_h > 0) {
			$respon = array('status' => TRUE, 'message' => 'Subscribe berhasil.<br> Nantikan update terbaru dari kami.');
		} else {
			$respon = array('status' => FALSE, 'message' => 'Terjadi error saat menyimpan data');
		}

		echo json_encode($respon);
	}


	function unsubscribe_email($id = "")
	{
		$status = ['status' => 0];
		$this->Main_model->proses_data('ms_email_subscriber', $status, array('id' => $id));
		echo "Anda berhasil Unsubscribe email Interflow.";
	}
}
