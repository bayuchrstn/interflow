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

								<th> Title </th>

								<th> Counter </th>
								
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

					<h5 class="modal-title">Form Milestones</h5>

				</div>

				<div class="modal-body">

					<form id="form-data" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id">

						<fieldset class="mb-3">

							<div class="form-group row">

								<label class="col-form-label col-md-2">Title</label>

								<div class="col-md-10">

									<div class="input-group">

										<input type="text" id="title" name="title" class="form-control" ></input>

									</div>

								</div>

							</div>
							
							<div class="form-group row">

								<label class="col-form-label col-md-2">Counter</label>

								<div class="col-md-10">

									<div class="input-group">

										<input type="text" id="counter" name="counter" class="form-control" ></input>

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

<style>
	
	.card {
		padding: 1%;
	}

</style>