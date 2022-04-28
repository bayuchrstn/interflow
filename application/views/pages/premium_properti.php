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

<!-- Properties section body start -->
<div class="properties-section-body content-area">
    <div class="container">
        <div class="main-title">
            <h2>Search Result</h2>
            <span class="small">With Category Select</span>
            <!-- <?php if($this->session->userdata('user_id')) { ?>
            <input type="hidden" id="premium" value="<?= isset($pre) ? '1':'';?>">
            <div class="blog-tags pull-right"><a class="<?= isset($pre) ? 'actived':'';?>" href="<?= isset($pre) ? base_url().'Main/list_property':base_url().'Main/list_property?pre=1';?>">Premium</a></div>
            <?php } ?> -->
        </div>
        <input type="hidden" id="categoryId" readonly>
        <div class="row wrap-option">
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-4 form-group text-center">
                <a href="javascript:;" onclick="CategorySearch('')">
                    <div class="wrap-option-box">
                        <div class="icon">
                            <img class="img-responsive cat-active" data-id="0" id="img-cat" src="<?= base_url()?>assets/img/icon/interfloworange.png" alt="">
                        </div>
                        <hr>
                        <div class="detail">
                            <h6>All Properties</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-4 form-group text-center">
                <a href="javascript:;" onclick="CategorySearch(1)">
                    <div class="wrap-option-box">
                        <div class="icon">
                            <img class="img-responsive" id="img-cat1" src="<?= base_url()?>assets/img/icon/homegrey.png" alt="">
                        </div>
                        <hr>
                        <div class="detail">
                            <h6>House</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-4 form-group text-center">
                <a href="javascript:;" onclick="CategorySearch(2)">
                    <div class="wrap-option-box">
                        <div class="icon">
                            <img class="img-responsive" id="img-cat2" src="<?= base_url()?>assets/img/icon/officegrey.png" alt="">
                        </div>
                        <hr>
                        <div class="detail">
                            <h6>Office</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-4 form-group text-center">
                <a href="javascript:;" onclick="CategorySearch(3)">
                    <div class="wrap-option-box">
                        <div class="icon">
                            <img class="img-responsive" id="img-cat3" src="<?= base_url()?>assets/img/icon/landgrey.png" alt="">
                        </div>
                        <hr>
                        <div class="detail">
                            <h6>Lands</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-4 form-group text-center">
                <a href="javascript:;" onclick="CategorySearch(4)">
                    <div class="wrap-option-box">
                        <div class="icon">
                            <img class="img-responsive" id="img-cat4" src="<?= base_url()?>assets/img/icon/garagegrey.png" alt="">
                        </div>
                        <hr>
                        <div class="detail">
                            <h6>Garages</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-4 form-group text-center">
                <a href="javascript:;" onclick="CategorySearch(5)">
                    <div class="wrap-option-box">
                        <div class="icon">
                            <img class="img-responsive" id="img-cat5" src="<?= base_url()?>assets/img/icon/apartementgrey.png" alt="">
                        </div>
                        <hr>
                        <div class="detail">
                            <h6>Apartement</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <form id="form_filter">
            <div class="row form-filter">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Enter Address, City or State" value="<?= isset($address) ? $address:'';?>">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 form-group">
                    <?php echo form_dropdown('status', $opt_status, isset($status) ? $status:'', 'id="status" class="form-control"');?>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 form-group">
                    <?php echo form_dropdown('type', $opt_type, isset($type) ? $type:'', 'id="type" class="form-control"');?>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 form-group">
                    <label>MIN</label>
                    <input type="text" class="form-control text-right" id="current_min" name="min_price" value="<?= isset($min_price) ? $min_price : '0'; ?>">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 form-group">
                <label>MAX</label>
                    <input type="text" class="form-control text-right" id="current_max" name="max_price" value="<?= isset($max_price) ? $max_price : '500000000000'; ?>">
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-12 form-group">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-2 col-sm-6 col-12 form-group">
                    <button type="button" id="btn-search" class="btn btn-primary btn-block btn-circle"> Search</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Option bar start -->
                <div class="option-bar clearfix">
                    <div class="sorting-options2">
                        <span class="sort">Sort by:</span>
                        <select class="selectpicker search-fields" name="sort_order" id="sort_order">
                            <option value="">Default Order</option>
                            <option value="HtoL">Price High to Low</option>
                            <option value="LtoH">Price: Low to High</option>
                            <option value="DESC">Newest Properties</option>
                            <option value="ASC">Oldest Properties</option>
                        </select>
                    </div>
                    <div class="sorting-options float-right">
                        <a href="javascript:;" class="change-view-btn" id="list-type"><i class="fa fa-th-list"></i></a>
                        <a href="javascript:;" class="change-view-btn active-view-btn" id="grid-type"><i class="fa fa-th-large"></i></a>
                    </div>
                </div>
                 <!-- <div class="main-title">  -->
                    <!-- <h2>Recommended for you</h2> -->
                    <!-- <h2>Hot Property</h2>
                </div>
                <div id="recommended" class="row grid-type">
                    
                </div>
                <div id="recommended_type_list" class="row list-type" style="display:none;">
                    
                </div> -->

                <div class="main-title">
                    <h2>List Property</h2>
                </div>
                <div id="property_list" class="row grid-type">
                    
                </div>
                <div id="property_type_list" class="row list-type" style="display:none;">
                    
                </div>
                <!-- Page navigation start -->
                <div id="pagination_prop"></div>
            </div>
        </div>
    </div>
</div>
<!-- Properties section body end -->