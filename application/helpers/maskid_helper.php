<?php

// ini hanya untuk menjaga agar kerahasiaan id yang asli bisa dihilangkan

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @param maskid ini digunakan untuk mengamankan id agar tidak terlihar aslinya
 */
 /**
 * @param $id is integer
 * NOTE: untuk mengkonversi id menjadi angka lain
 */
 if (!function_exists('send_id')) {
   function send_id($id='')
   {
       $date_init = new DateTime(date('Y-m-d'));
       $time = $date_init->getTimestamp();
       $date = getdate();
       $baru = $id * $date['year'] * $date['mon'] * $date['mday'];
       return ($baru + $time)*$date['hours'];
   }
 }

 /**
 * @param $id is integer
 * NOTE: untuk menerima angka menjadi id
 */
 if (!function_exists('receive_id')) {
   function receive_id($id='')
   {
       $date_init = new DateTime(date('Y-m-d'));
       $time = $date_init->getTimestamp();
       $date = getdate();
       $div = $id / $date['hours'];
       $new_id = $div - $time;
       return (($new_id/$date['year'])/$date['mon'])/$date['mday'];
   }
 }