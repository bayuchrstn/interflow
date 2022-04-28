<!-- Sub banner start -->
<div class="sub-banner text-center">
    <div class="page-title">
        <h1><?= isset($title_2) ? $title_2 : ''; ?></h1>
    </div>
</div>
<!-- Sub Banner end -->
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

<!-- Photo gallery start -->
<div class="photo-gallery content-area-13">
    <div class="container">
        <div class="main-title text-center">
            <ul class="list-inline-listing filters filteriz-navigation">
                <li class="btn filtr-button filtr active load_album" data-filter="all"><a href="javascript:;">All</a></li>
                <?= isset($data_album) ? $data_album : ''; ?>
            </ul>
        </div>
            <div class="row filter-container">
                <?= isset($data_gallery) ? $data_gallery : ''; ?>
            </div>
        <div class="row" id="load_data_message"></div>
    </div>
</div>
<!-- Photo gallery end -->