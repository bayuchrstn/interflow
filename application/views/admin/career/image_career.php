<!-- Main content -->



<div class="content-wrapper">



	<div style="padding-right: 20px;margin-bottom: 10px;">



		<button type="button" title="Add" onClick="show_form()" class="btn btn-primary rounded-round"



			style="float:right">



			<i class="icon-plus-circle2"></i> Add Image



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



                                <th> Image </th>

                                <!-- <th> Image </th> -->



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



					<h5 class="modal-title">Form Image Career</h5>



				</div>



				<div class="modal-body">



				<form id="form-data" enctype="multipart/form-data">



						<fieldset class="mb-3">



							<div class="form-group row">



								<input type="hidden" name="id" id="id">



							</div>





							<div class="form-group row">



								<label class="col-form-label col-md-2">Upload Image</label>



								<div class="col-md-8">



									<div class="input-group">



										<input type="file" name="file_img" id="file_img" class="form-control"> 



									</div>



									<span class="form-text text-muted">Ukuran File max. <b> 500 KB </b> </span>



								</div>



							</div>



							<div id="old_img"></div>



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










	<!-- Image Modal -->



	<!-- <div class="modal fade" id="picture" tabindex="-1" role="dialog">



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



	</div> -->



	<!-- /Image modal -->





<style>

	

	.card {

		padding: 1%;

	}



</style>