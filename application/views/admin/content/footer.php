<!-- Main content -->
<div class="content-wrapper">
	<!-- Content area -->
	<div class="content pt-0">

		<!-- Main charts -->
		<div class="row">
			<div class="col-xl-12">

				<!-- Traffic sources -->
				<div class="card">
					<table class="table responsive nowrap datatable-button-init-basic" id="table1" width="100%">
						<thead>
							<tr class="bg-orange-700">
								<th> # </th>
								<th> Alamat Perusahaan</th>
								<th> Kontak </th>
								<th> Email </th>
								<th> Link Facebook </th>
								<th> Link Instagram </th>
								<th> Nama Email </th>
								<th> Nama Facebook </th>
								<th> Nama Instagram </th>
								<th style="text-align:center"> Action </th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /traffic sources -->

			</div>
		</div>
	</div>

	<!-- Medium modal -->
	<div id="modal_form" class="modal fade" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-scrollable ">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Form Footer</h5>
				</div>
				<div class="modal-body">
					<form id="form-data">
						<fieldset class="mb-3">
							<div class="form-group row">
								<input type="hidden" name="id" id="id">
								<label class="col-form-label col-md-2">Alamat</label>
								<div class="col-md-10">
									<div class="input-group">
										<input type="text" id="alamat" name="alamat" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Kontak</label>
								<div class="col-md-10">
									<div class="input-group">
										<textarea class="form-control" id="kontak" name="kontak" rows="5"
											placeholder="Input kontak"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Email</label>
								<div class="col-md-10">
									<div class="input-group">
										<input type="text" id="email" name="email" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Link Facebook</label>
								<div class="col-md-10">
									<div class="input-group">
										<input type="text" id="facebook" name="facebook" class="form-control">
									</div>
								</div>
							</div>
								<div class="form-group row">
									<label class="col-form-label col-md-2">Link Instagram</label>
									<div class="col-md-10">
										<div class="input-group">
											<input type="text" id="instagram" name="instagram" class="form-control">
										</div>
									</div>
								</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Nama Email</label>
								<div class="col-md-10">
									<div class="input-group">
										<input type="text" id="email_name" name="email_name" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Nama Facebook</label>
								<div class="col-md-10">
									<div class="input-group">
										<input type="text" id="facebook_name" name="facebook_name" class="form-control">
									</div>
								</div>
							</div>
								<div class="form-group row">
									<label class="col-form-label col-md-2">Nama Instagram</label>
									<div class="col-md-10">
										<div class="input-group">
											<input type="text" id="instagram_name" name="instagram_name" class="form-control">
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
	<!-- /Medium modal -->


	<!-- Image Modal -->
	<div class="modal fade" id="picture" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<center> <img id="myImage" class="img-fluid" src="" alt=""> </center>
				</div>
				<div class="modal-footer">
					<a class="btn btn-primary btn_download" download="" href=""><i class="fa fa-download"></i> Download</a>
					<button type="button" class="btn bg-grey-300" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Image modal -->

	<!-- <div style="padding-right: 20px;margin-bottom: 10px;">
		<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round"
			style="float:right">
			<i class="icon-plus-circle2"></i> Add Footer
		</button>
	</div> -->

<style>
	
	.card {
		padding: 1%;
	}
</style>
	
