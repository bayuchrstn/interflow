<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
  }
    
  function get_properti_aktif() {    
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti 
            WHERE `status` = 1";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_properti_on_progress() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti 
            WHERE `status` = 0";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_agent() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_user 
            WHERE tipe = 3 AND `status` = 1";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_approval() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti
            WHERE `status` = 0";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_premium_investor() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_user 
            WHERE tipe = 4 AND `status` = 1";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_cabang() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM ms_cabang 
            WHERE `status` = 1";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_properti_new() {    
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti 
            WHERE DATE_FORMAT(`insert_at`, '%Y-%m-%d') = CURDATE()";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_properti_due_date() {    
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti 
            WHERE due_date >= CURDATE() AND
              CURDATE() BETWEEN DATE_SUB(due_date, INTERVAL 6 DAY) AND due_date";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_jatuhtempo() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti
            WHERE id_status_property = 4 AND `status` = 1";

    $data = $this->db->query($sql);
    return $data;
  }
  
  function get_visitor() {
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM tb_visitor
            WHERE tanggal = CURDATE()";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_properti_agent($id) {    
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti 
            WHERE id_agent='$id'";

    $data = $this->db->query($sql);
    return $data;
  }
  function get_not_approval($id) {    
    $sql = "SELECT COUNT(*) AS jumlah 
            FROM manage_properti 
            WHERE `status` = 0 AND id_agent='$id'";

    $data = $this->db->query($sql);
    return $data;
  }

  function get_from_query($sql) {    
    
    $data = $this->db->query($sql);
    return $data;
    
  }

}


?>