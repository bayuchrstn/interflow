<!-- Main content -->
<div class="content-wrapper">
	<!-- Content area -->
	<div class="content pt-0">

		<!-- Main charts -->
		<div class="row">
			<div class="col-xl-12">

				<div class="card">
                    <h5 class="panel-title">
                        <span class="text-black">
                        <i class="icon-lock text-teal"></i> &nbsp; Change Password 
                        </span>
                    </h5>
					<form id="form-data">
						<fieldset class="mb-3">
							<div class="form-group row">
								<input type="hidden" name="id" id="id" value="<?php echo  $this->session->userdata('id'); ?>">
								<label class="col-form-label col-md-2">Password Lama</label>
								<div class="col-md-4">
									<div class="input-group">
										<input type="password" id="old_password" name="old_password" class="form-control">
										<button type="button" class="btn btn-light btn-labeled btn-labeled-left btn-sm" onclick="toggle_oldpass()"> 
											<b>	<i class="icon-search4"></i> </b> Show/Hide 
										</button>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Password Baru</label>
								<div class="col-md-4">
									<div class="input-group">
										<input type="password" id="new_password" name="new_password" class="form-control">
										<button type="button" class="btn btn-light btn-labeled btn-labeled-left btn-sm" onclick="toggle_newpass()"> 
											<b>	<i class="icon-search4"></i> </b> Show/Hide 
										</button>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Konfirmasi Password Baru</label>
								<div class="col-md-4">
									<div class="input-group">
										<input type="password" id="confirm_password" name="confirm_password" class="form-control">
										<button type="button" class="btn btn-light btn-labeled btn-labeled-left btn-sm" onclick="toggle_confirmpass()"> 
											<b>	<i class="icon-search4"></i> </b> Show/Hide 
										</button>
									</div>
								</div>
							</div>
                        </fieldset>
                        <div class="col-md-6">
                            <button type="submit" id="save_pass" class="btn bg-primary" style="float: right;">
                                <i class="icon-floppy-disk"></i> &nbsp; Simpan
                            </button>
                        </div>
                </div>
                
				
			
			</form>

            </div>
		</div>


    </div>
    

    <style>
        fieldset.mb-3 {
            padding-top: 1%;
        }
        .card {
            padding: 2%;
        }

        h5.panel-title {
            border-bottom: 1px solid #eee;
            padding-bottom: 1%;
        }
    </style>