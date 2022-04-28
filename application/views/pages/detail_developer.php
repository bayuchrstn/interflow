<section id="breadcrumb">
    <div class="container breadcrumb-area">
        <div class="breadcrumb-areas">
            <ul class="breadcrumbs">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active"><?php echo isset($title) ? $title:''; ?></li>
            </ul>
        </div>
    </div>
</section>

<div class="detail-developers content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
				<?php 
				if(!empty($detail->image_url)){
				?>
					<img class="img-responsive" src="<?php echo isset($detail->image_url) ? $detail->image_url:''; ?>">
				<?php	
				}
				?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <h2><?php echo isset($detail->name_tag) ? $detail->name_tag:'';?></h2>
                <div class="detail">
                    <i class="flaticon-pin"></i> <?php echo isset($detail->address) ? $detail->address:'';?>
                </div>
				<?php 
				if(!empty($detail->pdf_name)){
					?>
					<a target="_blank" href="<?php echo isset($detail->pdf_url) ? $detail->pdf_url.$detail->pdf_name:'';?>" class="btn btn-primary btn-circle btn-more">Download Brosure</a>
					<?php
				}
				?>
            </div>
        </div>
    </div>
</div>

<!-- Services start -->
<div class="other-developers content-area">
    <div class="container">
        <div class="main-title">
            <h2>Other Developers</h2>
        </div>
        <?= isset($random_developer) ? $random_developer:'';?>
    </div>
</div>
<!-- Services end -->