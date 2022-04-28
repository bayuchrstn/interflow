<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('Model_manajemen_admin', 'model_admin');
		$this->load->model('Dashboard_model', '', true);
		
		if (!$this->session->userdata('username')) {
			redirect('Login');
		}
	}
	public function index()
	{
		$data['title'] = 'Interflow | Dashboard';
		$data['judul'] = 'Dashboard';
		
		$level = $this->session->userdata('level');
		$js_super_admin = '<script src="'.base_url('assets/js/dashboard/dashboard_super_admin.js?_='.rand()).'"></script>';
		$js_admin_cabang = '<script src="'.base_url('assets/js/dashboard/dashboard_admin_cabang.js?_='.rand()).'"></script>';
		$js_agent = '<script src="'.base_url('assets/js/dashboard/dashboard_agent.js?_='.rand()).'"></script>';

		switch ($level) {
			case 1:
				$footer['js'] = $js_super_admin;
				break;
			case 2:
				$footer['js'] = $js_admin_cabang;
				break;
			case 3:
				$footer['js'] = $js_agent;
				break;
			default:
				$footer['js'] = '';
				break;
		}
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/body', $data);
		$this->load->view('admin/footer', $footer);
	}

	function stats_properti_aktif() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_properti_aktif()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_properti_on_progress() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_properti_on_progress()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_agent() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_agent()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_approval() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_approval()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_premium_investor() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_premium_investor()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_cabang() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_cabang()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_properti_new() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_properti_new()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_properti_due_date() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_properti_due_date()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_jatuhtempo() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_jatuhtempo()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function stats_visitor() {
		$is_ajax = $this->input->is_ajax_request();
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_visitor()->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}
	
	function stats_properti_agent() {
		$is_ajax = $this->input->is_ajax_request();
		$id = $this->session->userdata('id');
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_properti_agent($id)->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}
	function stats_not_approval() {
		$is_ajax = $this->input->is_ajax_request();
		$id = $this->session->userdata('id');
        
        if ($is_ajax) {
			$data = $this->Dashboard_model->get_not_approval($id)->row();
			echo json_encode($data);
		} else {
			show_404();
		}

	}

	function logout()
	{
		//remove all session data
		$session_data = $this->session->userdata('user_id');
		// $this->session->unset_userdata($session_data);
		$this->session->sess_destroy();
		redirect(base_url('Login'), 'refresh');
	}


	function visitor(){
		
		$data['title'] = 'Interflow | Visitor';
        $data['judul'] = 'Visitor Statistic';
		$data['form_action'] = base_url().'dashboard/visitor';
		$page='';
		$dari = date('Y-m-d', strtotime(date('Y-m-d').' -7 day'));
		$sampai = date('Y-m-d');
		
		if(!empty($_POST['sampai'])){
			$sampai = $_POST['sampai'];
		}
		if(!empty($_POST['dari'])){
			$dari = $_POST['dari'];
		}
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$dates = array($dari);
		while(end($dates) < $sampai){
			$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
		}
		$arr = '[';
		for($r=0;$r<sizeof($dates);$r++){
			$q = '';
			$q .= ' WHERE tanggal="'.$dates[$r].'"';
			
			$get = $this->Dashboard_model->get_from_query('select count(id) as jml from tb_visitor '.$q)->row();
			// print_r($get);
			if(!empty($get)){
				$arr .= "['".$dates[$r]."',".$get->jml."]";				
			}else{
				$arr .= "['".$dates[$r]."',0]";			
			}
			if($sampai!=$dates[$r]){
				$arr .= ',';
			}
		}
		$arr .= ']';
		$data['json'] = $arr;
		// echo $data['json'];exit;
		$this->load->view('admin/header', $data);
        $this->load->view('admin/content/visitor');
		$this->load->view('admin/footer');
		$this->load->view('admin/content/visitor_js');
	}

}
