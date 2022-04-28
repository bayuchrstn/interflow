<!-- Footer start -->
<footer class="footer">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="footer-item clearfix">
                    <img src="<?= base_url() ?>assets/img/logos/logoputih.png" alt="logo" class="f-logo">
                    <ul class="contact-info">
                        <li>
                            <i class="flaticon-pin"></i> <?php echo isset($footer->alamat) ? $footer->alamat : ''; ?>
                            <!-- JL. Lamper Tengah No.C-12A -->
                        </li>
                        <li>
                            <i class="flaticon-mail"></i>
                            <a href="mailto:<?php echo isset($footer->email) ? $footer->email/* .'?subject=Important!&body=Hi.' */ : ''; ?>">
                                <!-- interflow.property@gmail.com -->
                                <!-- target="_blank" rel="noopener noreferrer" -->
                                <?php echo isset($footer->email) ? $footer->email : ''; ?>
                                <!-- interflow.property@gmail.com -->
                            </a>
                            <!-- sales@hotelempire.com -->
                        </li>
                        <li>
                            <i class="flaticon-phone"></i>
                            <a href="tel:<?php echo isset($footer->phone) ? $footer->phone : ''; ?>">
                                <!-- 0895 602 532 888 -->
                                <?php echo isset($footer->phone) ? $footer->phone : ''; ?>
                                <!-- 0895 602 532 888 -->
                            </a>
                            <!-- +55-417-634-7071 -->
                        </li>
                        <li>
                            <i class="fa fa-facebook"></i>
                            <a href="<?php echo isset($footer->facebook_url) ? $footer->facebook_url : ''; ?>" target="__blank">Facebook</a>
                        </li>
                        <li>
                            <i class="fa fa-instagram"></i>
                            <a href="<?php echo isset($footer->instagram_url) ? $footer->instagram_url : ''; ?>" target="__blank">Instagram</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>
                        Useful Links
                    </h4>
                    <ul class="links">
                        <li>
                            <a href="<?= base_url() ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/about_us">About Us</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/list_property">Property</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/developer">Developer</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/service_loan">Loan Service</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/consultant">Consultant</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/news">News</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/gallery">Gallery</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/faq">Faq</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Main/contact_us">Add Property</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6">
                <div class="recent-properties footer-item">

                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item clearfix">
                    <h4>Subscribe</h4>
                    <div class="Subscribe-box">
                        <p>Ikuti update seputar informasi tentang properti dengan berlanggan menggunakan email.</p>
                        <form id="form-email-subs" class="form-inline">
                            <!-- GET -->
                            <input type="email" id="email_subs" name="email_subs" class="form-control mb-sm-0" id="inlineFormInputName3" placeholder="Email Address" autocomplete="off" required>
                            <button type="button" id="btn-subs" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button> <!-- onclick="alert('Coming Soon')" -->
                        </form>
                        <div id="subs_alert_notif" style="color: #ffffff; font-size: 15px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <p class="copy sub-footer">© <?php echo date('Y'); ?> Interflow</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Full Page Search -->
<div id="full-page-search">
    <button type="button" class="close">×</button>
    <form action="index.html#">
        <input type="search" value="" placeholder="type keyword(s) here" />
        <button type="submit" class="btn btn-sm button-theme">Search</button>
    </form>
</div>

<!-- Modal Login-->
<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin-bottom:30px">
                <div class="col-md-12 col-12">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-md-6 col-6">
                                    <a href="#" id="register-form-link">Forgot Password</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <form id="login-form2">
                                        <div class="form-group">
                                            <input type="text" name="username" tabindex="1" class="form-control" placeholder="Username" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" tabindex="2" class="form-control" placeholder="Password" required="required">
                                        </div>
                                        <div class="form-group">
                                            <div id="logerror2" class="text-center"></div>
                                            <div class="row" style="justify-content:center">
                                                <div class="col-md-6 col-6">
                                                    <button type="button" id="btn-login2" class="form-control btn btn-login">Log In</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <form id="register-form" style="display: none;">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="text-center">
                                                    <button type="button" id="forgot-submit" class="form-control btn btn-register">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Forgot-->
<div class="modal fade" id="modal-forgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin-bottom:30px">
                <div class="col-md-12 col-12">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a href="#" id="register-form-link">Forgot Password</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <form id="register-form" style="display: block;">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="text-center">
                                                    <button type="button" id="forgot-submit" class="form-control btn btn-register">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/js/jquery-2.2.0.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-submenu.js"></script>
