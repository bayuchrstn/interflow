<?php
function now()
{
    $ci =& get_instance();

    $query = $ci->db->query("SELECT NOW() AS time")->row();

    return isset($query->time) ? $query->time : '';
}

function tgl_indo($date = '')
{
    if ($date <> '') {
        $date = date_create($date);

        $tanggal = date_format($date, 'd');
        $tahun = date_format($date, 'Y');
        $bulan = date_format($date, 'n');

        $bulan = convert_bulan($bulan);

        return $tanggal.' '.$bulan.' '.$tahun;
    } else {
        return '';
    }
}

function convert_bulan($month = '')
{
    $month = (int)$month;
    if ($month <> '' && $month <= 12 && $month > 0) {
        $bulan = list_bulan();

        return isset($bulan[$month]) ? $bulan[$month] : '';
    } else {
        return '';
    }
}

function list_bulan()
{
    $bln = array(
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );

    return $bln;
}

// date range to date -
// pecah senin - minggu
function weekly_range($date_start = '', $date_end = '')
{
    if ($date_start <> '' && $date_end <> '') {
        $mulaix = round(strtotime($date_start) / 60 / 60 / 24);
        $sampaix = round(strtotime($date_end) / 60 / 60 / 24);
        $selisih = $sampaix - $mulaix + 1;
       
        $w2 = $w = 0;
        $arr = array();

        for ($q = $mulaix; $q <= $sampaix; $q++) {
            $w2++;
            $hr = date('w', ($q * 60 * 60 * 24));
            $pls = $q + (7 - ($hr));
            if ($w2 == 1 or $hr == 1) {
                $t = strftime("%Y-%m-%d", ($q * 60 * 60 * 24));
                $tt1 = strftime("%Y-%m-%d", ($q * 60 * 60 * 24));
                $r = date('w', strtotime($tt1));
                $t3 = strftime("%Y-%m-%d", ($pls * 60 * 60 * 24));
                $t4 = round(strtotime($t3) / 60 / 60 / 24);
                
                if ($r == 0) {
                    $t2 = strftime("%Y-%m-%d", ($q * 60 * 60 * 24));
                    $tt2 = strftime("%Y-%m-%d", ($q * 60 * 60 * 24));
                } elseif ($t4 > $sampaix) {
                    $t2 = strftime("%Y-%m-%d", ($sampaix * 60 * 60 * 24));
                    $tt2 = strftime("%Y-%m-%d", ($sampaix * 60 * 60 * 24));
                } else {
                    $t2 = strftime("%Y-%m-%d", ($pls * 60 * 60 * 24));
                    $tt2 = strftime("%Y-%m-%d", ($pls * 60 * 60 * 24));
                }
                // $arr[] = $t.' sd '.$t2;
                $arr[] = array(
                    'awal' => $t,
                    'akhir' => $t2
                );
            }

            if ($hr == 1) {
                $w++;
            }
        }
        
        $panjang = count($arr);
        if ($panjang == 0) {
            $panjang = 1;
        }

        $week   = array();
        for ($a = 0; $a < $panjang; $a++) {
            array_push($week, $arr[$a]);
        }
        // return to array
        return $week;
    } else {
        return '';
    }
}

function range_to_date($date_start = '', $date_end = '')
{
    $tanggal = array();
    while (strtotime($date_start) <= strtotime($date_end)) {
            $tanggal[] = $date_start;
            $date_start = date("Y-m-d", strtotime("+1 day", strtotime($date_start)));
    }
    return $tanggal;
}

function hari($tanggal = '', $style = '1')
{
    $date = date('w', strtotime($tanggal));
    if ($tanggal != '') {
        $hari = list_hari($style);

        return isset($hari[$date]) ? $hari[$date] : '';
    } else {
        return '';
    }
}

function list_hari($style = '1')
{
    if ($style == 1) {
        $arr = array(
            '0' => 'Minggu',
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu'
        );
    } else {
        $arr = array(
            '0' => 'Min',
            '1' => 'Sen',
            '2' => 'Sel',
            '3' => 'Rab',
            '4' => 'Kam',
            '5' => 'Jum',
            '6' => 'Sab'
        );
    }

    return $arr;
}

function convert_tgl($tanggal = '')
{
    if ($tanggal != '' && $tanggal != '0000-00-00') {
        $tgl_ex = explode("/", $tanggal);
        $result = $tgl_ex[2] . "-" . $tgl_ex[1] . "-" . $tgl_ex[0];
    } else {
        $result = '';
    }

    return $result;
}

function convert_datetime($datetime = '')
{
    $result = '';
    if ($datetime != '') {
        $datetime_ex = explode(' ', $datetime);

        # tanggal
        $tanggal = isset($datetime_ex[0]) ? $datetime_ex[0] : '';

        # jam
        $jam = isset($datetime_ex[1]) ? $datetime_ex[1] : '';

        $tanggal = convert_tgl($tanggal);

        $result = $tanggal.' '.$jam;
    }

    return $result;
}

function tanggal($tanggal = '')
{
    if ($tanggal != '' && $tanggal != '0000-00-00') {
        $create = date_create($tanggal);
        $result = date_format($create, "d/m/Y");
    } else {
        $result = '';
    }

    return $result;
}

function jam($param = '')
{
    return date('H:i', strtotime($param));
}

function hitung_jam($start = '', $end = '')
{
    $result = 0;
    $ci =& get_instance();
    if ($start != '' && $end != '') {
        $query = $ci->db->query("
                    SELECT 
                    TIMESTAMPDIFF(HOUR, '$start', '$end') AS jumlah")->row();

        $result = isset($query->jumlah) ? $query->jumlah : 0;
    }

    return $result;
}

function hitung_menit($start = '', $end = '')
{
    $result = 0;
    $ci =& get_instance();
    if ($start != '' && $end != '') {
        $query = $ci->db->query("
                    SELECT 
                    TIMESTAMPDIFF(MINUTE, '$start', '$end') AS jumlah")->row();

        $result = isset($query->jumlah) ? $query->jumlah : 0;
    }

    return $result;
}
