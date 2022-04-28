<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    function view_cabang() {
        $data = $this->db->query("SELECT * FROM ms_cabang WHERE `status` = 1");
        return $data;
    }

    function view_feature() {
        $data = $this->db->query("SELECT * FROM ms_feature WHERE `status` = 1");
        return $data;
    }

    function view_fasilitas() {
        $data = $this->db->query("SELECT * FROM ms_fasilitas WHERE `status` = 1");
        return $data;
    }

    function view_satuan() {
        $data = $this->db->query("SELECT * FROM ms_satuan WHERE `status` = 1");
        return $data;
    }

    function view_category() {
        $data = $this->db->query("SELECT * FROM ms_category WHERE `status` = 1");
        return $data;
    }

    function view_status_properti() {
        $data = $this->db->query("SELECT * FROM ms_status_property WHERE `status` = 1");
        return $data;
    }

    function view_periode_sewa() {
        $data = $this->db->query("SELECT * FROM ms_periode_sewa WHERE `status` = 1");
        return $data;
    }

    function view_album() {
        $data = $this->db->query("SELECT * FROM ms_album WHERE `status` = 1");
        return $data;
    }

    function view_email_subscriber() {
        $data = $this->db->query("SELECT * FROM ms_email_subscriber WHERE `status` = 1");
        return $data;
    }


}



?>