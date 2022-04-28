<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Career_Model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

    function view_lowongan_kerja() {
        $data = $this->db->query("SELECT * FROM tb_lowongan_kerja WHERE `status` = 1");
        return $data;
    }

    function view_pelamar() {
        $sql = "SELECT p.*, l.`posisi_pekerjaan`, CONCAT(p.`host`,p.`pdf_name`) AS pdf_url 
                FROM tb_pendaftar p 
                    INNER JOIN tb_lowongan_kerja l ON p.`id_posisi` = l.`id`                
                WHERE p.`status` = 1";

        $data = $this->db->query($sql);
        return $data;
    }

    function view_imagecr() {
        $data = $this->db->query("SELECT * FROM tb_image_karir WHERE `status` = 1");
        return $data;
        }

}