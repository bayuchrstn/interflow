<!-- Main content -->
<div class="content-wrapper">
	<div style="padding-right: 20px;margin-bottom: 10px;">
	<?php
		$level = $this->session->userdata('level'); 
		if ($level == 1 || $level == 2) { ?>
		<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round"
			style="float:right"><i class="icon-plus-circle2"></i> Add Property Consultant</button>
	<?php } ?>
	</div>
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
								<th> Nama Lengkap</th>
								<th> Nickname</th>
								<th> ID Consultant </th>
								<th> Motto </th>
								<th> Username </th>
								<th> Email </th>
								<!-- <th> Alamat </th> -->
								<th> Phone 1 </th>
								<th> Phone 2 </th>
								<th> Foto Profil </th>
								<th> File PDF </th>
								<th> Cabang </th>
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
					<h5 class="modal-title">Form Property Consultant</h5>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<form id="form-data" enctype="multipart/form-data">
						<fieldset class="mb-3">
							<div class="form-group row">
							<input type="hidden" name="id" id="id">
								<label class="col-form-label col-lg-3">Tanggal Permohonan</label>
								<div class="col-lg-8">
									<div class="col-lg-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp; 
											<input type="text" class="form-control input-md" id="tgl_permohonan" name="tgl_permohonan"
												readonly placeholder="Tanggal Permohonan">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">ID Consultant</label>
								<div class="col-lg-3">
									<div class="input-group">
										<input type="text" id="id_consultant" name="id_consultant" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Nama Lengkap</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="fullname" name="fullname" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Nickname</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="nickname" name="nickname" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3"> Motto </label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" id="motto" name="motto" class="form-control">
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
								<label class="col-form-label col-lg-3">Jenis Identitas</label>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<!-- <div class="uniform-choice"> -->
													<span class="">
														<input type="radio" class="form-check-input-styled" name="jns_identitas" id="rd_ktp"
															value="KTP" data-fouc> <!-- checked data-fouc="" -->
													</span>
												<!-- </div> -->
												KTP
											</label>
										</div>
									</div>
									<div class="col-lg-1" style="margin-right: 5%;">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<!-- <div class="uniform-choice"> -->
													<span class="">
														<input type="radio" class="form-check-input-styled" name="jns_identitas" id="rd_sim"
															value="SIM" data-fouc> <!-- data-fouc="" -->
													</span>
												<!-- </div> -->
												SIM
											</label>
										</div>
									</div>
									<label class="col-form-label col-lg-2">Nomor Identitas</label>
									<div class="col-lg-4">
										<div class="input-group">
											<input type="text" id="nmr_identitas" name="nmr_identitas" class="form-control">
										</div>
									</div>
								
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Jenis Kelamin</label>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="gender" id="rd_male"
														value="Pria" data-fouc> 
												</span>
												Pria
											</label>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="gender" id="rd_female"
														value="Wanita" data-fouc> 
												</span>
												Wanita
											</label>
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
								<label class="col-form-label col-lg-3">Nomor Telepon (Rumah)</label>
								<div class="col-lg-2">
									<div class="input-group">
										<input type="text" id="kode_area_telp" name="kode_area_telp" class="form-control" placeholder="Kode Area">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="input-group">
										<input type="text" id="telp_rumah" name="telp_rumah" class="form-control" placeholder="Telepon Rumah">
									</div>
								</div>
							</div> 
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Telepon Seluler 1</label>
								<div class="col-lg-3">
									<div class="input-group">
										<input type="text" id="telp" name="telp" class="form-control">
									</div>
								</div>
								<label class="col-form-label col-lg-2">Telepon Seluler 2 <b> (Opsional) </b> </label>
								<div class="col-lg-3">
									<div class="input-group">
										<input type="text" id="telp_2" name="telp_2" class="form-control">
									</div>
								</div>
							</div> 
							<!-- <div class="form-group row">
								
							</div> -->
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
								<label class="col-form-label col-lg-3">Pendidikan Terakhir</label>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="education" id="rd_sma"
														value="SMA" data-fouc> 
												</span>
												SMA
											</label>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="education" id="rd_s1"
														value="S1" data-fouc> 
												</span>
												S1
											</label>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="education" id="rd_s2"
														value="S2" data-fouc> 
												</span>
												S2
											</label>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="education" id="rd_s3"
														value="S3" data-fouc> 
												</span>
												S3
											</label>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="education" id="rd_other_edu"
														value="other_edu" data-fouc> 
												</span>
												Lainnya 
											</label> 
										</div>
									</div> 
									<div class="col-lg-2" style="margin-left: 2%;">
										<input type="text" id="other_edu" name="other_edu" class="form-control" placeholder="Pendidikan Lain">
									</div>
								
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Status Pernikahan</label>
									<div class="col-lg-2">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="marital_status" id="rd_married"
														value="Menikah" data-fouc> 
												</span>
												Menikah
											</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<span class="">
													<input type="radio" class="form-check-input-styled" name="marital_status" id="rd_single"
														value="Belum Menikah" data-fouc> 
												</span>
												Belum Menikah
											</label>
										</div>
									</div>
								
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Agama</label>
								<div class="col-lg-4">
									<div class="input-group">
									<?php echo form_dropdown('religion', $opt_religion, '0', ' class="form-control" id="religion" '); ?>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3"> Rekening Bank BCA No. Rekening </label>
								<div class="col-lg-4">
									<div class="input-group">
										<input type="text" id="no_rek" name="no_rek" class="form-control">
									</div>
								</div>
							</div> 
							<div class="form-group row">
								<label class="col-form-label col-lg-3"> Rekening Atas Nama </label>
								<div class="col-lg-4">
									<div class="input-group">
										<input type="text" id="no_rek_atasnama" name="no_rek_atasnama" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3"> KCP </label>
								<div class="col-lg-4">
									<div class="input-group">
										<input type="text" id="kcp" name="kcp" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Kelengkapan</label>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<div class="">
											<span class="">
												<input type="checkbox" class="form-check-input-styled" 
													name="kelengkapan[]" id="chk_doc1" value="FC KTP" data-fouc="">
											</span>
										</div>
										FC KTP
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<div class="">
											<span class="">
												<input type="checkbox" class="form-check-input-styled" 
													name="kelengkapan[]" id="chk_doc2" value="FC NPWP" data-fouc="">
											</span>
										</div>
										FC NPWP
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<div class="">
											<span class="">
												<input type="checkbox" class="form-check-input-styled" 
													name="kelengkapan[]" id="chk_doc3" value="FC KK, KTP SUAMI" data-fouc="">
											</span>
										</div>
										FC KK, KTP SUAMI
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<div class="">
											<span class="">
												<input type="checkbox" class="form-check-input-styled" 
													name="kelengkapan[]" id="chk_doc4" value="FC COVER BUKU TABUNGAN" data-fouc="">
											</span>
										</div>
										FC COVER BUKU TABUNGAN
									</label>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3">Referensi Agen
									<br> <b> (Opsional) </b> 
								</label>
								<div class="col-lg-5">
									<div class="input-group">
									<?php echo form_dropdown('agent_ref', $opt_ref_agent, '0', ' class="form-control" id="agent_ref" '); ?>
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
					<button type="button" class="btn bg-grey-300" data-dismiss="modal">Close</button>
					<button type="button" id="btn_simpan" class="btn btn-primary" onclick="save_data()">Simpan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- /large modal -->
	



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


<style>
	
	.card {
		padding: 1%;
	}

</style>