<!-- Main content -->
<div class="content-wrapper">
<?php if ($this->session->userdata('level') == 2) { ?>
	<div style="padding-right: 20px;margin-bottom: 10px;">
		<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round" style="float:right"><i class="icon-plus-circle2"></i> Add Premium Investor</button>
	</div>
<?php } ?>
	<!-- Content area -->
	<div class="content pt-0">

		<!-- Main charts -->
		<div class="row">
			<div class="col-xl-12">

				<!-- Traffic sources -->
				<div class="card">
					<table class="table responsive nowrap datatable-button-init-basic table-columned table-hover" id="table1" width="100%">
						<thead>
							<tr class="bg-orange-700">
								<th> No </th>
								<th> Nama Lengkap </th>
								<th> Username </th>
								<th> Email </th>
								<th> Alamat </th>
								<th> Phone </th>
								<th style="text-align:center"> Action </th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /traffic sources -->

			</div>
		</div>
	</div>



	<!-- Large modal -->
	<div id="modal_form" class="modal fade" data-backdrop="static">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Form Premium Investor</h5>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<form enctype="multipart/form-data" id="form-data">
						<fieldset class="mb-3">
							<div class="form-group row">
								<input type="hidden" name="id" id="id">
								<label class="col-form-label col-lg-3">Nama Lengkap</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="fullname" name="fullname" class="form-control">
									</div>
								</div>
								<!-- <label class="col-form-label col-lg-3">Nama Depan</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="first_name" name="first_name" class="form-control">
									</div>
								</div> -->
							</div>
							<!-- <div class="form-group row">
								<label class="col-form-label col-lg-3">Nama Belakang</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="last_name" name="last_name" class="form-control">
									</div>
								</div>
							</div> -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3"> Tempat & Tanggal Lahir</label>
								<div class="col-lg-3">
									<input type="text" class="form-control input-md" id="tempat_lahir"
										name="tempat_lahir" value="">
								</div>
								<div class="col-lg-3">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp; 
										<input type="text" class="form-control input-md" id="tgl_lahir" name="tgl_lahir"
											readonly placeholder="Tanggal Lahir">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Alamat</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="alamat" name="alamat" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Phone</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="telp" name="telp" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Username</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="username" name="username" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Email</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="email" id="email" name="email" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Deskripsi </label>
								<div class="col-lg-8">
									<div class="input-group">
										<textarea class="form-control" id="deskripsi" name="deskripsi" rows="7" placeholder="Input deskripsi"></textarea>
									</div>
								</div>
							</div>
						</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn bg-grey-300" data-dismiss="modal">Close</button>
					<button type="button" id="btn_simpan" class="btn btn-primary" onclick="save_data()">Simpan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- /large modal -->



<style>
	
	.card {
		padding: 1%;
	}

</style>