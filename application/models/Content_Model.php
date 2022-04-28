<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_Model extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function view_home_slider() {
        $data = $this->db->query("SELECT * FROM tb_home_slider WHERE `status` = 1");
        return $data;
    }

    function view_about_us() {
        $data = $this->db->query("SELECT * FROM tb_about_us WHERE `status` = 1");
        return $data;
    }

	function view_milestones() {
        $data = $this->db->query("SELECT * FROM tb_milestones WHERE `status` = 1");
        return $data;
    }

    function view_contact_us() {
        $data = $this->db->query("SELECT * FROM tb_contact_us WHERE `status` = 1
                                    ORDER BY insert_at DESC");
        return $data;
    }
    
    function view_contact_us_by_agent($id_user = '') {
        $data = $this->db->query("SELECT * FROM tb_contact_us 
                                    WHERE `status` = 1 AND id_agent = '$id_user'
                                    ORDER BY insert_at DESC");
        return $data;
    }
    
    function view_developer() {
        $data = $this->db->query("SELECT * FROM tb_developer WHERE `status` = 1");
        return $data;
    }
	
	function view_whyus() {
        $data = $this->db->query("SELECT * FROM tb_why_us WHERE `status` = 1");
        return $data;
    }

    function view_partner() {
        $data = $this->db->query("SELECT * FROM tb_partner WHERE `status` = 1");
        return $data;
    }

    function view_gallery() {
        $data = $this->db->query("SELECT g.*, a.nama_album 
                                    FROM tb_gallery g
                                    JOIN ms_album a ON g.id_album = a.id
                                    WHERE g.`status` = 1 AND a.`status` = 1");
        return $data;
    }

    function view_news() {
        $data = $this->db->query("SELECT * FROM tb_news WHERE `status` = 1");
        return $data;
    }

    function view_testimoni() {
        $data = $this->db->query("SELECT * FROM tb_testimony WHERE `status` = 1");
        return $data;
    }

    function view_footer() {
        $data = $this->db->query("SELECT * FROM tb_footer WHERE `status` = 1");
        return $data;
    }

    function view_faq() {
        $data = $this->db->query("SELECT * FROM tb_faq WHERE `status` = 1");
        return $data;
    }

    // function view_loan_service() {
    //     $data = $this->db->query("SELECT * FROM tb_service_loan WHERE `status` = 1");
    //     return $data;
    // }

    function view_loan_service() {
        $data = $this->db->query("SELECT * FROM tb_data_loan_service WHERE `status` = 1");
        return $data;
    }

    function view_image_loan() {
        $data = $this->db->query("SELECT * FROM tb_image_loan WHERE `status` = 1");
        return $data;
    }

    function options_album() {
        $data = $this->db->query("SELECT * FROM ms_album WHERE `status` = 1")->result();

        $result[0] = 'Pilih Album';
        foreach ($data as $row) {
            $result[$row->id] = $row->nama_album;
        }
        return $result;
    }

    /* function view_service() {
        $data = $this->db->query("SELECT * FROM ......... WHERE `status` = 1");
        return $data;
    }
 */
    function view_founder() {
        $data = $this->db->query("SELECT * FROM tb_image_founder WHERE `status` = 1");
        return $data;
    }

    function view_home_video() {
        $data = $this->db->query("SELECT *, file_url AS video_url FROM tb_home_video");
        return $data;
    }
    

}


?>