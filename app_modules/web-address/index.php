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
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								ที่อยู่ :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="address" name="address" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="ที่อยู่" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								อาคาร :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input type="text" id="address2" name="address2" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="อาคาร" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								ถนน :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input  type="text" id="street" name="street" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="ถนน" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								แขวง/ตำบล :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="subdistrict" name="subdistrict" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="แขวง/ตำบล" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								เขต/อำเภอ :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="district" name="district" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="เขต/อำเภอ" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								จังหวัด :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="province" name="province" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="จังหวัด" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								รหัสไปรษณีย์ :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="zipcode" name="zipcode" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="รหัสไปรษณีย์" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								มือถือ :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="mobile" name="mobile" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="มือถือ" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								มือถือ2 :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="mobile2" name="mobile2" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="มือถือ" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								โทรศัพท์ :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="phone" name="phone" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="โทรศัพท์" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								โทรสาร :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="fax" name="fax" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="โทรสาร" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								E-Mail :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="email" name="email" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="E-Mail" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								facebook/fanpage :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="facebook" name="facebook" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="facbook/fanpage" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								Line ID :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="line" name="line" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="Line ID" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								youtube :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<input required type="text" id="youtube" name="youtube" class="frm form-control col-11 col-sm-8 col-md-6" placeholder="youtube" />
							</div>
						</div>
						<div class="form-group row mt-2">
							<div class="col-sm-4 col-form-label text-sm-right pr-0">
								Google Map :
							</div>
							
							<div class="col-sm-8  pr-0 pr-sm-3">
								<textarea id="gmap" name="gmap" placeholder="googlemap" class="col-xs-10 col-sm-5" rows="6"></textarea>							
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
								