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
							<i class="icon-list text-teal"></i> &nbsp; Akses Menu
						</span>
					</h5>
					<div class="row">
						<div class="col-md-7">
							<form id="filter_role__form" class="form-inline">
								<div class="form-group">
									<b>Filter:</b>&nbsp;&nbsp;
								</div>
								<div class="form-group">
									<select name="role" id="filter_role__role" class="form-control select2"
										required="true">
										<option selected="true" disabled="true" value="0">- Pilih Level User -</option>
										<?php foreach ($master_role as $row) { ?>
										<option value="<?php echo $row->id; ?>"> <?php echo $row->name; ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-light" id="filter_role__submit">
										<i class="icon-search4"></i>
									</button>
								</div>
							</form>
						</div>

						<div class="col-md-5">
							<button type="button" class="btn btn-success rounded-round" data-toggle="modal"
								data-target="#set_menu_modal" data-keyboard="false" data-backdrop="static" style="float: right;">
								<i class="icon-plus2"></i> Menu
							</button>
						</div>
					</div>


					<hr>
					<div class="row">
						<div class="col-md-12 col-xs-12 text-center" style="margin-bottom: 20px">
							<h5>Level User : <b id="display_role_name">-</b></h5>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div id="menu_role__tree"></div>
						</div>
					</div>


				</div>
			</div>


		</div>


		<div class="modal fade" id="set_menu_modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
							<h4 class="modal-title">Tambah Permission Menu</h4>
                    </div>
                    <hr>
					<div class="modal-body">
                        <form id="set_menu__form" class="horizontal-form">
						<div class="form-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group form-md-line-input" style="margin-top: -20px;">
										<label for="set_menu__role" class="control-label">Role <span
												class="text-danger">*</span></label>
										<select name="set_menu__role" id="set_menu__role" class="form-control select2" required="true">
											<option selected="true" disabled="true" value="">- Pilih Role -</option>
                                            <?php foreach ($master_role as $row) { ?>
                                            <option value="<?php echo $row->id; ?>"> <?php echo $row->name; ?> </option>
                                            <?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="set_menu__role" class="control-label">Menu List <span
												class="text-danger">*</span></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">

									<div id="set_menu__menulist"> </div>

								</div>
							</div>
						</div>
						<div class="form-actions" style="margin-top: 30px">
							<div class="row">
								<div class="col-md-12 text-center">
									<button type="submit" class="btn btn-sm btn-primary"
										id="set_menu__submit">Simpan</button>
									<button type="cancel" class="btn btn-sm btn-default"
										id="set_menu__cancel">Batal</button>
								</div>
							</div>
						</div>

                        </form>
					</div>
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

			#set_menu__menulist, #menu_role__tree {
				max-height: 350px;
				overflow-y: auto;
				border: 1px solid #ccc;
				padding: 20px 10px;
				border-radius: 3px;
			}

			.modal .modal-header {
				border-bottom: 1px solid #EFEFEF;
			}

			.modal-header:not([class*=bg-]) {
				padding-bottom: 15px;
			}

			/* .modal-title {
				margin: 0 auto;
			} */

		</style>
