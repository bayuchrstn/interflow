<!-- Banner start -->
<?php
    $video = isset($video) ? $video : '';
?>
        <div class="banner" id="banner">
        <!-- <div id="bannerCarousole" class="carousel slide" data-ride="carousel">
        <?php echo isset($data_slider) ? $data_slider : ''; ?>
    </div> -->
        <div id="bannerCarousole" style="padding-top:106px" class="carousel slide" data-ride="carousel" data-interval="2000">
            <!-- <div id="demo" class="carousel slide" data-ride="carousel"> -->
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#bannerCarousole" data-slide-to="0" class="active"></li>
                <li data-target="#bannerCarousole" data-slide-to="1"></li>
                <li data-target="#bannerCarousole" data-slide-to="2"></li>
                <li data-target="#bannerCarousole" data-slide-to="3"></li>
                <li data-target="#bannerCarousole" data-slide-to="4"></li>
            </ul>
            <?php echo isset($data_slider) ? $data_slider : ''; ?>
            <!-- Left and right controls -->
            <!-- <a class="carousel-control-prev" href="#bannerCarousole" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#bannerCarousole" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a> -->
            <a class="carousel-control-prev none-580" href="#bannerCarousole" role="button" data-slide="prev">
                <span class="slider-mover-left" aria-hidden="true">
                    <i class="fa fa-angle-left"></i>
                </span>
            </a>
            <a class="carousel-control-next none-580" href="#bannerCarousole" role="button" data-slide="next">
                <span class="slider-mover-right" aria-hidden="true">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
            <!-- </div> -->
        </div>


