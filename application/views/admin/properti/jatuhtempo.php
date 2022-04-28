<!-- Main content -->
<div class="content-wrapper">
	<?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
		<!-- <div style="padding-right: 20px;margin-bottom: 10px;">
			<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round" style="float:right"><i class="icon-plus-circle2"></i> Add Properti</button>
		</div> -->
	<?php } ?>
	<!-- Content area -->
	<div class="content pt-0">

		<!-- Main charts -->
		<div class="row">
			<div class="col-xl-12">

				<!-- Traffic sources -->
				<div class="card">
					<div class="card-header bg-white header-elements-inline">
						<!-- <div class="row">
							<div class="col-md-7" style="margin-bottom: 2%;"> -->
								<!-- <form id="filter_properti" class="form-inline"> -->
									<!-- <div class="form-group">
										<b>Status:</b>&nbsp;&nbsp;
									</div> -->
									<div class="form-group">
										<?php 
											echo form_dropdown('opt_filter_status', $filter_status, $status_val, ' class="form-control" id="opt_filter_status" '); 
										?>
									</div>
									<!-- <div class="form-group">
										<button type="submit" class="btn btn-light" id="btn_search">
											<i class="icon-database-refresh"></i> Reload 
										</button>
									</div> -->
								<!-- </form> -->
							<!-- </div>
						</div> -->
						<div class="header-elements">
						</div>
					</div>
					

				
					<table class="table responsive nowrap datatable-button-init-basic" id="table_properti" width="100%"> <!-- datatable-responsive -->
						<thead>
							<tr class="bg-orange-700">
								<th> No </th>
								<!-- <th> ID </th> -->
								<th> Nama </th>
								<th> Alamat </th>
								<th> Jenis Property </th>
								<th> Status Property </th>
								<!-- <th> Luas Bangunan </th>
								<th> Luas Tanah </th>
								<th> Jumlah Lantai </th>
								<th> Legalitas </th> -->
								<th> PIC </th>
								<!-- <th> Telp </th> -->
								<!-- <th> Harga Jual </th> -->
								<!-- <th> Harga User </th> -->
								<!-- <th> Fasilitas </th>
								<th> Deskripsi </th> -->
								<th> Start Date </th>
								<th> Due Date </th>
								<!-- <th> Foto Cover </th> -->
								<!-- <th> Status </th> -->
								<!-- <th style="text-align:center"> Action </th> -->
							</tr>
						</thead>
					</table>
				</div>
				<!-- /traffic sources -->

			</div>
		</div>
	</div>
	
	<style>

		.select2-container--default .select2-search--inline .select2-search__field {
			width: initial !important;
		}

		.card {
			padding: 1%;
		}

		#table_properti_wrapper {
			padding-top: 1%;
		}
		
		.pac-input::-webkit-input-placeholder, 
		.pac-input::-moz-placeholder, 
		.pac-input::-ms-input-placeholder {
    		font-weight: bold;
		}

		

	</style>