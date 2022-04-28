<!-- Main content -->

<div class="content-wrapper">

    <div style="padding-right: 20px;margin-bottom: 10px;">

        <button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round" style="float:right">

            <i class="icon-plus-circle2"></i> Add Satuan

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

                                <th> Nama </th>

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

					<h5 class="modal-title">Form Satuan</h5>

				</div>

				<div class="modal-body">

					<form id="form-data">

						<fieldset class="mb-3">

							<div class="form-group row">

								<input type="hidden" name="id" id="id">

								<label class="col-form-label col-md-2">Nama</label>

								<div class="col-md-10">

									<div class="input-group">

										<input type="text" id="nama" name="nama" class="form-control">

									</div>

								</div>

							</div>

						</fieldset>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn bg-grey-300" data-dismiss="modal">Close</button>

					<button type="submit" class="btn btn-primary">Simpan</button>

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