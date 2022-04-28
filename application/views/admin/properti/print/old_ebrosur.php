 <div class="container">
        <div id="brochure">  <!-- class="col-md-12" -->
            <img src="<?php echo base_url('assets/img/template/DESAIN E BROSUR.jpg'); ?>" 
                class="responsive img-fluid"> <!-- border: 50px; border-color: grey; -->

            <div class="status-properti"> 
                <b>
                    <?php 

                        $status_properti = isset($data->id_status_property) ? $data->id_status_property : '' ;

                        switch ($status_properti) {
                            case 1:
                                $status_text = 'DIJUAL';
                                break;
                            case 2:
                                $status_text = 'DISEWA';
                                break;
                            default:
                                $status_text = '';
                                break;
                        }
                                
                        echo $status_text;
                            
                    ?> </b> 
            </div>

            <table class="content">  <!-- border="1" -->
                <tr>
                    <td rowspan="2">
                        <img src="<?php echo isset($foto->img_url) ? $foto->img_url : ''; ?>" class="property_img" height="230px">
                    </td>
                    <td class="judul"> 
                        <!-- <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12"> -->
                            <?php echo isset($data->nama) ? '<b>'.strtoupper($data->nama).'</b>' : ''; ?> 
                        <!-- </div> -->
                    </td>
                </tr>
                
                <tr>
                    <td class="fasilitas"> 
                        <?php 

                        /*     echo "<pre>";
                                print_r ($fasilitas);
                            echo "</pre>"; */

                            if (isset($fasilitas)) {
                                $i = 1;
                                echo '<table class="tb-fasilitas">
                                        <tr>';
                                
                                foreach ($fasilitas as $row => $val) {

                                    echo '<td style="padding-left: 10px;"> <b>'.$val->nama.'</b> </td>
                                        <td> : '.$val->label.' '.$val->satuan.'</td>';

                                    if ($i % 3 == 0) {
                                        echo '</tr> <tr>';
                                    } 

                                    $i++;
                                    
                                }

                                
                                echo '</tr> </table>';
                            }    
                        
                        ?>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="padding-top: 15px; font-size: 12px;">
                            <?php echo isset($data->full_furnish) && $data->full_furnish != "" ? 'Full Furnish : '.$data->full_furnish : ''; ?>
                        </div>
                    </td>
                </tr>
                

                <tr>
                    <td class="harga"> <?php echo isset($data->harga_jual) ? 'Rp '.number_format($data->harga_jual, 0, "", ".").',-' : ''; ?> </td>
                    <td> 
                        <table class="tb-footer">  <!-- border="1" -->
                            <tr>
                                <td class="qr"> 
                                    <div id="qrcode"></div> 
                                    <div class="scan"> <b>SCAN ME</b> </div>
                                </td>
                                <td class="kontak-agen">
                                    <?php echo isset($kontak->fullname) ? '<b>'.$kontak->fullname.'</b> <br>' : ''; ?>
                                    <?php echo isset($kontak->email) ? $kontak->email.'<br>' : ''; ?>
                                    <?php echo isset($kontak->phone) ? $kontak->phone : ''; ?>
                                </td>
                                <td class="foto-agen">
                                    <img src="<?php echo isset($kontak->profile_img) ? $kontak->profile_img : ''; ?>" width="100px">
                                    
                                </td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
                
                

            </table>

            
        </div>

        

        

    </div>



<script type="text/javascript">
    var qrcode = new QRCode("qrcode", {
        text: "http://jindo.dev.naver.com/collie",
        width: 70,
        height: 70,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    qrcode.clear();
    qrcode.makeCode("<?php echo base_url('Main/detail_property?q='.$data->id);?>");
    // new QRCode(document.getElementById("qrcode"), "http://jindo.dev.naver.com/collie");


</script>