<?php   
    if ($video != '') {
?>
    <!-- <div class="banner banner_video_bg" id="banner">
        <div class="pattern-overlay">
            <a id="bgndVideo" class="player" data-property="{videoURL:'<?php echo $video; ?>',containment:'.banner_video_bg', quality:'large', autoPlay:true, mute:true, opacity:1}">bg</a>
        </div> -->

          <!-- Video start -->
          <div class="container-fluid about-us">
            <div class="row">
                <div class="col-md-6" style="padding:0">
                    <div class="video-wrap" style="padding-top:0px;">
                        <div id="bannerVideo"class="video carousel slide" data-ride="carousel">
                            <img class="ratio" src="http://placehold.it/16x9" />

                            <iframe src="<?php echo isset($dt_video['link_youtube']) ? $dt_video['link_youtube'] : ''; ?>" frameborder="0" 
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe> 

                            <!-- width="100%" height="500" -->
                        </div>
                    </div>
            
                </div>
                <div class="col-md-6"> <!-- background-color:#F08519; -->
                    <div class="tab-box">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <!-- <h2>Keterangan Event</h2> <br> -->
                                <p style="color: black; text-align: justify;line-height: 1.5;">
                                    <?php echo isset($dt_video['description']) ? nl2br($dt_video['description']) : ''; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video end -->

<?php } ?>


        </div>
        <!-- Banner end -->

        <!-- Search area 3 start -->
        <div class="search-content content-area-0">
            <div class="container">
                <!-- Main title -->
                <div class="main-title">
                    <h1 class="text-white">Searching Your Property</h1>
                </div>
                <form method="GET" action="<?= base_url() ?>Main/list_property">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address, City or State">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 form-group">
                            <?php echo form_dropdown('status', $opt_status, '', 'id="status" class="form-control"'); ?>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 form-group">
                            <?php echo form_dropdown('type', $opt_type, '', 'id="type" class="form-control"'); ?>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 form-group">
                        <label style="color:white">MIN</label>
                        <input id="minval" type="text" name="min_price"  class="form-control text-right" value="0"/>
                            <!-- <div class="range-slider"> -->
                                <!-- <div data-min="0" data-max="<?= isset($price->max_price) ? $price->max_price : '0'; ?>"  data-min-name="min_price" data-max-name="max_price" data-unit="Rp" class="range-slider-ui ui-slider text-white" aria-disabled="false"></div> -->
                                <!-- <div data-min="0" data-max="500000000000" data-min-name="min_price" data-max-name="max_price" data-unit="Rp" class="range-slider-ui ui-slider text-white" aria-disabled="false"></div>
                                <div class="clearfix"></div>
                            </div> -->
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 form-group">
                        <label style="color:white">MAX</label>
                        <input id="maxval" type="text" name="max_price"  class="form-control text-right" value="500000000000" />
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 form-group">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 form-group">
                        <label></label>
                            <button type="submit" class="btn btn-primary btn-block btn-circle"> Search</button>
                        </div>
                    </div>
                </form>
                <!-- <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 form-group">
                <div id="option-accor" class="accordion">
                    <div class="">
                        <a class="checkbox_collapse text-white small collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#option-accor" href="#collapse1">
                            More Option
                        </a>
                    </div>
                    <div id="collapse1" class=" collapse">
                        cxcxz
                    </div>
                </div>                
            </div>
        </div> -->
            </div>
        </div>
        <!-- Search area 3 end -->

        <!-- Featured Properties start -->
        <div class="featured-properties content-area-0">
            <div class="container">
                <!-- Main title -->
                <div class="main-title">
                    <!-- <h1>HOT PROPERTY</h1> -->
                    <h1>STAR PROPERTY</h1>
                </div>
                <div class="slick-slider-area">
                    <div id="slider_hot_property" class="row slick-carousel">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="<?= base_url() ?>Main/list_property" class="btn btn-primary btn-circle btn-more">View More Properties</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured Properties end -->

        <!-- About Us start -->
        <div class="container-fluid about-us">
            <div class="row">
                <div class="col-md-6" style="padding:0">
                    <img class="img-responsive" src="<?php echo isset($about_us->img_url_profil) ? $about_us->img_url_profil : ''; ?>" alt="img-interflow">
                </div>
                <div class="col-md-6" style="padding:0;background-color:#F08519;">
                    <div class="tab-box">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item col-md-6 col-sm-6 col-6 text-center no-padd">
                                <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">About Us</a>
                            </li>
                            <li class="nav-item col-md-6 col-sm-6 col-6 text-center no-padd">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Why Choose Us</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <p>
                                    <!-- Interflow Property merupakan suatu wadah komunitas dimana kami selaku kantor property agent tepatnya beberapa principle kantor property agent merasa bahwa kami harus melindungi semua pihak baik buyer / investor  maupun kami selaku marketing pemasaran property. -->
                                    <?php echo isset($about_us->profil_perusahaan) ? nl2br($about_us->profil_perusahaan) : ''; ?>
                                    <br> <br>
                                    Nomor SIUP : <?php echo isset($about_us->nmr_siup) ? '<b>' . $about_us->nmr_siup . '</b>' : ''; ?>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="widget why-choose-u">
                                    <?php
                                    foreach ($why_us as $row) {
                                        echo '
								<div class="media mb-4">
									<a class="pr-3" href="javascript">
										<img class="media-object" src="' . $row->img_url . '">
									</a>
									<div class="media-body align-self-center">
										<h5><a href="javascript:;">' . $row->title . '</a></h5>
										<p>' . $row->text . '</p>
									</div>
								</div>
								';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Us end -->

        <!-- Own start -->
        <div class="own">
            <div class="content-own">
                <img class="img-responsive" src="<?= base_url() ?>assets/img/have-some-for-sale.jpg" alt="img-own">
                <div class="own-title">
                    <div class="text-center">
                        <h2 class="text-white">Have Some Property For Sale ?</h2>
                    </div>
                    <div class="text-center">
                        <a href="<?= base_url() ?>Main/contact_us" class="btn btn-primary btn-circle btn-more">Submit Your Own</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Own Us end -->

        <!-- Our team start -->
        <div class="our-team content-area-0">
            <div class="container">
                <!-- Main title -->
                <div class="main-title">
                    <h1>Meet Our Property Consultant</h1>
                </div>
                <div class="slick-slider-area">
                    <div id="slider_consultant" class="row slick-carousel">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="<?= base_url() ?>Main/consultant" class="btn btn-primary btn-circle btn-more">View More Property Consultant</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our team end -->

        <!-- Testimonial start -->
        <div class="testimonial content-area-0">
            <hr>
            <div class="container">
                <!-- Main title -->
                <div class="main-title">
                    <h1>What Our Clients Say</h1>
                </div>
                <!-- Slick slider area start -->
                <div class="slick-slider-area">
                    <div id="slider_testimoni" class="row slick-carousel">
                        <?php echo isset($data_testimoni) ? $data_testimoni : ''; ?>
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

        <!-- Blog section start -->
        <div class="blog-section bg-grea-3 content-area-0">
            <div class="container">
                <!-- Main title -->
                <div class="main-title">
                    <h1>News</h1>
                </div>
                <div class="slick-slider-area">
                    <div id="slider_news" class="row slick-carousel">

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="<?= base_url() ?>Main/news" class="btn btn-primary btn-circle btn-more">View More News</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog section end -->

        <!-- Google map start -->
        <div class="section">
            <div class="map">
                <div id="map" class="contact-map"></div>
            </div>
        </div>
        <!-- Google map end -->

        <!-- Iklan -->
        <a id="arebia" href="javascript:;" style="position: fixed; z-index: 21474836;"><img src="<?= base_url(); ?>/assets/img/logo-arebi.png" style="width:75px;height:75px"></a>



<style type="text/css" id="ct_code_block_css_2">

    @keyframes fade-in-up {
        0% {
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }


    .video {
        position: relative;
    }

    .video .ratio {
        display:block;
        width:100%;
        height:auto;       
    }

    .video iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* max-width: 100%;
        max-height: 100%; */
    }

    .video.stuck {
        position: fixed;
        /* top: 160px; */
        bottom: 20px;
        /* left: 20px; */
        right: 20px;
        width: 260px;
        height: 145px;
        transform: translateY(100%);
        animation: fade-in-up 0.75s ease forwards;
        z-index: 1;
    }


    #arebia.stuck {
        position: fixed;
        bottom: 180px;
        transform: translateY(100%);
        animation: fade-in-up 0.50s ease forwards;
        z-index: 1;
    }
    
    
 </style>