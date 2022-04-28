<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Blash_Model extends CI_Model {

        function get_email($day, $month){
            $this->db->select('*');
            $this->db->from('manage_user');
            $this->db->where("DAY(tgl_lahir)='$day' AND MONTH(tgl_lahir)='$month' AND status=1");
            return $this->db->get();
        }

        function get_all(){
            $this->db->select('email');
            $this->db->from('manage_user');
            $this->db->where('status = 1');
            return $this->db->get();
        }

        function kirim_email($title, $from, $to,  $subject, $email, $cc = '', $attch = '', $flag = 0, $bcc = ''){    

            $this->load->library('email');
      
            $config['mailtype'] = 'html';
      
            $config['charset'] = 'iso-8859-1';
      
            
      
            $this->email->initialize($config);
      
      
      
            $this->email->from($from, $title);
      
            
      
            $this->email->to($to);
      
            if($cc != '' || $bcc != ''){
      
              $this->email->cc($cc);
      
              $this->email->bcc($bcc);
      
            }
      
            $this->email->subject($subject);
      
            $this->email->message($email);	
      
            if($attch != ''){
      
                if($flag > 0){
      
                    foreach ($attch as $row){
      
                          $this->email->attach($row);
      
                    }
      
                } else{
      
                  $this->email->attach($attch);
      
                }
      
            }
      
            $this->email->send(FALSE);
            // echo "aaaaaa";
            $this->email->print_debugger(array('headers'));
           $debug = $this->email->print_debugger();
        //    print_r($debug);
        //     exit();
            
      
            return TRUE; 
      
        }
      
        
    
    }
    
    /* End of file Blash_Model.php */
    
?>