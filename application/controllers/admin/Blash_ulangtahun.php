<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Blash_ulangtahun extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Blash_Model');
        }
    
        public function index()
        {
            $day = date('d');
            $month = date('m');
            $title = "Interflow";
            $from = "noreply@interflow.co.id";
            
            $test = $this->Blash_Model->get_email($day, $month)->result();
            // print_r($test);
            // exit();

            // $getall = $this->Blash_Model->get_all()->result_array();
            // print_r($getall);
            // exit();
             // $to = implode(', ', array_map(function ($entry) {
                 // return $entry['email'];
               // }, $getall));
             // echo implode(', ', array_map(function ($entry) {
            //    return $entry['email'];
            //  }, $getall));
            //  exit();
            foreach( $test as $val){
                $to = $val->email;
				$subject = "Selamat Ulang Tahun, $val->fullname";
				$email = "Dear $val->fullname,
                      Kami segenap karyawan Interflow mengucapkan Selamat Ulang Tahun, semoga dengan bertambahnya usia anda bertambah pula semangat serta kinerjanya dalam memajukan perusahaan ini di masa sekarang dan masa mendatang dan semoga anda selalu dalam keadaan sehat serta panjang umur.";

				$this->Blash_Model->kirim_email($title, $from, $to, $subject, $email);
            
            }
        }
    
    }
    
    /* End of file Blash_ulangtahun.php */
    
?>