<body>

    <div class="container">
        <div id="brochure">  <!-- class="col-md-12" -->
            <img src="<?php echo FCPATH.'assets/img/template/DESAIN E BROSUR.jpg'; ?>" class="responsive-img"> 
            <!-- border: 50px; border-color: grey; -->

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
                            case 3:
                                $status_text = 'TERJUAL';
                                break;
                            case 4:
                                $status_text = 'TERSEWA';
                                break;
                            case 5:
                                $status_text = '<div style="font-size: 65px; margin-left: 25%;"> DIJUAL / DISEWA </div>';
                            break;
                            default:
                                $status_text = '';
                                break;
                        }
                                
                        echo $status_text;
                            
                    ?> </b> 
            </div>

            <table class="content"> <!-- border="1" -->
                <tr>
                    <td> 
                        <center>
                            <img src="<?php echo isset($foto->img_url) ? FCPATH.'assets/img/property/'.$foto->img_name : ''; ?>" class="property-img" height="330px"> 
                        </center>
                    </td>
                    <td style="width: 50%;">  </td>
                </tr>

                <tr>
                <?php
                    $keterangan_sewa = '';
                    if (empty($sewa->id_periode_sewa)) { //  === NULL
                        $keterangan_sewa = '';
                    } else {
                        $keterangan_sewa = '/ ' . lcfirst($sewa->periode);
                    }


                    if ($status_properti == "1" || $status_properti == "3") { // Jual: Sell / Sold
                ?>

                    <td class="harga"> 
                        <div class="harga-text">
                            <?php echo isset($data->harga_jual) ? '<b> Rp '.number_format($data->harga_jual, 0, "", ".").' </b>' : ''; ?> 
                        </div>
                    </td>

                <?php

                    } else if ($status_properti == "2" || $status_properti == "4") { // Sewa: Rent / Rented
                ?>

                    <td class="harga"> 
                        <?php echo isset($data->harga_sewa) ? '<b> Rp '.number_format($data->harga_sewa, 0, "", ".").' </b>'.'<b>'.$keterangan_sewa.'</b>' : ''; ?>  
                    </td>
                
                <?php
                        
                    } else if ($status_properti == "5") { // Bisa Jual, bisa Sewa: Sell / Rent  
                ?>

                    <td class="harga" style="font-size: 32px;"> 
                        <?php echo isset($data->harga_jual) ? 'Jual:<b> Rp '.number_format($data->harga_jual, 0, "", ".").' </b>' : ''; ?> <br>
                        <?php echo isset($data->harga_sewa) ? 'Sewa:<b> Rp '.number_format($data->harga_sewa, 0, "", ".").' </b>'.'<b>'.$keterangan_sewa.'</b>' : ''; ?>  
                    </td>

                <?php
                    } else {   
                ?>

                    <td class="harga"> 
                        <?php echo isset($data->harga_jual) ? '<b> Rp '.number_format($data->harga_jual, 0, "", ".").' </b>' : ''; ?> 
                    </td>

                <?php
                    }
                ?>
                </tr>
            </table>

            <table class="content">  <!-- border="1" -->
                <tr>
                    <td rowspan="2" style="width: 50%; height: 42%;">
                        <center>
                            <!-- <img src="<?php echo isset($foto->img_url) ? FCPATH.'assets/img/property/'.$foto->img_name : ''; ?>"  height="300px" style="display: none;">  -->
                        </center>
                    </td>

                    <td class="fasilitas"> 
                        <div>  <!-- class="judul-top" -->
                            <table class="property-title"> <!--  border="1" -->
                                <tr>
                                    <td class="judul">   
                                            <?php echo isset($data->nama) ? '<b>'.strtoupper($data->nama).'</b>' : ''; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="nama-jalan"> <?php echo isset($data->nama_jalan) ? $data->nama_jalan : ''; ?>  </td>
                                </tr>
                            </table>
                        </div>

                        <div> <!-- style="height: 125px" -->
                            <?php 

                            /*     echo "<pre>";
                                    print_r ($fasilitas);
                                echo "</pre>"; */

                                if (isset($fasilitas)) {
                                    $i = 1;
                                    echo '<table class="tb-fasilitas">
                                            <tr style="font-size: 18px;">';
                                    
                                    foreach ($fasilitas as $row => $val) {

                                        // if (!empty($val->label)) { 
// 
                                            echo '<td style="padding-left: 10px; font-size: 18px;"> <b>'.$val->nama.'</b> </td>
                                                <td style="font-size: 18px;"> : '.$val->label.' '.$val->satuan.'</td>';

                                        /* } else {
                                            echo '<td style="display: none;"></td> 
                                                <td style="display: none;"></td>';
                                        } */

                                        if ($i % 2 == 0) {
                                            echo '</tr> <tr>';
                                        } 

                                        $i++;
                                        
                                    }

                                    
                                    echo '</tr> </table>';
                                }    
                            
                            ?>
                        </div>
                        <div style="padding-top: 15px; padding-left: 10px; font-size: 18px; height: 50px;">
                            <?php echo isset($data->full_furnish) && $data->full_furnish != "" ? nl2br($data->full_furnish) : ''; ?>
                        </div>
                    </td>

                </tr>
                
                <tr> </tr>
                

                <tr>
                   
                    <td class="harga"> </td>
                    <td> 
                        <table class="tb-footer">  <!-- border="1"  -->
                            <tr>
                                <td class="qr"> 
                                    <div id="qrcode">
                                        <img src="<?php echo FCPATH.'assets/ebrosur/qrcode/qr_'.$data->id.'.png'; ?>" width="70px" height="70px"> 
                                    </div> 
                                    <div class="scan"> <b>SCAN ME</b> </div>
                                </td>
                                <td class="kontak-agen">
                                    <?php echo isset($kontak->fullname) ? '<b>'.$kontak->fullname.'</b> <br>' : ''; ?>
                                    <?php echo isset($kontak->email) ? $kontak->email.'<br>' : ''; ?>
                                    <?php echo isset($kontak->phone) ? $kontak->phone : ''; ?>
                                </td>
                                <td class="foto-agen">
                                    <img src="<?php echo isset($kontak->profile_img) ? FCPATH.'assets/img/consultant/'.$kontak->foto_agen : ''; ?>" width="180px">
                                    
                                </td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
                
                

            </table>

            
        </div>



