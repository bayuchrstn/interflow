<!-- <script type="text/javascript">
           function formatCurrency(num) {
num = num.toString().replace(/\$|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+'.'+
num.substring(num.length-(4*i+3));
return (((sign)?'':'-') + 'Rp' + num + ',' + cents);
}
		</script> -->


<!-- Main content -->
<div class="content-wrapper">
	<?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
		<div style="padding-right: 20px;margin-bottom: 10px;">
			<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round" style="float:right"><i class="icon-plus-circle2"></i> Add Properti</button>
		</div>
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
						<form id="filter_properti" class="form-inline">
							<div class="form-group">
								<b>Status:</b>&nbsp;&nbsp;
							</div>
							<div class="form-group">
								<?php
								echo form_dropdown('opt_filter_status', $filter_status, $status_val, ' class="form-control" id="opt_filter_status" ');
								?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-light" id="btn_search">
									<i class="icon-database-refresh"></i> Reload
								</button>
							</div>
						</form>
						<!-- </div>
						</div> -->
						<div class="header-elements">
						</div>
					</div>



					<table class="table responsive nowrap datatable-button-init-basic" id="table_properti" width="100%">
						<!-- datatable-responsive -->
						<thead>
							<tr class="bg-orange-700">
								<th> No </th>
								<th> ID </th>
								<th> Nama </th>
								<th> Alamat </th>
								<th> Jenis Property </th>
								<th> Status Property </th>
								<!-- <th> Luas Bangunan </th>
								<th> Luas Tanah </th>
								<th> Jumlah Lantai </th>
								<th> Legalitas </th> -->
								<th> PIC </th>
								<th> Telp </th>
								<th> Harga Jual / Sewa </th>
								<th> Harga User </th>
								<!-- <th> Fasilitas </th>
								<th> Deskripsi </th> -->
								<th> Start Date </th>
								<th> Due Date </th>
								<th> Foto Cover </th>
								<th> Status </th>
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
	<div id="modal_properti" class="modal fade" data-backdrop="static">
		<!-- tabindex="-1" -->
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Form Properti</h5>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<form id="form-properti" enctype="multipart/form-data">
						<fieldset class="mb-3">
							<div class="row" style="margin-bottom: 3%;">

								<div class="col-lg-12" style="margin-right: 5%;">

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Kontak Agen</label>
										<div class="col-lg-8">

											<div class="input-group">
												<!-- <input type="hidden" name="telp" class="form-control" value="<?= $this->session->userdata('id'); ?>"><?= $this->session->userdata('username'); ?>  -->
												<?php
												$level = $this->session->userdata('level');

												if ($level != 3) {
													echo form_dropdown('telp', $opt_kontak, '0', ' class="form-control" id="telp" ');
												} else {
													$user_id = $this->session->userdata('id');
													echo form_dropdown('telp', $opt_kontak, $user_id, ' class="form-control" id="telp" ');
												}

												?>
												<input type="hidden" id="no_hp" name="no_hp">
												<input type="hidden" id="pic" name="pic">
												<!-- <input type="hidden" id="no_hp" name="no_hp" value="<?= $this->session->userdata('phone'); ?>">
										<input type="hidden" id="pic" name="pic" value="<?= $this->session->userdata('nama'); ?>"> -->
												<!-- <select name="telp" id="telp"> </select> -->
											</div>
										</div>
									</div>

									<div class="form-group row">
										<input type="hidden" name="id" id="id">
										<label class="col-form-label col-lg-4">Judul</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="nama" name="nama" class="form-control" placeholder="Input Judul" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Alamat Lengkap</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="alamat" name="alamat" class="form-control" placeholder="Input Alamat Lengkap" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Alamat Singkat <br> <i> (tampil pada website) </i></label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="nama_jalan" name="nama_jalan" class="form-control" placeholder="Input Alamat Singkat" autocomplete="off">
											</div>
										</div>
									</div>
									<!--div class="form-group row">
										<label class="col-form-label col-lg-4">No. Jalan, RT/RW</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="nmr_jalan" name="nmr_jalan" class="form-control"
													placeholder="No. Jalan" autocomplete="off">
												<input type="text" id="rt" name="rt" class="form-control"
													placeholder="RT" style="margin-left: 5%;" autocomplete="off">
												<input type="text" id="rw" name="rw" class="form-control"
													placeholder="RW" style="margin-left: 5%;" autocomplete="off">
											</div>
										</div>
									</div-->

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Tampilkan alamat pada Map</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="radio" checked id="flok" name="flag" class="flag" value="0"> Ya &nbsp &nbsp &nbsp &nbsp &nbsp
												<input type="radio" id="flok" name="flag" class="flag" value="2"> Tidak
											</div>
										</div>
									</div>



									<div class="col-lg-12">
										<div class="form-group row">
											<label class="col-form-label col-lg-4">Jenis Property</label>
											<div class="col-lg-8">
												<div class="input-group">
													<?php echo form_dropdown('jns_property', $opt_kategori, '0', ' class="form-control" id="jns_property" '); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-4">Status Property</label>
											<div class="col-lg-8">
												<div class="input-group">
													<?php echo form_dropdown('status_property', $opt_status, '0', ' class="form-control" id="status_property" '); ?>
												</div>
											</div>
										</div>
										<!-- <div class="form-group row">
										<label class="col-form-label col-lg-3">Harga User</label>
										<div class="col-lg-9">
											<div class="input-group">
												<input type="number" id="harga_user" name="harga_user" 
													class="form-control" min="0" placeholder="Input Harga User" autocomplete="off">
											</div>
										</div>
									</div> -->
										<div class="form-group row form_tipe_jual_tanah">
											<label class="col-form-label col-lg-4">Tipe Jual Tanah</label>
											<div class="col-lg-4">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<!-- <div class="uniform-choice"> -->
														<span class="">
															<input type="radio" class="form-check-input-styled" name="options_type" id="rd_tanah_area" value="1" data-fouc> <!-- checked data-fouc="" -->
														</span>
														<!-- </div> -->
														Luas area
													</label>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<!-- <div class="uniform-choice"> -->
														<span class="">
															<input type="radio" class="form-check-input-styled" name="options_type" id="rd_tanah_per_meter" value="2" data-fouc> <!-- data-fouc="" -->
														</span>
														<!-- </div> -->
														Per M<sup>2</sup>
													</label>
												</div>
											</div>

										</div>
										<div class="form-group row form_harga_jual">
											<label class="col-form-label col-lg-4 harga_jual_txt">Harga Jual</label>
											<div class="col-lg-8">
												<div class="input-group">
													<input type="text" id="harga_jual" name="harga_jual" class="form-control mask_uang" min="0" placeholder="Input Harga Jual" autocomplete="off">
													<!-- <?php echo form_dropdown('periode_sewa', $opt_periode, '0', ' class="form-control" id="periode_sewa" style="margin-left: 5%;" '); ?> -->
													<!-- <script type="text/javascript">$("#harga_jual").maskMoney();</script> -->
													<!-- <pre class="brush: js">$("#demo1").maskMoney();</pre> -->
												</div>
											</div>
										</div>
										<div class="form-group row form_harga_sewa">
											<label class="col-form-label col-lg-4 harga_jual_txt">Harga Sewa</label>
											<div class="col-lg-8">
												<div class="input-group">
													<input type="text" id="harga_sewa" name="harga_sewa" class="form-control mask_uang" min="0" placeholder="Input Harga sewa" autocomplete="off">
													<?php echo form_dropdown('periode_sewa', $opt_periode, '0', ' class="form-control" id="periode_sewa" style="margin-left: 5%;" '); ?>
												</div>
											</div>
										</div>
										<!-- <div class="form-group row">  
										<label class="col-form-label col-lg-4"> Start Date </label>
										<div class="col-lg-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp; 
												<input type="text" class="form-control input-md" id="start_date" name="start_date"
													readonly placeholder="Start Date">
											</div>
										</div>
									</div>
									<div class="form-group row">  
										<label class="col-form-label col-lg-4"> Due Date </label>
										<div class="col-lg-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp; 
												<input type="text" class="form-control input-md" id="due_date" name="due_date"
													readonly placeholder="Due Date">
											</div>
										</div>
									</div> -->
										<div class="form-group row">
											<label class="col-form-label col-lg-4">Deskripsi <br> <b> Hanya tampil di (E-Brosur) </b> </label>
											<div class="col-lg-8">
												<div class="input-group">
													<textarea class="form-control" id="full_furnish" name="full_furnish" rows="5" placeholder="Input Deskripsi E-Brosur"></textarea>
													<!-- <input type="text" id="full_furnish" name="full_furnish" class="form-control" placeholder="Input Deskripsi E-Brosur" autocomplete="off"> -->
												</div>
												<p id="char_num">160 karakter tersisa</p>
											</div>
										</div>
										<div class="start_date_rent">
											<div class="form-group row">
												<label class="col-form-label col-lg-4"> Periode Sewa Properti</label></div>
											<div class="form-group row">
												<label class="col-form-label col-lg-4"> Start Date Sewa</label>
												<div class="col-lg-8">
													<div class="input-group">
														<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp;
														<input type="text" class="form-control input-md" id="start_date_rent" name="start_date_rent" readonly placeholder="Start Date Rented">
													</div>
												</div>
											</div>
										</div>
										<div class="due_date_rent">
											<div class="form-group row">
												<label class="col-form-label col-lg-4"> Due Date Sewa</label>
												<div class="col-lg-8">
													<div class="input-group">
														<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp;
														<input type="text" class="form-control input-md" id="due_date_rent" name="due_date_rent" readonly placeholder="Due Date Rented">
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row count_class">
											<label class="col-form-label col-lg-3"><b>Fasilitas</b></label>
										</div>
										<div id="fasilitas_properti" style="width: 83%;"> </div>
										<!-- <div class="form-group row">
										<label class="col-form-label col-lg-3">Swimming Pool</label>
										<div class="col-lg-3">
											<div class="input-group">
												<input type="text" id="alamat" name="alamat" class="form-control" 
													placeholder="Input Alamat Lengkap" autocomplete="off">
											</div>
										</div>
										<label class="col-form-label col-lg-3">Electrical Power</label>
										<div class="col-lg-3">
											<div class="input-group">
												<input type="text" id="alamat" name="alamat" class="form-control" 
													placeholder="Input Alamat Lengkap" autocomplete="off">
											</div>
										</div>
									</div> -->
									</div>
									<!-- <div class="form-group row count_class">
										<label class="col-form-label col-lg-3"><b>Feature</b></label>
									</div>
									<input type="checkbox" id="fruit1" name="features[]" value="Apple">
									<label for="fruit4">Strawberry</label> -->
									<label class="col-form-label col-lg-12"> <b>Feature</b></label>
									<div class="col-lg-6">
										<?php foreach ($opt_features as $result) : ?>
											<input type="checkbox" name="features[]" id="features<?php echo $result['id'] ?>" value="<?php echo $result['id'] ?>">&nbsp;<?php echo $result['nama'] ?><br />
										<?php endforeach; ?>
									</div>
									<!-- <div class="form-group row">
										<label class="col-form-label col-lg-12"> <b>Feature</b></label> -->
									<!-- <div class="input-group"> -->
									<!-- <?php foreach ($opt_features as $result) : ?>
												<input type="checkbox" name="features[]" id="features<?php echo $result['id'] ?>" value="<?php echo $result['id'] ?>">&nbsp;<?php echo $result['nama'] ?>
											<?php endforeach; ?> -->

									<!-- </div> -->
									<!-- </div> -->
									<!-- <div class="form-group row">
										<label class="col-form-label col-lg-12"> <b>Deskripsi</b></label>
										<textarea class="form-control"></textarea>
									</div> -->
									<!-- <div class="form-group row"> --><br>
									<label class="col-form-label col-lg-12"><b>Deskripsi </b></label>
									<div class="col-lg-12">
										<div class="input-group">
											<textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Input deskripsi"></textarea>
										</div>
									</div>
									<!-- </div> --><br>
									<div class="form-group row img_form">
										<label class="col-form-label col-lg-8">Upload Gambar <br> <b> (Max. 5 File) </b>
										</label>

										<div class="col-lg-12">
											<div class="container">
												<div class="row droparea">
													<div class="dropzone" id="myDropzone" style="width:225px;margin-right:20px; margin-top: 2%;">
														<div class="dz-message needsclick">
															<b> <u> Foto 1 </u> </b> <br> Ukuran File max. <b> 4 MB </b>
														</div>
														<input type="hidden" name="Dropzone1" id="Dropzone1">
													</div>
													<div class="dropzone" id="myDropzone2" style="width:225px;margin-right:20px; margin-top: 2%;">
														<div class="dz-message needsclick">
															<b> <u> Foto 2 </u> </b> <br> Ukuran File max. <b> 4 MB </b>
														</div>
														<input type="hidden" name="Dropzone2" id="Dropzone2">
													</div>
													<div class="dropzone" id="myDropzone3" style="width:225px;margin-right:20px; margin-top: 2%;">
														<div class="dz-message needsclick">
															<b> <u> Foto 3 </u> </b> <br> Ukuran File max. <b> 4 MB </b>
														</div>
														<input type="hidden" name="Dropzone3" id="Dropzone3">
													</div>
													<div class="dropzone" id="myDropzone4" style="width:225px;margin-right:20px; margin-top: 2%;">
														<div class="dz-message needsclick">
															<b> <u> Foto 4 </u> </b> <br> Ukuran File max. <b> 4 MB </b>
														</div>
														<input type="hidden" name="Dropzone4" id="Dropzone4">
													</div>
													<div class="dropzone" id="myDropzone5" style="width:225px;margin-right:20px; margin-top: 2%;">
														<div class="dz-message needsclick">
															<b> <u> Foto 5 </u> </b> <br> Ukuran File max. <b> 4 MB </b>
														</div>
														<input type="hidden" name="Dropzone5" id="Dropzone5">
													</div>
												</div>
											</div>
										</div>



										<!-- </form> -->
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-3"> Link Youtube <br> <b> (Opsional) </b> </label>
										<div class="col-lg-9">
											<div class="input-group">
												<input type="text" id="url_video" name="url_video" class="form-control" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Pilih Lokasi</label>
										<div class="col-lg-10">
											<div class="input-group">
												<input type="hidden" class="form-control" id="koordinat" name="koordinat">
											</div>
											<div class="row">
												<div class="col-md-12">
													<input type="text" name="pac-input" class="pac-input" id="pac-input" placeholder="Pencarian peta" value="" style="z-index: 9998 !important;">
													<div id="pro-maps_content" style="height: 400px"></div>
													<!-- <button type="button" class="btn btn-sm btn-primary" id="pro-maps_done">
												Selesai
											</button> -->
												</div>
											</div>
										</div>
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

	<!-- medium modal -->
	<div id="modal_approve" class="modal fade" data-backdrop="static">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Form Approval</h5>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<form id="form-properti" enctype="multipart/form-data">
					<input id="id_properti" type="hidden" />
					<div class="modal-body">
						<fieldset class="mb-3">
							<div class="row" style="margin-bottom: 3%;">

								<div class="col-lg-12">

									<div class="form-group row">
										<label class="col-form-label col-lg-3"> Start Date </label>
										<div class="col-lg-5">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp;
												<input type="text" class="form-control input-md" id="start_date" name="start_date" readonly placeholder="Start Date">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-3"> Due Date </label>
										<div class="col-lg-5">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span> &nbsp; &nbsp; &nbsp;
												<input type="text" class="form-control input-md" id="due_date" name="due_date" readonly placeholder="Due Date">
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn bg-grey-300" data-dismiss="modal">Close</button>
						<button type="button" id="btn_simpan_confirm" class="btn btn-primary" onclick="confirm_approve()">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /medium modal -->


	<!-- Medium modal -->
	<div id="modal_reject" class="modal fade">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-warning">
					<h5 class="modal-title">Alasan Penolakan</h5>
				</div>
				<div class="modal-body">
					<form id="form-reject">
						<fieldset class="mb-3">
							<div class="form-group row">
								<label class="col-form-label col-md-2">Note</label>
								<div class="col-md-10">
									<div class="input-group">
										<input type="text" id="note_alasan" name="note_alasan" class="form-control" required>
									</div>
								</div>
							</div>
						</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn bg-brown">Simpan</button>
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
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Image modal -->

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

		#char_num {
			color: #0ab85f;
		}
	</style>


	<script>
		var description_input = document.getElementById("full_furnish");

		description_input.addEventListener("keyup", function(e) {

			var maxLength = 160;
			var text_fmt = this.value.replace(/(\r\n|\n|\r)/gm, "");
			var strLength = text_fmt.length;
			// var strLength = this.value.length;
			var charRemain = (maxLength - strLength);

			if (charRemain < 0) {
				document.getElementById("char_num").innerHTML = '<span style="color: red;">' + strLength + ' dari ' + maxLength + ' karakter. Deskripsi sudah melebihi batas ' + maxLength + ' karakter. </span>';
			} else {
				document.getElementById("char_num").innerHTML = charRemain + '  karakter tersisa';
			}

		});

		/* description_input.addEventListener("paste", function(e){

			var maxLength = 460;
			var text_fmt = this.value.replace(/(\r\n|\n|\r)/gm,"");
			var strLength = text_fmt.length;
			// var strLength = this.value.length;
			var charRemain = (maxLength - strLength);

			if(charRemain < 0){
				document.getElementById("char_num").innerHTML = '<span style="color: red;">'+ strLength +' dari ' + maxLength + ' karakter. Deskripsi sudah melebihi batas ' + maxLength + ' karakter. </span>';
			}else{
				document.getElementById("char_num").innerHTML = charRemain + '  karakter tersisa';
			}
				
		}, false); */
	</script>