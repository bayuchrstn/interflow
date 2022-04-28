<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0">

        <!-- Main charts -->
        <div class="row">
            <div class="col-xl-12">
            <form method="post" action="<?php echo base_url().'admin/Dashboard/visitor'; ?>">
                <!-- Traffic sources -->
                <div class="card">
                        <div class="row">
		            		<div class="col-md-2">
		            			<input type="text" readonly="" name="dari" id="tgl_awal" value="<?php echo isset($dari) ? $dari:'' ; ?>"class="form-control input-md" placeholder="Start Date">
		            		</div>
		            		<div class="col-md-2">
		            			<input type="text" readonly="" name="sampai" id="tgl_akhir" value="<?php echo isset($sampai) ? $sampai:'' ; ?>" class="form-control input-md" placeholder="End Date">
		            		</div>
							<div class="col-md-1">
		            			<button id="btn_cari" class="btn btn-primary"><i class="fas fa-book"></i> Cari</button>
							</div>
		            	</div>
                    <br><br>
                    <div id="gchart_line_1" style="height:350px;"></div>

                </div>
                <!-- /traffic sources -->
                </form>
            </div>
        </div>
    </div>
    
	
<style>
	
	.card {
		padding: 1%;
	}

</style>