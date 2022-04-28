<?php

class Model_manage_user extends CI_Model
{

    function get_data_super_admin()
    {
        $column_order = array(null, 'a.fullname', 'a.username', 'a.email', 'a.alamat', 'a.phone', 'b.nama', null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.fullname'; // a.first_name
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        $this->db->select("SQL_CALC_FOUND_ROWS *,a.id AS id_user, a.fullname AS nama_user, b.nama", false); // CONCAT(a.first_name,' ',a.last_name)
        $this->db->from('manage_user a');
        $this->db->join('ms_cabang b', "a.`cabang`=b.`id`", "left");
        $this->db->group_start();
        /* $this->db->like('a.`first_name`', $_POST['search']['value']);
        $this->db->or_like('a.`last_name`', $_POST['search']['value']); */
        $this->db->like('a.`fullname`', $_POST['search']['value']);
        $this->db->or_like('a.`username`', $_POST['search']['value']);
        $this->db->or_like('a.`email`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('a.`phone`', $_POST['search']['value']);
        $this->db->or_like('b.`nama`', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("a.`tipe`='1' AND a.`status`=1");
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor


        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $opsi = '<a href="javascript:;" title="Edit" onClick="get_id(\'' . $r['id_user'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>  <a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_user'] . '\')"><i class="icon-trash text-danger"></i></a>';


                $row  = array(
                    $no . '.',
                    $r['nama_user'],
                    $r['username'],
                    $r['email'],
                    $r['alamat'],
                    $r['phone'],
                    $r['nama'],
                    $opsi
                );


                $data[] = $row;
            }
        }
        $q->free_result();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $n,
            "recordsFiltered" => $n,
            "data" => $data,
        );
        echo json_encode($output);
    }



    function get_data_admin_cabang()
    {
        $column_order = array(null, 'a.fullname', 'a.username', 'a.email', 'a.alamat', 'a.phone', 'b.nama', null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.fullname'; // a.first_name
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        $this->db->select("SQL_CALC_FOUND_ROWS *,a.id AS id_user, a.fullname AS nama_user, b.nama", false); // CONCAT(a.first_name,' ',a.last_name)
        $this->db->from('manage_user a');
        $this->db->join('ms_cabang b', "a.`cabang`=b.`id`", "left");
        $this->db->group_start();
        /* $this->db->like('a.`first_name`', $_POST['search']['value']);
        $this->db->or_like('a.`last_name`', $_POST['search']['value']); */
        $this->db->like('a.`fullname`', $_POST['search']['value']);
        $this->db->or_like('a.`username`', $_POST['search']['value']);
        $this->db->or_like('a.`email`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('a.`phone`', $_POST['search']['value']);
        $this->db->or_like('b.`nama`', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("a.`tipe`='2' AND a.`status`=1");
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor


        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $opsi = '<a href="javascript:;" title="Edit" onClick="get_id(\'' . $r['id_user'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>  <a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_user'] . '\')"><i class="icon-trash text-danger"></i></a>';

                if ($level == 1) {
                    $reset_pass = '<a title="Reset Password" style="min-width: 40px;" href="javascript:;" onclick="reset_pass(\'' . $r['id_user'] . '\')"> <i class="icon-lock2"></i> </a>';
                } else {
                    $reset_pass = '';
                }




                $row  = array(
                    $no . '.',
                    $r['nama_user'],
                    $r['username'],
                    $r['email'],
                    $r['alamat'],
                    $r['phone'],
                    $r['nama'],
                    $opsi . '&nbsp;&nbsp;' . $reset_pass
                );


                $data[] = $row;
            }
        }
        $q->free_result();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $n,
            "recordsFiltered" => $n,
            "data" => $data,
        );
        echo json_encode($output);
    }



    function get_data_premium_investor()
    {
        $column_order = array(null, 'a.fullname', 'a.username', 'a.email', 'a.alamat', 'a.phone', 'b.nama', null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.fullname'; // a.first_name
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        $this->db->select("SQL_CALC_FOUND_ROWS *,a.id AS id_user, a.fullname AS nama_user, b.nama", false); // CONCAT(a.first_name,' ',a.last_name)
        $this->db->from('manage_user a');
        $this->db->join('ms_cabang b', "a.`cabang`=b.`id`", "left");
        $this->db->group_start();
        /* $this->db->like('a.`first_name`', $_POST['search']['value']);
        $this->db->or_like('a.`last_name`', $_POST['search']['value']); */
        $this->db->like('a.`fullname`', $_POST['search']['value']);
        $this->db->or_like('a.`username`', $_POST['search']['value']);
        $this->db->or_like('a.`email`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('a.`phone`', $_POST['search']['value']);
        $this->db->or_like('b.`nama`', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("a.`tipe`='4' AND a.`status`=1");
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor


        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $opsi = '<a href="javascript:;" title="Edit" onClick="get_id(\'' . $r['id_user'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>  <a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_user'] . '\')"><i class="icon-trash text-danger"></i></a>';

                if ($level == 2) {
                    $reset_pass = '<a title="Reset Password" style="min-width: 40px;" href="javascript:;" onclick="reset_pass(\'' . $r['id_user'] . '\')"> <i class="icon-lock2"></i> </a>';
                } else {
                    $reset_pass = '';
                }




                $row  = array(
                    $no . '.',
                    $r['nama_user'],
                    $r['username'],
                    $r['email'],
                    $r['alamat'],
                    $r['phone'],
                    $opsi . '&nbsp;&nbsp;' . $reset_pass
                );


                $data[] = $row;
            }
        }
        $q->free_result();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $n,
            "recordsFiltered" => $n,
            "data" => $data,
        );
        echo json_encode($output);
    }



    function get_data_agent()
    {
        $column_order = array(null, 'a.fullname', 'a.nickname', 'c.consultant_id', 'a.username', 'a.email', 'a.phone', 'a.phone2', null, null, 'b.nama', null); // 'a.alamat',
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.fullname'; // a.first_name
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        $this->db->select("SQL_CALC_FOUND_ROWS *,a.id AS id_user, a.fullname AS nama_user, b.nama, c.consultant_id", false); // CONCAT(a.first_name,' ',a.last_name)
        $this->db->from('manage_user a');
        $this->db->join('ms_cabang b', "a.`cabang`=b.`id`", "left");
        $this->db->join('detail_agent c', "a.`id`=c.`id_agent`", "left");
        $this->db->group_start();
        /* $this->db->like('a.`first_name`', $_POST['search']['value']);
        $this->db->or_like('a.`last_name`', $_POST['search']['value']); */
        $this->db->like('a.`fullname`', $_POST['search']['value']);
        $this->db->or_like('a.`nickname`', $_POST['search']['value']);
        $this->db->or_like('a.`username`', $_POST['search']['value']);
        $this->db->or_like('a.`email`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('a.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`phone2`', $_POST['search']['value']);
        $this->db->or_like('b.`nama`', $_POST['search']['value']);
        $this->db->or_like('c.`consultant_id`', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("a.`tipe`='3' AND a.`status`=1");
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4:Premium Investor


        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;
                $opsi = '<a href="javascript:;" title="Edit" onClick="get_id(\'' . $r['id_user'] . '\')"><i class="icon-menu7 position-left text-slate-800"></i></a>  <a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_user'] . '\')"><i class="icon-trash text-danger"></i></a>';

                if ($level == 1 || $level == 2) {
                    $reset_pass = '<a title="Reset Password" style="min-width: 40px;" href="javascript:;" onclick="reset_pass(\'' . $r['id_user'] . '\')"> <i class="icon-lock2"></i> </a>';
                } else {
                    $reset_pass = '';
                }

                if ($level == 1) {
                    $resign_agent = '<a title="Resign" style="min-width: 40px;" href="javascript:;" onclick="resign_agent(\''.$r['id_user']. '\')"> <i class="icon-exit3 text-grey"></i> </a>';
                } else {
                    $resign_agent = '';
                }
                

                if ($r['alamat'] != "") {
                    $alamat = $r['alamat'];
                } else {
                    $alamat = "<center> - </center>";
                }
                
                $consultant_id = (isset($r['consultant_id']) && $r['consultant_id'] != "") ? $r['consultant_id'] : '-';
                $phone_2 = (isset($r['phone2']) && $r['phone2'] != "") ? $r['phone2'] : '-';

                $row  = array(
                    $no . '.',
                    $r['nama_user'],
                    $r['nickname'],
                    $consultant_id,
                    $r['motto'],
                    $r['username'],
                    $r['email'],
                    // $alamat,
                    $r['phone'],
                    $phone_2,
                    '<a href="#picture" data-id="' . $r['host'] . $r['foto'] . '" data-name="' . $r['foto'] . '" 
                        class="openImageDialog thumbnail" data-toggle="modal">
                        <img src="' . $r['host'] . $r['foto'] . '" width="100px">
                    </a>',
                    '<a href="'.base_url('admin/Manage_user/export_agent_form/'.$r['id_user']).'" target="_blank" class="btn btn-sm btn-danger">
                        <span class="icon-file-pdf" style="margin-right:5px;"> </span> PDF 
                    </a>', // style="display:flex;"
                    $r['nama'],
                    $opsi . '&nbsp;&nbsp;' . $reset_pass . '&nbsp;&nbsp;' . $resign_agent
                );


                $data[] = $row;
            }
        }
        $q->free_result();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $n,
            "recordsFiltered" => $n,
            "data" => $data,
        );
        echo json_encode($output);
    }


    function options_cabang()
    {
        $data = $this->db->query("SELECT * FROM ms_cabang WHERE `status` = 1 ")->result();

        $result[0] = 'Pilih Cabang';
        foreach ($data as $row) {
            $result[$row->id] = $row->nama;
        }
        return $result;


        /*  // filtering parameter
        $search = $this->db->escape_str($search);

        // build query for searching
        $condition = '';
        if ($search != '') {
            $condition .= " AND (a.nama LIKE '%$search%') ";
        }

        return $this->db->query("
			SELECT a.*
			FROM `ms_cabang` a 
			WHERE a.status = 1
            $condition")->result(); */
            
    }

    function get_agent_profile($id = '') {
        $sql = "SELECT a.*, a.id AS id_user, a.fullname AS nama_user, tx.fullname AS nama_referensi, 
                    c.id_agent, c.`tgl_permohonan`, c.`jns_identitas`, c.`nmr_identitas`,
                    c.`gender`, c.`kode_area_telp`, c.`telp_rumah`, c.`last_education`,
                    c.`mar_stat`, c.`agama`, c.`no_rek`, c.`no_rek_atasnama`, 
                    c.`kcp`, c.`kelengkapan`, c.`id_ref_agent`, c.`consultant_id` 
                FROM manage_user a 
                    LEFT JOIN ms_cabang b ON a.`cabang` = b.`id`
                    LEFT JOIN detail_agent c ON a.`id` = c.`id_agent` 
                    LEFT JOIN (
                        SELECT ty.`id` AS id_agent, ty.`fullname` 
                        FROM manage_user ty
                        WHERE ty.`tipe` = '3'
                    ) tx ON c.`id_ref_agent` = tx.`id_agent`  
                WHERE a.id = '$id' AND 
                    a.tipe = '3' AND a.`status`='1' ";
    
        $data = $this->db->query($sql);
        return $data;
      }


      function options_referensi_agen() { 
            $data = $this->db->query("SELECT a.* FROM `manage_user` a 
                                        WHERE a.tipe = 3 AND a.`status` = 1")->result();

                                        /* a.fullname IS NOT NULL AND
                                        a.fullname != 'Property Consultant'  */

            $result[0]= 'Pilih Agen';
            foreach ($data as $row) {
                $result[$row->id] = $row->fullname;
            }

            return $result;
      }

        


      
}
