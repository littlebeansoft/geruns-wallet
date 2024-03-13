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
	<div class="row mt-4" id="div-main-form" style="display:block;">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-toolbar mr-auto no-border">
						<label class="mb-0">
							<h4 class="text-primary align-middle d-block d-sm-inline text-600" id="frm-label">
							</h4>
						</label>
					</div>
				</div>
				<div class="card-body">
					<!-- if "Input Validation" is selected, we should validate this form before going to next step -->
					<form id="frm-main" name="frm-main" class="mt-4 text-dark-m1">
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								รหัสผ่านเดิม :
							</div>
							
							<div class="col-sm-8 pr-0 pr-sm-4">
								<input type="password" id="old_password" name="old_password" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="รหัสผ่านเดิม" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								รหัสผ่านใหม่ :
							</div>
							
							<div class="col-sm-8 pr-0 pr-sm-4">
								<input type="password" id="password" name="password" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="รหัสผ่านใหม่" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								ยืนยันรหัสผ่าน :
							</div>
							
							<div class="col-sm-8 pr-0 pr-sm-4">
								<input type="password" id="cpassword" name="cpassword" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="ยืนยันรหัสผ่าน" />
							</div>
						</div>
						<input type="hidden" id="form_action" name="form_action" value="2">
						<div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
							<div class="col-12 text-nowrap text-center">
								<button class="btn btn-info btn-bold px-4" type="submit">
									<i class="fa fa-upload mr-1"></i>
									บันทึก
								</button>
								
								<button class="btn btn-danger btn-bold ml-2 px-4" type="reset" id="btn-reset" name="btn-reset">
									<i class="fa fa-undo mr-1"></i>
									ล้างข้อมูล
								</button>
							</div>
						</div>
					</form>
					<input type="hidden" id="did" name="did">	
					
					
				</div><!-- /.card-body -->
			</div><!-- .card -->
			
		</div>
	</div>
	
</div>
