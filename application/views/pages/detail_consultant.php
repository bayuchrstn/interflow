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



<section id="agent-info" class="content-area-6">

    <div class="container">

        <!--Box-->

        <div class="ts-box ts-has-talk-arrow">

            <!--Row-->

            <div class="row">

                <!--Brand-->

                <div class="col-md-4 ts-center__both">

                    <img class="ts-circle__xxl ts-shadow__md img-responsive lazy" src="<?= isset($detail->host) ? $detail->host : ''; ?><?= isset($detail->foto) ? $detail->foto : ''; ?>">

                </div>

                <!--Description-->

                <div class="col-md-8">

                    <div class="py-5">

                        <!--Title-->

                        <div class="ts-title mb-2">

                            <h2 class="mb-1"><?= isset($detail->fullname) ? $detail->fullname : ''; ?></h2>

                        </div>

                        <!--Row-->

                        <div class="row">

                            <div class="col-md-7">

                                <p class="detail-consultan">

                                    <?= isset($detail->deskripsi) ? $detail->deskripsi : ''; ?>

                                </p>

                            </div>

                            <div class="col-md-7">

                                <p class="detail-consultan">

                                    <?= isset($detail->motto) ? $detail->motto : ''; ?>

                                </p>

                            </div>

                            <div class="col-md-5 ts-opacity__50">

                                <!--Phone-->

                                <figure class="mb-1">

                                    <i class="fa fa-phone"></i>

                                    <?= isset($detail->phone) ? $detail->phone : ''; ?>

                                </figure>

                                <!--Mail-->

                                <figure class="mb-1">

                                    <i class="fa fa-envelope mr-2"></i>

                                    <a href="javascript:;"><?= isset($detail->email) ? $detail->email : ''; ?></a>

                                </figure>

                                <div class="col-lg-10 col-md-10 col-xs-10 callconsultant">

                                    <button type="button" class="nav-link link-color">Call Property Consultant</button>

                                </div>

                            </div>

                        </div>

                        <!--end row-->

                    </div>

                    <!--end p-4-->

                </div>

                <!--end col-md-8-->

            </div>

            <!--end row-->

        </div>

        <!--end ts-box-->

    </div>

    <!--end container-->

</section>



