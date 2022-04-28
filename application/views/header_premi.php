<!DOCTYPE html>

<html lang="zxx">

<head>

    <title>Interflow | <?= isset($title) ? $title : ''; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="utf-8">

    <!-- External CSS libraries -->

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/animate.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap-submenu.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap-select.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/magnific-popup.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/leaflet.css" type="text/css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/map.css" type="text/css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fonts/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fonts/linearicons/style.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.mCustomScrollbar.css">

    <link href="<?= base_url(); ?>assets_admin/global_assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/dropzone.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick.css">

    <!-- End External CSS libraries -->

    <!-- Custom stylesheet -->

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style2.css">

    <link rel="stylesheet" type="text/css" id="style_sheet" href="<?= base_url() ?>assets/css/skins/default.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom.css?v=<?php echo rand() ?>">

    <!-- End Custom stylesheet -->

    <!-- Favicon icon -->

    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logos/logowarna.png" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/ie10-viewport-bug-workaround.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/mt-range-slider.css">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!--[if lt IE 9]><script  src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <script src="<?= base_url() ?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- SLIDER HEADER -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
    <!-- TUTUP SLIDER HEADER -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

    <script  src="js/html5shiv.min.js"></script>

    <script  src="js/respond.min.js"></script>

    <![endif]-->
    <!-- <style>
     .main-header .navbar-expand-lg .navbar-nav .nav-link {
    color: #636060;
}

.main-header .navbar-expand-lg .navbar-nav .nav-link {
    padding: 35px 15px;
    line-height: 20px;
    color: #515151;
    font-family: 'Raleway', sans-serif;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 1px;
}

.main-header .navbar-expand-lg .navbar-nav .nav-link i {
    margin-right: 5px;
}

.main-header .navbar-expand-lg .navbar-nav .link-color:hover {
    background: transparent;
}

.main-header .navbar-expand-lg .navbar-nav .link-color {
    padding: 8px 20px!important;
    border-radius: 5px;
    margin: 26px 0 0 10px;
}

.main-header .navbar-expand-lg .user-account {
    padding: 30px 15px;
    font-size: 14px;
    font-weight: 600;
}

.main-header .navbar-expand-lg .user-account li {
    border: none;
    display: inline-block;
    font-size: 14px;
}

.main-header .navbar-expand-lg .user-account li a {
    color: #4d4d4d;
}

.main-header .navbar {
    padding: 0;
}

.main-header .form-inline .submit {
    padding: 7px 22px;
    border-radius: 3px;
    font-size: 14px;
    margin-left: 15px;
    font-weight: 600;
}

.main-header .dropdown-menu {
    min-width: 10rem;
    padding: 0;
    margin: 0;
    font-size: 13px;
    color: #212529;
    border: none;
    -webkit-transition: opacity .4s ease 0s, visibility .4s linear 0s, -webkit-transform .4s ease 0s;
    transition: opacity .4s ease 0s, visibility .4s linear 0s, -webkit-transform .4s ease 0s;
    transition: opacity .4s ease 0s, transform .4s ease 0s, visibility .4s linear 0s;
    transition: opacity .4s ease 0s, transform .4s ease 0s, visibility .4s linear 0s, -webkit-transform .4s ease 0s;
    border-radius: 0;
    border-top: solid 1px #f1f1f1;
    border-bottom: solid 1px #f1f1f1;
}
    </style> -->

</head>



<body>

    <div class="page_loader"></div>



    <!-- Top header start -->

    <header class="top-header" id="top-header-2">

        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-7 col-sm-6">

                    <div class="list-inline">

                        <a href="javascript:;"><i class="fa fa-phone"></i>0895 602 532 888</a>



                        <a href="javascript:;"><i class="fa fa-phone"></i>0247 641 0827</a>



                        <a href="javascript:;"><i class="fa fa-envelope"></i>interflow.property@gmail.com</a>



                        <a href="javascript:;"><i class="flaticon-pin"></i>JL. Lamper Tengah No.C-12A</a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-5 col-sm-6">
                    <div class="list-inline">
                        <ul class="top-social-media pull-right">

                            <li><a href="javascript:;"><i class="fa fa-user"></i></a></li>

                            <li>
                                <div class="dropdown">
                                    <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" class="link-right dropdown-toggle"><?php echo isset($nama) ? $nama : ''; ?></a>

                                    <div class="dropdown-menu form-wrapper" aria-labelledby="dropdownMenuLink" style="z-index:999999999;">


                                        <a class="dropdown-item" href="<?php echo base_url(); ?>Main/logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;Sign Out</a>



                                    </div>
                                </div>

                            </li>

                        </ul>

                    </div>
                </div>

            </div>

        </div>

    </header>

    <!-- Top header end -->



    <!-- Main header start -->

    <header class="main-header fixed-header">

        <div class="container-fluid">

            <nav class="navbar navbar-expand-lg navbar-light">

                <a class="navbar-brand company-logo" href="<?= base_url() ?>">

                    <img src="<?= base_url() ?>assets/img/logos/logowarna.png" alt="logo">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav header-ml">

                        <li class="nav-item dropdown login-name text-right">

                            <a class="nav-link"><i class="fa fa-user"></i> Halo, <?= isset($nama) ? $nama : ''; ?></a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($home) ? $home : ''; ?>" href="<?= base_url() ?>" aria-haspopup="true" aria-expanded="false">

                                Home

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($about_uss) ? $about_uss : ''; ?>" href="<?= base_url() ?>Main/about_us" aria-haspopup="true" aria-expanded="false">

                                About Us

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($premium_properti) ? $premium_properti : ''; ?>" href="<?= base_url() ?>Main/premium_properti" aria-haspopup="true" aria-expanded="false">

                                Premium Property

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($list_property) ? $list_property : ''; ?>" href="<?= base_url() ?>Main/list_property" aria-haspopup="true" aria-expanded="false">

                                Property

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($developer) ? $developer : ''; ?>" href="<?= base_url() ?>Main/developer" aria-haspopup="true" aria-expanded="false">

                                Developer

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($service_loan) ? $service_loan : ''; ?>" href="<?= base_url() ?>Main/service_loan" aria-haspopup="true" aria-expanded="false">

                                Loan Service

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($consultant) ? $consultant : ''; ?>" href="<?= base_url() ?>Main/consultant" aria-haspopup="true" aria-expanded="false">

                                Consultant

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($news) ? $news : ''; ?>" href="<?= base_url() ?>Main/news" aria-haspopup="true" aria-expanded="false">

                                News

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($gallery) ? $gallery : ''; ?>" href="<?= base_url() ?>Main/gallery" aria-haspopup="true" aria-expanded="false">

                                Gallery

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($karir) ? $karir : ''; ?>" href="<?= base_url() ?>Main/karir_front" aria-haspopup="true" aria-expanded="false">

                                Career

                            </a>

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link <?= isset($faq) ? $faq : ''; ?>" href="<?= base_url() ?>Main/faq" aria-haspopup="true" aria-expanded="false">

                                FAQ

                            </a>

                        </li>

                    </ul>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">

                            <a href="<?= base_url() ?>Main/contact_us" class="nav-link link-color">Add Property</a>

                        </li>

                    </ul>

                    <ul id="login" class="navbar-nav ml-auto"  style="z-index:999999999;">

                        <li class="nav-item ">

                            <a class="nav-link" href="<?= base_url(); ?>Main/logout">

                                <i class="fa fa-power-off"></i>Logout

                            </a>

                        </li>

                    </ul>

                </div>

            </nav>

        </div>

    </header>

    <!-- Main header end -->