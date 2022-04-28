<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Panel - Admin</title>



    <!-- Global stylesheets -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/css/colors.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/toastr/toastr.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/dropzone/dropzone.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/cropper/cropper.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/global_assets/croppie/croppie.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_admin/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link rel="stylesheet" href="https://www.orangehilldev.com/jstree-bootstrap-theme/demo/assets/dist/themes/proton/style.css" />
    
    <script src="<?= base_url(); ?>assets_admin/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets_admin/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($){
        $('.mask_uang').mask('#.##0,00', {reverse: true});
    })
    </script>

	<!-- summernote -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
	<!-- summernote -->

    <!-- /global stylesheets -->

    <link rel="shortcut icon" href="<?= base_url(); ?>assets_admin/media/logos/favicon.ico" />

</head>



<body class="sidebar-xs">



    <!-- Main navbar -->

    <div class="navbar navbar-expand-md">



        <!-- Header with logos -->

        <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">

            <div class="navbar-brand navbar-brand-md">

                <a href="<?= base_url(); ?>" class="d-inline-block">

                    <img src="<?= base_url() ?>assets_admin/media/logos/logo interflow.png" alt="">

                </a>

                <div class="nav-item" style="float:right">

                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">

                        <i class="icon-paragraph-justify3"></i>

                    </a>

                </div>

            </div>



            <div class="navbar-brand navbar-brand-xs">

                <div class="nav-item">

                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">

                        <i class="icon-paragraph-justify3"></i>

                    </a>

                </div>

            </div>

        </div>

        <div class="page-header-content header-elements-md-inline">

            <div class="page-title d-flex">

                <h4><span class="font-weight-semibold"></i> <?= $judul ?></span></h4>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

            </div>

        </div>

        <!-- /page header -->

        <!-- /header with logos -->





        <!-- Mobile controls -->

        <div class="d-flex flex-1 d-md-none">

            <div class="navbar-brand mr-auto">

                <a href="<?= base_url(); ?>" class="d-inline-block">

                    <img src="<?= base_url() ?>assets_admin/media/logos/logo-sm-interflow.png" alt="">

                </a>

            </div>



            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">

                <i class="icon-tree5"></i>

            </button>



            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">

                <i class="icon-paragraph-justify3"></i>

            </button>

        </div>

        <!-- /mobile controls -->



    </div>

    <!-- /main navbar -->

    <!-- Page content -->

    <div class="page-content">



        <!-- Main sidebar -->

        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">



            <!-- Sidebar mobile toggler -->

            <div class="sidebar-mobile-toggler text-center">

                <a href="#" class="sidebar-mobile-main-toggle">

                    <i class="icon-arrow-left8"></i>

                </a>

                Navigation

                <a href="#" class="sidebar-mobile-expand">

                    <i class="icon-screen-full"></i>

                    <i class="icon-screen-normal"></i>

                </a>

            </div>

            <!-- /sidebar mobile toggler -->





            <!-- Sidebar content -->

            <div class="sidebar-content">



                <!-- User menu -->

                <div class="sidebar-user-material">

                    <div class="sidebar-user-material-body">

                        <div class="card-body text-center">

                            <a href="#">


                            <?php 

                            
                                $sess_foto = $this->session->userdata('foto');

                                if (!empty($sess_foto)) {
                                    $foto_profil = $sess_foto;
                                } else {
                                    $foto_profil = base_url('assets_admin/media/users/avatar-icon-png-11.png');
                                }
                              
                                $sess_nama = $this->session->userdata('nama');

                                if (!empty($sess_nama)) {
                                    $nama_profil = $sess_nama;
                                } else {
                                    $nama_profil = $this->session->userdata('username');
                                }


                            ?>
                                <img src="<?= $foto_profil; ?>" class="img-fluid rounded-circle shadow-1 mb-3" width="120" height="120" alt="">

                            </a>

                            <h6 class="mb-0 text-white text-shadow-dark"><?= $nama_profil ?></h6>

                            <span class="font-size-sm text-white text-shadow-dark"><?= $this->session->userdata('cabang'); ?></span>

                        </div>



                        <!-- <div class="sidebar-user-material-footer">

                            <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>

                        </div> -->

                    </div>



                    <!-- <div class="collapse" id="user-nav"> -->

                        <ul class="nav nav-sidebar">

                            <!-- <li class="nav-item">

                                <a href="#" class="nav-link">

                                    <i class="icon-user-plus"></i>

                                    <span>My profile</span>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="#" class="nav-link">

                                    <i class="icon-coins"></i>

                                    <span>My balance</span>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="#" class="nav-link">

                                    <i class="icon-comment-discussion"></i>

                                    <span>Messages</span>

                                    <span class="badge bg-success-400 badge-pill align-self-center ml-auto">58</span>

                                </a>

                            </li> -->


                            <!-- <li class="nav-item">

                                <a href="<?= base_url(); ?>admin/Dashboard/logout" class="nav-link">

                                    <i class="icon-exit3"></i>

                                    <span>Logout</span>

                                </a>

                            </li> -->

                        </ul>

                    <!-- </div> -->

                </div>

                <!-- /user menu -->





                <!-- Main navigation -->

                <div class="card card-sidebar-mobile">

                    <ul class="nav nav-sidebar" data-nav-type="accordion">



                        <!-- Main -->

                        <li class="nav-item-header">

                            <!-- <div class="text-uppercase font-size-xs line-height-xs"></div> <i class="" title="Main"></i>

                            <div class="text-uppercase font-size-xs line-height-xs"></div> <i class="" title="Main"></i>

                            <div class="text-uppercase font-size-xs line-height-xs"></div> <i class="" title="Main"></i> -->

                        </li>

                        <?php foreach ($this->session->userdata('menu') as $first) {

                            $class = $class2 = '';

                            if (empty($first->child) && $first->parent == 0) {

                                if ($first->label == $judul) {

                                    $class = ' active';

                                } else {

                                    $class = '';

                                } ?>

                                <li class="nav-item"><a href="<?= base_url(); ?><?= $first->url ?>" class="nav-link<?= $class ?>"><i class="<?= $first->icon ?>"></i><span><?= $first->label; ?></span></a></li>

                            <?php }

                                if (!empty($first->child) && $first->parent == 0) {

                                    if ($first->kategori == $this->uri->segment(1)) {

                                        $class = ' nav-item-submenu';

                                        $class2 = ' active';

                                    } else {

                                        $class = ' nav-item-submenu';

                                        $class2 = '';

                                    } ?>

                                <li class="nav-item<?= $class ?>"><a href="#" class="nav-link<?= $class2 ?>"><i class="<?= $first->icon ?>"></i><span><?= $first->label ?></span></a>

                                    <ul class="nav nav-group-sub">

                                        <?php foreach ($first->child as $second) {

                                                    $class = $class2 = '';

                                                    if (!empty($second->child) && $second->parent != 0) {

                                                        if ($second->label == $judul) {

                                                            $class = ' nav-item-submenu';

                                                            $class2 = ' active';

                                                        } ?>

                                                <li class="nav-item<?= $class ?>"><a href="#" class="nav-link<?= $class2 ?>"><?= $second->label ?></a></li>

                                                <ul class="nav nav-group-sub">

                                                    <?php foreach ($second->child as $third) {

                                                                        if ($third->label == $judul) { ?>

                                                            <li class="nav-item"><a href="<?= base_url(); ?><?= $third->url ?>" class="nav-link active"><?= $third->label ?></a></li>

                                                        <?php } else { ?>

                                                            <li class="nav-item"><a href="<?= base_url(); ?><?= $third->url ?>" class="nav-link"><?= $third->label ?></a></li>

                                                    <?php }

                                                                    } ?>

                                                </ul>

                                </li>

                            <?php } else {

                                            if ($second->label == $judul) {

                                                $class = ' active';

                                            } ?>

                                <li class="nav-item"><a href="<?= base_url(); ?><?= $second->url ?>" class="nav-link<?= $class ?>"><?= $second->label ?></a></li>

                        <?php    }

                                }

                                ?>

                    </ul> <?php }

                            } ?>


                        <li class="nav-item-header"> </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/Setting/account_setting" class="nav-link">
                                <i class="icon-cog5"></i>
                                <span>Account settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/Dashboard/logout" class="nav-link">
                                <i class="icon-exit3"></i>
                                <span>Logout</span>
                            </a>
                        </li>
            <!-- /layout -->


            
            </ul>


           

                </div>

                <!-- /main navigation -->



            </div>

            <!-- /sidebar content -->



        </div>

        <!-- /main sidebar -->


