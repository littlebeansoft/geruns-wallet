<div id="results"></div>
<div class="page-content container container-plus">
	<!-- page header and toolbox -->
	<div class="page-header pb-2">
		<h1 class="page-title text-primary-d2 text-150">
			<?php echo $web_title;?>
			<small class="page-info text-secondary-d2 text-nowrap">
				<i class="fa fa-angle-double-right text-80"></i>
				<?php echo $web_title2;?>
			</small>
		</h1>
		
	</div>
	<hr/>
	<div class="row">
		<div class="col-12" id='calendar-container'>
			<div class="card acard">
				<div class="card-body p-lg-4">
                    <div id='calendar' class="text-blue-d1"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ฟอร์ม popup สลับข้อมูล -->
<div class="modal fade" id="dialog-detail" data-backdrop-bg="bgc-white"  tabindex="-1" role="dialog" data-blur="true" aria-labelledby="dangerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md " role="document">
		<div class="modal-content brc-primary-m2 shadow">
			<div class="modal-header py-2 bgc-primary-tp1 border-0  radius-t-1">
				<h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder">
					<i class="fas fa-clipboard-list"></i> รายละเอียดกิจกรรม
				</h5>
				
				<button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-150">&times;</span>
				</button>
			</div>
			<!-- form สลับตำแหน่งข้อมูล -->
			<div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
				<div class="align-items-top mr-2 mr-md-5" >
					<div class="alert alert-success strong">รายละเอียดกิจกรรม</div>
					<table class="table table-striped table-bordered table-hover">
						<tbody id="show_dub"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


