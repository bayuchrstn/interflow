<!-- Main content -->
<div class="content-wrapper">
	<div style="padding-right: 20px;margin-bottom: 10px;">
		<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round"
			style="float:right">
			<i class="icon-plus-circle2"></i> Add Lowongan
		</button>
	</div>
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
								<th> Posisi Pekerjaan </th>
								<th> Keterangan </th>
								<th> Persyaratan </th>
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
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Form Lowongan</h5>
				</div>
				<div class="modal-body">
				<form id="form-data" enctype="multipart/form-data">
					<fieldset class="mb-3">
						<div class="form-group row">
							<input type="hidden" name="id" id="id">
							<label class="col-form-label col-md-2">Posisi Pekerjaan</label>
							<div class="col-md-10">
								<div class="input-group">
									<input type="text" id="posisi_kerja" name="posisi_kerja" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Keterangan</label>
							<div class="col-md-10">
								<div class="input-group">
									<textarea class="form-control" id="keterangan" name="keterangan" rows="6" placeholder="Input Keterangan"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Persyaratan</label>
							<div class="col-md-10">
								<div class="input-group">
									<textarea class="form-control summernote" id="persyaratan" name="persyaratan" rows="6" placeholder="Input Persyaratan"></textarea>
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
    

<style>
	
	.card {
		padding: 1%;
	}

</style>