<?php



class Model_user extends CI_Model

{

    function kirim_email($to = '', $cc = '', $message = '', $subject = '', $from = '', $sender_name = '', $attach = '', $flag = 0) {
        $this->load->library('email');
        $bcc_mail = array(); // 'tian.z@hotmail.co.id', 'irfan.mahendra@gmedia.co.id'
        
        // setiap inputan yg mengarah ke email consultant/agent,hrs cc ke email pusat : interflow.property@gmail.com
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'interflow.co.id',
            'smtp_port' => '25',
            'smtp_user' => 'contact@interflow.co.id', // change it to yours
            'smtp_pass' => 'h3HnPnoBBQMC', // change it to yours
            'smtp_timeout' => '7',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => true
        );
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($from, $sender_name); // change it to yours
            $this->email->bcc($bcc_mail);
        if (! empty($cc)) {
            $this->email->cc($cc);
        }
            $this->email->to($to);// change it to yours
            $this->email->subject($subject);
            $this->email->message($message);
        if ($attach != '') {
            if ($flag > 0) {
                foreach ($attach as $row) {
                    $this->email->attach($row);
                }
            } else {
                $this->email->attach($attach);
            }
        }

        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
            return false;
        }
            
            // return $this->email->print_debugger();
    }

    function get_agent_email($id = '') {
        $sql = "SELECT email 
                FROM manage_user
                WHERE tipe = '3' AND id = '$id'";
                
        $data = $this->db->query($sql);
        return $data;
    }

    function get_all_agent_email() {
        $sql = "SELECT email 
                FROM manage_user
                WHERE tipe = '3'";
                
        $data = $this->db->query($sql);
        return $data;
    }

    function get_dummy_email() {
        $sql = "SELECT email 
                FROM  z_dummy_mail
                WHERE `status` = '1'";
                
        $data = $this->db->query($sql);
        return $data;
    }


   

    function insert_dataapp($data = "")

    {

        $this->db->insert('tb_user_app', $data);

    }



    function insert_datacab($data = "")

    {

        $this->db->insert('tb_user_cabang', $data);

    }



    function update_datacab($data = "", $id = "")

    {

        $this->db->where('usr_id', $id);

        $this->db->delete('tb_user_cabang');

        $this->db->update('tb_user_cabang', $data);

    }



    function update_dataapp($data = "", $id = "")

    {

        $this->db->where('usr_id', $id);

        $this->db->update('tb_user_app', $data);

    }



    function delete_data1($kode = "")

    {

        $this->db->where('usr_id', $kode);

        $this->db->delete('tb_user_cabang');

    }



    function delete_data2($kode = "")

    {

        $this->db->where('usr_id', $kode);

        $this->db->delete('tb_user_app');

    }





    function tampilcab_by_id($kode = "")

    {

        $this->db->select('*');

        $this->db->where('usr_id', $kode);

        $this->db->from('tb_user_cabang');



        return $this->db->get();

    }



    function tampilapp_by_id($kode = "")

    {

        $this->db->select('*');

        $this->db->join('tb_user_app', 'tb_user_app.usr_id=users.usr_id');

        $this->db->from('users');

        $this->db->where('tb_user_app.usr_id', $kode);



        return $this->db->get();

    }



    function get_user()

    {

        $this->db->select('users.nama,users.usr_name,tb_user_app.usr_id');

        $this->db->join('tb_user_app', 'tb_user_app.usr_id=users.usr_id');

        $this->db->from('users');

        $this->db->distinct('tb_user_app.usr_id');



        return $this->db->get();

    }

    function get_app($id = "")

    {

        $this->db->select('*');

        $this->db->where('usr_id', $id);

        $this->db->from('tb_user_app');



        return $this->db->get();

    }



    function get_cab($id = "")

    {

        $this->db->select('*');

        $this->db->where('usr_id', $id);

        $this->db->from('tb_user_cabang');



        return $this->db->get();

    }



    function get_users()

    {

        $this->db->select('*');

        $this->db->from('users');

        $this->db->order_by("usr_name", "asc");



        return $this->db->get();

    }



    function get_users1($kode)

    {

        $this->db->select('*');

        $this->db->like('usr_name', $kode);

        $this->db->from('users');

        $this->db->LiMIT(5);

        $this->db->order_by("usr_name", "asc");



        return $this->db->get();

    }



    function get_cabang()

    {

        $this->db->select('*');

        $this->db->from('ms_kota');



        return $this->db->get();

    }



    function get_cabang1($kode)

    {

        $this->db->select('*');

        $this->db->like('kota', $kode);

        $this->db->from('ms_kota');



        return $this->db->get();

    }



    function get_app2()

    {

        $this->db->select('*');

        $this->db->from('master');



        return $this->db->get();

    }



    function get_app1($kode)

    {

        $this->db->select('*');

        $this->db->like('nama_app', $kode);

        $this->db->from('master');



        return $this->db->get();

    }

    
    
    function kirim_email_broadcast($to = '', $cc = '', $message = '', $subject = '', $from = '', $sender_name = '', $bcc_mail = '',$attach = '', $flag = 0) {
        $this->load->library('email');
        // $bcc_mail = array(); // 'tian.z@hotmail.co.id', 'irfan.mahendra@gmedia.co.id'
        
        // setiap inputan yg mengarah ke email consultant/agent,hrs cc ke email pusat : interflow.property@gmail.com
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'interflow.co.id',
            'smtp_port' => '25',
            'smtp_user' => 'contact@interflow.co.id', // change it to yours
            'smtp_pass' => 'h3HnPnoBBQMC', // change it to yours
            'smtp_timeout' => '7',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => true
        ); // subscribers@interflow.co.id  Hwp-AoeCM}Ro
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($from, $sender_name); // change it to yours
            $this->email->bcc($bcc_mail);
        if (! empty($cc)) {
            $this->email->cc($cc);
        }
            $this->email->to($to);// change it to yours
            $this->email->subject($subject);
            $this->email->message($message);
        if ($attach != '') {
            if ($flag > 0) {
                foreach ($attach as $row) {
                    $this->email->attach($row);
                }
            } else {
                $this->email->attach($attach);
            }
        }

        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
            return false;
        }
            
            // return $this->email->print_debugger();
    }

}

