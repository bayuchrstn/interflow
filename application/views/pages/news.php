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
<div class="blog-body content-area">
    <div class="container">
        <?= isset($data_news) ? $data_news:'';?>
        <!-- Page navigation start -->                
        <?= isset($data_page) ? $data_page:'';?>
        </div>
    </div>
</div>
<!-- Blog body end -->