<!-- Sub banner start -->

<div class="sub-banner text-center">

    <div class="page-title">

        <h1><?= isset($title_2) ? $title_2:'';?></h1>

    </div>

</div>

<!-- Sub Banner end -->

<section id="breadcrumb">

    <div class="container breadcrumb-area">

        <div class="breadcrumb-areas">

            <ul class="breadcrumbs">

                <li><a href="<?=base_url()?>">Home</a></li>

                <li class="active"><?= isset($title) ? $title:'';?></li>

            </ul>

        </div>

    </div>

</section>



<div class="about-info content-area-0">

    <div class="container detail-info">

        <div class="row">

            <div class="col-md-5 col-xs-6">

                <img class="img-responsive" src="<?= base_url()?>assets/img/logos/logowarna.png" alt="Logo Interflow">

            </div>

            <div class="col-md-7 col-xs-6">

                <h3>Interflow</h3>

                <!-- <p>Interflow Property merupakan suatu wadah komunitas dimana kami selaku kantor property agent tepatnya beberapa principle kantor property agent merasa bahwa kami harus melindungi semua pihak baik buyer / investor  maupun kami selaku marketing pemasaran property.</p> -->
                <?php echo isset($about_us->profil_perusahaan) ? nl2br($about_us->profil_perusahaan) : ''; ?>
                <br> <br>
                Nomor SIUP : <?php echo isset($about_us->nmr_siup) ? '<b>'.$about_us->nmr_siup.'</b>' : ''; ?>
            </div>

        </div>

    </div>

</div>

<br>

<div class="founder content-area-0">

    <div class="container">

        <!-- Main title -->

        <div class="main-title">

            <h1>Meet Up The Executive Founder</h1>

        </div>

        <div class="detail">
            <div class="container">
                <?= isset($data) ? $data:'';?>
            </div>
        </div>
        <!-- <div class="detail">

            <div class="row">

                <div class="col-md-4 text-center" style="padding-right: 0px;padding-left: 0px;">

                    <img class="img-responsive" src="<?= base_url()?>assets/img/founder/MINARNI.jpg" alt="Minarni">

                    <!-- <div class="name">

                        MINARNI

                    </div> -->

                <!-- </div>

                <div class="col-md-4 text-center" style="padding-right: 0px;padding-left: 0px;">

                    <img class="img-responsive" src="<?= base_url()?>assets/img/founder/TINA.jpg" alt="Tina"> -->

                    <!-- <div class="name">

                        TINA

                    </div> -->

                <!-- </div>

                <div class="col-md-4 text-center" style="padding-right: 0px;padding-left: 0px;">

                    <img class="img-responsive" src="<?= base_url()?>assets/img/founder/PUPUT.jpg" alt="Puput"> -->

                    <!-- <div class="name">

                        PUPUT

                    </div> -->

                <!-- </div>

            </div>

        </div> --> 

    </div>

</div>

<br>

<div class="service-us">

    <div class="row" style="margin-right: 0px;margin-left: 0px;">

        <div class="col-md-12 no-padd">

            <img class="img-responsive" src="<?= base_url()?>assets/img/img-about-us.jpg" alt="img">

            <div class="info">

                <div class="row" style="margin-right: 0px;margin-left: 0px;">
					
					<?php 
					foreach($milestones as $row){
						echo '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 text-center">

								<h6 class="count">'.$row->counter.'</h6>

								<h6>'.$row->title.'</h6>

							</div>';
					}
					?>
                    
                </div>

            </div>

        </div>

    </div>

</div>



<!-- Testimonial start -->

<div class="testimonial content-area-0">

    <div class="container">

        <!-- Main title -->

        <div class="main-title">

            <h1>What Our Clients Say</h1>

        </div>

        <!-- Slick slider area start -->

        <div class="slick-slider-area">

            <div id="slider_testimoni"class="row slick-carousel">

                <?php echo isset($data_testimoni) ? $data_testimoni:'';?>

            </div>

        </div>

        <div class="partners">

            <div class="slick-slider-area">

                <div id="slider_partner" class="row slick-carousel">

                    

                </div>

            </div>

            <!-- <div class="partners-img">

                <img class="img-responsive" src="assets/img/partner/logo-01.png" alt="Partner">

            </div>

            <div class="partners-img text-center">

                <img width="40%" src="assets/img/partner/logo-02.png" alt="Partner">

            </div>

            <div class="partners-img text-center">

                <img width="70%" src="assets/img/partner/logo-03.png" alt="Partner">

            </div>

            <div class="partners-img text-center">

                <img width="70%" src="assets/img/partner/logo-04.png" alt="Partner">

            </div> -->

        </div>

    </div>

</div>

<!-- Testimonial end -->



<!-- Google map start -->

<div class="section">

    <div class="map">

        <div id="map" class="contact-map"></div>

    </div>

</div>

<!-- Google map end -->



<!-- Intro section start -->

<div class="intro-section">

    <div class="container">

        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-12">

                <div class="intro-text">

                    <h3>Do You Have Any Questions ?</h3>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-sm-12">

                <a href="<?= base_url() ?>Main/contact_us" class="btn btn-primary">Get in Touch</a>

            </div>

        </div>

    </div>

</div>

<!-- Intro section end -->