//ฟังก์ชั่นเปิดปิดฟอร์ม
function toggle_form_data(){
	$('.frm').val('');
	$('#form_action').val('1');		
	$('#div-main-form').toggle();
	$('#div-show-data').toggle();
	//$('#frm').show();
}

// ฟังก์ชั่น disable/enable 
function disable_input(sid,vdid,did){
	if($('#'+sid).val()==vdid){
		$('#'+did).attr("disabled", 'disabled');							
		}else{
		$('#'+did).removeAttr("disabled");
	}
}
function chk_menu_url(){
	let param = new FormData();
	param.append('menu_url',$('#menu_url').val());
	param.append('form_action','4');
	
	$.post(folder+'db.php',param)
	.done(function(data){
		if(data>0){
			ms="<div class='bgc-danger-d1 text-white px-3 pt-3'>";
			ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
			ms+="<i class='fa fa-check text-150'></i>";
			ms+="</div></div>";
			ms+="<div class='p-3 mb-0 flex-grow-1'>";
			ms+="<h4 class='text-130'>พบข้อผิดพลาด</h4>";
			ms+="ชื่อที่แสดงบน URL ซ้ำครับ";
			ms+="</div>";
			ms+="<button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button>";
			$.aceToaster.add({
				placement: 'tc',
				body:  ms,
				width: 420,
				delay: 5000,
				
				close: false,
				
				className: 'bgc-white-tp1 shadow border-0',
				
				bodyClass: 'd-flex border-0 p-0 text-dark-tp2',
				headerClass: 'd-none',
			});
			$('#menu_url').val('').focus();
		}
	});
}


//ย้ายตำแหน่งข้อมูล
function sort_data(id,label,order){
	$('#oposition').html('<option value="'+id+'">'+order+' '+label+'</option>');
	let param = new FormData();
	param.append('id',id);
	param.append('form_action',7);
	$.post(folder+'db.php',param).done(function(data){
		//$('#results').html(data);
		obj = jQuery.parseJSON(data);
		da1='';
		x=1;
		$.each(obj,function(i){	
			da1+='<option value="'+obj[i].id+'">'+i+' '+obj[i].title+'</option>';
		});	
		da+='</div>';
		$( "#nposition" ).html(da1);
	});
}
function sort(){
	let param = new FormData(document.getElementById("frm_sort"));
	param.append('form_action',8);
	$.post(folder+'db.php',param)
	.done(function(data){
		//$('#results').html(data);
		//alert(data);
		if(data=='0'){
			show_data();
			ms="<div class='bgc-success-d1 text-white px-3 pt-3'>";
			ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
			ms+="<i class='fa fa-check text-150'></i>";
			ms+="</div></div>";
			ms+="<div class='p-3 mb-0 flex-grow-1'>";
			ms+="<h4 class='text-130'>Success</h4>";
			ms+="บันทึกข้อมูลเรียบร้อยแล้ว";
			ms+="</div>";
			ms+="<button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button>";
			$.aceToaster.add({
				placement: 'tc',
				body:  ms,
				width: 420,
				delay: 5000,
				
				close: false,
				
				className: 'bgc-white-tp1 shadow border-0',
				
				bodyClass: 'd-flex border-0 p-0 text-dark-tp2',
				headerClass: 'd-none',
			});
			
			
		}
	});	
}
//ฟังก์ชั่นซ่อนรายการใน dialog ปรับลำดับ
function sh_nposition(id){
	if(id>3){ $('#dnposition').hide(); }else{$('#dnposition').show();}
}
//สิ้นสุดย้ายตำแหน่งข้อมูล