</body>

<style>

    * {
        padding: 0px;
        margin: 0px;
    }

    .container {
        width: 100%;
        /* position: relative;
        color: white;
        top: 0;
        left: 0; */
        /* margin-top: 120px; */
    }

    .container #brochure {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .responsive-img {
        width: 100%;
        position: absolute;
        /* max-width: 1366px;
        height: 500px; */
    }

    .status-properti {
        font-family: "Arial Black", Gadget, sans-serif;
        font-size: 100px;
        color: white;
        letter-spacing: 2px;
        text-shadow: 4px -4px 3px rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    table.content {
        position: absolute;
        width: 90%;
        top: 28%;
        left: 5%;
    }

    tr > td.harga {
        text-align: center;
        padding-top: 12px;
        font-family: "Arial Black", Gadget, sans-serif;
        font-size: 40px;
    }

    tr > td.harga > .harga-text {
        display: block;
        height: 15px;
        padding-top: -5px;
    }

    tr > td img.property-img {
        /* text-align: center; */
        max-width: 370px;
        /* height: 330px; */
        display: block;
        /* margin-left: 0;
        margin-right: 0; */
    }

    tr > td.judul {
        position: relative;
        top: 0;
        padding-left: 10px;
        vertical-align: top;
        word-wrap: break-word;
        max-width: 400px;
        padding-bottom: 20px;
        font-size: 22px;
        /* height: 10px; */
        /* padding-bottom: -500px; */
    }

    tr > td.nama-jalan {
        position: relative;
        top: 0;
        padding-left: 10px;
        vertical-align: top;
        word-wrap: break-word;
        max-width: 400px;
        padding-bottom: 20px;
        font-size: 18px;
    }

    /* tr > td > .judul-top {
        font-size: 22px;
        height: 10px;
    } */

    table.tb-fasilitas {
        font-size: 14px;
    }

    tr > td.fasilitas {
        vertical-align: top;
    }

    /* tr > td.fasilitas > .row {
        margin-left: 0;
        margin-right: 0;
    } */

    table.tb-footer {
        width: -webkit-fill-available;
    }

    tr > td.qr {
        text-align: center;
        padding-bottom: 160px;
    }

    tr > td.kontak-agen {
        text-align: right;
        padding-bottom: 150px;
        /* padding: 10px; */
        /* max-width: 82px; */
    }

    tr > td.foto-agen {
        text-align: center;
        padding-bottom: 100px;
    }

    tr > td.qr > #qrcode > img {
        /* margin-left: auto;
        margin-right: auto; */
    }

    tr > td.qr > .scan {
        font-family: "Arial Black", Gadget, sans-serif;
        color: #ff9201;
    }

</style>