<section id="items-listing-and-search">

    <div class="container">

        <div class="row flex-wrap-reverse">

            <!-- Left side -->

            <div class="col-md-8">

                <h3 class="mb-4 pb-4">My Properties</h3>

                <section id="display-control-agents">

                    <div class="clearfix">

                        <!--Display selector on the left-->

                        <div class="sorting-options float-left form-group">

                            <a href="javascript:;" class="change-view-btn" id="list-type"><i class="fa fa-th-list"></i></a>
                            <a href="javascript:;" class="change-view-btn active-view-btn" id="grid-type"><i class="fa fa-th-large"></i></a>

                        </div>

                        <!--Display selector on the right-->

                        <div class="float-none float-sm-right pl-2 ts-center__vertical">

                            <label for="sorting" class="mb-0 mr-2 text-nowrap">Sort by:</label>

                            <select class="custom-select bg-transparent" id="sorting" name="sorting">

                                <option value="">Default</option>

                                <option value="LtoH">Price lowest first</option>

                                <option value="HtoL">Price highest first</option>

                            </select>

                        </div>

                    </div>

                    <!--end container-->

                </section>

                <section id="list-property">
                    <div id="property_list" class="row grid-type">

                    </div>
                    <div id="property_type_list" class="row list-type" style="display:none;">

                    </div>
                </section>
                <!-- Page navigation start -->
                <div id="pagination_prop"></div>
            </div>

            <!-- End Left side -->

            <!-- Rigth Side -->

            <div class="col-md-4 navbar-expand-md">

                <button class="btn bg-white mb-4 w-100 d-block d-md-none" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="float-left">

                        <i class="fa fa-search mr-2"></i>

                        Search

                    </span>

                    <span class="float-right">

                        <i class="fa fa-plus small ts-opacity__30"></i>

                    </span>

                </button>

                <aside id="sidebar" class="ts-sidebar collapse navbar-collapse">

                    <section id="sidebar-search-form">

                        <h3 class="mb-4 pb-4">Property Search</h3>

                        <form id="form-search" class="ts-form">

                            <!--Keyword-->

                            <div class="form-group">

                                <input type="text" class="form-control" id="search" name="search" placeholder="Address, City or ZIP">

                            </div>

                            <!--Type-->

                            <div class="form-group">
                                <?php echo form_dropdown('type', $opt_type, isset($type) ? $type : '', 'id="type" class="custom-select"'); ?>
                            </div>

                            <!--Status-->

                            <div class="form-group">
                                <?php echo form_dropdown('status', $opt_status, isset($status) ? $status : '', 'id="status" class="custom-select"'); ?>
                            </div>

                            <div class="form-group">

                                <!--Row - Min price & Max price-->

                                <div class="row">

                                    <!--Min Price-->

                                    <div class="col-sm-6">

                                        <!-- <div class="input-group"> -->
                                            <!-- <div class="input-group-append">

                                                <span class="input-group-text bg-white border-right-0">Rp</span>

                                            </div> -->

                                            <input type="text" class="form-control text-right" id="min_price" name="min_price" placeholder="Min Price">



                                        <!-- </div> -->

                                    </div>

                                    <!--Max Price-->

                                    <div class="col-sm-6">

                                        <!-- <div class="input-group"> -->
                                            <!-- <div class="input-group-append">

                                                <span class="input-group-text bg-white border-right-0">Rp</span>

                                            </div> -->

                                            <input type="text" class="form-control text-right" id="max_price" name="max_price" placeholder="Max Price" value="5000000000"> <!-- value="500000000000" -->



                                        <!-- </div> -->

                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <!--Row - Bedrooms & Bathrooms-->

                                <div class="row">

                                    <!--Bedrooms-->

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <input type="number" class="form-control" id="bedrooms" name="bedrooms" min="0" placeholder="Bedrooms">

                                        </div>

                                    </div>

                                    <!--Bathrooms-->

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <input type="number" class="form-control" id="bathrooms" name="bathrooms" min="0" placeholder="Bathrooms">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!--Checkboxes-->

                            <div id="features-checkboxes" class="w-100">
                                <h6 class="mb-3">More Features</h6>
                                <div class="ts-column-count-2">
                                    <?php
                                    if (!empty($data_feature)) {
                                        foreach ($data_feature as $val) {
                                    ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_<?= $val->id ?>" name="features[]" value="<?= $val->id ?>">
                                                <label class="custom-control-label" for="ch_<?= $val->id ?>"><?= $val->nama ?></label>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                                <!--end ts-column-count-3-->
                            </div>

                            <!--end #features-checkboxes-->

                            <!--Submit button-->

                            <div class="form-group my-2">

                                <button type="button" class="btn btn-primary" id="search-btn">Search

                                </button>

                            </div>

                        </form>

                        <!--end #form-search-->

                    </section>

                    <!--end #sidebar-search-form-->

                </aside>

                <!--end #sidebar-->

            </div>

            <!-- End Right Side -->

        </div>

    </div>

</section>



<section id="contact-form" class="bg-grea-3 content-area-0">

    <div class="container">

        <div class="main-title text-left">

            <h2>Contact Property Consultant</h2>

        </div>

        <form id="form-contact" method="post">

            <div id="alert_notif"></div>

            <div class="row">

                <div class="col-md-6 col-sm-6">

                    <input type="hidden" value="<?= isset($id_agent) ? $id_agent : ''; ?>" name="id_agent" id="id_agent" readonly>

                    <div class="form-group">

                        <label for="form-contact-name">Name *</label>

                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="">

                    </div>

                </div>

                <div class="col-md-6 col-sm-6">

                    <div class="form-group">

                        <label for="form-contact-email">Email *</label>

                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required="">

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label for="form-contact-email">Subject*</label>

                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="">

            </div>

            <div class="form-group">

                <label for="form-contact-message">Message *</label>

                <textarea class="form-control" id="message" rows="5" name="message" placeholder="Your Message" required=""></textarea>

            </div>

            <div class="form-group">

                <div id="captcha_el" class="g-recaptcha" data-sitekey="6Lfz1LcUAAAAAPIx6KW33lR1vMpFlT_826O6NLFO"></div>

            </div>

            <div class="row">

                <div class="col-md-12 text-center">

                    <div class="form-group clearfix">

                        <button type="button" id="btn-send" class="btn btn-primary btn-more">

                            <i class="fas fa-circle-notch fa-spin spinner"></i> Send a Message

                        </button>

                    </div>

                </div>

            </div>

            <div class="form-contact-status"></div>

        </form>

    </div>

</section>