<?php

class Model_manage_properti extends CI_Model
{

    function get_data_bangunan($condition = '')
    {
        $column_order = array(null, 'a.id', 'a.nama', 'a.alamat', 'e.category', 'f.name_status', 'g.fullname', 'g.phone', 'a.harga_jual', 'a.harga_user', 'a.start_date', 'a.due_date', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $this->db->select("SQL_CALC_FOUND_ROWS *, a.*,c.img_url AS foto,a.id AS id_rumah, c.img_name AS nama_foto, 
                                CASE a.status 
                                    WHEN 0 THEN 'Proses'
                                    WHEN 1 THEN 'Sudah Aktif' 
                                    WHEN 8 THEN 'Ditolak'
                                    WHEN 9 THEN 'Tidak Aktif'
                                END AS status_rumah, 
                                `d`.area_lahan AS desc_area_lahan, `d`.area_bangunan AS desc_area_bangunan, 
                                `d`.legalitas AS desc_legalitas, `d`.fasilitas AS desc_fasilitas,
                                e.category, f.name_status, g.fullname, g.phone AS agent_phone
                        ", false); // Belum Aktivasi
        $this->db->from('manage_properti a');
        $this->db->join('ms_show b', "a.`id`=b.`id_rumah`", "left");
        $this->db->join('ms_photo c', "a.`id`=c.`id_rumah`", "left");
        $this->db->join('tb_deskripsi d', "a.`id`=d.`id_rumah`", "left");
        $this->db->join('ms_category e', "a.`id_category`=e.`id`", "left");
        $this->db->join('ms_status_property f', "a.`id_status_property`=f.`id`", "left");
        $this->db->join('manage_user g', "a.`id_agent`=g.`id`", "left");
        $this->db->group_start();
        $this->db->like('a.`id`', $_POST['search']['value']);
        $this->db->or_like('a.`nama`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('e.`category`', $_POST['search']['value']);
        $this->db->or_like('f.`name_status`', $_POST['search']['value']);
        $this->db->or_like('g.`fullname`', $_POST['search']['value']);
        $this->db->or_like('g.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_jual`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_user`', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`start_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`due_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->group_end();
        if (!empty($condition)) {
            $this->db->where($condition." AND g.status = 1"); // a.`status`!='9' AND b.`status`=1			
        }
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;

                $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

                // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
                switch ($r['status']) {
                    case 0:
                        $status_properti = '<span class="badge badge-primary">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 1:
                        $status_properti = '<span class="badge badge-success">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 8:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        if ($level == 2 || $level == 3) {

                            if ($r['note_approval'] != '') {
                                $status_properti .= '<br> <br> <div class="btn-group">
                                    <a href="#" class="btn bg-indigo-400 dropdown-toggle btn-xs" data-toggle="dropdown" style="padding: .1rem 1rem;">
                                        Alasan
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>' . $r['note_approval'] . '</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        }
                        break;
                    case 9:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        break;
                    default:
                        $status_properti = '';
                        break;
                }



                // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
                if ($level == 1 || $level == 2 || $level == 3) {
                    $btn_edit = '<a class="btn btn-md btn-primary" href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800" style="color:white"> Edit</i></a><br>';
                } else {

                    $btn_edit = '';

                    if ($level == 3 && $r['status'] == 8) {
                        $btn_edit = '<a class="btn btn-md btn-primary" href="javascript:;" style="margin-top:10px" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800" style="color:white" > Edit</i></a><br>';
                    }
                }




                if ($level == 3 || $level == 4) {
                    $btn_delete = '';
                } else {
                    
                    $btn_delete = '';

                    if ($r['status'] == 1) {
                        $btn_delete = '<a class="btn btn-md btn-danger" href="javascript:;" style="margin-top:10px" title="Tidak Aktif" onclick="delete_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2" style="color:white"> Set Non-Aktif </i></a><br>';
                    }

                    if ($r['status'] == 9) {
                        $btn_delete = '<a class="btn btn-md btn-success" href="javascript:;" style="margin-top:10px" title="Aktif" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-check" style="color:white"> Aktifkan </i></a><br>';
                    } 

                }

                $btn_setuju = '';
                $btn_tolak = '';
                if ($level == 1 || $level == 2) { // Approval by Super Admin / Admin Cabang

                    // 0: Proses, 1: Sudah Aktivasi (Setuju), 8: Tolak, 9: Tidak Aktif
                    if ($level == 2) {

                        if ($r['status'] == 0 || $r['status'] == 8) {
                            $id_cabang = $this->session->userdata('id_cabang');
                            if ($r['cabang'] == $id_cabang) {
                                $btn_setuju = '<a class="btn btn-md btn-success" style="margin-top:10px" href="javascript:;" title="Setuju" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-checkmark text-white"> Setuju </i> </a> <br>'; // style="margin-left:10px"
                                $btn_tolak = '<a class="btn btn-md btn-danger" style="margin-top:10px" href="javascript:;" title="Tolak" onclick="reject_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2 text-white"> Tolak </i></a>';
                            }
                        } else {
                            $btn_setuju = '';
                            $btn_tolak = '';
                        }
                    } else {
                        if ($r['status'] == 0 || $r['status'] == 8) {
                            $btn_setuju = '<a class="btn btn-md btn-success" style="margin-top:10px" href="javascript:;" title="Setuju" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-checkmark text-white"> Setuju </i> </a> <br>'; // style="margin-left:10px"
                            $btn_tolak = '<a class="btn btn-md btn-danger" style="margin-top:10px" href="javascript:;" title="Tolak" onclick="reject_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2 text-white"> Tolak </i></a>';
                        } else {
                            $btn_setuju = '';
                            $btn_tolak = '';
                        }
                    }




                    //     if ($r['status'] == 1 && $r['status_transaksi'] == 0) {

                    //         switch ($r['id_status_property']) {
                    //             case 1:
                    //                 $btn_sold = '<a href="javascript:;" title="Sold" onclick="set_property_sold(\'' . $r['id_rumah'] . '\')"><i class="icon-cash3 text-success"></i></a>';
                    //                 $btn_rented = '';
                    //                 break;
                    //             case 2:
                    //                 $btn_rented = '<a href="javascript:;" style="margin-left:10px" title="Rented" onclick="set_property_rented(\'' . $r['id_rumah'] . '\')"><i class="icon-cash3 text-success"></i></a>'; 
                    //                 $btn_sold = '';
                    //                 break;

                    //             default:
                    //                 $btn_sold = '';
                    //                 $btn_rented = '';
                    //                 break;
                    //         }

                    //     } else {
                    //         $btn_sold = '';
                    //         $btn_rented = '';
                    //     }



                    // } else {
                    //     $btn_setuju = '';
                    //     $btn_tolak = '';
                    //     $btn_sold = '';
                    //     $btn_rented = '';
                    // }
                }

                if ($r['status'] == 1) {

                    if ($level == 1 || $level == 2) {

                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        // $btn_set_lokasi = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';
                        // $btn_unset_lokasi = '';


                        // if ($r['recommended'] == '0') {
                        //     $btn_set_recommended = '<a href="javascript:;" title="Set Recommended" onclick="set_recommended(\'' . $r['id_rumah'] . '\')">
                        //                                 <i class="icon-thumbs-up2 text-primary"></i></a>';
                        // } else {
                        //     $btn_unset_recommended = '<a href="javascript:;" title="Unset Recommended" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                        //                                     <i class="icon-thumbs-up2 text-primary"></i></a>';
                        //     $status_properti .= '<br> <span class="badge badge-primary"> Recommended </span>';
                        // }


                        // if ($r['premium'] == '0') {
                        //     $btn_set_premium = '<a href="javascript:;" style="margin-left:10px" title="Set Premium Investor" onclick="set_premium(\'' . $r['id_rumah'] . '\')">
                        //                             <i class="icon-star-full2 text-warning"></i></a>';
                        // } else {
                        //     $btn_unset_premium = '<a href="javascript:;" style="margin-left:10px" title="Unset Premium Investor" onclick="unset_premium(\'' . $r['id_rumah'] . '\')">
                        //                                 <i class="icon-star-full2 text-warning"></i></a>';
                        //     $status_properti .= '<br> <span class="badge badge-warning"> Premium Investor </span>';
                        // }

                        if ($r['star'] == '0') {
                            $btn_set_recommended = '<a class="btn btn-md btn-warning" style="margin-top:10px" href="javascript:;" title="Set Star Property" onclick="set_recommended(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-star-full2" style="color:white">Set Star</i></a><br>';
                        } else {
                            $btn_unset_recommended = '<a class="btn btn-md btn-danger" style="margin-top:10px" href="javascript:;" title="Unset Star PropertyStar Property" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                                                            <i class="icon-star-full2" style="color:white">Unset Star</i></a><br>';
                            $status_properti .= '<br> <span class="badge badge-primary"> Star Property </span>';
                        }


                        if ($r['premium'] == '0') {
                            $btn_set_premium = '<a class="btn btn-md btn-primary" style="margin-top:10px" href="javascript:;"  title="Set Premium Investor" onclick="set_premium(\'' . $r['id_rumah'] . '\')">
                                                    <i class="icon-thumbs-up2" style="color:white"> Set Premium</i></a><br>';
                        } else {
                            $btn_unset_premium = '<a class="btn btn-md btn-danger" style="margin-top:10px" href="javascript:;"  title="Unset Premium Investor" onclick="unset_premium(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-thumbs-up2" style="color:white">Unset Premium</i></a><br>';
                            $status_properti .= '<br> <span class="badge badge-warning"> Premium Investor </span>';
                        }

                        // if ($r['flag'] == '0') {
                        //     $btn_set_lokasi = '<a href="javascript:;" title="Tampilkan Alamat" onclick="set_lokasi(\'' . $r['id_rumah'] . '\')">
                        //                                 <i class="icon-star-full2 text-primary"></i></a>';
                        // } else {
                        //     $btn_unset_lokasi = '<a href="javascript:;" title="Unset Star PropertyStar Property" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                        //                                     <i class="icon-star-full2 text-primary"></i></a>';
                        // }

                    } else {
                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';
                    }
                } else {
                    $btn_set_recommended = '';
                    $btn_set_premium = '';
                    $btn_unset_recommended = '';
                    $btn_unset_premium = '';
                }


                if ($r['status_transaksi'] != 0) {

                    if ($r['status_transaksi'] == 1) {
                        $status_properti .= '<br> <span class="badge badge-danger" style="font-size: 90%;"> Sold </span>';
                    } else if ($r['status_transaksi'] == 2) {
                        $status_properti .= '<br> <span class="badge badge-danger" style="font-size: 90%;"> Rented </span>';
                    } else {
                        $status_properti .= '';
                    }
                }

                $btn_ebrosur = '<br> <a href="' . base_url('admin/Manage_properti/ebrosur_preview/' . $r['id_rumah']) . '" target="_blank" class="btn btn-sm btn-dark">
                                        <span class="icon-newspaper"> </span> E-Brosur 
                                </a>';
                              
                // $options = $btn_edit . $btn_delete . $btn_setuju . '&nbsp;' . $btn_tolak .
                //             $btn_set_recommended . $btn_set_premium . $btn_unset_recommended .
                //              $btn_unset_premium. '&nbsp;' .$btn_sold.$btn_rented.'<br>'.$btn_ebrosur;

                $options = $btn_edit . $btn_delete . $btn_setuju  . $btn_tolak .
                    $btn_set_recommended . $btn_set_premium . $btn_unset_recommended .
                    $btn_unset_premium . '<br>' . $btn_ebrosur;


                $start_date = isset($r['start_date']) ? date('d-m-Y', strtotime($r['start_date'])) : '-';
                $due_date = isset($r['due_date']) ? date('d-m-Y', strtotime($r['due_date'])) : '-';

                $hj = number_format($r['harga_jual'], 0, "", ".");
                if ($r['name_status'] == 'Rent') {
                    $hj = number_format($r['harga_sewa'], 0, "", ".");
                }

                $row  = array(
                    $no . '.',
                    '#' . $r['id'],
                    $r['nama'],
                    $r['alamat'],
                    $r['category'],
                    $r['name_status'],
                    /* $r['luas_bangunan'],
                    $r['luas_tanah'],
                    $r['jml_lantai'],
                    $r['legalitas'], */
                    $r['fullname'],
                    $r['agent_phone'],
                    $hj,
                    number_format($r['harga_user'], 0, "", "."),
                    /* $r['fasilitas'],
                    $r['deskripsi'], */
                    $start_date,
                    $due_date,
                    '<a href="#picture" data-id="' . $r['foto'] . '" data-name="' . $r['nama_foto'] . '" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="' . $r['foto'] . '" width="100px">

                                            </a>',
                    $status_properti,
                    $options
                    /* $btn_edit . '&nbsp;' . $btn_delete . '<br/><br/>' . $btn_setuju . '&nbsp;' . $btn_tolak . '<br/>' .
                        $btn_set_recommended . '&nbsp;' . $btn_set_premium . '<br/>' . $btn_unset_recommended . '&nbsp;' . $btn_unset_premium, */
                    // $opsi
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

    function get_data_jatuhtempo($condition = '')
    {
        $column_order = array(null, 'a.id', 'a.nama', 'a.alamat', 'e.category', 'f.name_status', 'g.fullname', 'g.phone', 'a.harga_jual', 'a.harga_user', 'a.start_date', 'a.due_date', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $this->db->select("SQL_CALC_FOUND_ROWS *, a.*,a.id AS id_rumah, a.day_reminder, a.due_datee, e.category, f.name_status, g.fullname
                        ", false); // Belum Aktivasi
        $this->db->from('(SELECT *,
        (due_sewa - INTERVAL 3 MONTH) AS day_reminder,
        DATEDIFF(due_sewa, CURDATE()) AS due_datee
        FROM manage_properti WHERE STATUS = 1) a');
        $this->db->join('ms_category e', "a.`id_category`=e.`id`", "left");
        $this->db->join('ms_status_property f', "a.`id_status_property`=f.`id`", "left");
        $this->db->join('manage_user g', "a.`id_agent`=g.`id`", "left");
        $this->db->group_start();
        $this->db->like('a.`id`', $_POST['search']['value']);
        $this->db->or_like('a.`nama`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('e.`category`', $_POST['search']['value']);
        $this->db->or_like('f.`name_status`', $_POST['search']['value']);
        $this->db->or_like('g.`fullname`', $_POST['search']['value']);
        $this->db->or_like('g.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_jual`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_user`', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`start_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`due_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("$condition AND a.id_status_property = 4 AND due_datee < 90"); // a.`status`!='9' AND b.`status`=1
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;

                $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor


                $start_date = isset($r['start_sewa']) ? date('d-m-Y', strtotime($r['start_sewa'])) : '-';
                $due_date = isset($r['due_sewa']) ? date('d-m-Y', strtotime($r['due_sewa'])) : '-';

                $row  = array(
                    $no . '.',
                    // '#'.$r['id'],
                    $r['nama'],
                    $r['alamat'],
                    $r['category'],
                    $r['name_status'],
                    /* $r['luas_bangunan'],
                    $r['luas_tanah'],
                    $r['jml_lantai'],
                    $r['legalitas'], */
                    $r['fullname'],
                    // $r['agent_phone'],
                    // number_format($r['harga_jual'], 0, "", "."),
                    // number_format($r['harga_user'], 0, "", "."),
                    /* $r['fasilitas'],
                    $r['deskripsi'], */
                    $start_date,
                    $due_date,
                    // '<a href="#picture" data-id="' . $r['foto'] . '" data-name="' . $r['nama_foto'] . '" 

                    //                                 class="openImageDialog thumbnail" data-toggle="modal">

                    //                                 <img src="' . $r['foto'] . '" width="100px">

                    //                         </a>',
                    // $status_properti,
                    // $options
                    /* $btn_edit . '&nbsp;' . $btn_delete . '<br/><br/>' . $btn_setuju . '&nbsp;' . $btn_tolak . '<br/>' .
                        $btn_set_recommended . '&nbsp;' . $btn_set_premium . '<br/>' . $btn_unset_recommended . '&nbsp;' . $btn_unset_premium, */
                    // $opsi
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

    function get_data_bangunan_by_agent($id_user = '', $condition = '')
    {
        $column_order = array(null, 'a.id', 'a.nama', 'a.alamat', 'e.category', 'f.name_status', 'g.fullname', 'g.phone', 'a.harga_jual', 'a.harga_user', 'a.start_date', 'a.due_date', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $this->db->select("SQL_CALC_FOUND_ROWS *, a.*,c.img_url AS foto,a.id AS id_rumah, c.img_name AS nama_foto, 
                                CASE a.status 
                                    WHEN 0 THEN 'Proses'
                                    WHEN 1 THEN 'Sudah Aktif' 
                                    WHEN 8 THEN 'Ditolak'
                                    WHEN 9 THEN 'Tidak Aktif'
                                END AS status_rumah, 
                                `d`.area_lahan AS desc_area_lahan, `d`.area_bangunan AS desc_area_bangunan, 
                                `d`.legalitas AS desc_legalitas, `d`.fasilitas AS desc_fasilitas,
                                e.category, f.name_status, g.fullname, g.phone AS agent_phone
                        ", false); // Belum Aktivasi
        $this->db->from('manage_properti a');
        $this->db->join('ms_show b', "a.`id`=b.`id_rumah`", "left");
        $this->db->join('ms_photo c', "a.`id`=c.`id_rumah`", "left");
        $this->db->join('tb_deskripsi d', "a.`id`=d.`id_rumah`", "left");
        $this->db->join('ms_category e', "a.`id_category`=e.`id`", "left");
        $this->db->join('ms_status_property f', "a.`id_status_property`=f.`id`", "left");
        $this->db->join('manage_user g', "a.`id_agent`=g.`id`", "left");
        $this->db->group_start();
        $this->db->like('a.`id`', $_POST['search']['value']);
        $this->db->or_like('a.`nama`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('e.`category`', $_POST['search']['value']);
        $this->db->or_like('f.`name_status`', $_POST['search']['value']);
        $this->db->or_like('g.`fullname`', $_POST['search']['value']);
        $this->db->or_like('g.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_jual`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_user`', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`start_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`due_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->group_end();

        $and_condition = (!empty($condition)) ? 'AND' : '';
        $this->db->where("$condition $and_condition a.`id_agent` = '$id_user' "); // a.`status`!='9' AND b.`status`=1
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;

                $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

                // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
                switch ($r['status']) {
                    case 0:
                        $status_properti = '<span class="badge badge-primary">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 1:
                        $status_properti = '<span class="badge badge-success">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 8:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        if ($level == 2 || $level == 3) {

                            if ($r['note_approval'] != '') {
                                $status_properti .= '<br> <br> <div class="btn-group">
                                    <a href="#" class="btn bg-indigo-400 dropdown-toggle btn-xs" data-toggle="dropdown" style="padding: .1rem 1rem;">
                                        Alasan
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>' . $r['note_approval'] . '</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        }
                        break;
                    case 9:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        break;
                    default:
                        $status_properti = '';
                        break;
                }



                // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
                if ($level == 1 || $level == 2 || $level == 3) {
                    $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';

                    if ($level == 4 && $r['status'] == 1) {
                        $btn_edit = '';
                    }

                    if ($level == 4 && $r['status'] == 8) {
                        $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                    }
                } else {

                    $btn_edit = '';

                    if ($level == 4 && $r['status'] == 8) {
                        $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                    }
                }




                if ($level == 3 || $level == 4) {
                    $btn_delete = '';
                } else {
                   
                    $btn_delete = '';
                    
                    if ($r['status'] == 1) {
                        $btn_delete = '<a class="btn btn-md btn-danger" href="javascript:;" style="margin-top:10px" title="Tidak Aktif" onclick="delete_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2" style="color:white"> Set Non-Aktif </i></a><br>';
                    }

                    if ($r['status'] == 9) {
                        $btn_delete = '<a class="btn btn-md btn-success" href="javascript:;" style="margin-top:10px" title="Aktif" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-check" style="color:white"> Aktifkan </i></a><br>';
                    } 

                }


                if ($level == 2 || $level == 1) { // Approval by  Admin Cabang || Owner / Super Admin

                    // 0: Proses, 1: Sudah Aktivasi (Setuju), 8: Tolak, 9: Tidak Aktif

                    if ($r['status'] == 0 || $r['status'] == 8) {
                        $btn_setuju = '<a href="javascript:;" style="margin-left:10px" title="Setuju" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-checkmark text-success"></i></a>';
                        $btn_tolak = '<a href="javascript:;" style="margin-left:10px" title="Tolak" onclick="reject_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2 text-danger"></i></a>';
                    } else {
                        $btn_setuju = '';
                        $btn_tolak = '';
                    }
                } else {
                    $btn_setuju = '';
                    $btn_tolak = '';
                }


                if ($r['status'] == 1) {

                    if ($level == 1 || $level == 2) {

                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';

                        if ($r['recommended'] == '0') {
                            $btn_set_recommended = '<a href="javascript:;" title="Set Recommended" onclick="set_recommended(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-thumbs-up2 text-primary"></i></a>';
                        } else {
                            $btn_unset_recommended = '<a href="javascript:;" title="Unset Recommended" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                                                            <i class="icon-thumbs-up2 text-primary"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-primary"> Recommended </span>';
                        }


                        if ($r['premium'] == '0') {
                            $btn_set_premium = '<a href="javascript:;" title="Set Premium Investor" onclick="set_premium(\'' . $r['id_rumah'] . '\')">
                                                    <i class="icon-star-full2 text-warning"></i></a>';
                        } else {
                            $btn_unset_premium = '<a href="javascript:;" title="Unset Premium Investor" onclick="unset_premium(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-star-full2 text-warning"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-warning"> Premium Investor </span>';
                        }
                    } else {
                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';
                    }
                } else {
                    $btn_set_recommended = '';
                    $btn_set_premium = '';
                    $btn_unset_recommended = '';
                    $btn_unset_premium = '';

                    if ($r['status'] == 0) {

                        if ($level == 3 || $level == 4) {
                            $btn_delete = '<a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_rumah'] . '\')"><i class="icon-trash text-danger"></i></a>';
                        }
                    }
                }

                $btn_ebrosur = '<br> <a href="' . base_url('admin/Manage_properti/ebrosur_preview/' . $r['id_rumah']) . '" target="_blank" class="btn btn-sm btn-dark">
                                        <span class="icon-newspaper"> </span> E-Brosur 
                                </a>';

                $options = $btn_edit . $btn_delete . $btn_setuju . '&nbsp;' . $btn_tolak .
                    $btn_set_recommended . $btn_set_premium . $btn_unset_recommended . $btn_unset_premium . '<br>' . $btn_ebrosur;

                $start_date = isset($r['start_date']) ? date('d-m-Y', strtotime($r['start_date'])) : '-';
                $due_date = isset($r['due_date']) ? date('d-m-Y', strtotime($r['due_date'])) : '-';

                $hj = number_format($r['harga_jual'], 0, "", ".");
                if ($r['name_status'] == 'Rent') {
                    $hj = number_format($r['harga_sewa'], 0, "", ".");
                }

                $row  = array(
                    $no . '.',
                    '#' . $r['id'],
                    $r['nama'],
                    $r['alamat'],
                    $r['category'],
                    $r['name_status'],
                    /* $r['luas_bangunan'],
                    $r['luas_tanah'],
                    $r['jml_lantai'],
                    $r['legalitas'], */
                    $r['fullname'],
                    $r['agent_phone'],
                    // number_format($r['harga_jual'], 0, "", "."),
                    $hj,
                    number_format($r['harga_user'], 0, "", "."),
                    /* $r['fasilitas'],
                    $r['deskripsi'], */
                    $start_date,
                    $due_date,
                    '<a href="#picture" data-id="' . $r['foto'] . '" data-name="' . $r['nama_foto'] . '" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="' . $r['foto'] . '" width="100px">

                                            </a>',
                    $status_properti,
                    $options
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

    function get_data_aprov($condition = '')
    {
        $column_order = array(null, 'a.id', 'a.nama', 'a.alamat', 'e.category', 'f.name_status', 'g.fullname', 'g.phone', 'a.harga_jual', 'a.harga_user', 'a.start_date', 'a.due_date', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $this->db->select("SQL_CALC_FOUND_ROWS *, a.*,c.img_url AS foto,a.id AS id_rumah, c.img_name AS nama_foto, 
                                CASE a.status 
                                    WHEN 0 THEN 'Proses'
                                    WHEN 1 THEN 'Sudah Aktif' 
                                    WHEN 8 THEN 'Ditolak'
                                    WHEN 9 THEN 'Tidak Aktif'
                                END AS status_rumah, 
                                `d`.area_lahan AS desc_area_lahan, `d`.area_bangunan AS desc_area_bangunan, 
                                `d`.legalitas AS desc_legalitas, `d`.fasilitas AS desc_fasilitas,
                                e.category, f.name_status, g.fullname, g.phone AS agent_phone
                        ", false); // Belum Aktivasi
        $this->db->from('manage_properti a');
        $this->db->join('ms_show b', "a.`id`=b.`id_rumah`", "left");
        $this->db->join('ms_photo c', "a.`id`=c.`id_rumah`", "left");
        $this->db->join('tb_deskripsi d', "a.`id`=d.`id_rumah`", "left");
        $this->db->join('ms_category e', "a.`id_category`=e.`id`", "left");
        $this->db->join('ms_status_property f', "a.`id_status_property`=f.`id`", "left");
        $this->db->join('manage_user g', "a.`id_agent`=g.`id`", "left");
        //$this->db->join('ms_cabang h', "g.`cabang`=h.`id`","left");
        $this->db->group_start();
        $this->db->like('a.`id`', $_POST['search']['value']);
        $this->db->or_like('a.`nama`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('e.`category`', $_POST['search']['value']);
        $this->db->or_like('f.`name_status`', $_POST['search']['value']);
        $this->db->or_like('g.`fullname`', $_POST['search']['value']);
        $this->db->or_like('g.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_jual`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_user`', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`start_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`due_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where($condition); // a.`status`!='9' AND b.`status`=1
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;

                $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

                // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
                switch ($r['status']) {
                    case 0:
                        $status_properti = '<span class="badge badge-primary">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 1:
                        $status_properti = '<span class="badge badge-success">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 8:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        if ($level == 2 || $level == 3) {

                            if ($r['note_approval'] != '') {
                                $status_properti .= '<br> <br> <div class="btn-group">
                                    <a href="#" class="btn bg-indigo-400 dropdown-toggle btn-xs" data-toggle="dropdown" style="padding: .1rem 1rem;">
                                        Alasan
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>' . $r['note_approval'] . '</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        }
                        break;
                    case 9:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        break;
                    default:
                        $status_properti = '';
                        break;
                }



                // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
                if ($level == 1 || $level == 2) {
                    $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                } else {

                    $btn_edit = '';

                    if ($level == 3 && $r['status'] == 8) {
                        $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                    }
                }




                if ($level == 3 || $level == 4) {
                    $btn_delete = '';
                } else {
                    $btn_delete = '<a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_rumah'] . '\')"><i class="icon-trash text-danger"></i></a>';
                }



                if ($level == 2 || $level == 1) { // Approval by  Admin Cabang || Owner / Super Admin

                    // 0: Proses, 1: Sudah Aktivasi (Setuju), 8: Tolak, 9: Tidak Aktif

                    if ($r['status'] == 0 || $r['status'] == 8) {
                        $btn_setuju = '<a href="javascript:;" style="margin-left:10px" title="Setuju" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-checkmark text-success"></i></a>';
                        $btn_tolak = '<a href="javascript:;" style="margin-left:10px" title="Tolak" onclick="reject_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2 text-danger"></i></a>';
                    } else {
                        $btn_setuju = '';
                        $btn_tolak = '';
                    }



                    if ($r['status'] == 1 && $r['status_transaksi'] == 0) {

                        switch ($r['id_status_property']) {
                            case 1:
                                $btn_sold = '<a href="javascript:;" title="Sold" onclick="set_property_sold(\'' . $r['id_rumah'] . '\')"><i class="icon-cash3 text-success"></i></a>';
                                $btn_rented = '';
                                break;
                            case 2:
                                $btn_rented = '<a href="javascript:;" style="margin-left:10px" title="Rented" onclick="set_property_rented(\'' . $r['id_rumah'] . '\')"><i class="icon-cash3 text-success"></i></a>';
                                $btn_sold = '';
                                break;

                            default:
                                $btn_sold = '';
                                $btn_rented = '';
                                break;
                        }
                    } else {
                        $btn_sold = '';
                        $btn_rented = '';
                    }
                } else {
                    $btn_setuju = '';
                    $btn_tolak = '';
                    $btn_sold = '';
                    $btn_rented = '';
                }


                if ($r['status'] == 1) {

                    if ($level == 1 || $level == 2) {

                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';

                        if ($r['recommended'] == '0') {
                            $btn_set_recommended = '<a href="javascript:;" title="Set Recommended" onclick="set_recommended(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-thumbs-up2 text-primary"></i></a>';
                        } else {
                            $btn_unset_recommended = '<a href="javascript:;" title="Unset Recommended" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                                                            <i class="icon-thumbs-up2 text-primary"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-primary"> Recommended </span>';
                        }


                        if ($r['premium'] == '0') {
                            $btn_set_premium = '<a href="javascript:;" style="margin-left:10px" title="Set Premium Investor" onclick="set_premium(\'' . $r['id_rumah'] . '\')">
                                                    <i class="icon-star-full2 text-warning"></i></a>';
                        } else {
                            $btn_unset_premium = '<a href="javascript:;" style="margin-left:10px" title="Unset Premium Investor" onclick="unset_premium(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-star-full2 text-warning"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-warning"> Premium Investor </span>';
                        }
                    } else {
                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';
                    }
                } else {
                    $btn_set_recommended = '';
                    $btn_set_premium = '';
                    $btn_unset_recommended = '';
                    $btn_unset_premium = '';
                }


                // if ($r['status_transaksi'] != 0) {

                //     if ($r['status_transaksi'] == 1) {
                //         $status_properti .= '<br> <span class="badge badge-danger" style="font-size: 90%;"> Sold </span>';
                //     } else if ($r['status_transaksi'] == 2) {
                //         $status_properti .= '<br> <span class="badge badge-danger" style="font-size: 90%;"> Rented </span>';
                //     } else {
                //         $status_properti .= '';
                //     }

                // }

                $btn_ebrosur = '<br> <a href="' . base_url('admin/Manage_properti/ebrosur_preview/' . $r['id_rumah']) . '" target="_blank" class="btn btn-sm btn-dark">
                                        <div style="font-size: 18px;"><span class="icon-newspaper"> </span> E-Brosur </div>
                                </a>';

                $options = $btn_edit . $btn_delete . $btn_setuju . '&nbsp;' . $btn_tolak .
                    $btn_set_recommended . $btn_set_premium . $btn_unset_recommended .
                    $btn_unset_premium . '&nbsp;' . $btn_sold . $btn_rented . '<br>' . $btn_ebrosur;

                $start_date = isset($r['start_date']) ? date('d-m-Y', strtotime($r['start_date'])) : '-';
                $due_date = isset($r['due_date']) ? date('d-m-Y', strtotime($r['due_date'])) : '-';

                $row  = array(
                    $no . '.',
                    '#' . $r['id'],
                    $r['nama'],
                    $r['alamat'],
                    $r['category'],
                    $r['name_status'],
                    /* $r['luas_bangunan'],
                    $r['luas_tanah'],
                    $r['jml_lantai'],
                    $r['legalitas'], */
                    $r['fullname'],
                    $r['agent_phone'],
                    number_format($r['harga_jual'], 0, "", "."),
                    number_format($r['harga_user'], 0, "", "."),
                    /* $r['fasilitas'],
                    $r['deskripsi'], */
                    $start_date,
                    $due_date,
                    '<a href="#picture" data-id="' . $r['foto'] . '" data-name="' . $r['nama_foto'] . '" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="' . $r['foto'] . '" width="100px">

                                            </a>',
                    $status_properti,
                    $options
                    /* $btn_edit . '&nbsp;' . $btn_delete . '<br/><br/>' . $btn_setuju . '&nbsp;' . $btn_tolak . '<br/>' .
                        $btn_set_recommended . '&nbsp;' . $btn_set_premium . '<br/>' . $btn_unset_recommended . '&nbsp;' . $btn_unset_premium, */
                    // $opsi
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

    function get_cabang($cabang = '', $condition = '')
    {
        $column_order = array(null, 'a.id', 'a.nama', 'a.alamat', 'e.category', 'f.name_status', 'g.fullname', 'g.phone', 'a.harga_jual', 'a.harga_user', 'a.start_date', 'a.due_date', 'g.cabang', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $this->db->select("SQL_CALC_FOUND_ROWS *, a.*,c.img_url AS foto,a.id AS id_rumah, c.img_name AS nama_foto, 
                                CASE a.status 
                                    WHEN 0 THEN 'Proses'
                                    WHEN 1 THEN 'Sudah Aktif' 
                                    WHEN 8 THEN 'Ditolak'
                                    WHEN 9 THEN 'Tidak Aktif'
                                END AS status_rumah, 
                                `d`.area_lahan AS desc_area_lahan, `d`.area_bangunan AS desc_area_bangunan, 
                                `d`.legalitas AS desc_legalitas, `d`.fasilitas AS desc_fasilitas,
                                e.category, f.name_status, g.fullname, g.phone AS agent_phone, g.cabang
                        ", false); // Belum Aktivasi
        $this->db->from('manage_properti a');
        $this->db->join('ms_show b', "a.`id`=b.`id_rumah`", "left");
        $this->db->join('ms_photo c', "a.`id`=c.`id_rumah`", "left");
        $this->db->join('tb_deskripsi d', "a.`id`=d.`id_rumah`", "left");
        $this->db->join('ms_category e', "a.`id_category`=e.`id`", "left");
        $this->db->join('ms_status_property f', "a.`id_status_property`=f.`id`", "left");
        $this->db->join('manage_user g', "a.`id_agent`=g.`id`", "left");
        $this->db->join('ms_cabang h', "g.`cabang`=h.`id`", "left");
        $this->db->group_start();
        $this->db->like('a.`id`', $_POST['search']['value']);
        $this->db->or_like('a.`nama`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('e.`category`', $_POST['search']['value']);
        $this->db->or_like('f.`name_status`', $_POST['search']['value']);
        $this->db->or_like('g.`fullname`', $_POST['search']['value']);
        $this->db->or_like('g.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_jual`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_user`', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`start_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`due_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("$condition AND g.`cabang` = '$cabang' "); // a.`status`!='9' AND b.`status`=1
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;

                $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

                // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
                switch ($r['status']) {
                    case 0:
                        $status_properti = '<span class="badge badge-primary">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 1:
                        $status_properti = '<span class="badge badge-success">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 8:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        if ($level == 2 || $level == 3) {

                            if ($r['note_approval'] != '') {
                                $status_properti .= '<br> <br> <div class="btn-group">
                                    <a href="#" class="btn bg-indigo-400 dropdown-toggle btn-xs" data-toggle="dropdown" style="padding: .1rem 1rem;">
                                        Alasan
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>' . $r['note_approval'] . '</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        }
                        break;
                    case 9:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        break;
                    default:
                        $status_properti = '';
                        break;
                }



                // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
                if ($level == 1 || $level == 2) {
                    $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                } else {

                    $btn_edit = '';

                    if ($level == 3 && $r['status'] == 8) {
                        $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                    }
                }




                if ($level == 3 || $level == 4) {
                    $btn_delete = '';
                } else {
                    $btn_delete = '<a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_rumah'] . '\')"><i class="icon-trash text-danger"></i></a>';
                }



                if ($level == 2 || $level == 1) { // Approval by  Admin Cabang || Owner / Super Admin

                    // 0: Proses, 1: Sudah Aktivasi (Setuju), 8: Tolak, 9: Tidak Aktif

                    if ($r['status'] == 0 || $r['status'] == 8) {
                        $btn_setuju = '<a href="javascript:;" style="margin-left:10px" title="Setuju" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-checkmark text-success"></i></a>';
                        $btn_tolak = '<a href="javascript:;" style="margin-left:10px" title="Tolak" onclick="reject_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2 text-danger"></i></a>';
                    } else {
                        $btn_setuju = '';
                        $btn_tolak = '';
                    }



                    if ($r['status'] == 1 && $r['status_transaksi'] == 0) {

                        switch ($r['id_status_property']) {
                            case 1:
                                $btn_sold = '<a href="javascript:;" title="Sold" onclick="set_property_sold(\'' . $r['id_rumah'] . '\')"><i class="icon-cash3 text-success"></i></a>';
                                $btn_rented = '';
                                break;
                            case 2:
                                $btn_rented = '<a href="javascript:;" style="margin-left:10px" title="Rented" onclick="set_property_rented(\'' . $r['id_rumah'] . '\')"><i class="icon-cash3 text-success"></i></a>';
                                $btn_sold = '';
                                break;

                            default:
                                $btn_sold = '';
                                $btn_rented = '';
                                break;
                        }
                    } else {
                        $btn_sold = '';
                        $btn_rented = '';
                    }
                } else {
                    $btn_setuju = '';
                    $btn_tolak = '';
                    $btn_sold = '';
                    $btn_rented = '';
                }


                if ($r['status'] == 1) {

                    if ($level == 1 || $level == 2) {

                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';

                        if ($r['recommended'] == '0') {
                            $btn_set_recommended = '<a href="javascript:;" title="Set Recommended" onclick="set_recommended(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-thumbs-up2 text-primary"></i></a>';
                        } else {
                            $btn_unset_recommended = '<a href="javascript:;" title="Unset Recommended" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                                                            <i class="icon-thumbs-up2 text-primary"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-primary"> Recommended </span>';
                        }


                        if ($r['premium'] == '0') {
                            $btn_set_premium = '<a href="javascript:;" style="margin-left:10px" title="Set Premium Investor" onclick="set_premium(\'' . $r['id_rumah'] . '\')">
                                                    <i class="icon-star-full2 text-warning"></i></a>';
                        } else {
                            $btn_unset_premium = '<a href="javascript:;" style="margin-left:10px" title="Unset Premium Investor" onclick="unset_premium(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-star-full2 text-warning"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-warning"> Premium Investor </span>';
                        }
                    } else {
                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';
                    }
                } else {
                    $btn_set_recommended = '';
                    $btn_set_premium = '';
                    $btn_unset_recommended = '';
                    $btn_unset_premium = '';
                }


                // if ($r['status_transaksi'] != 0) {

                //     if ($r['status_transaksi'] == 1) {
                //         $status_properti .= '<br> <span class="badge badge-danger" style="font-size: 90%;"> Sold </span>';
                //     } else if ($r['status_transaksi'] == 2) {
                //         $status_properti .= '<br> <span class="badge badge-danger" style="font-size: 90%;"> Rented </span>';
                //     } else {
                //         $status_properti .= '';
                //     }

                // }

                $btn_ebrosur = '<br> <a href="' . base_url('admin/Manage_properti/ebrosur_preview/' . $r['id_rumah']) . '" target="_blank" class="btn btn-sm btn-dark">
                                        <div style="font-size: 18px;"><span class="icon-newspaper"> </span> E-Brosur </div>
                                </a>';

                $options = $btn_edit . $btn_delete . $btn_setuju . '&nbsp;' . $btn_tolak .
                    $btn_set_recommended . $btn_set_premium . $btn_unset_recommended .
                    $btn_unset_premium . '&nbsp;' . $btn_sold . $btn_rented . '<br>' . $btn_ebrosur;

                $start_date = isset($r['start_date']) ? date('d-m-Y', strtotime($r['start_date'])) : '-';
                $due_date = isset($r['due_date']) ? date('d-m-Y', strtotime($r['due_date'])) : '-';

                $row  = array(
                    $no . '.',
                    '#' . $r['id'],
                    $r['nama'],
                    $r['alamat'],
                    $r['category'],
                    $r['name_status'],
                    /* $r['luas_bangunan'],
                    $r['luas_tanah'],
                    $r['jml_lantai'],
                    $r['legalitas'], */
                    $r['fullname'],
                    $r['agent_phone'],
                    number_format($r['harga_jual'], 0, "", "."),
                    number_format($r['harga_user'], 0, "", "."),
                    /* $r['fasilitas'],
                    $r['deskripsi'], */
                    $start_date,
                    $due_date,
                    '<a href="#picture" data-id="' . $r['foto'] . '" data-name="' . $r['nama_foto'] . '" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="' . $r['foto'] . '" width="100px">

                                            </a>',
                    $status_properti,
                    $options
                    /* $btn_edit . '&nbsp;' . $btn_delete . '<br/><br/>' . $btn_setuju . '&nbsp;' . $btn_tolak . '<br/>' .
                        $btn_set_recommended . '&nbsp;' . $btn_set_premium . '<br/>' . $btn_unset_recommended . '&nbsp;' . $btn_unset_premium, */
                    // $opsi
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

    function get_data_aprov_by_agent($id_user = '', $condition = '')
    {
        $column_order = array(null, 'a.id', 'a.nama', 'a.alamat', 'e.category', 'f.name_status', 'g.fullname', 'g.phone', 'a.harga_jual', 'a.harga_user', 'a.start_date', 'a.due_date', null, null, null);
        $order_name = (isset($_POST['order'])) ? $column_order[$_POST['order']['0']['column']] : 'a.nama';
        $order_dir = (isset($_POST['order'])) ? $_POST['order']['0']['dir'] : 'asc';

        // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
        $this->db->select("SQL_CALC_FOUND_ROWS *, a.*,c.img_url AS foto,a.id AS id_rumah, c.img_name AS nama_foto, 
                                CASE a.status 
                                    WHEN 0 THEN 'Proses'
                                    WHEN 1 THEN 'Sudah Aktif' 
                                    WHEN 8 THEN 'Ditolak'
                                    WHEN 9 THEN 'Tidak Aktif'
                                END AS status_rumah, 
                                `d`.area_lahan AS desc_area_lahan, `d`.area_bangunan AS desc_area_bangunan, 
                                `d`.legalitas AS desc_legalitas, `d`.fasilitas AS desc_fasilitas,
                                e.category, f.name_status, g.fullname, g.phone AS agent_phone
                        ", false); // Belum Aktivasi
        $this->db->from('manage_properti a');
        $this->db->join('ms_show b', "a.`id`=b.`id_rumah`", "left");
        $this->db->join('ms_photo c', "a.`id`=c.`id_rumah`", "left");
        $this->db->join('tb_deskripsi d', "a.`id`=d.`id_rumah`", "left");
        $this->db->join('ms_category e', "a.`id_category`=e.`id`", "left");
        $this->db->join('ms_status_property f', "a.`id_status_property`=f.`id`", "left");
        $this->db->join('manage_user g', "a.`id_agent`=g.`id`", "left");
        $this->db->group_start();
        $this->db->like('a.`id`', $_POST['search']['value']);
        $this->db->or_like('a.`nama`', $_POST['search']['value']);
        $this->db->or_like('a.`alamat`', $_POST['search']['value']);
        $this->db->or_like('e.`category`', $_POST['search']['value']);
        $this->db->or_like('f.`name_status`', $_POST['search']['value']);
        $this->db->or_like('g.`fullname`', $_POST['search']['value']);
        $this->db->or_like('g.`phone`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_jual`', $_POST['search']['value']);
        $this->db->or_like('a.`harga_user`', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`start_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->or_like('DATE_FORMAT(a.`due_date`, "%d-%m-%Y")', $_POST['search']['value']);
        $this->db->group_end();
        $this->db->where("$condition AND a.`id_agent` = '$id_user' "); // a.`status`!='9' AND b.`status`=1
        $this->db->group_by('a.id');
        $this->db->order_by($order_name, $order_dir);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
        $qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
        $n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $no++;

                $level = $this->session->userdata('level'); // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor

                // 0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif
                switch ($r['status']) {
                    case 0:
                        $status_properti = '<span class="badge badge-primary">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 1:
                        $status_properti = '<span class="badge badge-success">' . $r['status_rumah'] . ' </span>';
                        break;
                    case 8:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        if ($level == 2 || $level == 3) {

                            if ($r['note_approval'] != '') {
                                $status_properti .= '<br> <br> <div class="btn-group">
                                    <a href="#" class="btn bg-indigo-400 dropdown-toggle btn-xs" data-toggle="dropdown" style="padding: .1rem 1rem;">
                                        Alasan
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>' . $r['note_approval'] . '</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        }
                        break;
                    case 9:
                        $status_properti = '<span class="badge badge-danger">' . $r['status_rumah'] . ' </span>';
                        break;
                    default:
                        $status_properti = '';
                        break;
                }



                // 1: Super Admin / Owner, 2: Admin Cabang, 3: Sales / Agent, 4: Premium Investor
                if ($level == 1 || $level == 2) {
                    $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                } else {

                    $btn_edit = '';

                    if ($level == 3 && $r['status'] == 8) {
                        $btn_edit = '<a href="javascript:;" title="Edit" onClick="update_data(\'' . $r['id_rumah'] . '\')"><i class="icon-pencil7 position-left text-slate-800"></i></a>';
                    }
                }




                if ($level == 3 || $level == 4) {
                    $btn_delete = '';
                } else {
                    $btn_delete = '<a href="javascript:;" style="margin-left:10px" title="Delete" onclick="delete_data(\'' . $r['id_rumah'] . '\')"><i class="icon-trash text-danger"></i></a>';
                }


                if ($level == 2 || $level == 1) { // Approval by  Admin Cabang || Owner / Super Admin

                    // 0: Proses, 1: Sudah Aktivasi (Setuju), 8: Tolak, 9: Tidak Aktif

                    if ($r['status'] == 0 || $r['status'] == 8) {
                        $btn_setuju = '<a href="javascript:;" style="margin-left:10px" title="Setuju" onclick="approve_data(\'' . $r['id_rumah'] . '\')"><i class="icon-checkmark text-success"></i></a>';
                        $btn_tolak = '<a href="javascript:;" style="margin-left:10px" title="Tolak" onclick="reject_data(\'' . $r['id_rumah'] . '\')"><i class="icon-close2 text-danger"></i></a>';
                    } else {
                        $btn_setuju = '';
                        $btn_tolak = '';
                    }
                } else {
                    $btn_setuju = '';
                    $btn_tolak = '';
                }


                if ($r['status'] == 1) {

                    if ($level == 1 || $level == 2) {

                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';

                        if ($r['recommended'] == '0') {
                            $btn_set_recommended = '<a href="javascript:;" title="Set Recommended" onclick="set_recommended(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-thumbs-up2 text-primary"></i></a>';
                        } else {
                            $btn_unset_recommended = '<a href="javascript:;" title="Unset Recommended" onclick="unset_recommended(\'' . $r['id_rumah'] . '\')">
                                                            <i class="icon-thumbs-up2 text-primary"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-primary"> Recommended </span>';
                        }


                        if ($r['premium'] == '0') {
                            $btn_set_premium = '<a href="javascript:;" style="margin-left:10px" title="Set Premium Investor" onclick="set_premium(\'' . $r['id_rumah'] . '\')">
                                                    <i class="icon-star-full2 text-warning"></i></a>';
                        } else {
                            $btn_unset_premium = '<a href="javascript:;" style="margin-left:10px" title="Unset Premium Investor" onclick="unset_premium(\'' . $r['id_rumah'] . '\')">
                                                        <i class="icon-star-full2 text-warning"></i></a>';
                            $status_properti .= '<br> <span class="badge badge-warning"> Premium Investor </span>';
                        }
                    } else {
                        $btn_set_recommended = '';
                        $btn_set_premium = '';
                        $btn_unset_recommended = '';
                        $btn_unset_premium = '';
                    }
                } else {
                    $btn_set_recommended = '';
                    $btn_set_premium = '';
                    $btn_unset_recommended = '';
                    $btn_unset_premium = '';
                }

                $btn_ebrosur = '<br> <a href="' . base_url('admin/Manage_properti/ebrosur_preview/' . $r['id_rumah']) . '" target="_blank" class="btn btn-sm btn-dark">
                <div style="font-size: 18px;"><span class="icon-newspaper"> </span> E-Brosur </div>
                                </a>';

                $options = $btn_edit . $btn_delete . $btn_setuju . '&nbsp;' . $btn_tolak .
                    $btn_set_recommended . $btn_set_premium . $btn_unset_recommended . $btn_unset_premium . '<br>' . $btn_ebrosur;

                $start_date = isset($r['start_date']) ? date('d-m-Y', strtotime($r['start_date'])) : '-';
                $due_date = isset($r['due_date']) ? date('d-m-Y', strtotime($r['due_date'])) : '-';

                $row  = array(
                    $no . '.',
                    '#' . $r['id'],
                    $r['nama'],
                    $r['alamat'],
                    $r['category'],
                    $r['name_status'],
                    /* $r['luas_bangunan'],
                    $r['luas_tanah'],
                    $r['jml_lantai'],
                    $r['legalitas'], */
                    $r['fullname'],
                    $r['agent_phone'],
                    // number_format($r['harga_jual'], 0, "", "."),
                    // number_format($r['harga_user'], 0, "", "."),
                    number_format($r['harga_jual'], 2, ",", "."),
                    number_format($r['harga_user'], 2, ",", "."),
                    /* $r['fasilitas'],
                    $r['deskripsi'], */
                    $start_date,
                    $due_date,
                    '<a href="#picture" data-id="' . $r['foto'] . '" data-name="' . $r['nama_foto'] . '" 

                                                    class="openImageDialog thumbnail" data-toggle="modal">

                                                    <img src="' . $r['foto'] . '" width="100px">

                                            </a>',
                    $status_properti,
                    $options
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

    function get_bangunan_id($id = '')
    {
        $sql = "SELECT a.*, c.`img_url` as foto ,c.`img_name` as nama_foto,a.`id` AS id_rumah,
                    `d`.area_lahan AS desc_area_lahan, `d`.area_bangunan AS desc_area_bangunan, 
                    `d`.legalitas AS desc_legalitas, `d`.fasilitas AS desc_fasilitas
                FROM manage_properti a
                    LEFT JOIN ms_show b ON a.`id` = b.`id_rumah`        
                    LEFT JOIN ms_photo c ON a.`id` = c.`id_rumah`
                    LEFT JOIN tb_deskripsi d ON a.`id` = d.`id_rumah`
                WHERE a.`id` = '$id' "; // AND a.`status` != '9' 
        $data = $this->db->query($sql);
        return $data;
    }

    function simpan_upload($data)
    {
        $this->db->insert('ms_photo', $data);
        // $data['id_rumah'] = $this->db->insert_id();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function simpan_upload_video($data)
    {
        $this->db->insert('ms_video', $data);
        // $data['id_rumah'] = $this->db->insert_id();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }



    function options_kontak_agen()
    {
        // $search = ''

        $data = $this->db->query("SELECT a.* FROM `manage_user` a WHERE a.tipe = 3 ")->result();

        $result[0] = 'Pilih Kontak Agen';
        foreach ($data as $row) {
            $result[$row->id] = $row->phone . ' | ' . $row->fullname; // $row->first_name.' '.$row->last_name
        }
        return $result;


        // filtering parameter
        // $search = $this->db->escape_str($search);

        // build query for searching
        /* $condition = '';
        if ($search != '') {
            $condition .= " AND (a.first_name LIKE '%$search%' OR 
                                a.last_name LIKE '%$search%' OR 
                                a.phone LIKE '%$search%') ";
        } */


        /* return $this->db->query("
			SELECT a.*
			FROM `manage_user` a 
			WHERE a.tipe = 3 
			$condition")->result(); */
    }




    function options_kontak_agen_aktif() { 

        $data = $this->db->query("SELECT m.id, d.`consultant_id`, 
                                        m.fullname, m.phone
                                    FROM manage_user m
                                        INNER JOIN detail_agent d ON m.`id` = d.`id_agent`
                                    WHERE d.status_resign = 0 AND m.status = 1")->result();

        $result[0]= 'Pilih Kontak Agen';
        foreach ($data as $row) {
            $result[$row->id] = $row->phone.' | '.$row->fullname; // $row->first_name.' '.$row->last_name
        }


        return $result;
    }

    function options_kontak_one_agent($id_user = '')
    {

        $data = $this->db->query("SELECT a.* FROM `manage_user` a 
                                    WHERE a.tipe = 3 AND a.id = '$id_user' ")->row();


        $result[$data->id] = $data->phone . ' | ' . $data->fullname;
        //    $result[0] = 'Pilih Kontak Agen';

        // $result[0] = 'Pilih Kontak Agen';
        /* foreach ($data as $row) {
            $result[$row->id] = $row->phone . ' | ' . $row->fullname; 
        } */
        return $result;
    }


    function options_jenis_properti()
    {
        $data = $this->db->query("SELECT * FROM ms_category WHERE `status` = 1 ")->result();

        $result[0] = 'Pilih Jenis';
        foreach ($data as $row) {
            $result[$row->id] = $row->category;
        }
        return $result;
    }

    function options_status_properti()
    {
        $data = $this->db->query("SELECT * FROM ms_status_property WHERE `status` = 1 ")->result();

        $result[0] = 'Pilih Status';
        foreach ($data as $row) {
            $result[$row->id] = $row->name_status;
        }
        return $result;
    }
    function options_fasilitas()
    {
        $sql = $this->db->query("SELECT * FROM ms_fasilitas WHERE status = 1");
        return $sql->result_array();
    }

    // function options_fasilitas()
    // {
    //     $data = $this->db->query("SELECT * FROM ms_fasilitas WHERE `status` = 1 ")->result();

    //     $result[0] = 'Pilih Fasilitas';
    //     foreach ($data as $row) {

    //         if ($row->satuan != "") {
    //             $satuan = ' - Satuan: ' . $row->satuan;
    //         } else {
    //             $satuan = '';
    //         }

    //         $result[$row->id] = $row->nama . $satuan;
    //     }
    //     return $result;
    // }

    function options_fasilitas_2()
    {
        $data = $this->db->query("SELECT * FROM ms_fasilitas WHERE `status` = 1 ")->result();

        $result = '<option value="0" selected="selected" disabled="disabled">Pilih Fasilitas</option>';
        foreach ($data as $row) {

            if ($row->satuan != "") {
                $satuan = ' - Satuan: ' . $row->satuan;
            } else {
                $satuan = '';
            }

            $result .= '<option value="' . $row->id . '">' . str_replace("'", '', $row->nama . $satuan) . '</option>';
        }

        return $result;
    }

    function options_features()
    {
        $sql = $this->db->query("SELECT * FROM ms_feature WHERE status = 1");
        return $sql->result_array();
    }

    // function options_features()
    // {
    //     $data = $this->db->query("SELECT * FROM ms_feature WHERE `status` = 1 ")->result();

    //     $result[0] = 'Pilih Feature';
    //     foreach ($data as $row) {
    //         $result[$row->id] = $row->nama;
    //     }
    //     return $result;
    // }

    function options_periode_sewa()
    {
        $data = $this->db->query("SELECT * FROM ms_periode_sewa WHERE `status` = 1 ")->result();

        $result[0] = 'Periode Sewa';
        foreach ($data as $row) {
            $result[$row->id] = $row->periode;
        }
        return $result;
    }

    function view_fasilitas_by_property($id = '')
    {
        $sql = "SELECT b.`id`, c.`id` AS id_properti, a.`id` AS id_fasilitas, 
                    a.`nama`, b.`label`, a.`satuan`  
                FROM ms_fasilitas a
                    INNER JOIN tb_properti_fasilitas b ON a.`id` = b.`id_fasilitas`
                    INNER JOIN manage_properti c ON b.`id_rumah` = c.`id`
                WHERE b.`id_rumah` = '$id' AND 
                     c.`status` != '9' AND a.`status` = 1";

        $data = $this->db->query($sql);
        return $data;
    }

    function view_features_by_property($id = '')
    {
        $sql = "SELECT b.`id`, c.`id` AS id_properti, a.`id` AS id_feature, a.`nama` 
                FROM ms_feature a
                    INNER JOIN tb_properti_feature b ON a.`id` = b.`id_feature`
                    INNER JOIN manage_properti c ON b.`id_rumah` = c.`id`
                WHERE b.`id_rumah` = '$id' AND  
                    c.`status` != '9' AND a.`status` = 1";

        $data = $this->db->query($sql);
        return $data;
    }

    function get_image_1($id = '')
    {
        $sql = "SELECT * 
                FROM ms_photo 
                WHERE id_rumah = '$id' AND `status` = '1' 
                    LIMIT 0,1";

        $data = $this->db->query($sql);
        return $data;
    }

    function get_image_2($id = '')
    {
        $sql = "SELECT * 
                FROM ms_photo 
                WHERE id_rumah = '$id' AND `status` = '1' 
                    LIMIT 1,1";

        $data = $this->db->query($sql);
        return $data;
    }

    function get_image_3($id = '')
    {
        $sql = "SELECT * 
                FROM ms_photo 
                WHERE id_rumah = '$id' AND `status` = '1' 
                    LIMIT 2,1";

        $data = $this->db->query($sql);
        return $data;
    }

    function get_image_4($id = '')
    {
        $sql = "SELECT * 
                FROM ms_photo 
                WHERE id_rumah = '$id' AND `status` = '1' 
                    LIMIT 3,1";

        $data = $this->db->query($sql);
        return $data;
    }

    function get_image_5($id = '')
    {
        $sql = "SELECT * 
                FROM ms_photo 
                WHERE id_rumah = '$id' AND `status` = '1' 
                    LIMIT 4,1";

        $data = $this->db->query($sql);
        return $data;
    }

    function get_image_cover($id = '')
    {
        $sql = "SELECT * 
                FROM ms_photo 
                WHERE id_rumah = '$id' AND 
                    `status` = '1' AND `cover` = '1' ";

        $data = $this->db->query($sql);
        return $data;
    }

    function kontak_agen_by_properti($id = '')
    {
        $sql = "SELECT b.`fullname`, b.`email`, b.`phone`, 
                    CONCAT(b.host,b.foto) AS profile_img, b.foto AS foto_agen
                FROM manage_properti a 
                    JOIN manage_user b ON a.`id_agent` = b.`id`
                WHERE a.`id` = '$id' AND b.`tipe` = 3";

        $data = $this->db->query($sql);
        return $data;
    }

    function periode_sewa_properti($id = '')
    {
        $sql = "SELECT a.id_periode_sewa, p.periode  
                FROM manage_properti a
                    JOIN ms_periode_sewa p ON a.id_periode_sewa = p.id
                WHERE a.id='$id'";

        $data = $this->db->query($sql);
        return $data;
    }


    function view_fasilitas_not_empty_by_property($id = '') {
        $sql = "SELECT b.`id`, c.`id` AS id_properti, a.`id` AS id_fasilitas, 
                    a.`nama`, b.`label`, a.`satuan`  
                FROM ms_fasilitas a
                    INNER JOIN tb_properti_fasilitas b ON a.`id` = b.`id_fasilitas`
                    INNER JOIN manage_properti c ON b.`id_rumah` = c.`id`
                WHERE b.`id_rumah` = '$id' AND 
                     c.`status` != '9' AND a.`status` = 1 
                     AND b.`label` != '' AND b.`label` IS NOT NULL";

        $data = $this->db->query($sql);
        return $data;
    }

    function view_agen_resign() {
        $sql = "SELECT m.id AS id_user, d.`consultant_id`, m.fullname
                FROM manage_user m
                    INNER JOIN detail_agent d ON m.`id` = d.`id_agent`
                WHERE d.status_resign = 1";

        return $this->db->query($sql)->result();
    }

    function get_agen_id($id) {
        $sql = "SELECT m.id AS id_user, d.`consultant_id`, m.fullname
                FROM manage_user m
                    INNER JOIN detail_agent d ON m.`id` = d.`id_agent`
                WHERE m.id = '$id'";

        return $this->db->query($sql)->row();
    }


    function view_properti_agen_resign($id = '') {

        $sql = "SELECT p.id AS id_property, 
                    m.id AS id_user, d.`consultant_id`, m.fullname AS agent_fullname, 
                    p.nama AS nama_properti,
                    p.`alamat` AS alamat,
                    c.category AS category, 
                    s.name_status AS status_name,
                    CASE p.status 
                        WHEN 0 THEN 'Proses'
                        WHEN 1 THEN 'Sudah Aktif' 
                        WHEN 8 THEN 'Ditolak'
                        WHEN 9 THEN 'Tidak Aktif'
                    END AS status_properti
                FROM manage_properti p
                    INNER JOIN manage_user m ON p.`id_agent` = m.`id`
                    INNER JOIN detail_agent d ON m.`id` = d.`id_agent`
                    LEFT JOIN ms_category c ON p.`id_category` = c.`id`        
                    LEFT JOIN ms_status_property s ON p.`id_status_property` = s.`id`
                WHERE m.id='$id';";

        return $this->db->query($sql)->result();

    }

    function get_properti_by_id_agen_resign($id = '') {

        $sql = "SELECT p.id AS id_property, 
                    m.id AS id_user, d.`consultant_id`, m.fullname AS agent_fullname, 
                    p.nama AS nama_properti,
                    p.`alamat` AS alamat,
                    c.category AS category, 
                    s.name_status AS status_name,
                    CASE p.status 
                        WHEN 0 THEN 'Proses'
                        WHEN 1 THEN 'Sudah Aktif' 
                        WHEN 8 THEN 'Ditolak'
                        WHEN 9 THEN 'Tidak Aktif'
                    END AS status_properti
                FROM manage_properti p
                    INNER JOIN manage_user m ON p.`id_agent` = m.`id`
                    INNER JOIN detail_agent d ON m.`id` = d.`id_agent`
                    LEFT JOIN ms_category c ON p.`id_category` = c.`id`        
                    LEFT JOIN ms_status_property s ON p.`id_status_property` = s.`id`
                WHERE p.id='$id';";

        return $this->db->query($sql);

    }

    function update_counter_properti_aktif($id = '') {
        $this->db->query("UPDATE manage_properti
                            SET aktif_count = aktif_count + 1
                            WHERE id = '$id' ");
    }

}
