function check_dub(id){
	let param = new FormData();
	param.append(id,$('#'+id).val());
	param.append('form_action','4');
	
	$.post(folder+'db.php',param)
	.done(function(data){
		//alert(data);
		if(data=='false'){
			ms="<div class='bgc-danger-d1 text-white px-3 pt-3'>";
			ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
			ms+="<i class='fa fa-check text-150'></i>";
			ms+="</div></div>";
			ms+="<div class='p-3 mb-0 flex-grow-1'>";
			ms+="<h4 class='text-130'>พบข้อผิดพลาด</h4>";
			ms+="รหัสผ่านเดิมไม่ถูกต้องครับ";
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
			$('#'+id).val('').focus();
		}
	});
}


$(function(){
	//ปรับการแสดงผลเลขหน้าตามขนาดจอ
	$(window).on('resize', function() {
		show_data($('#page').va());
	});
	
	$('#old_password').change(function(){
		check_dub('old_password');
		});
	
	var $invalidClass = 'brc-danger-tp2'
	var $validClass = 'brc-info-tp2'
	
	$.validator.addMethod("time24", function(value, element) {
		if (!/^\d{2}:\d{2}$/.test(value)){return false;}else{
			var parts = value.split(':');
			if (parts[0] > 23 || parts[1] > 59)
			{return false;}else{
				return true;
			}
		}
	}, " รูปแบบ hh:mm ");
	
	$('#frm-main').validate({
		errorElement: 'span',
		errorClass: 'form-text form-error text-danger-m2',
		focusInvalid: false,
		ignore: "",
		rules: {
			old_password: {
				required: true,
			},
			password: {
				required: true,
				minlength: 10
			},
			cpassword: {
				required: true,
				equalTo: '#password',
			},
		},
		messages: {
			old_password: {
				required: ' ',
			},
			password: {
				required: ' ',
				minlength: ' รหัสผ่านอย่างน้อย 10 ตัวอักษรครับ'
			},
			cpassword: {
				required: ' ',
				equalTo: ' รหัสผ่านไม่ตรงกันครับ',
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
			let param=new FormData(document.getElementById('frm-main'));			
			$.post(folder+'db.php',param)
			.done(function(data){
				//alert(data);
				$('#results').html(data);
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
					$('#form_action').val('2');
					}else{
					
				}
			});
			return false;
		},
	});
	
});				