//pagination แบ่งหน้าแสดงข้อมูล
function pagination(max_page,page){
	$('#total_page').html(' จาก '+ max_page + ' หน้า');
	var width = $(window).width();
	if(max_page>=1){
		$('#pagination').empty();
		if(page==1){ 
			ds='class="disabled"';
			oc='';
			}else{
			ds='';
			pe=parseInt(page)-1;
			oc='onclick="show_data('+pe+');"';
		}
		pag='<li class="page-item mr-1" '+ds+'><a class="page-link btn btn-sm btn-bgc-tp p-25 radius-3px text-600 btn-light-grey border-0"  '+oc+'><i class="fa fa-caret-left text-11s0"></i></a>';
		$('#pagination').append(pag);
		if(width<370){
			max=6;
			}else if(width<650){
			max=12;
			}else if(width<740){
			max=15;
			}else if(width<1025){
			max=20;
			}else if(width>1100){
			max=7;
		}
		if(page==1){
			i=1;
			}else{
			if(max_page<max){
				i=1;
				}else{
				loop=page+max;
				if(loop>max_page){
					i=max_page-max+1;
					}else{
					i=page;
				}
			}
		}
		var x=1;
		var pag='';			
		while(i<=max_page){
			if(page==i){ at='active';}else{at='';}
			pag+='<li class="page-item mr-15" ><a class=" '+at+' w-5 page-link btn p-25 btn-sm border-0 btn-bgc-tp radius-3px text-600 btn-light-black btn-h-primary btn-a-primary"  onclick="show_data('+i+');" >'+i+'</a></li>';
			++i;
			++x;
			if(x>max){break;}
		}
		if(page==max_page){ 
			ds='class="disabled"';
			oc='';
			}else{
			ds='';
			po=parseInt(page)+1;
			oc='onclick="show_data('+po+');"';
		}		
		pag+='<li class="page-item" '+ds+'><a class="page-link btn btn-sm btn-bgc-tp p-25 radius-3px text-600 btn-light-grey border-0" '+oc+'><i class="fa fa-caret-right text-11s0"></i></a></li>';
		$('#pagination').append(pag);					
	}else{$('#pagination').empty();}		
}
//สิ้นสุด pagination แบ่งหน้าแสดงข้อมูล

//แสดงข้อมูล
function show_data(page){
	if(page==null){ 
		page=$('#page').val();
		}else{
		$('#page').val(page);
	}
	$('#show_data').empty();
	let param = new FormData(document.getElementById("frm-search"));
	//let param = new FormData();
	param.append('page',page);
	param.append('qpage',$('#qpage').val());
	param.append('form_action',6);
	$.post(folder+'db.php',param)
	.done(function(data){
	//alert(data);
//		$('#results').html(data);
		obj = jQuery.parseJSON(data);
		$('#show_state').html(obj['pagination'].state);
		pagination(obj['pagination'].max_loop,page);
		
		if(page==1){x=1;}else{x=(page-1)*$('#qpage').val()+1;}			
		da="";
		$.each(obj,function(i){	
			if(i!=='pagination'){
				da+='<tr class="bgc-h-yellow-l4 d-style">';
				da+='<td class="text-center pr-0 pos-rel center" align="center" >'+x+'</td>';
				da+='<td>'+obj[i].title+'</td>';
				da+='<td class="text-center">'+obj[i].menu_type+'</td>';
				da+='<td>'+obj[i].menu_url+'</td>';
				da+='<td><i class="fa '+obj[i].menu_icon+'"></i> : '+obj[i].menu_icon+'</td>';
				da+='<td>'+obj[i].menu_file+'</td>';			
				da+='<td class="text-center">';
				
				if(obj[i].status=='1'){ sel='checked';}else{sel='';}
				//action buttons
				// show a dropdown in mobile
				da+="<div>";
				da+="<a href='#' class='btn btn-orange btn-xs py-15 radius-round dropdown-toggle' data-toggle='dropdown' >";
				da+='<i class="fa fa-cog"></i>';
				da+='</a>';
				
				da+='<div class="dropdown-menu dd-slide-up dd-slide-none-lg">';
				da+='<div class="dropdown-inner">';
				da+='<div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">';
				da+=i+' '+obj[i].title;
				da+='</div>';
				da+='<a class="dropdown-item"><label><input value="1" '+sel+' class="ace-switch input-lg ace-switch-onoff bgc-blue-d2 text-grey-m3 radius-1" type="checkbox" id="st_'+obj[i].id+'" onclick="update_status('+obj[i].id+')" /><span class="lbl"></span></label></a>';
				da+='<a style="cursor:pointer" onClick="edit_data('+obj[i].id+')" class="dropdown-item">';
				da+='<i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>';
				da+='Edit';
				da+='</a>';
				da+='<a style="cursor:pointer" onClick="delete_data('+obj[i].id+')" class="dropdown-item">';
				da+='<i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>';
				da+='Delete';
				da+='</a>';
				da+='<a style="cursor:pointer" onClick="sort_data('+"'"+obj[i].id+"','"+obj[i].title+"','"+i+"'"+')" class="dropdown-item" data-toggle="modal" data-target="#dialog-sort">';
				da+='<i class="fa fa-sort text-orange-d1 mr-1 p-2 w-4"></i>';
				da+='Sort';
				da+='</a>';
				da+='</div>';
				da+='</div>';
				da+='</div>';
				da+='</td>';
				da+='</tr>';
				++x;
			}
		});
		$('#show_data').html(da);	
	});
}

