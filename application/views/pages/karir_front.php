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



<!-- Our team start -->

<div class="career content-area-9">

    <div class="container">

        <div class="row">

            <div class="head-section">

                <div class="col-lg-10 offset-lg-1 career-box">

                <div class="head-career-box">
                <center> 
                       <!-- <font color="black"> 
                            <b> Kami selalu mencari talenta baru </b> 
                        </font> -->
                        <?= isset($data) ? $data:'';?>
                    </center> 
                </div>

                <!-- <br> <br> -->
                Kami selalu terbuka dan mencari tim yang memiliki antusiasme dan talenta untuk membantu Interflow berkembang lebih besar lagi. 

                <br> <br> <br>

                <a href="<?php echo base_url('Main/karir'); ?>" type="button" class="btn btn-md btn-primary btn-circle" style="background-color: #13235F;"> Lihat lowongan kerja </a>  

                </div>

            </div>


        </div>

    </div>

</div>

<!-- Our team end -->

<style>

    .career.content-area-9 {
        padding: 100px 0px 50px;
    }

    .career-box {
        font-size: 150%; 
        text-align: center;
    }


    /* For mobile phones: */

    /* @media only screen and (max-width: 480px), only screen and (max-device-width: 480px) {
        font-size: 50%;    
    } */

    @media only screen and (max-width: 720px),
    only screen and (max-device-width: 720px) {
        

        .content-area-9 .head-section {
            font-size: 70%;
        }

        .content-area-9 .head-section .head-career-box{
            font-size: 162%;
        }

        


    }


    @media only screen and (min-width: 768px) {

        /* For desktop: */

        .content-area-9 .head-section .head-career-box{
            font-size: 180%;
        }


    }


</style>