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
		
		<div class="page-tools d-inline-flex">
			<button type="button" class="btn btn-light-green btn-h-green btn-a-green border-0 radius-3 py-2 text-600 text-90">
				<span class="d-none d-sm-inline mr-1">
					Save
				</span>
				<i class="fa fa-save text-110 w-2 h-2"></i>
			</button>
			
			<button type="button" class="mx-2px btn btn-light-purple btn-h-purple btn-a-purple border-0 radius-3 py-2 text-90">
				<i class="fa fa-undo text-110 w-2 h-2"></i>
			</button>
			
			<div class="btn-group dropdown dd-backdrop dd-backdrop-none-md">
				<button type="button" class="btn btn-light-primary btn-h-primary btn-a-primary border-0 radius-3 py-2 text-90 dropdown-toggle" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-search text-110 w-2 h-2"></i>
				</button>
				
				<div class="dropdown-menu dropdown-menu-right dropdown-caret dropdown-animated animated-2 dd-slide-up dd-slide-none-md">
					<div class="dropdown-inner">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Separated link</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row mt-4" id="div-main-form"1>
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
							<div class="col-sm-2 col-form-label text-sm-right pr-0">
								ชื่อเว็บไซต์ :
							</div>
							
							<div class="col-sm-10 pr-0 pr-sm-3">
								<input required type="text" id="title" name="title" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="ระบุชื่อเมนู" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-2 col-form-label text-sm-right pr-0">
							</div>
							
							<div class="col-sm-10 pr-0 pr-sm-6">
								<img id="previewImg" class="img-thumbnail" src="/haclc/images/map.png"  width="100" height="111">
								
							</div>
						</div>												
						<div class="form-group row mt-2">
							<div class="col-sm-2 col-form-label text-sm-right pr-0">
								Logo :
							</div>
							
							<div class="input-group col-sm-5 pr-0 pr-sm-6">
								<input type="text" class="frm remove form-control" onClick="BrowseServer( 'Images:/logo/', 'logo' );" required id="logo" name="logo" onchange="previewFile(this,'previewImg');"/>
								<button class="btn btn-sm btn-yellow" type="button" onClick="BrowseServer( 'Images:/logo/', 'logo' );">
									<i class="fa fa-image bigger-110"></i>
								</button>			
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-2 col-form-label text-sm-right pr-0">
								Motto :
							</div>
							
							<div class="col-sm-10 pr-0 pr-sm-3">
								<input required type="text" id="motto" name="motto" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="ระบุชื่อเมนู" />
							</div>
						</div>						
						<div class="form-group row mt-2">
							<div class="col-sm-2 col-form-label text-sm-right pr-0">
								รายละเอียด:
							</div>
							
							<div class="col-sm-10 pr-0 pr-sm-3">
								<textarea class="form-control" id="slogan" name="slogan"></textarea>
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-2 col-form-label text-sm-right pr-0">
								สถานะ :
							</div>
							
							<div class="col-sm-10 pr-0 pr-sm-3">
								<select class="frm form-control col-11 col-sm-8 col-md-6" id="status" name="status" data-placeholder="Click to Choose...">
									<option value=''>โปรดเลือกสถานะเว็บไซต์</option>
									<option value='0'>ปิดเว็บ</option>
									<option value='1'>เปิดเว็บ</option>
								</select>
							</div>
						</div>
						
						
						<input type="hidden" id="form_action" name="form_action" value="2">
						<input type="hidden" id="id" name="id">
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
								<button class="btn btn-dark btn-bold ml-2 px-4" type="button" id="btn-hide-main-form">
									<i class="far fa-times-circle mr-1"></i>
									ปิด
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
