<!-- Sub banner start -->
<div class="sub-banner text-center">
    <div class="page-title">
        <h1><?= isset($title_2) ? $title_2:'';?></h1>
    </div>
</div>
<!-- Sub Banner end -->
<section id="breadcrumb">
    <div class="container breadcrumb-area">
        <div class="breadcrumb-areas">
            <ul class="breadcrumbs">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li class="active"><?= isset($title) ? $title:'';?></li>
            </ul>
        </div>
    </div>
</section>

<!-- Our team start -->
<div class="photo-gallery content-area-13"><!--  --> 
    <!-- <div class="container">
        <div class="row filter-portfolio">
            <div class="cars">
                <?php //echo isset($list_data) ? $list_data:''; ?>
            </div>
        </div>
    </div> -->
    <div class="container">
            <?php echo isset($data_loan) ? $data_loan:'';?>
	</div>

	<div class="container">
	<!-- <a href="#" id="btn-edit" data-toggle="modal" data-id="' . $val->id . '" data-target="#myModal" class="view_data"> -->
		<?php echo isset($data) ? $data:'';?>

		 <!-- The Modal -->
		 <div class="modal fade bd-example-modal-lg" id="myModal">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			
			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="modal-title"></h4>
				<!--button type="button" class="close" data-dismiss="modal">&times;</button-->
			  </div>
			  
			  <!-- Modal body -->
			  <div class="modal-body">
			 
			  </div>
			  
			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			  
			</div>
		  </div>
		</div>

	</div>
</div>

<script>
var base_url = '<?php echo base_url(); ?>';
 // $(document).on('click','.btn-showmodal',function()
// {
            // var id=$(this).attr('data-id');
            // $.ajax({
            // type : "POST",
            // url  : "<?php echo base_url()?>Main/imgloan",
            // dataType : "JSON",
            // data : {id:id},
              // success: function(data){
                  // $.each(data,function(id,deskripsi){
                      // $('#myModal').modal('show');
                      // // $('[name="deskripsi"]').val(data.deskripsi);
                      // $('.modal-body').html(data.deskripsi);
                      // $('.modal-title').html(data.judul);
                      // // $('#id').val(data.id);
                  // });
              // }
            // });
        // });
</script>