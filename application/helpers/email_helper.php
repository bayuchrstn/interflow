<?php 

    function broadcast_mail($id_property) {
        $CI =& get_instance();

        $CI->load->model('Master_Model');
        $CI->load->model('Model_user');
        $CI->load->model('Model_manage_properti');
        $CI->load->model('Main_model');

        $email = $CI->Master_Model->view_email_subscriber()->result();
        $mail_data = array();
        $mail_id = array();

        
        $property = $CI->Model_manage_properti->get_bangunan_id($id_property)->row();
        $img_property = $CI->Model_manage_properti->get_image_cover($id_property)->row();

        $nama_property = $property->nama;
        $image_url = $img_property->img_url;
        $link = base_url('Main/detail_property?q='.$id_property);

        $from = 'noreply@interflow.co.id';
        $to = 'subscribers@interflow.co.id';
        $bcc = ''; // $mail_data
        $cc = '';

        $subject = '#'.$id_property.' - New Property';
        $sender_name = 'Interflow Property';

        $dt_footer = $CI->Main_model->get_footer();


        $address = isset($dt_footer->alamat) ? $dt_footer->alamat : '';
        $interflow_email = isset($dt_footer->email) ? $dt_footer->email : '';
        $phone = isset($dt_footer->phone) ? $dt_footer->phone : '';
        $nama_email = isset($dt_footer->email_name) ? $dt_footer->email_name : '';
        $nama_fb = isset($dt_footer->facebook_name) ? $dt_footer->facebook_name : '';
        $nama_ig = isset($dt_footer->instagram_name) ? $dt_footer->instagram_name : '';

        $logo_url = base_url().'assets/img/logos/logowarna.png';
        $fb_url = isset($dt_footer->facebook_url) ? $dt_footer->facebook_url : '';
        $ig_url = isset($dt_footer->instagram_url) ? $dt_footer->instagram_url : '';

        $icon_pin = base_url().'assets/img/flat-fa-icon/location-pin.png';
        $icon_mail = base_url().'assets/img/flat-fa-icon/mail.png';
        $icon_phone = base_url().'assets/img/flat-fa-icon/phone.png';
        $icon_fb = base_url().'assets/img/flat-fa-icon/facebook.png';
        $icon_ig = base_url().'assets/img/flat-fa-icon/instagram.png';


        $footer = '<div class="footer-item clearfix" style="background-color: white;">
                        <img src="'.$logo_url.'" alt="logo" style="width: 150px;">
                        <table border="0">
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_pin.'" style="width: 20px;">  </td>
                                <td> </td>
                                <td>'.$address.'</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_mail.'" style="width: 20px;"> </td>
                                <td> </td>
                                <td> <a href="mailto:'.$interflow_email.'">'.$nama_email.'</a> </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_phone.'" style="width: 17px;"> </td>
                                <td> </td>
                                <td>'.$phone.'</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_fb.'" style="width: 25px;"> </td>
                                <td> </td>
                                <td> <a href="'.$fb_url.'" target="__blank">'.$nama_fb.'</a> </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_ig.'" style="width: 25px;"> </td>
                                <td> </td>
                                <td> <a href="'.$ig_url.'" target="__blank">'.$nama_ig.'</a> </td>
                            </tr>
                        </table>
                    </div>';



                    /* <ul style="list-style-type: none;">
                            <li style="position: relative; padding-right: 30px;">
                                <img src="'.$icon_pin.'" style="width: 20px;"> '.$address.'
                            </li>
                            <li style="position: relative; padding-right: 30px;">
                                <img src="'.$icon_mail.'" style="width: 20px;">
                                <a href="mailto:'.$interflow_email.'">'.$interflow_email.'.</a>
                            </li>
                            <li style="position: relative; padding-right: 30px;">
                                <img src="'.$icon_phone.'" style="width: 20px;">'.$phone.'
                            </li>
                            <li style="position: relative; padding-right: 30px;">
                                <img src="'.$icon_fb.'" style="width: 25px;">
                                <a href="'.$fb_url.'">Facebook</a>
                            </li>
                            <li style="position: relative; padding-right: 30px;">
                                <img src="'.$icon_ig.'" style="width: 25px;">
                                <a href="'.$ig_url.'">Instagram</a>
                            </li>
                        </ul> */


        if (!empty($email)) {

            foreach ($email as $row => $val) {
                $link_unsubscribe = base_url().'Main/unsubscribe_email/'.$val->id; 

                $message = "<h3 style='font-size: 30px; font-weight: 600;'>".$nama_property."</h3> 
                                Detail Property: <a href='".$link."' target='__blank'>".$link."</a>
                                <br> <br>
                                <div style='width: 100%; position: relative; display: inline-block;'>
                                        <img src='".$image_url."' style='width:400px;'>
                                </div> <br> <br> <br> <br>
                            Bila Anda ingin berhenti berlangganan (Unsubscribe), silahkan klik <a href='".$link_unsubscribe."' target='__blank'>disini</a>. <br> <br> 
                                <hr style='border: 0.5px solid; margin-bottom: 20px; border-color: #d8dade3b;'>".$footer; 

                $CI->Model_user->kirim_email_broadcast($to, $val->email, $message, $subject, $from, $sender_name, $bcc);

                $msg_without_html = strip_tags($message);

                $data = array(
                    'head' => $subject,
                    'cc' => $val->email,
                    'isi' => $msg_without_html, // $message
                    'status' => 1
                );

                $CI->Main_model->proses_data('tb_subscribe_mail', $data);

                /* $mail_data[$row] = $val->email;
                $mail_id[$row] = $row; */
            }

        }




        /* $message = "<h3 style='font-size: 30px; font-weight: 600;'>".$nama_property."</h3> 
                        Detail Property: <a href='".$link."' target='__blank'>".$link."</a>
                        <br> <br>
                        <div style='width: 100%; position: relative; display: inline-block;'>
                                <img src='".$image_url."' style='width:400px;'>
                        </div>
                        Jika Anda ingin berhenti berlangganan (Unsubscribe), silahkan klik disini."; */

                    /* <a href='".$image_url."'>  </a>*/

        

        /* if (!empty($email)) {
            $CI->Model_user->kirim_email_broadcast($to, $cc, $message, $subject, $from, $sender_name, $bcc);
        } */

    }



    function footer_email() {
        $CI =& get_instance();

        $CI->load->model('Master_Model');
        $CI->load->model('Model_user');
        $CI->load->model('Model_manage_properti');
        $CI->load->model('Main_model');

        $dt_footer = $CI->Main_model->get_footer();


        $address = isset($dt_footer->alamat) ? $dt_footer->alamat : '';
        $interflow_email = isset($dt_footer->email) ? $dt_footer->email : '';
        $phone = isset($dt_footer->phone) ? $dt_footer->phone : '';
        $nama_email = isset($dt_footer->email_name) ? $dt_footer->email_name : '';
        $nama_fb = isset($dt_footer->facebook_name) ? $dt_footer->facebook_name : '';
        $nama_ig = isset($dt_footer->instagram_name) ? $dt_footer->instagram_name : '';

        $logo_url = base_url().'assets/img/logos/logowarna.png';
        $fb_url = isset($dt_footer->facebook_url) ? $dt_footer->facebook_url : '';
        $ig_url = isset($dt_footer->instagram_url) ? $dt_footer->instagram_url : '';

        $icon_pin = base_url().'assets/img/flat-fa-icon/location-pin.png';
        $icon_mail = base_url().'assets/img/flat-fa-icon/mail.png';
        $icon_phone = base_url().'assets/img/flat-fa-icon/phone.png';
        $icon_fb = base_url().'assets/img/flat-fa-icon/facebook.png';
        $icon_ig = base_url().'assets/img/flat-fa-icon/instagram.png';


        $footer = '<div class="footer-item clearfix" style="background-color: white;">
                        <img src="'.$logo_url.'" alt="logo" style="width: 150px;">
                        <table border="0">
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_pin.'" style="width: 20px;">  </td>
                                <td> </td>
                                <td>'.$address.'</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_mail.'" style="width: 20px;"> </td>
                                <td> </td>
                                <td> <a href="mailto:'.$interflow_email.'">'.$nama_email.'</a> </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_phone.'" style="width: 17px;"> </td>
                                <td> </td>
                                <td>'.$phone.'</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_fb.'" style="width: 25px;"> </td>
                                <td> </td>
                                <td> <a href="'.$fb_url.'" target="__blank">'.$nama_fb.'</a> </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"> <img src="'.$icon_ig.'" style="width: 25px;"> </td>
                                <td> </td>
                                <td> <a href="'.$ig_url.'" target="__blank">'.$nama_ig.'</a> </td>
                            </tr>
                        </table>
                    </div>';


        echo $footer;

    }


?>