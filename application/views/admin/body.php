<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0">
        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Traffic sources -->
                <?php if ($this->session->userdata('level') == 1) { ?>
				<div class="card">
					<div class="card-header header-elements-inline" style="padding-top: 2.5rem; justify-content: unset;">


						<!-- Quick stats boxes -->
						<div class="row col-lg-12">


							<div class="col-lg-3">

								<!-- Members online -->
								<a href="<?php echo base_url('admin/Manage_properti?status=aktif'); ?>">
									<div class="card bg-teal-400">
										<div class="card-body">
											<div class="visual">
                                                <i class="icon-checkbox-checked"></i>
											</div>
											<div class="d-flex">
												<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
													<span data-counter="counterup" data-value="50" id="jml_properti_aktif">
														<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
													</span>
												</h1>
											</div>

											<div> Properti Aktif </div>
											
										</div>
										
										<!-- <div class="container-fluid">
											<div id="members-online"></div>
										</div> -->
									</div>
								</a>
								<!-- /members online -->

							</div>

							<div class="col-lg-3">

								<!-- Current server load -->
								<a href="<?php echo base_url('admin/Manage_properti?status=proses'); ?>">
									<div class="card bg-primary-600">
										<div class="card-body">
											<div class="visual">
                                                <i class="icon-spinner9"></i>
											</div>
											<div class="d-flex">
												<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
													<span data-counter="counterup" data-value="50" id="jml_properti_process">
														<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
													</span>
												</h1>
											</div>
											<div> Properti on Progress </div>
										</div>

									</div>
								</a>
								<!-- /current server load -->

							</div>

							<div class="col-lg-3">

								<!-- Today's revenue -->
								<a href="<?php echo base_url('admin/Manage_user/Agent'); ?>">
									<div class="card bg-orange-600" style="background-color: #F08519;">
										<div class="card-body">
											<div class="visual">
                                                <i class="icon-users4"></i>
											</div>
											<div class="d-flex">
												<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
													<span data-counter="counterup" data-value="50" id="jml_agent">
														<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
													</span>
												</h1>
											</div>

											<div> Property Consultant </div>
										</div>

									</div>
								</a>
								<!-- /today's revenue -->

                            </div>


							<div class="col-lg-3">

							<!-- Members online -->
							<a href="<?php echo base_url('admin/Dashboard/visitor'); ?>">
								<div class="card bg-yellow-300" style="background-color: #ab930e;">
									<div class="card-body">
										<div class="visual">
										<i class="icon-graph"></i>
										</div>
										<div class="d-flex">
											<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
												<span data-counter="counterup" data-value="50" id="jml_visitor">
													<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
												</span>
											</h1>
										</div>

										<div> Visitor Hari ini </div>
									</div>

								</div>
							</a>
                            <!-- /members online -->

                            </div>

                            <!-- <div class="col-lg-3"> -->

								<!-- Today's revenue -->
								<!-- <a href="<?php echo base_url('admin/Manage_properti/approval'); ?>">
									<div class="card bg-olive-600" style="background-color: #91921b;">
										<div class="card-body">
											<div class="visual">
                                                <i class="icon-envelope"></i>
											</div>
											<div class="d-flex">
												<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
													<span data-counter="counterup" data-value="50" id="jml_approval"> -->
														<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
													<!-- </span>
												</h1>
											</div>

											<div> Approval Property </div>
										</div>

									</div>
								</a> -->
								<!-- /today's revenue -->

                            <!-- </div> -->

                            
                            

						</div>
						<!-- /quick stats boxes -->


                    </div>
                    

					<div class="card-header header-elements-inline" style="padding-top: 0rem; justify-content: unset;">
					<div class="row col-lg-12">
                        <div class="col-lg-3">

							<!-- Members online -->
							<a href="<?php echo base_url('admin/Manage_user/Premium_investor'); ?>">
								<div class="card bg-purple-300" style="background-color: #775aa9;">
									<div class="card-body">
										<div class="visual">
                                            <i class="icon-stars"></i>
										</div>
										<div class="d-flex">
											<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
												<span data-counter="counterup" data-value="50" id="jml_premium_investor">
													<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
												</span>
											</h1>
										</div>

										<div> Premium Investor </div>
									</div>

								</div>
							</a>
                            <!-- /members online -->

                            </div>


                            <div class="col-lg-3">

                                <!-- Members online -->
                                <a href="<?php echo base_url('admin/Master/Cabang'); ?>">
                                    <div class="card bg-brown-400" style="background-color: #7d6258;">
                                        <div class="card-body">
                                            <div class="visual">
                                                <i class="icon-office"></i>
                                            </div>
                                            <div class="d-flex">
                                                <h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
                                                    <span data-counter="counterup" data-value="50" id="jml_cabang">
                                                        <!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
                                                    </span>
                                                </h1>
                                            </div>
                                            <!-- <div class="d-flex">
                                                <h1 class="font-weight-semibold mb-0" id="jml_cabang"></h1>
                                            </div> -->

                                                <div> Cabang </div>
                                        </div>

                                        
                                    </div>
                                </a>
                                <!-- /members online -->

							</div>

							<div class="col-lg-3">

							<!-- Members online -->
							<a href="<?php echo base_url('admin/Manage_properti?status=new'); ?>">
								<div class="card bg-success-600">
									<div class="card-body">
										<div class="visual">
                                            <i class="icon-folder-plus"></i>
										</div>
										<div class="d-flex">
											<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
												<span data-counter="counterup" data-value="50" id="jml_properti_new">
													<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
												</span>
											</h1>
										</div>
										<!-- <div class="d-flex">
											<h1 class="font-weight-semibold mb-0" id="jml_cabang"></h1>
										</div> -->

											<div> Properti Baru <!-- (Hari ini) --> </div>
									</div>

									
								</div>
							</a>
                            <!-- /members online -->

                            </div>
							
                            <div class="col-lg-3">

							<!-- Members online -->
							<a href="<?php echo base_url('admin/Manage_properti?status=due_date'); ?>">
								<div class="card bg-danger-600">
									<div class="card-body" style="width: 111%;">
										<div class="visual">
                                            <i class="icon-calendar2"></i>
										</div>
										<div class="d-flex">
											<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
												<span data-counter="counterup" data-value="50" id="jml_properti_due_date">
													<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
												</span>
											</h1>
										</div>
										<!-- <div class="d-flex">
											<h1 class="font-weight-semibold mb-0" id="jml_cabang"></h1>
										</div> -->

											<div> Properti Due Date <!-- (Minggu Ini) --> </div>
											<div>  (<?php echo date('d-m-Y').' s.d. '.date('d-m-Y', strtotime('+6 days')); ?>) </div>
									</div>

									
								</div>
							</a>
                            <!-- /members online -->

                            </div>
							
							<div class="col-lg-3">

							<!-- Members online -->
							<a href="<?php echo base_url('admin/Manage_properti/jatuh_tempo'); ?>">
								<div class="card bg-darken-4-300" style="background-color: #1a6285;">
									<div class="card-body">
										<div class="visual">
										<i class="icon-book"></i>
										</div>
										<div class="d-flex">
											<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
												<span data-counter="counterup" data-value="50" id="jml_jatuhtempo">
													<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
												</span>
											</h1>
										</div>

										<div> Properti Jatuh Tempo </div>
									</div>

								</div>
							</a>
                            <!-- /members online -->

                            </div>

							

						</div>
					</div>
				</div>
			<?php } ?>
                <!-- /traffic sources -->
            </div>
        </div>
	</div>
	 <!-- Content area -->
	 <div class="content pt-0">
        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Traffic sources -->
                <?php if ($this->session->userdata('level') == 3) { ?>
				<div class="card">
					<div class="card-header header-elements-inline" style="padding-top: 2.5rem; justify-content: unset;">


						<!-- Quick stats boxes -->
						<div class="row col-lg-12">


							<div class="col-lg-3">

								<!-- Members online -->
								<a href="<?php echo base_url('admin/Manage_properti'); ?>">
									<div class="card bg-teal-400">
										<div class="card-body">
											<div class="visual">
                                                <i class="icon-checkbox-checked"></i>
											</div>
											<div class="d-flex">
												<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
													<span data-counter="counterup" data-value="50" id="jml_properti_aktif">
														<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
													</span>
												</h1>
											</div>

											<div> Properti</div>
											
										</div>
										
										<!-- <div class="container-fluid">
											<div id="members-online"></div>
										</div> -->
									</div>
								</a>
								<!-- /members online -->

							</div>

                            <div class="col-lg-3">

								<!-- Today's revenue -->
								<a href="<?php echo base_url('admin/Manage_properti'); ?>">
									<div class="card bg-olive-600" style="background-color: #91921b;">
										<div class="card-body">
											<div class="visual">
                                                <i class="icon-envelope"></i>
											</div>
											<div class="d-flex">
												<h1 class="font-weight-semibold mb-0" style="font-size: 35px;">
													<span data-counter="counterup" data-value="50" id="jml_approval">
														<!-- <h1 class="font-weight-semibold mb-0" ></h1> -->
													</span>
												</h1>
											</div>

											<div>Property Has Not Ben Approved</div>
										</div>

									</div>
								</a>
								<!-- /today's revenue -->

                            </div>

                            
                            

						</div>
						<!-- /quick stats boxes -->


                    </div>
                    

					
				</div>
			<?php } ?>
                <!-- /traffic sources -->
            </div>
        </div>
    </div>
    <div class="content pt-0">
        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header header-elements-inline" style="padding-top: 23.25rem;">
                    </div>
                    <div class="card-body py-0">
                        <div class="row">
                        </div>
                    </div>
                    <div class="chart position-relative" id="traffic-sources"></div>
                </div>
            </div>
        </div>
        <style>
		.visual {	
			width: 80px;
			height: 80px;
			display: block;
			float: right;
			padding-top: 10px;
			padding-left: 15px;
			margin-bottom: 15px;
			font-size: 35px;
			line-height: 35px;
			color: #FFF;
			opacity: .1;
		}

		.visual > i {
			margin-left: -35px;
			font-size: 110px;
			line-height: 110px;
		}

		.details {
			position: absolute;
			right: 15px;
			padding-right: 15px;
		}
	</style>