<script src="<?= base_url() ?>assets/js/rangeslider.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mb.YTPlayer.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.easing.1.3.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.scrollUp.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/js/leaflet.js"></script>
<script src="<?= base_url() ?>assets/js/leaflet-providers.js"></script>
<script src="<?= base_url() ?>assets/js/leaflet.markercluster.js"></script>
<script src="<?= base_url() ?>assets/js/dropzone.js"></script>
<script src="<?= base_url() ?>assets/js/slick.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/pickers/daterangepicker.js"></script>
<script src="<?= base_url() ?>assets/js/lazyload/lazyload.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.filterizr.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.countdown.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.elevatezoom.js"></script>
<script src="<?= base_url() ?>assets_admin/global_assets/js/plugins/forms/validation/validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/numeral.min.js"></script>
<script src="<?= base_url() ?>assets/js/mortgage.js"></script>
<script src="<?= base_url() ?>assets/js/maps.js"></script>
<script src="<?= base_url() ?>assets/js/plugins.js"></script>
<!-- <script src="<?= base_url() ?>assets/js/swiper.jquery.min.js"></script> -->
<script src="<?= base_url() ?>assets/js/app.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootbox/bootbox.min.js"></script>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?= base_url() ?>assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script src="<?= base_url() ?>assets/js/ie10-viewport-bug-workaround.js"></script>
<script>
    let base_url = '<?= base_url() ?>';
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM4nQXqt2vURkV97krRFVXzOWMTcA3Mvg"></script>
<?php echo isset($app) ? '<script src="' . base_url() . 'assets/app/js/' . $app . '?v=' . rand() . '"></script>' : ''; ?>
</body>
<script>
    $(".date-picker").datepicker({
        autoclose: !0,
        todayHighlight: true
    });
    $(document).ready(function() {
        var zoomConfig = {
            tint: true,
            tintColour: '#F90',
            tintOpacity: 0.5
        }

        // var slickImage = $('.slick-image'); 
        var zoomImage = $('#img-show-slide');

        $('.slider').slick({
            dots: false,
            vertical: true,
            slidesToShow: 5
        });

        zoomImage.elevateZoom(zoomConfig);

        $('.carousel-inner').magnificPopup({
            delegate: 'a',
            type: 'image',
            image: {
                cursor: null,
                titleSrc: 'title'
            },
            gallery: {
                enabled: true,
                preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
                navigateByImgClick: true
            }
        });
    });

    $(document).ready(function() {
        var counters = $(".count");
        var countersQuantity = counters.length;
        var counter = [];

        for (i = 0; i < countersQuantity; i++) {
            counter[i] = parseInt(counters[i].innerHTML);
        }

        var count = function(start, value, id) {
            var localStart = start;
            setInterval(function() {
                if (localStart < value) {
                    localStart++;
                    counters[id].innerHTML = localStart;
                }
            }, 40);
        }

        for (j = 0; j < countersQuantity; j++) {
            count(0, counter[j], j);
        }

        $.ajax({
            url: base_url + "Main/ajax_recent_property",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let html = '<h4>Recent Properties</h4>';
                for (let i = 0; i < data.length; i++) {
                    prop = data[i];
                    status_property = prop.status_property;
                    harga_jual = prop.harga_jual;
                    harga_sewa = prop.harga_sewa;
                    if (status_property == "1" || status_property == "3") { // Jual: Sell / Sold
                        harga = harga_jual;
                    } else if (status_property == "2" || status_property == "4") { // Sewa: Rent / Rented
                        harga = harga_sewa;
                    } else if (status_property == "5") { // Bisa Jual, bisa Sewa: Sell / Rent  
                        harga = harga_jual + ' ...';
                    } else {
                        harga = harga_jual;
                    }
                    html += '<div class="media mb-4"><a class="pr-3" href="' + base_url + 'Main/detail_property?q=' + prop.id + '"><img class="media-object" src="' + prop.image + '" alt="small-properties"></a><div class="media-body align-self-center"><h5><a href="' + base_url + 'Main/detail_property?q=' + prop.id + '">' + prop.nama + '</a></h5><div class="listing-post-meta"><a href="javascript:;"><i class="fa fa-calendar"></i> ' + prop.tanggal + ' </a> | Rp ' + harga + ' jt</div></div></div>';
                }

                $(".recent-properties").html(html);
            },
            error: function(err) {
                console.log(err);
            }
        });
        var myEle = document.getElementById("current_max");
        if (myEle) {} else {
            $('.max-value').html('Rp 500 M');
        }
        // if( $('.range-slider-ui').find('.ui-state-default.1').css()$('.current-max').val() == '500.000.000.000'){
        //     $('.max-value').html('Rp 500 M');
        // }

    });

    $(function() {

        $('#login-form-link').click(function(e) {
            $("#login-form2").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form2").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });
    var header = document.getElementById("top-header-2");
    var sticky = header.offsetTop;
    window.onscroll = function() {
        if (window.pageYOffset > sticky) {
            $("#top-header-2").addClass("fixed-top").animate("slow");
        } else {
            $("#top-header-2").animate("slow").removeClass("fixed-top");
        }
    };


    $("#btn-subs").click(function() {
        $.ajax({
            url: base_url + "Main/ajax_subscribe_email",
            type: "POST",
            data: $("#form-email-subs").serialize(),
            dataType: "JSON",
            beforeSend: function() {
                $('#btn-subs').html("<i class='fa fa-lg fa-refresh fa-spin'></i>").attr('disabled', true);
            },
            complete: function() {
                $('#btn-subs').html("<i class='fa fa-paper-plane'></i>").attr('disabled', false);
            },
            success: function(data) {
                if (data.status == true) {
                    $("#subs_alert_notif").html(data.message);
                    $('#email_subs').val('');
                } else {
                    $("#subs_alert_notif").html(data.message);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>

</html>