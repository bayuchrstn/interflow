<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Main_model extends CI_Model
{



    // ------------------- Login -------------------//

    function cek($username = "", $password = "")

    {

        $this->db->select('a.`id` AS id, a.`username`, a.`first_name`, 

                             a.`email`, a.`tipe`');

        $this->db->where('a.`username`', $username);

        $this->db->where('a.`password`', md5($password));

        $this->db->where('a.`tipe` = 4');

        $this->db->from('manage_user a');

        $this->db->group_by('a.id');

        return $this->db->get();
    }

    // ------------------- End Login --------------//





    function login($username = '', $password = '')

    {

        $query = $this->db->where('username', $username)

            ->where('password', md5($password))

            ->where('status', 1)

            ->get('tb_user')

            ->row();



        return $query;
    }



    function create_session($username = '')

    {

        $random = generate_random(8);

        $random = md5($random);



        $this->db->where('username', $username)

            ->update('tb_user', ['session' => $random]);



        return $random;
    }



    function is_valid_page()

    {

        // session cabang

        $cabang = $this->session->userdata('cabang');

        // if cabang == 0 then level 1

        $level = ($cabang == 0) ? 1 : 2;

        // class == function

        $class = $this->router->fetch_class();

        // method == method of class

        $method = $this->router->fetch_method();

        // cari menu apakah ada ?

        $query = $this->db->query("

        	SELECT *

			FROM tb_menu a

			WHERE a.`fungsi` = '$class'

			AND a.`method` = '$method'

			AND a.level = '$level' ")->row();



        $result = ($query) ? TRUE : FALSE;



        return $result;
    }



    function get_page()

    {

        $is_valid_page = $this->is_valid_page();

        if ($is_valid_page == FALSE) {

            show_404();
        }
    }



    function is_login()

    {

        $username = $this->session->userdata('username');

        $id_user = $this->session->userdata('id_user');



        $query = $this->db->where('username', $username)

            ->where('id', $id_user)

            ->get('tb_user')

            ->row();



        if (!empty($query)) {

            return TRUE;
        } else {

            return FALSE;
        }
    }



    function get_login()

    {

        $is_login = $this->is_login();

        if ($is_login == FALSE) {

            redirect('main/logout');
        }
    }



    // ===== Global function ===== //

    function view_by_id($table = '', $condition = '', $row = 'row')

    {

        if ($row == 'row') {

            if ($condition) {

                return $this->db->where($condition)->get($table)->row();
            } else {

                return $this->db->get($table)->row();
            }
        } else if ($row == 'result') {

            if ($condition) {

                return $this->db->where($condition)->get($table)->result();
            } else {

                return $this->db->get($table)->result();
            }
        } else if ($row == 'num_rows') {

            if ($condition) {

                return $this->db->where($condition)->get($table)->num_rows();
            } else {

                return $this->db->get($table)->num_rows();
            }
        }
    }



    function process_data($table = '', $data = '', $condition = '')

    {

        if ($condition) {

            $this->db->where($condition)->update($table, $data);

            return $this->db->affected_rows();
        } else {

            $this->db->insert($table, $data);

            return $this->db->insert_id();
        }
    }



    function proses_data($table = '', $data = '', $condition = '')

    {

        if ($condition) {

            $this->db->where($condition)->update($table, $data);
        } else {

            $this->db->insert($table, $data);
        }

        return $this->db->affected_rows();
    }



    function delete_data($table = '', $condition = '')

    {

        $this->db->where($condition)->delete($table);

        return $this->db->affected_rows();
    }



    function session_cabang()

    {

        $user_id = user_id();



        $level = level();



        $query = $this->db->where('id_user', $user_id)

            ->get('tb_user_cabang')

            ->result();



        $result = [];

        if (!empty($query) && $level <> 1) {

            foreach ($query as $row) {

                $result[] = $row->kode_lokasi;
            }
        }



        return $result;
    }



    function build_query($data = [], $where = 'WHERE', $table = '')

    {

        $result = '';



        if ($data) {

            $jumlah = count($data);

            $result .= $where . ' (';

            for ($i = 0; $i < $jumlah; $i++) {

                $result .= $table . " = '" . $data[$i] . "'";



                if (end($data) == $data[$i]) {

                    $result .= '';
                } else {

                    $result .= ' OR ';
                }
            }



            $result .= ')';
        }



        return $result;
    }



    function convert_tanggal($tgl)
    {

        $date = strtotime($tgl);

        return date('Y-m-d', $date);
    }



    function tanggal_indo($tgl)
    {

        $date = strtotime($tgl);

        return date('d/m/Y', $date);
    }

    // ===== End Global function ===== //



    function jobs_id()

    {

        $date      = date_create();

        $timestamp = date_timestamp_get($date);



        $method    = 'aes-256-cbc';

        $password  = substr(hash('sha256', '3sc3RLrpd17', true), 0, 32);

        $col_chr   = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);



        $unique    = base64_encode(openssl_encrypt($timestamp, $method, $password, OPENSSL_RAW_DATA, $col_chr));



        return $unique;
    }



    function ajax_function()

    {

        $is_ajax = $this->input->is_ajax_request();

        if ($is_ajax == TRUE) {

            return TRUE;
        } else {

            show_404();
        }
    }



    function random_word($id = 10)

    {

        $pool = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $word = '';

        for ($i = 0; $i < $id; $i++) {

            $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }

        return $word;
    }

    // --------------- Data About Us ---------------- //
    function data_about_us()
    {
        $data = $this->db->query("SELECT * FROM tb_image_founder

                                    WHERE `status`=1")->result();

        $html = '<div class="row">';

        if (!empty($data)) {

            foreach ($data as $val) {

                $html .= '<div class="col-md-3">

                                    <img class="img-res" src="' . $val->img_url . '" alt="">

                        </div>';
            }
        }



        if (empty($data)) {

            $html .= '<div class="col-md-12 text-center"> --- no data available --- </div>';
        }



        $html .= '</div>';



        return $html;
    }
    // --------------- END ABOUT US ----------------- //

    // --------------- Data Developer --------------- //

    function data_developer()

    {

        $data = $this->db->query("SELECT * FROM tb_developer

                                    WHERE `status`=1")->result();

        $html = '<div class="row">';

        if (!empty($data)) {

            foreach ($data as $val) {

                $html .= '<div class="col-lg-4 col-md-6 col-sm-6 col-6">

                            <div class="developer-info">

                                <a href="' . base_url() . 'Main/detail_developer?q=' . $val->id . '">

                                    <img class="img-responsive" src="' . $val->img_url . '" alt="' . $val->name . '">

                                    <div class="title">

                                        <h5>' . $val->name . '</h5>

                                    </div>

                                </a>

                            </div>

                        </div>';
            }
        }



        if (empty($data)) {

            $html .= '<div class="col-md-12 text-center"> --- no data available --- </div>';
        }



        $html .= '</div>';



        return $html;
    }



    function data_developer_id($id = '')

    {

        return $this->db->query("SELECT * FROM tb_developer

                                    WHERE `id`='$id'")->row();
    }



    function data_developer_random()

    {

        $data = $this->db->query("SELECT * FROM tb_developer

                                    WHERE `status`=1

                                    ORDER BY RAND()

                                    LIMIT 4")->result();

        $html = '<div class="row">';

        if (!empty($data)) {

            foreach ($data as $val) {

                $html .= '<div class="col-lg-3 col-md-6 col-sm-6 col-6">

                            <div class="developer-info">

                                <a href="' . base_url() . 'Main/detail_developer?q=' . $val->id . '">

                                    <img class="img-responsive" src="' . $val->img_url . '" alt="' . $val->name . '">

                                    <div class="title">

                                        <h5>' . $val->name . '</h5>

                                    </div>

                                </a>

                            </div>

                        </div>';
            }
        }



        if (empty($data)) {

            $html .= '<div class="col-md-12 text-center"> --- no data available --- </div>';
        }



        $html .= '</div>';



        return $html;
    }

    // --------------- End Data Developer --------------- //



    // --------------- Data Gallery --------------- //

    function data_gallery($start = '0', $limit = '12')

    {

        $html = null;
        $no = 0;

        $data = $this->db->query("SELECT a.*,b.`nama_album` 
                                    FROM tb_gallery a 
                                        JOIN ms_album b ON a.`id_album`=b.`id` 
                                    WHERE a.`status` = 1 AND b.`status` = 1
                                        LIMIT $start,$limit")->result();

        if (!empty($data)) {

            foreach ($data as $val) {

                $no++;

                $html .= '<div class="col-lg-3 col-md-6 col-sm-12 filtr-item col-pad" data-category="' . $val->id_album . '">

                            <div class="portfolio-item">

                                <a href="' . str_replace('beta/', '', $val->file_url) . '" title="' . $val->title . '">

                                    <img src="' . str_replace('beta/', '', $val->file_url) . '" alt="gallery-photo" class="lazy">

                                </a>

                                <div class="portfolio-content">

                                    <div class="portfolio-content-inner">

                                        <p>' . $val->title . '</p>

                                    </div>

                                </div>

                            </div>

                        </div>';

                if ($no == 3) {

                    $no = 0;
                }
            }
        }

        return $html;
    }

    function data_album()
    {
        $html = null;
        $data = $this->db->query("SELECT * FROM ms_album b WHERE b.`status`=1")->result();

        if (!empty($data)) {
            foreach ($data as $val) {
                $html .= '<li data-filter="' . $val->id . '" class="btn-inline filtr-button filtr"><a href="javascript:;">' . $val->nama_album . '</a></li>';
            }
        }

        return $html;
    }

    // --------------- End Data Gallery --------------- //



    // --------------- Data Faq --------------- //

    function data_faq()

    {

        $data = $this->db->query("SELECT * FROM tb_faq

                                    WHERE `status`=1")->result();

        $html = '<div class="row">

                    <div class="col-lg-11 offset-lg-1">

                        <div id="faq" class="faq-accordion">

                            <div class="card m-b-0">';

        $number_id = 0;

        if (!empty($data)) {

            foreach ($data as $val) {

                $html .= '<div class="card-header">

                            <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse' . $number_id . '">

                                ' . $val->question . '

                            </a>

                        </div>

                        <div id="collapse' . $number_id . '" class="card-block collapse">

                            <div class="p-text text-justify">

                                ' . $val->answer . '

                            </div>

                        </div>';

                $number_id++;
            }
        }



        if (empty($data)) {

            $html .= ' <div class="row"><div class="col-md-12 text-center">--- no data available ---</div></div> ';
        }



        $html .= '        </div>

                    </div>

                </div>

            </div>';

        return $html;
    }
    // --------------- End Data Faq --------------- //



    // --------------- Data Slider --------------- //

    function data_slider()

    {

        $data = $this->db->query("SELECT * FROM tb_home_slider WHERE `status`=1")->result();
        $html = '<div class="carousel-inner banner-slider-inner text-left">';
        if (!empty($data)) {
            foreach ($data as $row => $val) {
                $is_active = '';
                if ($row == 0) {
                    $is_active = 'active';
                }
                $html .= '<div class="carousel-item banner-max-height ' . $is_active . '">
                            <img  class="d-block w-100 h-100" src="' . $val->file_url . '" alt="banner">
                        </div>';
            }
        }
        if (empty($data)) {
            $html .= '<div class="carousel-item banner-max-height active">
                        <img class="d-block w-100 h-100" src="' . base_url() . 'assets/img/slider/slide_3.jpg" alt="banner">
                    </div>';
        }
        $html .= '</div>';
        return $html;
    }

    // --------------- End Data Slider --------------- //



    // --------------- Data Testimoni --------------- //

    function data_testimoni_random()

    {

        $data = $this->db->query("SELECT * FROM tb_testimony

                                    WHERE `status`=1

                                    ORDER BY RAND()")->result();

        $html = '';

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $rating = '<i class="fa fa-star-o"></i>

                            <i class="fa fa-star-o"></i>

                            <i class="fa fa-star-o"></i>

                            <i class="fa fa-star-o"></i>

                            <i class="fa fa-star-o"></i>';



                if ($val->rating > 0) {

                    $rating = '';

                    for ($i = 0; $i < $val->rating; $i++) {

                        $rating .= '<i class="fa fa-star"></i>';
                    }



                    if ($val->rating < 5) {

                        $start_o = 5 - $val->rating;

                        for ($j = 0; $j < $start_o; $j++) {

                            $rating .= '<i class="fa fa-star-o"></i>';
                        }
                    }
                }



                $html .= '<div class="slick-slide-item">

                        <div class="testimonial-inner">

                            <div class="text-box">

                                <div class="user">

                                    <div class="photo">

                                        <img class="media-object" src="' . $val->img_url . '" alt="user">

                                    </div>

                                    <div class="detail">

                                        <h5>' . $val->name . '</h5>

                                        <div class="rating">

                                            ' . $rating . '

                                        </div>

                                    </div>

                                </div>

                                <div class="testimonial-content">

                                    <h5 class="bold">' . $val->title . '</h5>

                                    <p>' . nl2br($val->testimony) . '</p>

                                </div>

                            </div>

                        </div>

                    </div>';
            }
        }



        if (empty($data)) {

            $html .= '<div class="slick-slide-item">

                        <div class="testimonial-inner">

                            <div class="text-box">

                                <div class="user">

                                    <div class="photo">

                                        <img class="media-object" src="http://placehold.it/60x60" alt="user">

                                    </div>

                                    <div class="detail">

                                        <h5>Good People</h5>

                                        <div class="rating">

                                            <i class="fa fa-star"></i>

                                            <i class="fa fa-star"></i>

                                            <i class="fa fa-star"></i>

                                            <i class="fa fa-star"></i>

                                            <i class="fa fa-star"></i>

                                        </div>

                                    </div>

                                </div>

                                <div class="testimonial-content">

                                    <h5 class="bold">Good Service</h5>

                                    <p>Good Service</p>

                                </div>

                            </div>

                        </div>

                    </div>';
        }



        return $html;
    }

    // --------------- End Data Testimoni --------------- //



    // --------------- Home Data --------------- //

    function data_property_random()

    {

        $data = $this->db->query("SELECT a.id, a.nama, a.alamat, a.harga_jual, a.harga_sewa, a.status_transaksi,  
                                        b.img_url, b.img_name, s.name_status,
                                        t.name_status AS name_status_trx, a.nama_jalan, a.id_status_property AS status_property
                                    FROM manage_properti a 
                                        JOIN ms_status_property s ON a.id_status_property = s.id
                                        LEFT JOIN (
                                                    SELECT id_rumah, img_url, img_name 
                                                    FROM ms_photo 
                                                    WHERE cover=1
                                        ) b ON a.id = b.id_rumah
                                        LEFT JOIN ms_status_transaksi_property t ON a.status_transaksi = t.id
                                    WHERE a.status=1 AND a.star = 1 AND (a.id_status_property = 1 OR a.id_status_property = 2 )
                                    GROUP BY a.id, a.nama, a.alamat
                                    LIMIT 15")->result(); // , a.harga_jual, b.img_url, b.img_name



        $arr = array();

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $data_fasilitas = $this->db->query("SELECT a.id_rumah, s.logo, s.nama AS fasilitas, a.label, s.satuan 
                                                    FROM tb_properti_fasilitas a 
                                                        JOIN ms_fasilitas s ON a.id_fasilitas=s.id
                                                    WHERE a.id_rumah='$val->id'
                                                    AND s.default=1
                                                        LIMIT 4")->result();

                $arr[$row] = array(
                    'id' => $val->id,
                    'nama' => $val->nama,
                    'alamat' => $val->alamat,
                    'harga_jual' => uang($val->harga_jual),
                    'harga_sewa' => uang($val->harga_sewa),
                    'image' => $val->img_url,
                    'fasilitas' => $data_fasilitas,
                    'name_status' => $val->name_status,
                    'name_status_trx' => $val->name_status_trx,
                    'status_transaksi' => $val->status_transaksi,
                    'status_property' => $val->status_property,
                    'nama_jalan' => $val->nama_jalan
                );
            }
        }



        return $arr;
    }



    function data_consultant_random()

    {

        return $this->db->query("SELECT * FROM `manage_user`

                                    WHERE `status`=1 AND foto <> ''

                                    AND tipe=3

                                    ORDER BY RAND()

                                    LIMIT 15")->result();
    }



    function data_news_random()

    {

        return $this->db->query("SELECT *, 

                                    CONCAT(DATE_FORMAT(tanggal, '%d/%m/%Y'),' ', DATE_FORMAT(insert_at, '%H:%i')) AS format_tanggal  

                                    FROM tb_news

                                    WHERE `status`=1

                                    ORDER BY RAND()

                                    LIMIT 12")->result();
    }



    function data_partner()

    {

        return $this->db->query("SELECT * FROM tb_partner

                                    WHERE `status`=1")->result();
    }



    function data_recent_property()
    {

        $data = $this->db->query("SELECT a.id, a.nama, a.alamat, a.harga_jual, a.harga_sewa, b.img_url, b.img_name,
                                    DATE_FORMAT(a.tanggal,'%M %d %Y') AS tanggal,
                                    a.id_status_property AS status_property
                                FROM manage_properti a 
                                    LEFT JOIN (
                                            SELECT id_rumah, img_url, img_name 
                                            FROM ms_photo 
                                            WHERE cover=1
                                    ) b ON a.id=b.id_rumah
                                WHERE a.status=1
                                    GROUP BY a.id, a.nama, a.alamat, a.harga_jual, b.img_url, b.img_name
                                    ORDER BY a.id DESC
                                LIMIT 3")->result();



        $arr = array();

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $arr[$row] = array(
                    'id' => $val->id,
                    'nama' => $val->nama,
                    'alamat' => $val->alamat,
                    'harga_jual' => uang($val->harga_jual),
                    'harga_sewa' => uang($val->harga_sewa),
                    'image' => $val->img_url,
                    'tanggal' => $val->tanggal,
                    'status_property' => $val->status_property
                );
            }
        }


        return $arr;
    }

    // --------------- End Home Data --------------- //



    // --------------- Consultant --------------- //

    function data_consultant()

    {

        return $this->db->query("SELECT * FROM `manage_user`

                                    WHERE `status`=1

                                    AND tipe=3")->result();
    }



    function data_consultant_id($id = '')

    {

        return $this->db->query("SELECT * FROM `manage_user`

                                    WHERE `status`=1

                                    AND tipe=3

                                    AND id='$id'")->row();
    }

    // --------------- End Consultant --------------- //



    // --------------- News --------------- //

    function data_news($limit = '', $start = '')

    {

        if ($start == '') {

            $start = 0;
        }

        $data = $this->db->query("SELECT *, 

                                    CONCAT(DATE_FORMAT(tanggal, '%d/%m/%Y'),' ', DATE_FORMAT(insert_at, '%H:%i')) AS format_tanggal  

                                    FROM tb_news

                                    WHERE `status`=1

                                    LIMIT $start,$limit")->result();

        $html = '<div class="row">';

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $html .= '<div class="col-lg-3 col-md-6">

                            <div class="blog-2">

                                <div class="blog-photo">

                                    <img src="' . $val->img_url . '" alt="small-blog" class="img-fluid">

                                </div>

                                <div class="detail">

                                    <span class="date-up">' . $val->format_tanggal . ' WIB</span>

                                    <h4><a href="' . base_url() . 'Main/detail_news?q=' . $val->id . '">' . $val->judul . '</a></h4>

                                    <p style="text-align: justify;">' . limit_str($val->berita, 150) . '</p>

                                    <a href="' . base_url() . 'Main/detail_news?q=' . $val->id . '" class="btn btn-primary btn-sm btn-block">Read News</a>

                                </div>

                            </div>

                        </div>';
            }
        }



        $html .= '</div>';

        return $html;
    }



    function jumlah_data_news()

    {

        $get = $this->db->query("SELECT count(*) AS jumlah

                                    FROM tb_news

                                    WHERE `status`=1")->row();

        $jumlah = isset($get->jumlah) ? $get->jumlah : '0';

        return $jumlah;
    }



    function data_news_id($id = '')

    {

        return $this->db->query("SELECT *, 

                                    CONCAT(DATE_FORMAT(tanggal, '%d/%m/%Y'),' ', DATE_FORMAT(insert_at, '%H:%i')) AS format_tanggal  

                                    FROM tb_news

                                    WHERE `status`=1

                                    AND id='$id'")->row();
    }

    // --------------- End News --------------- //



    // --------------- Property --------------- //

    function data_property_id($id = '')

    {

        $data = $this->db->query("SELECT a.id, a.nama, a.alamat, a.harga_jual, b.img_url, b.img_name, c.id AS id_agent , CONCAT(c.first_name,c.last_name) as nama_agent,c.phone AS telp_agent,

                                        c.fullname as fullname_agent, c.email AS email_agent,  CONCAT(c.host,c.foto) as foto_agent, d.`area_lahan`,d.`area_bangunan`,d.`legalitas`,d.`fasilitas`,
                                        
                                        a.`lat`,a.`lang`, a.`id_periode_sewa`, a.`id_tipe_jual_tanah`, a.`status_transaksi`,  

                                        tr.name_status AS name_status_trx, a.nama_jalan, a.flag, a.premium, a.star, a.harga_sewa, a.id_status_property, a.`deskripsi`, a.`video_url`

                                    FROM manage_properti a 

                                        LEFT JOIN (SELECT id_rumah, img_url, img_name 

                                                FROM ms_photo 

                                                WHERE cover=1) b ON a.id=b.id_rumah

                                        LEFT JOIN manage_user c ON a.`id_agent`=c.`id`

                                        LEFT JOIN tb_deskripsi d ON a.`id`=d.`id_rumah`

                                        LEFT JOIN ms_tipe_jual_tanah t ON a.`id_tipe_jual_tanah`=t.`id`

                                        LEFT JOIN ms_status_transaksi_property tr ON a.status_transaksi = tr.id
                                        LEFT JOIN ms_status_property st ON a.id_status_property = st.id

                                    WHERE a.status=1

                                    AND a.id='$id'

                                    GROUP BY a.id, a.nama, a.alamat, a.harga_jual, b.img_url, b.img_name, c.id,c.first_name,c.last_name,c.phone,c.fullname,
                                    d.area_lahan,d.area_bangunan,d.legalitas,d.fasilitas,a.lat,a.lang,a.id_periode_sewa, a.id_tipe_jual_tanah, tr.name_status, a.status_transaksi,
                                    a.id_status_property")->row();



        $arr = array();

        if (!empty($data)) {

            $id   = isset($data->id) ? $data->id : '';

            $premium = isset($data->premium) ? $data->premium : '';
            $star = isset($data->star) ? $data->star : '';
            $nama = isset($data->nama) ? $data->nama : '';

            $alamat = isset($data->alamat) ? $data->alamat : '';

            $harga_jual = isset($data->harga_jual) ? $data->harga_jual : 0;
            $harga_sewa = isset($data->harga_sewa) ? $data->harga_sewa : 0;

            $img_url = isset($data->img_url) ? $data->img_url : '';

            $id_agent = isset($data->id_agent) ? $data->id_agent : '';

            $nama_agent = isset($data->fullname_agent) ? $data->fullname_agent : ''; // $data->nama_agent

            $telp_agent = isset($data->telp_agent) ? $data->telp_agent : '';

            $foto_agent = isset($data->foto_agent) ? $data->foto_agent : '';
            $email_agent = isset($data->email_agent) ? $data->email_agent : '';

            $deskripsi = isset($data->deskripsi) ? $data->deskripsi : '';
            $area_lahan = isset($data->area_lahan) ? $data->area_lahan : '';

            $area_bangunan = isset($data->area_bangunan) ? $data->area_bangunan : '';

            $legalitas = isset($data->legalitas) ? $data->legalitas : '';

            $fasilitas = isset($data->fasilitas) ? $data->fasilitas : '';

            $latitude = isset($data->lat) ? $data->lat : '';

            $longitude = isset($data->lang) ? $data->lang : '';

            $status_property = isset($data->id_status_property) ? $data->id_status_property : '';
            $status_transaksi = isset($data->status_transaksi) ? $data->status_transaksi : '';

            $name_status_trx = isset($data->name_status_trx) ? $data->name_status_trx : '';

            $periode_sewa = isset($data->id_periode_sewa) ? $data->id_periode_sewa : '';

            $id_tipe_jual_tanah = isset($data->id_tipe_jual_tanah) ? $data->id_tipe_jual_tanah : '';

            $nama_jalan = isset($data->nama_jalan) ? $data->nama_jalan : '';

            $flag = isset($data->flag) ? $data->flag : '';

            $video_url = isset($data->video_url) ? $data->video_url : '';


            $data_fasilitas = $this->db->query("SELECT a.id_rumah, s.logo, s.nama AS fasilitas, a.label, s.satuan 

                                                        FROM tb_properti_fasilitas a 

                                                        JOIN ms_fasilitas s ON a.id_fasilitas=s.id

                                                        WHERE a.id_rumah='$id'")->result();



            $data_slide = $this->db->query("SELECT * FROM ms_photo WHERE id_rumah='$id' AND status='1' ")->result();



            $data_feature = $this->db->query("SELECT a.*, s.nama AS feature 

                                                        FROM tb_properti_feature a

                                                        JOIN ms_feature s ON a.id_feature=s.id

                                                        WHERE a.id_rumah='$id'")->result();


            $data_periode_sewa = $this->db->query("SELECT a.id_periode_sewa, p.periode  

                                                    FROM manage_properti a

                                                    JOIN ms_periode_sewa p ON a.id_periode_sewa = p.id

                                                    WHERE a.id='$id'")->result();



            $data_tipe_jual_tanah =  $this->db->query("SELECT a.id_tipe_jual_tanah, t.nama AS nama_tipe_jual_tanah  

                                                        FROM manage_properti a

                                                        JOIN ms_tipe_jual_tanah t ON a.id_tipe_jual_tanah = t.id

                                                        WHERE a.id='$id'")->result();


            $arr = array(

                'id'        => $id,

                'nama'      => $nama,
                'premium'      => $premium,
                'star'      => $star,

                'alamat'    => $alamat,

                'deskripsi' => $deskripsi,

                'area_lahan' => $area_lahan,

                'area_bangunan' => $area_bangunan,

                'legal' => $legalitas,

                'facilities' => $fasilitas,

                'latitude' => $latitude,

                'longitude' => $longitude,

                'id_agent' => $id_agent,

                'nama_agent' => $nama_agent,

                'telp_agent' => $telp_agent,

                'foto_agent' => $foto_agent,
                'email_agent' => $email_agent,

                'harga_jual' => uang($harga_jual),
                'harga_sewa' => uang($harga_sewa),

                'image'     => $img_url,

                'status_property' => $status_property,
                'status_transaksi' => $status_transaksi,

                'name_status_trx' => $name_status_trx,

                'slide'     => $data_slide,

                'fasilitas' => $data_fasilitas,

                'feature'   => $data_feature,

                'sewa' => $data_periode_sewa,

                'tipe_jual_tanah' => $data_tipe_jual_tanah,

                'nama_jalan' => $nama_jalan,

                'flag' => $flag,

                'video_url' => $video_url
            );
        }



        return $arr;
    }



    function data_property_recommended($condition = '', $search = '', $ordering = '')
    {
        $data = $this->db->query("SELECT a.id, a.nama, a.alamat, a.harga_jual, a.harga_sewa, a.status_transaksi,
                                    b.img_url, b.img_name, s.name_status,
                                    t.name_status AS name_status_trx, a.nama_jalan, a.id_status_property AS status_property
                                FROM manage_properti a 
                                    JOIN ms_status_property s ON a.id_status_property=s.id
                                    LEFT JOIN (
                                        SELECT id_rumah, img_url, img_name 
                                        FROM ms_photo 
                                        WHERE cover=1) b ON a.id=b.id_rumah
                                    LEFT JOIN ms_status_transaksi_property t ON a.status_transaksi = t.id
                                WHERE a.status=1 AND a.recommended=1
                                    $condition
                                    AND (
                                        a.nama LIKE '%$search%'
                                        OR a.alamat LIKE '%$search%'
                                        OR a.deskripsi LIKE '%$search%'
                                    )
                                    GROUP BY a.id, a.nama, a.alamat, a.harga_jual
                                    $ordering
                                LIMIT 3")->result();



        $arr = array();

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $data_fasilitas = $this->db->query("SELECT a.id_rumah, s.logo, s.nama AS fasilitas, a.label, s.satuan 
                                                    FROM tb_properti_fasilitas a 
                                                        JOIN ms_fasilitas s ON a.id_fasilitas=s.id
                                                    WHERE a.id_rumah='$val->id'
                                                    AND s.default=1
                                                        LIMIT 4")->result();

                $arr[$row] = array(
                    'id' => $val->id,
                    'nama' => $val->nama,
                    'alamat' => $val->alamat,
                    'harga_jual' => uang($val->harga_jual),
                    'harga_sewa' => uang($val->harga_sewa),
                    'image' => $val->img_url,
                    'name_status' => $val->name_status,
                    'fasilitas' => $data_fasilitas,
                    'name_status_trx' => $val->name_status_trx,
                    'status_transaksi' => $val->status_transaksi,
                    'status_property' => $val->status_property,
                    'nama_jalan' => $val->nama_jalan
                );
            }
        }



        return $arr;
    }


    function data_premium_properti($start = '0', $limit = '', $condition = '', $search = '', $ordering = '', $features = '')

    {

        $data = $this->db->query("SELECT SQL_CALC_FOUND_ROWS a.id, a.nama, a.alamat, a.harga_jual, a.id_status_property, 
        
                                    b.img_url, b.img_name, s.name_status,

                                    t.name_status AS name_status_trx, a.nama_jalan

                                    FROM manage_properti a 

                                    JOIN ms_status_property s ON a.id_status_property=s.id

                                    LEFT JOIN (SELECT id_rumah, img_url, img_name 

                                        FROM ms_photo 

                                        WHERE cover=1) b ON a.id=b.id_rumah

                                    LEFT JOIN (

                                        SELECT id_rumah, SUM(bedrooms) AS bedrooms, SUM(bathrooms) AS bathrooms 

                                            FROM (

                                            SELECT s.id_rumah, s.label AS bedrooms, '' AS bathrooms 

                                                FROM tb_properti_fasilitas s 

                                                JOIN ms_fasilitas a ON s.id_fasilitas=a.id

                                                WHERE (

                                                    a.nama LIKE '%beds%'

                                                    OR a.nama LIKE '%bedsroom%'

                                                )

                                            UNION ALL

                                            SELECT s.id_rumah, '' AS bedrooms, s.label AS bathrooms 

                                                FROM tb_properti_fasilitas s 

                                                JOIN ms_fasilitas a ON s.id_fasilitas=a.id

                                                WHERE (

                                                    a.nama LIKE '%bathroom%'

                                                    OR a.nama LIKE '%bathrooms%'

                                                )

                                        ) fasilitas

                                        GROUP BY id_rumah

                                    ) fas ON a.id=fas.id_rumah

                                    LEFT JOIN ms_status_property t ON a.id_status_property = t.id

                                    WHERE a.status=1 

                                    $condition

                                    $features

                                    AND (
                                        a.nama LIKE '%$search%'
                                        OR a.alamat LIKE '%$search%'
                                        OR a.deskripsi LIKE '%$search%'

                                    )  AND ( a.id_status_property='1' OR a.id_status_property='2' OR a.id_status_property='3' OR a.id_status_property='4' OR a.id_status_property='5' ) AND a.premium = 1

                                    GROUP BY a.id, a.nama, a.alamat, a.harga_jual

                                    $ordering

                                    LIMIT $start,$limit")->result();



        // Get  total jumlah data //

        $q = $this->db->query('SELECT FOUND_ROWS() AS ttl');

        $total_data = isset($q->row()->ttl) ? $q->row()->ttl : '0';



        $arr = array();

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $data_fasilitas = $this->db->query("SELECT a.id_rumah, s.logo, s.nama AS fasilitas, a.label, s.satuan 

                                                        FROM tb_properti_fasilitas a 

                                                        JOIN ms_fasilitas s ON a.id_fasilitas=s.id

                                                        WHERE a.id_rumah='$val->id'
                                                        AND s.default=1

                                                        LIMIT 4")->result();



                $arr[$row] = array(

                    'id' => $val->id,

                    'nama' => $val->nama,

                    'alamat' => $val->alamat,

                    'harga_jual' => uang($val->harga_jual),

                    'image' => $val->img_url,

                    'name_status' => $val->name_status,

                    'fasilitas' => $data_fasilitas,

                    'name_status_trx' => $val->name_status_trx,

                    'id_status_property' => $val->id_status_property,

                    'nama_jalan' => $val->nama_jalan

                );
            }
        }



        $result = array(

            'data'      => $arr,

            'total_data' => $total_data

        );



        return $result;
    }

    function data_property_list_property($start = '0', $limit = '', $condition = '', $search = '', $ordering = '', $features = '')
    {

        $data = $this->db->query("SELECT SQL_CALC_FOUND_ROWS a.id, a.nama, a.alamat, a.harga_jual, a.harga_sewa, a.status_transaksi, 
                                    b.img_url, b.img_name, s.name_status,
                                    t.name_status AS name_status_trx, a.nama_jalan,a.premium,
                                    a.id_status_property AS status_property
                                FROM manage_properti a 
                                    JOIN ms_status_property s ON a.id_status_property=s.id
                                    LEFT JOIN (SELECT id_rumah, img_url, img_name 
                                        FROM ms_photo 
                                        WHERE cover=1) b ON a.id=b.id_rumah
                                    LEFT JOIN (
                                        SELECT id_rumah, SUM(bedrooms) AS bedrooms, SUM(bathrooms) AS bathrooms 
                                            FROM (
                                                SELECT s.id_rumah, s.label AS bedrooms, '' AS bathrooms 
                                                FROM tb_properti_fasilitas s 
                                                    JOIN ms_fasilitas a ON s.id_fasilitas=a.id
                                                WHERE (
                                                    a.nama LIKE '%beds%'
                                                    OR a.nama LIKE '%bedsroom%'
                                                )
                                            UNION ALL
                                        SELECT s.id_rumah, '' AS bedrooms, s.label AS bathrooms 
                                            FROM tb_properti_fasilitas s 
                                            JOIN ms_fasilitas a ON s.id_fasilitas=a.id
                                            WHERE (
                                                a.nama LIKE '%bathroom%'
                                                OR a.nama LIKE '%bathrooms%'
                                            )
                                        ) fasilitas
                                        GROUP BY id_rumah
                                    ) fas ON a.id=fas.id_rumah
                                    LEFT JOIN ms_status_transaksi_property t ON a.status_transaksi = t.id
                                WHERE a.status=1 AND ( a.id_status_property='1' OR a.id_status_property='2' OR a.id_status_property='3' OR a.id_status_property='4' OR a.id_status_property='5' )
                                    $condition
                                    $features
                                    AND (
                                        a.nama LIKE '%$search%'
                                        OR a.alamat LIKE '%$search%'
                                        OR a.deskripsi LIKE '%$search%'
                                    )
                                    GROUP BY a.id, a.nama, a.alamat, a.harga_jual
                                    $ordering
                                    LIMIT $start,$limit")->result();



        // Get  total jumlah data //

        // $get = $this->db->query("SELECT count(*) AS total_data

        //                             FROM manage_properti a 

        //                             LEFT JOIN (SELECT id_rumah, img_url, img_name 

        //                                 FROM ms_photo 

        //                                 WHERE cover=1 

        //                                 LIMIT 1) b ON a.id=b.id_rumah

        //                             LEFT JOIN (

        //                                 SELECT id_rumah, SUM(bedrooms) AS bedrooms, SUM(bathrooms) AS bathrooms 

        //                                     FROM (

        //                                     SELECT s.id_rumah, s.label AS bedrooms, '' AS bathrooms 

        //                                         FROM tb_properti_fasilitas s 

        //                                         JOIN ms_fasilitas a ON s.id_fasilitas=a.id

        //                                         WHERE (

        //                                             a.nama LIKE '%beds%'

        //                                             OR a.nama LIKE '%bedsroom%'

        //                                         )

        //                                     UNION ALL

        //                                     SELECT s.id_rumah, '' AS bedrooms, s.label AS bathrooms 

        //                                         FROM tb_properti_fasilitas s 

        //                                         JOIN ms_fasilitas a ON s.id_fasilitas=a.id

        //                                         WHERE (

        //                                             a.nama LIKE '%bathroom%'

        //                                             OR a.nama LIKE '%bathrooms%'

        //                                         )

        //                                 ) fasilitas

        //                                 GROUP BY id_rumah

        //                             ) fas ON a.id=fas.id_rumah

        //                             LEFT JOIN ms_status_transaksi_property t ON a.status_transaksi = t.id

        //                             WHERE a.status=1

        //                             $condition

        //                             $features

        //                             AND (

        //                                 a.nama LIKE '%$search%'
        //                                  OR a.alamat LIKE '%$search%'
        //                                 OR a.deskripsi LIKE '%$search%'

        //                             )")->row();
        $get = $this->db->query('SELECT FOUND_ROWS() AS ttl')->row();
        $total_data = isset($get->ttl) ? $get->ttl : '0';



        $arr = array();

        if (!empty($data)) {

            foreach ($data as $row => $val) {

                $data_fasilitas = $this->db->query("SELECT a.id_rumah, s.logo, s.nama AS fasilitas, a.label, s.satuan 
                                                    FROM tb_properti_fasilitas a 
                                                        JOIN ms_fasilitas s ON a.id_fasilitas=s.id
                                                    WHERE a.id_rumah='$val->id'
                                                        AND s.default=1
                                                        LIMIT 4")->result();



                $arr[$row] = array(
                    'id' => $val->id,
                    'nama' => $val->nama,
                    'alamat' => $val->alamat,
                    'harga_jual' => uang($val->harga_jual),
                    'harga_sewa' => uang($val->harga_sewa),
                    'image' => $val->img_url,
                    'name_status' => $val->name_status,
                    'fasilitas' => $data_fasilitas,
                    'name_status_trx' => $val->name_status_trx,
                    'status_transaksi' => $val->status_transaksi,
                    'status_property' => $val->status_property,
                    'nama_jalan' => $val->nama_jalan,
                    'premium' => $val->premium
                );
            }
        }



        $result = array(

            'data'      => $arr,

            'total_data' => $total_data

        );



        return $result;
    }



    function get_max_price_property()

    {

        return $this->db->query("SELECT MAX(harga_jual) AS max_price 

                                    FROM manage_properti")->row();
    }

    // --------------- End Property --------------- //



    // --------------- Master Option --------------- //

    function opt_type()

    {

        $data = $this->db->query("SELECT * FROM ms_category

                                    WHERE `status`=1

                                    ORDER BY category ASC")->result();

        $result[''] = ' All Type ';

        foreach ($data as $val) {

            $result[$val->id] = $val->category;
        }

        return $result;
    }



    function opt_status()

    {

        $data = $this->db->query("SELECT * FROM ms_status_property

                                    WHERE `status`=1

                                    ORDER BY name_status ASC")->result();

        $result[''] = ' All Status ';

        foreach ($data as $val) {

            $result[$val->id] = $val->name_status;
        }

        return $result;
    }



    function data_feature()

    {

        return $this->db->query("SELECT * FROM ms_feature 

                                    WHERE `status`=1

                                    ORDER BY nama ASC")->result();
    }

    // --------------- End Master Option --------------- //

    // --------------- Karir -------------------------- //
    function data_karir()
    {
        $data = $this->db->query("SELECT * FROM tb_image_karir

        WHERE `status`=1")->result();

        $html = '<div class="row">';

        if (!empty($data)) {

            foreach ($data as $val) {

                $html .= '<div class="col-lg-12 text-center" >
       
                <img style="height:500px;" class="img-fluid" src="' . $val->img_url . '" alt="' . $val->img_name . '">


       

        </div>';
            }
        }



        if (empty($data)) {

            $html .= '<div class="col-md-12 text-center"> --- no data available --- </div>';
        }



        $html .= '</div>';



        return $html;
    }
    // ------------- END KARIR ------------------------ //

    function get_video()
    {

        $result = '';

        $get = $this->db->query("SELECT * FROM tb_home_video
                                    WHERE `status`=1")->row();

        if (!empty($get)) {
            $result = isset($get->file_url) ? $get->file_url : '';
        }

        return $result;
    }

    function get_data_video()
    {

        $result = '';

        $get = $this->db->query("SELECT * FROM tb_home_video
                                    WHERE `status`=1")->row();

        if (!empty($get)) {
            $result = array(
                'link_youtube' => $get->file_url,
                'description' => $get->description
            );
        }

        return $result;
    }


    function get_about_us()
    {

        $get = $this->db->query("SELECT * FROM tb_about_us 
                                    WHERE `status` = 1")->row();

        return $get;
    }

    function get_why_us()
    {

        $get = $this->db->query("SELECT * FROM tb_why_us 
                                    WHERE `status` = 1")->result();

        return $get;
    }

    function get_milestones()
    {

        $get = $this->db->query("SELECT * FROM tb_milestones 
                                    WHERE `status` = 1")->result();

        return $get;
    }

    function get_footer()
    {

        $get = $this->db->query("SELECT alamat, email, phone, facebook_url, instagram_url,
                                    email_name, facebook_name, instagram_name
                                FROM tb_footer 
                                WHERE `status` = 1")->row();

        return $get;
    }

    function data_service_loan()
    {
        $data = $this->db->query("SELECT * FROM tb_data_loan_service WHERE `status`=1")->result();

        $html = '<div class="row">

                    <div class="col-lg-10 offset-lg-1">

                        <div id="faq" class="faq-accordion">
							<div class="card m-b-0">';

        $number_id = 0;

        if (!empty($data)) {

            foreach ($data as $val) {

                $html .= '
							<div class="card-header">
								
								<a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse' . $number_id . '">

                                ' . $val->judul . '

								</a>

							</div>
							
							<div id="collapse' . $number_id . '" class="card-block collapse">

								<div class="card-body p-text">

									' . $val->deskripsi . '

								</div>

							</div>';

                $number_id++;
            }
        }



        if (empty($data)) {

            $html .= ' <div class="row"><div class="col-md-12 text-center">--- no data available ---</div></div> ';
        }



        $html .= '        </div>
						</div>

                    </div>

                </div>';

        return $html;
    }

    function data_image_loan()
    {
        $data = $this->db->query("SELECT * FROM tb_image_loan

                                  WHERE `status`=1")->result();

        $html = '<div class="row">';

        if (!empty($data)) {

            foreach ($data as $val) {


                $html .= '<div class="col-sm-4 text-center" style="padding-right: 0px;padding-left: 0px; padding-bottom:50px; ">
                                <a href="#" class="btn-showmodal" data-toggle="modal" data-id="' . $val->id . '" data-target="#myModal">

                                    <div class="container" style="position: relative;
                                    margin: 0 auto;">
                                        <br><br>
                                        <img class="img-resp" style ="width:250px; height:400px;"src="' . $val->img_url . '" alt="' . $val->judul . '" >

                                        <div class="imagetext" style="position: absolute;margin-left: 65px;left: 0;bottom: 0;width: 66%;text-align: center;background: rgb(255, 140, 0); padding: 5px;
                                                                      border-top-left-radius: 0; border-top-right-radius: 0;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                            
                                            <p style="color: #ffffff; font-size: 14px;margin-top:7px;">' . $val->judul . '</p>
                                            
                                        </div>

                                    </div>

                                </a>
                               
                        </div>';
            }
        }



        if (empty($data)) {

            $html .= '<div class="col-md-12 text-center"> --- no data available --- </div>';
        }



        $html .= '</div>';



        return $html;
    }
    // function data_service_loan()
    // {
    //     $data = $this->db->query("SELECT * FROM tb_service_loan WHERE `status`=1")->result();
    //     $result = '';
    //     foreach ($data as $val) {
    //         $result.='<div class="col-lg-4 col-md-6 col-sm-12 filtr-item col-pad" data-category="1, 2">
    //                     <div class="portfolio-item">
    //                         <a href="'.$val->img_url.$val->img_name.'" title="'.$val->judul.'">
    //                             <img src="'.$val->img_url.$val->img_name.'" alt="img-'.$val->judul.'" class="img-responsive lazy">
    //                         </a>
    //                         <div class="portfolio-content">
    //                             <div class="portfolio-content-inner">
    //                                 <p>'.$val->judul.'</p>
    //                             </div>
    //                         </div>
    //                     </div>                    
    //                 </div>';
    //     }
    //     return $result;
    // }

    function opt_data_lowongan_kerja()
    {
        $data = $this->db->query("SELECT * FROM tb_lowongan_kerja WHERE `status`=1")->result();
        $result[''] = ' - Posisi - ';
        foreach ($data as $val) {
            $result[$val->id] = $val->posisi_pekerjaan;
        }
        return $result;
    }

    function jumlah_data_karir()
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM tb_lowongan_kerja
                                    WHERE `status`=1")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah : 0;
        return $jumlah;
    }

    function data_lowongan_kerja($limit = '', $start = '0')
    {
        $result = '';

        if ($start == '') {
            $start = 0;
        }

        $data = $this->db->query("SELECT * FROM tb_lowongan_kerja
                                    WHERE `status`=1
                                    LIMIT $start,$limit")->result();
        if (!empty($data)) {
            foreach ($data as $row => $val) {
                $bgcolor = 'background:#fCfCfC;border-bottom:2px solid #FCFCF6;';
                if ($row % 2 == 0) {
                    $bgcolor = '';
                }
                $result .= '<div class="row on-top-5" style="' . $bgcolor . 'padding-top:12px;padding-bottom:10px;">
                            <div class="col-md-12">
                                <h4>' . $val->posisi_pekerjaan . '</h4>
                                <br>
                                <p>' . nl2br($val->keterangan) . '
                                <br>
                                <br>
                                ' . nl2br($val->persyaratan) . '</p>
                            </div>
                        </div>';
            }
        } else {
            $result .= '<div class="row"><div class="col-md-12 text-center">--- no data available ---</div></div>';
        }

        return $result;
    }

    function get_premium()
    {

        $get = $this->db->query("SELECT * FROM manage_properti 
		WHERE due_date < '" . date('Y-m-d') . "' AND premium = '1'")->result();

        return $get;
    }

    function get_loan($id = '')
    {

        $n = $this->db->query("SELECT * from tb_image_loan where id='" . $id . "'")->row();

        $output = array(
            "judul" => $n->judul,
            "deskripsi" => $n->deskripsi
        );
        echo json_encode($output);
    }

    function get_platform()
    {
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        $platform = $this->agent->platform();

        return array(
            'agent' => $agent,
            'platform' => $platform
        );
    }
    function get_visitor()
    {
        $ip = $this->input->ip_address();
        $date = date('Y-m-d');

        $p = $this->get_platform();
        $agent = $p['agent'];
        $platform = $p['platform'];

        $q = $this->db->where('ip', $ip)
            ->where('tanggal', $date)
            ->get('tb_visitor')
            ->row();

        if (empty($q)) {
            $data = array(
                'ip' => $ip,
                'platform' => $platform,
                'agent' => $agent,
                'tanggal' => $date
            );
            $this->db->insert('tb_visitor', $data);
        }
    }
}