function show_data2(){
	$('#qpage option:first').prop('selected',true);
	$('#page').val(1);
	show_data();
}

function edit_data(id){
	let param = new FormData();
	param.append('id',id);
	param.append('form_action','5');
	$.post(folder+'db.php',param).done(function(data){
		//$('#results').html(data);
		obj = jQuery.parseJSON(data);
		$.each(obj,function(index,value){
			$('#'+index).val(value);
			if(index=='menu_type'){ disable_input('menu_type','2','menu_file');}
		});
		$('#form_action').val(2);
	});
	$('#frm-label').html('แก้ไขข้อมูล');
	toggle_form_data();	
}


function delete_data(did){
	ms='<div class="bgc-danger-d2 px-3 py-3 radius-round ml-1 mr-3 mb-3 float-left">';
	ms+='<i class="fa fa-exclamation-circle text-180 text-white mx-1px"></i>';
	ms+='</div>';
	ms+='<h4>คำเตือน</h4>';
	ms+='<h5>หากลบข้อมูลแล้วจะไม่สามารถกู้คืนกลับมาได้</h5>';
	ms+='<hr class="my-3" />';
	ms+='<p class="text-center mt-2 mb-0">';
	ms+='<button type="button" data-dismiss="toast" class="btn px-4 btn-danger" onclick="confirm_delete('+did+')">ยืนยันการลบข้อมูล</button>';
	ms+=' <button type="button" data-dismiss="toast" class="btn px-4 btn-light-secondary">ยกเลิก</button>';
	ms+='</p>';
	
	$.aceToaster.add({
		placement: 'tc',
		title: 'ยืนยันการลบข้อมูล',
		body: ms,
		
		width: '420px',
		
		sticky: true,
		belowNav: true,
		
		closeClass: 'btn btn-bgc-tp border-0 btn-light-danger btn-xs px-2 py-1px m2-px radius-1 text-100 font-normal position-tr mt-2px mr-2px',
		
		//icon: '<i class="fa fa-user fa-2x text-success-m3 ml-2 mr-1"></i>',
		
		headerClass: 'bgc-transparent border-0 text-white text-140 mb-3 p-0 pl-3 pr-4',
		titleClass: 'text-dark-tp3 font-normal pt-15',
		
		className: 'brc-danger-m1 border-1 border-t-4 radius-0 pr-0',
		
		bodyClass: 'pt-0 pl-3 text-105'
	})
	
}
function confirm_delete(did){
	let param=new FormData();
	param.append('id',did);
	param.append('form_action',3);
	$.post(folder+'db.php',param)
	.done(function(data){
		//alert(data);		
		if(data=='0'){
			ms="<div class='bgc-success-d1 text-white px-3 pt-3'>";
			ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
			ms+="<i class='fa fa-check text-150'></i>";
			ms+="</div></div>";
			ms+="<div class='p-3 mb-0 flex-grow-1'>";
			ms+="<h4 class='text-130'>Success</h4>";
			ms+="ลบข้อมูลเรียบร้อยแล้ว";
			ms+="</div>";
			ms+="<button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button>";
			$.aceToaster.add({
				placement: 'tc',
				body:  ms,
				width: 420,
				delay: 5000,
				
				close: false,
				
				className: 'bgc-white-tp1 shadow border-0',
				
				bodyClass: 'd-flex border-0 p-0 text-dark-tp2',
				headerClass: 'd-none',
			});
			show_data(1);
			}else{
			$('#dia-derror').modal();
		}
	});
	
}

