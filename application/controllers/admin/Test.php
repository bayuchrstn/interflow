<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Model_user');
    }
    

    function show_agent_email() {
        $cek = $this->Model_user->get_agent_email(38)->row();

        $email_agent = isset($cek->email) ? $cek->email : '';
        
        echo "<pre>";
            print_r($email_agent); exit;
        echo "</pre>";
    }

    function show_all_agent_email() {
        $email_agent = $this->Model_user->get_all_agent_email()->result();
        $data = array();

        foreach ($email_agent as $row => $val) {
            $data[$row] = $val->email;
        }

        $new_arr = array_chunk($data, 5, TRUE);
        
        // $email_agent = isset($cek->email) ? $cek->email : '';
        
        echo "<pre>";
            print_r($data); exit;
            // print_r($new_arr); exit;
            // print_r($email_agent); exit;
        echo "</pre>";
    }


    function broadcast_mail() {
        $email = $this->Model_user->get_dummy_email()->result();
        $mail_data = array();

        foreach ($email as $row => $val) {
            $mail_data[$row] = $val->email;
        }


        $from = 'noreply@interflow.co.id';
        $to = 'subscribers@interflow.co.id';
        $bcc = $mail_data;
        $cc = '';
        $message = 'Hello World<br>..........';
        $subject = 'Tes Broadcast';
        $sender_name = 'Interflow Property';

        if (!empty($email)) {
            // $this->Model_user->kirim_email($to, $cc, $message, $subject, $from, $sender_name);
            $this->Model_user->kirim_email_broadcast($to, $cc, $message, $subject, $from, $sender_name, $bcc);
        }

    }

    function check_column_name() {
        $q = $this->db->query("SELECT logo, satuan 
                                FROM ms_fasilitas 
                                WHERE `logo` LIKE '%flaticon%' OR 
                                `satuan` LIKE '%flaticon%' ");
        $fields = $q->list_fields();
        // $fields = $q->field_data();

        foreach ($fields as $row) {
            // echo $row->name.'<br>';
            echo $row.'<br>';
        }
    }

    function print_footer_mail() {
        footer_email();
    }


}