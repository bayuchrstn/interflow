<?php 
class my404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('404'); 
        $data['heading'] = "Oops! You're lost"; // View name 
        $data['message'] = "We can not find the page you're looking for.";
        $this->load->view('errors/html/404', $data);//loading in my template 
    } 
    } 
    ?>