//ฟังก์ชั่น update status
function update_status(id){
	//alert(id);
	if($('#st_'+id).prop("checked")){ st='1';	}else{st='2';}
	let param=new FormData();
	param.append('id',id);
	param.append('status',st);
	param.append('form_action',2);
	$.post(folder+'db.php',param)
	.done(function(data){
		if(data=='0'){
			ms="<div class='bgc-success-d1 text-white px-3 pt-3'>";
			ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
			ms+="<i class='fa fa-check text-150'></i>";
			ms+="</div></div>";
			ms+="<div class='p-3 mb-0 flex-grow-1'>";
			ms+="<h4 class='text-130'>Success</h4>";
			ms+="บันทึกข้อมูลเรียบร้อยแล้ว";
			ms+="</div>";
			ms+="<button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button>";
			$.aceToaster.add({
				placement: 'tc',
				body:  ms,
				width: 420,
				delay: 5000,
				close: false,
				className: 'bgc-white-tp1 shadow border-0',
				bodyClass: 'd-flex border-0 p-0 text-dark-tp2',
				headerClass: 'd-none',
			});
			}else{
			$('#dia-ierror').modal();			
		}
	});
}


$(function(){
	//ปรับการแสดงผลเลขหน้าตามขนาดจอ
	$(window).on('resize', function() {
		show_data($('#page').va());
	});
	
	//แสดงผลข้อมูลเมื่อกด enter ที่เลขหน้า
	$('#page').on('keypress',function(e) {
		if(e.which == 13) {
			show_data($('#page').val());
			return false;
		}
	});	
	
	//แสดงข้อมูลเมื่อเปิดหน้า
	show_data();
	
	//แสดงข้อมูลตามจำนวนที่ผู้ใช้งานต้องการ
	$('#qpage').change(function(){show_data(1);});
	
	//แสดงข้อมูลตามหน้าที่ผู้ใช้งานต้องการ
	$('#go_page').click(function(){show_data($('#page').val());});
	
	//ซ่อนและแสดง main form และ data
	$('#btn-show-main-form').click(function(){toggle_form_data(); $('#frm-label').html('เพิ่มข้อมูล');});
	$('#btn-hide-main-form').click(function(){toggle_form_data();});
	
	//เช็ค menu_url ซ้ำ
	$('#menu_url').blur(function(){ chk_menu_url();});	
	
	//คลิกเลือกประเภทแล้ว disable/enable input 
	$('#menu_type').change(function(){disable_input('menu_type','2','menu_file');});	
	
	//คลิกปุ่ม reset แล้วไม่ enable menu_file
	$('#btn-reset').click(function(){ $('#menu_file').attr('disabled',false);});	
	
	//ฟอร์มค้นหาข้อมูลโดยละเอียด
	$('#aside-search').aceAside({
		placement: 'right',
		dismiss: true,
		belowNav: true,
		extrwNav: true,
		extraClass: 'my-2'
	})
	
	var $invalidClass = 'brc-danger-tp2'
	var $validClass = 'brc-info-tp2'
	
	$('#frm-main').validate({
		errorElement: 'span',
		errorClass: 'form-text form-error text-danger-m2',
		focusInvalid: false,
		ignore: "",
		rules: {
			menu_type: {
				required: true,
			},
			menu_url: {
				required: true,
			},
			menu_title: {
				required: true,
			},
			menu_icon: {
				required: true,
			},
		},
		messages: {
			menu_type: {
				required: " กรุณาเลือกประเภทเมนูด้วยครับ",
			},
			menu_url: {
				required: " กรุณาพิมพ์ชื่อเมนูที่แสดงบน URL ด้วยครับ",
			},
			menu_title: {
				required: " กรุณาพิมพ์ชื่อเมนูด้วยครับ",
			},
			menu_file: {
				required: " กรุณาพิมพ์ไฟล์ปลายทางด้วยครับ",
			},				
			menu_icon: {
				required: " กรุณาพิมพ์ชื่อ Class Icon ด้วยครับ",
			},						
		},
		highlight: function (element) {
			var $element = $(element);
			
			//remove error messages to be inserted again, so that the `.fa-exclamation-circle` is inserted in `errorPlacement` function
			$element.closest('.form-group').find('.form-text').remove()
			
			if( $element.is('input[type=checkbox]') || $element.is('input[type=radio]') ) return
			
			else if( $element.is('.select2')) {
				var container = $element.siblings('[class*="select2-container"]')
				container.find('.select2-selection').addClass( $invalidClass )
			}
			else if( $element.is('.chosen')) {
				var container = $element.siblings('[class*="chosen-container"]');
				container.find('.chosen-choices, .chosen-single').addClass( $invalidClass )
				}else {
				$element.addClass($invalidClass + ' d-inline-block').removeClass( $validClass )
			}
		},
		
		success: function (error, element) {
			var parent = error.parent()
			var $element = $(element)
			
			$element.removeClass( $invalidClass )
			.closest('.form-group').find('.form-text').remove()
			
			if ($element.is('input[type=checkbox]') || $element.is('input[type=radio]')) return
			
			else if( $element.is('.select2')) {
				var container = $element.siblings('[class*="select2-container"]')
				container.find('.select2-selection').removeClass($invalidClass)
			}
			else if( $element.is('.chosen')) {
				var container = $element.siblings('[class*="chosen-container"]')
				container.find('.chosen-choices, .chosen-single').removeClass($invalidClass)
			}
			
			else {
				$element.addClass($validClass + ' d-inline-block')
			}
			
			// append 'fa-check' icon
			parent.append('<span class="form-text d-inline-block ml-sm-2"><i class=" fa fa-check text-success-m1 text-120"></i></span>')
		},
		
		errorPlacement: function (error, element) {
			// prepend 'fa-exclamation-circle' icon
			error.prepend('<i class="form-text fa fa-exclamation-circle text-danger-m1 text-100 mr-1 ml-2"></i>')
			
			if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
				element.closest('div[class*="col-"]').append(error)
			}
			else if(element.is('.select2')) {
				var container = element.siblings('[class*="select2-container"]')
				error.insertAfter(container)
				container.find('.select2-selection').addClass($invalidClass)
			}
			else if(element.is('.chosen')) {
				var container = element.siblings('[class*="chosen-container"]')
				error.insertAfter(container)
				container.find('.chosen-choices, .chosen-single').addClass($invalidClass)
			}
			else {
				error.addClass('d-inline-block').insertAfter(element)
			}
		},
		
		submitHandler: function (form) {
			$('#show_data').empty();
			let param=new FormData(document.getElementById('frm-main'));			
			$.post(folder+'db.php',param)
			.done(function(data){
				//$('#results').html(data);
				if(data=='0'){
					ms="<div class='bgc-success-d1 text-white px-3 pt-3'>";
					ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
					ms+="<i class='fa fa-check text-150'></i>";
					ms+="</div></div>";
					ms+="<div class='p-3 mb-0 flex-grow-1'>";
					ms+="<h4 class='text-130'>Success</h4>";		
					if($('#form_action').val()==1){
						ms+="บันทึกข้อมูลเรียบร้อยแล้ว";
						}else{
						ms+="แก้ไขข้อมูลเรียบร้อยแล้วครับ";
					}
					ms+="</div>";
					ms+="<button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button>";
					$.aceToaster.add({
						placement: 'tc',
						body:  ms,
						width: 420,
						delay: 5000,
						close: false,
						className: 'bgc-white-tp1 shadow border-0',
						bodyClass: 'd-flex border-0 p-0 text-dark-tp2',
						headerClass: 'd-none',
					});
					
					$('.frm').val('');
					toggle_form_data();
					show_data();					
					$('#form_action').val('1');
					}else{
					
				}
			});
			return false;
		},
	});
});