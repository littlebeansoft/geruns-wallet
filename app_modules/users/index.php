<div id="xxx"></div>
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
	<div class="row mt-4" id="div-main-form" style="display:none;">
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
						<div class="form-group row">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
								ประเภทผู้ใช้งาน :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
								<select class="form-control col-11 col-sm-4 frm" id="user_type_id" name="user_type_id" data-placeholder="Click to Choose...">
									<option value="">กรุณาเลือก</option>
									<?php  $sql="select id,title from user_type ";
										if($_SESSION['user_type_id']==2){
											$sql .=" where id='3'";
										}
										//$sql="select user_type_id,user_type_name from user_type ";
										$query=$conn->prepare($sql);
										$query->execute();
										while($data=$query->fetch(PDO::FETCH_ASSOC)){?>
										<option value='<?php echo $data['id'];?>'><?php echo $data['title'];?></option>
										<?php 	}
									?>
								</select>
							</div>
						</div>
						<?php /*
							
							<div class="form-group row">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
							ห้องสมุด :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
							<select class="form-control col-11 col-sm-4 frm" id="schoolid" name="schoolid" data-placeholder="Click to Choose...">
							<option value="">กรุณาเลือก</option>
							<?php  $sql="select schoolid as id,schoolname as title from school where leader='1276010000' ";
							if($_SESSION['user_type_id']==1){
							$sql.=" and status in ('1','2')";
							}else{
							$sql.=" and status='2'";
							}
							//$sql="select user_type_id,user_type_name from user_type ";
							$query=$conn->prepare($sql);
							$query->execute();
							while($data=$query->fetch(PDO::FETCH_ASSOC)){?>
							<option value='<?php echo $data['id'];?>'><?php echo $data['title'];?></option>
							<?php 	}
							?>
							</select>
							</div>
							</div>
							<div class="form-group row">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
							อำเภอ :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
							<select class="form-control col-11 col-sm-4 frm" id="schoolid2" name="schoolid2" data-placeholder="Click to Choose...">
							<option value="">กรุณาเลือก</option>
							</select>
							</div>
							</div>
							<div class="form-group row">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
							ตำแหน่ง :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
							<select class="form-control col-11 col-sm-4 frm" id="teacher_type_id2" name="teacher_type_id2" data-placeholder="Click to Choose...">
							<option value="">กรุณาเลือก</option>
							<?php  $sql="select id,title from app_posit order by id";
							//$sql="select user_type_id,user_type_name from user_type ";
							$query=$conn->prepare($sql);
							$query->execute();
							while($data=$query->fetch(PDO::FETCH_ASSOC)){?>
							<option value='<?php echo $data['id'];?>'><?php echo $data['title'];?></option>
							<?php 	}
							?>
							</select>
							</div>							
							</div>
						*/?>
						<div class="form-group row mt-2">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
								E-mail :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
								<input required type="text" id="username" name="username" class="form-control col-11 col-sm-8 col-md-6 frm" placeholder="กรุณากรอก E-mail" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
								คำนำหน้า :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
								<select class="form-control col-11 col-sm-4 frm" id="prefix_id" name="prefix_id" data-placeholder="Click to Choose...">
									<option value="">กรุณาเลือก</option>
									<?php  $smt = $conn->prepare("select * from prefix where prefix_status='1'");	
										$smt->execute();
										while ($row = $smt->fetch()){
										?>														   
										<option value ="<?php echo $row['prefix_id']; ?>"><?php echo $row['prefix_name']; ?></option>
									<?php }?>	
								</select>
							</div>
						</div>
						
						<div class="form-group row mt-2">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
								ชื่อ :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
								<input required type="text" id="FirstName" name="FirstName" class="form-control col-11 col-sm-8 col-md-6 frm" placeholder="กรุณากรอกชื่อ" />
							</div>
						</div>
						
						<div class="form-group row mt-2">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
								นามสกุล :
							</div>							
							<div class="col-sm-9 pr-0 pr-sm-3">
								<input required type="text" id="LastName" name="LastName" class="form-control col-11 col-sm-8 col-md-6 frm" placeholder="กรุณากรอกนามสกุล" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 col-form-label text-sm-right pr-0">
								สถานะ :
							</div>
							
							<div class="col-sm-9 pr-0 pr-sm-3">
								<select class="form-control col-11 col-sm-4 frm" id="user_status" name="user_status" data-placeholder="Click to Choose...">
									<option value="">กรุณาเลือก</option>
									<?php  $smt = $conn->prepare("select id,title from user_status ");	
										$smt->execute();
										while ($row = $smt->fetch()){
										?>														   
										<option value ="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
									<?php }?>	
								</select>
							</div>
						</div>
						<!-- <input type="hidden" id="username" name="username" value="1256010001"> -->
						<input type="hidden" id="stamp" name="stamp" value="<?php echo $today?>">
						<input type="hidden" id="form_action" name="form_action" value="1">
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
								
								
								
								<!-- include file content-->
								<div class="row mt-3" id="div-show-data">
								<div class="col-12">
								<div id="results"></div>
								<form id="frm_show_data" autocomplete="off">
								<div class="card dcard overflow-hidden">
								<div class="card-body px-1 px-md-3">
								<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
								<h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
								Data Detail
								</h3>
								
								<div class="pos-rel ml-sm-auto mr-sm-2 order-last order-sm-0">
								<!-- copy -->
								<button type="button" data-toggle="modal" data-target="#aside-search" class="btn btn-warning px-3 d-block w-100 text-95 border-2 brc-black-tp10">
								<i class="fa fa-search mr-1"></i>
								ค้นหาข้อมูล
								</button>
								<!-- สิ้นสุด copy -->
								</div>
								<div class="mb-2 mb-sm-0 mr-sm-2">
								<button type="button" id="btn-show-main-form" class="btn btn-blue px-3 d-block w-100 text-95 border-2 brc-black-tp10">
								<i class="fa fa-plus mr-1"></i>
								<span class="d-sm-none d-md-inline">เพิ่มข้อมูล</span>
								</button>
								</div>
								</div>
								<div class="radius-1 table-responsive" style="min-height:300px;">
								
								<table id="simple-table" class="mb-0 table table-striped table-bordered  brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
								<thead class="text-white-tp3 bgc-primary text-90 border-b-1 brc-transparent">
								<tr>
								<th class="bgc-d2 text-white text-center pr-0" width="5%">
								ที่
								</th>
								<th class="bgc-d2 text-white text-center" width='25%'>
								Username
								</th>
								<th class="bgc-d2 text-white text-center" width="25%">
								ชื่อ-นามสกุล
								</th>																			
								<th class="bgc-d2 text-white text-center" width="25%">
								ประเภทผู้ใช้งาน
								</th>									
								<th class="bgc-d2 text-white text-center" width="15%">
								สถานะการใช้งาน
								</th>																			
								<th class="bgc-green-d2 text-white text-center"></th>
								</tr>
								</thead>
								
								<tbody class="mt-1" id="show_data">
								
								</tbody>
								</table>
								</div>
								</div><!-- /.card-body -->
								</div><!-- /.card -->
								<div  class="center text-center mt-3 d-flex shadow-sm border-1 brc-dark-l3 radius-1 bgc-white p-2 flex-wrap" align="center">
								<div class="d-flex align-items-center justify-content-center mt-md-0 mx-auto flex-grow-1 flex-md-grow-0 my-1">
								<span id="show_state" class="d-inline-block text-grey-d2"></span>
								<select id="qpage" name="qpage" class="ace-select ml-5 no-border angle-down brc-h-blue-m3 w-auto pr-45 text-secondary-d3">
								<option value="7">แสดง 7 </option>
								<option value="10">แสดง 10 </option>
								<option value="20">แสดง 20 </option>
								<option value="50">แสดง 50 </option>
								<option value="100">แสดง 100 </option>
								<option value="150">แสดง 150 </option>
								<option value="300">แสดง 300 </option>
								<option value="500">แสดง 500 </option>
								</select>									
								</div>
								<div class="border-l-1 mx-2 brc-grey-l2 d-none d-md-block"></div>
								<div class="border-b-1 my-2 brc-grey-l3 d-md-none w-100"></div>									
								<!-- pagination -->	
								<div class="d-flex align-items-center justify-content-center mt-md-0 mx-auto flex-grow-1 flex-md-grow-0 my-1">						
								<ul id="pagination" class="pagination">
								</ul>
								</div>
								<!-- pagination -->						
								<div class="border-l-1 mx-2 brc-grey-l2 d-none d-md-block"></div>
								<div class="border-b-1 my-2 brc-grey-l3 d-md-none w-100"></div>
								
								
								<div class="d-flex align-items-center justify-content-center mt-md-0 mx-auto flex-grow-1 flex-md-grow-0 my-1">
								<span class="text-grey-m1 text-95">
								ไปที่หน้า
								</span>
								
								<input type="text" id="page" name="page" class="form-control form-control-sm w-6 text-center ml-2 mr-2px px-1" value="1" />
								<span id="total_page"></span>
								
								</div>
								</div>
								</form>
								</div><!-- /.col -->
								</div><!-- /.row -->
								<!-- include file content-->
								
								<!-- ฟอร์ม popup สลับข้อมูล -->
								<div class="modal fade" id="dialog-sort" data-backdrop-bg="bgc-white"  tabindex="-1" role="dialog" data-blur="true" aria-labelledby="dangerModalLabel" aria-hidden="true">
								<div class="modal-dialog " role="document">
								<div class="modal-content brc-primary-m2 shadow">
								<div class="modal-header py-2 bgc-primary-tp1 border-0  radius-t-1">
								<h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder">
								<i class="fa fa-sort text-white-d1 mr-1 p-2 w-4"></i> ฟอร์มสลับตำแหน่ง
								</h5>
								
								<button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true" class="text-150">&times;</span>
								</button>
								</div>
								<!-- form สลับตำแหน่งข้อมูล -->
								<form id="frm_sort" name="frm_sort">
								<div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
								<div class="align-items-top mr-2 mr-md-5" >
								
								<div class="form-group row">
								<div class="col-sm-4 col-form-label text-sm-right pr-0">
								หัวข้อที่จะย้าย :
								</div>
								
								<div class="col-sm-8 pr-0 pr-sm-3">
								<select class="form-control col-9" id="oposition" name="oposition" >
								</select>
								</div>
								</div>
								<div class="form-group row">
								<div class="col-sm-4 col-form-label text-sm-right pr-0">
								รูปแบบการย้าย :
								</div>
								
								<div class="col-sm-8 pr-0 pr-sm-3">
								<select class="form-control col-9"id="order_type" name="order_type" onChange="sh_nposition(this.value);" >
								<option value='1'>สลับตำแหน่ง</option>
								<option value='2'>อยู่ก่อนหน้า</option>
								<option value='3'>อยู่ด้านหลัง</option>
								<option value='4'>ตำแหน่งแรก</option>
								<option value='5'>ตำแหน่งสุดท้าย</option>
								</select>
								</div>
								</div>									
								<div class="form-group row" id="dnposition">
								<div class="col-sm-4 col-form-label text-sm-right pr-0">
								หัวข้ออ้างอิง :
								</div>
								
								<div class="col-sm-8 pr-0 pr-sm-3">
								<select class="form-control col-9" id="nposition" name="nposition" >
								</select>
								</div>
								</div>
								
								</div>
								</div>
								
								<div class="modal-footer bgc-default-l5">
								<button type="button" onclick="sort();" class="btn px-4 btn-blue" id="id-danger-yes-btn" data-dismiss="modal">
								บันทึก
								</button>
								<button type="reset" class="btn px-4 btn-light-grey" data-dismiss="modal">
								ยกเลิก
								</button>								
								</div>
								</form>
								<!-- form สลับตำแหน่งข้อมูล -->
								
								</div>
								</div>
								</div>
								<!-- สิ้นสุดฟอร์มสลับข้อมูล-->
								<!-- form aside ค้นหาข้อมูล-->
								<form id="frm-search" name="frm-search" onsubmit="return false;" />
								<div class="modal" id="aside-search" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
								<div class="modal-content shadow border-0 radius-0">
								
								<div class="modal-header p-0 radius-0 border-none border-t-3 brc-primary-m1 shadow-sm">
								<h5 class="flex-grow-1 text-blue-d1 text-120 py-3 ml-3 mb-0">
								<i class="fas fa-search text-secondary-m1"></i>
								ค้นหาข้อมูลโดยละเอียด
								</h5>
								
								<a href="#" class="close m-0 border-l-1 brc-grey-m4" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</a>
								</div>
								
								<div class="modal-body" data-ace-scroll='{"smooth": true}'>
								<?php /*
								<div class="form-group row">
								<div class="col-sm-12 col-form-label pr-0">
								จังหวัด :
								</div>
								
								<div class="col-sm-12 pr-0 pr-sm-3">
								<select class="form-control col-12 col-sm-12 col-md-12 frm" id="s_schoolid" name="s_schoolid" data-placeholder="Click to Choose...">
								<option value="">กรุณาเลือก</option>
								<?php  $sql="select schoolid as id,schoolname as title from school where status='1' ";
								//$sql="select user_type_id,user_type_name from user_type ";
								$query=$conn->prepare($sql);
								$query->execute();
								while($data=$query->fetch(PDO::FETCH_ASSOC)){?>
								<option value='<?php echo $data['id'];?>'><?php echo $data['id'].' : '.$data['title'];?></option>
								<?php 	}
								?>
								</select>
								</div>
								</div>
								<div class="form-group row">
								<div class="col-sm-12 col-form-label pr-0">
								จังหวัด :
								</div>
								
								<div class="col-sm-12 pr-0 pr-sm-3">
								<select class="form-control col-12 col-sm-12 col-md-12 frm" id="s_schoolid2" name="s_schoolid2" data-placeholder="Click to Choose...">
								<option value="">กรุณาเลือก</option>
								</select>
								</div>
								</div>
								*/?>
								<div class="form-group row">
								<div class="col-sm-12 col-form-label pr-0">
								ชื่อ :
								</div>
								
								<div class="col-sm-12 pr-0 pr-sm-3">
								<input required type="text" id="s_FirstName" name="s_FirstName" class="frm form-control col" placeholder="กรุณากรอกชื่อ" />
								</div>
								</div>
								
								<div class="form-group row">
								<div class="col-sm-12 col-form-label pr-0">
								นามสกุล :
								</div>
								
								<div class="col-sm-12 pr-0 pr-sm-3">
								<input required type="text" id="s_LastName" name="s_LastName" class="frm form-control col" placeholder="กรุณากรอกนามสกุล" />
								</div>
								</div>
								<div class="form-group row">
								<div class="col-sm-12 col-form-label pr-0">
								ประเภทผู้ใช้งาน :
								</div>
								
								<div class="col-sm-12 pr-0 pr-sm-3">
								<select class="form-control col-12 col-sm-12 col-md-12 frm" id="s_user_type_id" name="s_user_type_id" data-placeholder="Click to Choose...">
								<option value="">กรุณาเลือก</option>
								<?php  $smt = $conn->prepare("select id, title from user_type ");
								if($_SESSION['user_type_id']==2){
								$sql .=" where id='3'";
								}
								
								$smt->execute();
								while ($row = $smt->fetch()){
								?>														   
								<option value ="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
								<?php }?>	
								</select>
								</div>
								</div>					
								<div class="form-group row">
								<div class="col-sm-12 col-form-label pr-0">
								สถานะ :
								</div>
								
								<div class="col-sm-12 pr-0 pr-sm-3">
								<select class="form-control col-12 col-sm-12 col-md-12 frm" id="s_user_status" name="s_user_status" data-placeholder="Click to Choose...">
								<option value="">กรุณาเลือก</option>
								<?php  $smt = $conn->prepare("select id,title from user_status ");	
								$smt->execute();
								while ($row = $smt->fetch()){
								?>														   
								<option value ="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
								<?php }?>	
								</select>
								</div>
								</div>
								
								</div>
								
								<div class="modal-footer bgc-secondary-l4 brc-secondary-l2 justify-content-center">
								<button type="button" onclick="show_data2();" class="btn btn-info btn-a-blue btn-h-blue px-4 border-2" data-dismiss="modal">
								<i class="fas fa-search"></i> ค้นหาข้อมูล
								</button>
								<button type="reset"  class="btn btn-warning btn-text-white btn-a-yellow btn-h-yellow px-4 border-2">
								<i class="fa fa-brush"></i> ล้างข้อมูล
								</button>							
								</div>
								
								</div><!-- .modal-content -->
								</div><!-- .modal-dialog -->
								</div><!-- .ace-aside -->
								</form>
								<!-- สิ้นสุด form aside-->
								
								</div>
																