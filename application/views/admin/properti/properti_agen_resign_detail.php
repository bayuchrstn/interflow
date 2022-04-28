<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0">
    <input type="hidden" name="id" id="id" value="<?php echo isset($id_agent) ? $id_agent : ''; ?>">
        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-12">

                <!-- Traffic sources -->
                <div class="card">
                    <table class="table responsive nowrap datatable-button-init-basic" id="table2" width="100%">  
                        <thead>
                            <tr class="bg-orange-700">
                                <th> # </th>
                                <!-- <th> ID Consultant </th>
                                <th> Nama </th> -->
                                <th> Nama Property </th>
                                <th> Alamat </th>
                                <th> Jenis Property </th>
                                <th> Status Property </th>
                                <!-- <th> Agen </th> -->
                                <th style="text-align:center"> Action </th>
                            </tr>
                        </thead>
                            <?php /* echo isset($row_table) ? $row_table : ''; */ ?>
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
                    <h5 class="modal-title">Form Agen</h5>
                </div>

                <div class="modal-body">

                <form id="form-update" enctype="multipart/form-data">
                    <fieldset class="mb-3">
                        <div class="form-group row">
                            <input type="hidden" name="id_property" id="id_property">
                            <label class="col-form-label col-md-3"> Agen Pengganti</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <?php echo form_dropdown('telp', $opt_kontak, '0', ' class="form-control" id="telp" '); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Nama Property</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" id="nama" name="nama" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Alamat</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" id="alamat" name="alamat" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Jenis Property</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" id="jenis" name="jenis" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Status Property</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" id="status" name="status" class="form-control" disabled>
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
    


	<!-- Large modal -->
	<div id="modal_properti" class="modal fade" data-backdrop="static">
		<!-- tabindex="-1" -->
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-orange-700">
					<h5 class="modal-title">Detail Property</h5>
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

												/* if ($level != 3) {
													echo form_dropdown('telp', $opt_kontak, '0', ' class="form-control" id="telp" ');
												} else { */
													$user_id = $this->session->userdata('id');
													echo form_dropdown('telp_kontak', $opt_kontak_all, $user_id, ' class="form-control" id="telp_kontak" disabled');
												// }

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
										<label class="col-form-label col-lg-4">Judul</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="judul" name="judul" class="form-control" placeholder="" autocomplete="off" disabled>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Alamat Lengkap</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="alamat_lengkap" name="alamat_lengkap" class="form-control" placeholder="" autocomplete="off" disabled>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Alamat Singkat <br> <i> (tampil pada website) </i></label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" id="nama_jalan" name="nama_jalan" class="form-control" placeholder="" autocomplete="off" disabled>
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
													<?php echo form_dropdown('jns_property', $opt_kategori, '0', ' class="form-control" id="jns_property" disabled'); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-4">Status Property</label>
											<div class="col-lg-8">
												<div class="input-group">
													<?php echo form_dropdown('status_property', $opt_status, '0', ' class="form-control" id="status_property" disabled'); ?>
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
											<div class="col-lg-4" id="radio_tanah_area">
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
											<div class="col-lg-4" id="radio_tanah_per_meter">
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
													<input type="text" id="harga_jual" name="harga_jual" class="form-control mask_uang" min="0" placeholder="" autocomplete="off" disabled>
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
													<input type="text" id="harga_sewa" name="harga_sewa" class="form-control mask_uang" min="0" placeholder="" autocomplete="off" disabled>
													<?php echo form_dropdown('periode_sewa', $opt_periode, '0', ' class="form-control" id="periode_sewa" style="margin-left: 5%;" disabled'); ?>
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
													<textarea class="form-control" id="full_furnish" name="full_furnish" rows="5" placeholder="" disabled></textarea>
													<!-- <input type="text" id="full_furnish" name="full_furnish" class="form-control" placeholder="Input Deskripsi E-Brosur" autocomplete="off"> -->
												</div>
												<!-- <p id="char_num">160 karakter tersisa</p> -->
											</div>
										</div>
										<div class="start_date_rent" style="display: none;">
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
										<div class="due_date_rent" style="display: none;">
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
									<div id="features"></div>
										<?php foreach ($opt_features as $result) : ?>
											<!-- <input type="checkbox" name="features[]" id="features<?php echo $result['id'] ?>" value="<?php echo $result['id'] ?>">&nbsp;<?php echo $result['nama'] ?><br /> -->
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
											<textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="" disabled></textarea>
										</div>
									</div>
									<!-- </div> --><br>
									<div class="form-group row img_form">
										<label class="col-form-label col-lg-8"> <b> Foto Properti </b> <!-- <br> <b> (Max. 5 File) </b> -->
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
												<input type="text" id="url_video" name="url_video" class="form-control" autocomplete="off" disabled>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-2">Lokasi</label>
										<div class="col-lg-10">
											<div class="input-group">
												<input type="hidden" class="form-control" id="koordinat" name="koordinat">
											</div>
											<div class="row">
												<div class="col-md-12">
													<!-- <input type="text" name="pac-input" class="pac-input" id="pac-input" placeholder="Pencarian peta" value="" style="z-index: 9998 !important;"> -->
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