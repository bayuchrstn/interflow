<section id="breadcrumb">
    <div class="container breadcrumb-area">
        <div class="breadcrumb-areas">
            <ul class="breadcrumbs">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li class="active"><?= isset($title) ? $title : ''; ?></li>
            </ul>
        </div>
    </div>
</section>



<div class="properties-details-page content-area-6" style="padding:140px 0 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slider slider-single">
                    <?php

                    if (isset($detail['slide'])) {

                        foreach ($detail['slide'] as $k => $row) {

                            if (!empty($row)) {

                                if (!empty($row->img_name)) {
                    ?>
                                    <div style="width:100%;position:relative;">
                                        <a href="<?= $row->img_url ?>">
                                            <?php
                                            if ($detail['premium'] == 1) {
                                                echo '<img src="../assets/img/premium.png" style=" height:100px;right:0;position:absolute;">';
                                            } else if ($detail['star'] == 1) {
                                                echo '<img src="../assets/img/starproperti.png" style=" height:50px; right:0;position:absolute;margin-top:10px">';
                                            }
                                            ?>
                                            <img src="<?= $row->img_url ?>" class="img-fluid mx-auto" style="width:100%;">
                                        </a>
                                    </div>

                    <?php
                                }
                            }
                        }
                    }
                    ?>

                </div>

                <div class="slider slider-nav">
                    <?php

                    $no = 0;

                    if (isset($detail['slide'])) {

                        foreach ($detail['slide'] as $k => $row) {

                            $selected = null;
                            if (!empty($row)) {

                                if (!empty($row->img_name)) {

                                    if ($row->cover == 1) {
                                        $selected = ' class="selected" ';
                                    } ?>

                                    <div>
                                        <a id="carousel-selector-<?= $no ?>" <?= $selected ?> data-slide-to="<?= $no ?>">
                                            <img src="<?= base_url(); ?>assets/img/property/<?= $row->img_name ?>" class="img-fluid" style="height: 90px;">
                                        </a>
                                    </div>

                    <?php

                                }
                            }

                            $no++;
                        }
                    }

                    ?>

                </div>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <h3 class="judul"><?= isset($detail['nama']) ? $detail['nama'] : ''; ?></h3>
                <h6 class="judul-address">
                    <?=
                        isset($detail['nama_jalan']) ? $detail['nama_jalan'] : '';
                    // $detail['alamat']
                    ?>
                </h6>

                <input type="hidden" id="flag" value="<?= isset($detail['flag']) ? $detail['flag'] : ''; ?>">

                <?php
                $status_property = isset($detail['status_property']) ? $detail['status_property'] : '';

                $keterangan_sewa = '';

                if (isset($detail['sewa'])) {

                    foreach ($detail['sewa'] as $k => $row) {

                        if ($row->id_periode_sewa === NULL) {
                            $keterangan_sewa = '';
                        } else {
                            $keterangan_sewa = ' / ' . lcfirst($row->periode);
                        }
                    }
                }

                $keterangan_jual_tanah = '';

                if (isset($detail['tipe_jual_tanah'])) {

                    foreach ($detail['tipe_jual_tanah'] as $k => $row) {

                        if ($row->id_tipe_jual_tanah === NULL) {
                            $keterangan_jual_tanah = '';
                        } else {

                            if ($row->id_tipe_jual_tanah == 2) {
                                $keterangan_jual_tanah = ' / ' . $row->nama_tipe_jual_tanah;
                            } else {
                                $keterangan_jual_tanah = '';
                            }
                        }
                    }
                }


                if (isset($detail['harga_jual']) || isset($detail['harga_sewa'])) {


                    if ($status_property == "1" || $status_property == "3") { // Jual: Sell / Sold
                        $harga = $detail['harga_jual'];
                    } else if ($status_property == "2" || $status_property == "4") { // Sewa: Rent / Rented
                        $harga = $detail['harga_sewa'];
                    } else if ($status_property == "5") { // Bisa Jual, bisa Sewa: Sell / Rent  
                        $harga_jual = $detail['harga_jual'];
                        $harga_sewa = $detail['harga_sewa'];
                    } else {
                        $harga = $detail['harga_jual'];
                    }
                }

                ?>

                <?php if ($status_property == "1" || $status_property == "3" || $status_property == "2" || $status_property == "4") { ?>

                    <h3 class="judul-harga">Rp <?= isset($harga) ? $harga . $keterangan_jual_tanah . $keterangan_sewa : ''; ?>

                    <?php } else if ($status_property == "5") { ?>

                        <h3 class="judul-harga" style="margin-bottom: 10px;">
                            <font style="font-size:20px;" color="#575757">Jual:</font> <br> Rp <?= isset($harga_jual) ? $harga_jual . $keterangan_jual_tanah : ''; ?>
                            <h3 class="judul-harga">
                                <font style="font-size:20px;" color="#575757">Sewa:</font> <br> Rp <?= isset($harga_sewa) ? $harga_sewa . $keterangan_jual_tanah . $keterangan_sewa : ''; ?>
                                <!-- '<font style="font-size:23px;"> </font>' -->

                            <?php } else { ?>

                                <h3 class="judul-harga">Rp <?= isset($harga) ? $harga . $keterangan_jual_tanah . $keterangan_sewa : ''; ?>

                                <?php } ?>


                                <?php
                                $keterangan_status_transaksi = '';

                                if (isset($detail['status_transaksi'])) {

                                    if ($detail['status_transaksi'] == 0 || $detail['status_transaksi'] == '') {
                                        $keterangan_status_transaksi = '';
                                    } else {
                                        $keterangan_status_transaksi = '<span class="badge badge-danger d-block" style="margin-top: 5%;"> ' . $detail['name_status_trx'] . ' </span>';
                                    }
                                }

                                echo $keterangan_status_transaksi;
                                ?>
                                </h3>

                                <div class="col-lg-12 col-md-12" style="padding-right: 0px;padding-left: 0px;">
                                    <h3>Details</h3>
                                    <div class="ts-box">

                                        <dl class="ts-description-list__line mb-0">
                                            <dt>ID:</dt>
                                            <dd>#<?= isset($detail['id']) ? $detail['id'] : ''; ?></dd>
                                            <?php

                                            if (isset($detail['fasilitas'])) {

                                                foreach ($detail['fasilitas'] as $k => $row) { 

                                                    if (!empty($row->label)) { 
                                            ?>
                                                        <dt><?= $row->fasilitas ?></dt>
                                                        <dd><?= $row->label ?> <?= $row->satuan ?></dd>

                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </dl>

                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-8 col-xs-8 calculator">
                                    <button type="button" onclick=open_calc(); class="nav-link link-color">Mortgage Calculator</button>
                                </div>

            </div>
        </div>
    </div>
</div>

<section id="content">
    <div class="container">
        <div class="row flex-wrap-reverse">
            <!-- Left side -->
            <div class="col-md-5 col-lg-4">
                <section class="contact-the-agent">
                    <h3>Property Consultant</h3>
                    <div class="ts-box">

                        <!--Agent Image & Phone-->
                        <div class="ts-center__vertical mb-4">
                            <!--Image-->

                            <a href="#" class="ts-circle p-5 mr-4 ts-shadow__sm" data-bg-image="<?= isset($detail['foto_agent']) ? $detail['foto_agent'] : ''; ?>" style="background-image: url(&quot;<?= isset($detail['foto_agent']) ? $detail['foto_agent'] : ''; ?> &quot;); background-size: 100%; background-repeat: no-repeat;"></a>

                            <!--Phone contact-->

                            <figure class="mb-0">
                                <h5 class="mb-0"><?= isset($detail['nama_agent']) ? $detail['nama_agent'] : ''; ?></h5>
                                <p class="mb-0">
                                    <i class="fa fa-phone-square ts-opacity__50 mr-2"></i>
                                    <?= isset($detail['telp_agent']) ? $detail['telp_agent'] : ''; ?> <br>
                                    <i class="fa fa-envelope ts-opacity__50 mr-2"></i>
                                    <span style="font-size: 10px;"><?= isset($detail['email_agent']) ? $detail['email_agent'] : ''; ?></span>
                                </p>
                            </figure>
                        </div>

                        <!--Agent contact form-->

                        <form id="form-agent" class="ts-form">

                            <!--Name-->
                            <div class="form-group">
                                <input type="hidden" id="id_agent" name="id_agent" value="<?= isset($detail['id_agent']) ? $detail['id_agent'] : ''; ?>">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                            </div>

                            <!--Email-->

                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="">
                            </div>

                            <!--Message-->

                            <div class="form-group">
                                <textarea class="form-control" id="form-contact-message" rows="3" name="message" placeholder="Hi, I want to have more information about property #<?= isset($detail['id']) ? $detail['id'] : ''; ?>"></textarea>
                            </div>

                            <!--Submit button-->

                            <div class="form-group">
                                <div id="captcha_el" class="g-recaptcha" data-sitekey="6Lfz1LcUAAAAAPIx6KW33lR1vMpFlT_826O6NLFO"></div>
                            </div>

                            <div id="alert_notif"></div>

                            <div class="form-group clearfix mb-0">
                                <button type="button" class="btn btn-primary float-right" id="form-contact-submit">
                                    Send a Message
                                </button>

                            </div>

                        </form>
                    </div>
                </section>

                <!-- <section id="actions">

                    <div class="d-flex justify-content-between">

                        <a href="#" class="btn btn-light mr-2 w-100" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to favorites">

                            <i class="fa fa-star"></i>

                        </a>

                        <a href="#" class="btn btn-light mr-2 w-100" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print">

                            <i class="fa fa-print"></i>

                        </a>

                        <a href="#" class="btn btn-light w-100" data-toggle="tooltip" data-placement="top" title="" data-original-title="Share property">

                            <i class="fa fa-share-alt"></i>

                        </a>

                    </div>

                </section> -->

            </div>

            <!-- End Left side -->

            <!-- RIGHT SIDE -->

            <div class="col-md-7 col-lg-8">
                <section id="features">

                    <h3>Features</h3>
                    <ul class="list-unstyled ts-list-icons ts-column-count-3 ts-column-count-sm-2 ts-column-count-md-2">
                        <?php
                        if (isset($detail['feature']) && !empty($detail['feature'])) { 

                            foreach ($detail['feature'] as $k => $row) {                        
                                
                                // if (!empty($row->feature)) { 
                        ?>
                                    <li>
                                        <i class="fa fa-check-circle"></i>
                                        <?= $row->feature ?>
                                    </li>

                        <?php    
                                // }
                            }

                        } else {
                            echo '-';
                        }
                        ?>

                    </ul>

                </section>

                <section id="quick-info">
                    <h3>Description</h3>

                    <!--Quick Info-->

                    <!-- <div class="ts-quick-info ts-box"> -->

                    <!--Row-->

                    <!-- <div class="row no-gutters"> -->

                    <!--Bathrooms-->
                    <!-- 
                            <div class="col-sm-3 col-3">

                                <div class="ts-quick-info__item active" id="surface_area" data-bg-image="<?= base_url(); ?>assets/img/icon/area tanah.png" style="background-image: url(&quot;<?= base_url(); ?>assets/img/icon/area tanah.png&quot;);">

                                </div>

                            </div> -->

                    <!--Bedrooms-->

                    <!-- <div class="col-sm-3 col-3">

                                <div class="ts-quick-info__item" id="building_area" data-bg-image="<?= base_url(); ?>assets/img/icon/area bangunan.png" style="background-image: url(&quot;<?= base_url(); ?>assets/img/icon/area bangunan.png&quot;);">

                                </div>

                            </div> -->

                    <!--Area-->

                    <!-- <div class="col-sm-3 col-3">

                                <div class="ts-quick-info__item" id="proprietary" data-bg-image="<?= base_url(); ?>assets/img/icon/hak milik.png" style="background-image: url(&quot;<?= base_url(); ?>assets/img/icon/hak milik.png&quot;);">

                                </div>

                            </div> -->

                    <!--Garages-->

                    <!-- <div class="col-sm-3 col-3">

                                <div class="ts-quick-info__item" id="facilities" data-bg-image="<?= base_url(); ?>assets/img/icon/fasilitas.png" style="background-image: url(&quot;<?= base_url(); ?>assets/img/icon/fasilitas.png&quot;);">

                                </div>

                            </div>

                        </div> -->

                    <!--end row-->

                    <!-- </div> -->

                    <!--end ts-quick-info-->

                    <!-- </section> -->

                    <!-- <section id="description"> -->

                    <!-- <h3>Description</h3> -->
                    <?php if (!empty($detail['deskripsi'])) { ?>

                        <p class="text-justify"> <?= isset($detail['deskripsi']) ? nl2br($detail['deskripsi']) : ''; ?> </p>

                    <?php } else { ?>

                        <p class="text-justify"> <?= '-'; ?> </p>

                    <?php } ?>

                    <!-- <p id="building_area_det"><?= isset($detail['area_bangunan']) ? $detail['area_bangunan'] : ''; ?></p>

                    <p id="proprietary_det"><?= isset($detail['legal']) ? $detail['legal'] : ''; ?></p>

                    <p id="facilities_det"><?= isset($detail['facilities']) ? $detail['facilities'] : ''; ?></p> -->

                </section>





                <section id="map-location">
                    <h3>Map</h3>
                    <div class="map">
                        <div id="map" class="contact-map">
                            <input type="hidden" id="lang" value="<?= isset($detail['longitude']) ? $detail['longitude'] : ''; ?>">
                            <input type="hidden" id="lat" value="<?= isset($detail['latitude']) ? $detail['latitude'] : ''; ?>">
                        </div>
                    </div>
                </section>

                <?php if (!empty($detail['video_url'])) { ?>

                    <section id="video">
                        <h3>Video</h3>
                        <div class="embed-responsive embed-responsive-16by9 rounded ts-shadow__md">
                            <iframe src="<?= isset($detail['video_url']) ? $detail['video_url'] : ''; ?>" width="640" height="360" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" autostart="false" allowfullscreen=""></iframe>
                        </div>
                    </section> 
                    <!-- "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4 -->

                <?php } ?>

            </div>

            <!--end col-md-8-->

        </div>

        <!--end row-->

    </div>

    <!--end container-->

</section>



<div id="modalcalculator" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">MORTGAGE CALCULATOR</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="loanwrapperup">
                    <div class="row">
                        <div class="col-md-4 col-sm-5 col-4">Price</div>
                        <div class="col-md-3 col-sm-3 col-4"></div>
                        <div class="col-md-5 col-sm-4 col-4 text-right">
                            <input id="price" type="text" class="form-control text-right" value="0" size="13">
                        </div>
                    </div>

                    <div class="row" style="margin-top:3vh;">
                        <div class="col-md-4 col-sm-5 col-4">Down Payment (DP)</div>
                        <div class="col-md-2 col-sm-2 col-3"><input id="dp" type="text" class="form-control" value="30" size="5"></div>
                        <div class="col-md-1 col-sm-1 col-1">%</div>
                        <div class="col-md-5 col-sm-4 col-4 text-right"><span id="valuedp">750,000,000</span></div>
                    </div>

                    <div class="row" style="margin-top:3vh;">
                        <div class="col-md-4 col-sm-5 col-4">Loan Amount</div>
                        <div class="col-md-3 col-sm-3 col-4"></div>
                        <div class="col-md-5 col-sm-4 col-4 text-right"><span id="valueloan">1,750,000,000</span></div>
                    </div>

                    <div class="row" style="margin-top:3vh;">
                        <div class="col-md-4 col-sm-5 col-4">Loan Time</div>
                        <div class="col-md-2 col-sm-2 col-3">
                            <input id="loantimeyear" type="text" class="form-control" value="10" size="5"></div>
                        <div class="col-md-1 col-sm-1 col-1">Years</div>
                        <div class="col-md-5 col-sm-4 col-4 text-right"><span id="loantimemonth">240</span> Month</div>
                    </div>

                    <div class="row" style="margin-top:3vh;">
                        <div class="col-md-4 col-sm-5 col-4">Interest Rate</div>
                        <div class="col-md-3 col-sm-3 col-4"></div>
                        <div class="col-md-4 col-sm-3 col-3 text-right">
                            <input id="intrate" type="number" class="form-control text-right" value="10" step="0.1" min="0" max="100"></div>
                        <div class="col-md-1 col-sm-1 col-1">%</div>
                    </div>
                </div>

                <hr>

                <div class="loanwrapperdown" align="left">

                    <div class="row" style="margin-top:6vh;">
                        <div class="col-md-4 col-sm-5 col-5">Total Loan + Interest</div>
                        <div class="col-md-3 col-sm-3 col-3"></div>
                        <div class="col-md-5 col-sm-4 col-4 text-right"><span id="totloan">1,785,000,000</span></div>
                    </div>

                    <div class="row" style="margin-top:3vh;">
                        <div class="col-md-4 col-sm-5 col-5">Monthly Payment</div>
                        <div class="col-md-3 col-sm-3 col-3"></div>
                        <div class="col-md-5 col-sm-4 col-4 text-right"><span id="paymonth">16,887,879</span> (IDR)</div>
                    </div>

                    <div class="row" style="margin-top:3vh;">
                        <div class="col-md-12 col-sm-12 col-12" align="center"><button id="resetbutton" type="button" class="btn btn-danger btn-sm">Reset to Default</button></div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>



    </div>
</div>