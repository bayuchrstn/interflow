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

<!-- Faq start -->
<div class="faq content-area-9">
    <div class="container">
        <?php echo isset($data_faq) ? $data_faq : ''; ?>
    </div>
</div>
<!-- Faq end -->