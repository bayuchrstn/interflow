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
<div class="our-team content-area-0">
    <div class="container our-team-content">
        
    </div>
</div>
<!-- Our team end -->

<!-- Own start -->
<div class="own">
    <div class="content-own" style="margin-bottom: -5% !important;">
        <img class="img-responsive" src="<?= base_url()?>assets/img/have-some-for-sale.jpg" alt="img-own">
        <div class="own-title">
            <div class="text-center">
                <h2 class="text-white">Have Some Property For Sale ?</h2>
            </div>
            <div class="text-center">
                <a href="<?= base_url()?>Main/contact_us" class="btn btn-primary btn-circle btn-more">Submit Your Own</a>
            </div>
        </div>
    </div>
</div>
<!-- Own Us end -->