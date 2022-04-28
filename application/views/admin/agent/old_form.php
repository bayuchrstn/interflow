<!-- Large modal -->
<div id="modal_form" class="modal fade" data-backdrop="static">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Form Agent</h5>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<form id="form-data" enctype="multipart/form-data">
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
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Nickname</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="nickname" name="nickname" class="form-control">
									</div>
								</div>
								<!-- <label class="col-form-label col-lg-3">Nama Belakang</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="last_name" name="last_name" class="form-control">
									</div>
								</div> -->
							</div>
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
							<!-- <div class="form-group row">
								<label class="col-form-label col-lg-3">Alamat</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="alamat" name="alamat" class="form-control">
									</div>
								</div>
							</div> -->
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Phone 1</label>
								<div class="col-lg-4">
									<div class="input-group">
										<input type="text" id="telp" name="telp" class="form-control">
									</div>
								</div>
							</div> 
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Phone 2
									<br> <b> (Opsional) </b> 
								</label>
								<div class="col-lg-4">
									<div class="input-group">
										<input type="text" id="telp_2" name="telp_2" class="form-control">
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
								<label class="col-form-label col-lg-3">Foto</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="file" name="file_img" id="file_img" class="form-control">
									</div>
									<span class="form-text text-muted">Ukuran File max. <b> 250 KB </b> </span>
								</div>
							</div>
							<div id="old_img"></div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Cabang</label>
								<div class="col-lg-8">
									<div class="input-group">
									<?php echo form_dropdown('cabang', $opt_cabang, '0', ' class="form-control" id="cabang" '); ?>
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
										<textarea class="form-control" id="deskripsi" name="deskripsi" rows="7"
											placeholder="Input deskripsi"></textarea>
									</div>
								</div>
							</div>
							<input type="hidden" id="img_name" name="img_name" value="">
						</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" id="btn_simpan" class="btn bg-orange-700" onclick="save_data()">Simpan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- /large modal -->