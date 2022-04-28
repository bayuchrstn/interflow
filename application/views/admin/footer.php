<div class="navbar navbar-expand-lg navbar-light">

	<div class="text-center d-lg-none w-100">

		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">

			<i class="icon-unfold mr-2"></i>

			Footer

		</button>

	</div>



	<div class="navbar-collapse collapse" id="navbar-footer">

		<span class="navbar-text">

			<!-- &copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a> -->

		</span>



		<ul class="navbar-nav ml-lg-auto">

			<!-- <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>

			<li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>

			<li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold"><span class="text-pink-400"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li> -->

		</ul>

	</div>

</div>

<!-- /footer -->



</div>

<!-- /main content -->



</div>

<!-- /page content -->

<script>

	var base_url = "<?= base_url(); ?>";

</script>
<!-- Core JS files -->
<script src="<?= base_url(); ?>assets_admin/global_assets/js/main/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/loaders/blockui.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/ui/ripple.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/notifications/bootbox.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/forms/inputs/bootstrap-show-password.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/dropzone/dropzone.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/cropper/cropper.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/croppie/croppie.js"></script>



<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/ui/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/pickers/daterangepicker.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/demo_pages/datatables_extension_buttons_init.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/js/app.js"></script>
<script src="<?= base_url(); ?>assets_admin/js/gmaps.js?_=<?php echo rand(); ?>"></script>
<script src="<?= base_url(); ?>assets_admin/js/datatable/dataTables.responsive.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM4nQXqt2vURkV97krRFVXzOWMTcA3Mvg&callback=myMap&libraries=places"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/demo_pages/dashboard.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/js/plugins/forms/styling/switch.min.js"></script>
<script src="<?= base_url(); ?>assets_admin/global_assets/checkbox/form_checkboxes_radios.js"></script>
<!-- <script src="http://demo.interface.club/limitless/demo/Template/global_assets/js/demo_pages/form_checkboxes_radios.js"></script> -->
<!-- /theme JS files -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
		  airMode: true
		});
    });
  </script>
<?php

	if (isset($js)) {
		echo $js;
	}

?>

<style>

	.dtr-inline.collapsed 
	tbody tr td:first-child, .dtr-inline.collapsed 
	tbody tr th:first-child {
		white-space: inherit;
	}
	
	/* 	.dataTable tr.child .dtr-title {
			width: 10%;
		} */
		
</style>

</body>



</html>