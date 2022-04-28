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

<!-- Blog body start -->
<div class="blog-body content-area-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <!-- Blog 1 start -->
                <div class="blog-1 blog-big">
                    <div class="blog-photo">
                        <img src="<?= isset($detail->img_url) ? $detail->img_url:'';?>" alt="small-blog" class="img-fluid">
                    </div>
                    <div class="detail">
                        <h3>
                            <a href="javascript:;"><?= isset($detail->judul) ? $detail->judul:'';?></a>
                        </h3>
                        <p style="text-align: justify;"><?= isset($detail->berita) ? nl2br($detail->berita):'';?></p>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                            <div class="blog-social-list">
                                <span>Share</span>
                                <a href="#" class="facebook-bg">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="twitter-bg">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="google-bg">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#" class="linkedin-bg">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <a href="#" class="pinterest-bg">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar-right">
                    <!-- Recent properties start -->
                    <div class="widget recent-properties">
                        
                    </div>
                    <!-- Recent news -->
                    <div class="widget recent-news">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog body end -->