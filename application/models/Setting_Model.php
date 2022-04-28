<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_Model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

    function check_old_pass($id = '', $password = '') {
        $sql = "SELECT * FROM manage_user WHERE id = '$id' AND `password` = '".md5($password)."' ";
        $data = $this->db->query($sql)->row();
        return $data;
    }

}



?>