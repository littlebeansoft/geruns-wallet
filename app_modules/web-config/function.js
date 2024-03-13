function edit_data(id){
	$("#logo").removeAttr('required');	
	let param = new FormData();
	param.append('form_action','5');
	param.append('id',id);
	$.post(folder+'db.php',param).done(function(data){
	//alert(data);
		//$('#results').html(data);
		obj = jQuery.parseJSON(data);
		SetContents(obj['slogan'],slogan);		
		$('#previewImg').attr('src',obj['logo']);
		$.each(obj,function(index,value){
			$('#'+index).val(value);
		});
	});
	$('#form_action').val('2');	
	$('#frm-label').html('แก้ไขข้อมูล');
}
function BrowseServer( startupPath, functionData )
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	
	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.basePath = '../';
	
	//Startup path in a form: "Type:/path/to/directory/"
	finder.startupPath = startupPath;
	
	// Name of a function which is called when a file is selected in CKFinder.
	finder.selectActionFunction = SetFileField;
	
	// Additional data to be passed to the selectActionFunction in a second argument.
	// We'll use this feature to pass the Id of a field that will be updated.
	finder.selectActionData = functionData;
	
	// Name of a function which is called when a thumbnail is selected in CKFinder.
	finder.selectThumbnailActionFunction = ShowThumbnails;
	
	// Launch CKFinder
	finder.popup();
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl, data )
{
	document.getElementById( data["selectActionData"] ).value = fileUrl;
	$('#previewImg').attr("src",data["fileUrl"]);	
	
}

// This is a sample function which is called when a thumbnail is selected in CKFinder.
function ShowThumbnails( fileUrl, data )
{
	// this = CKFinderAPI
	var sFileName = this.getSelectedFile().name;
	document.getElementById( 'thumbnails' ).innerHTML +=
	'<div class="thumb">' +
	'<img src="' + fileUrl + '" />' +
	'<div class="caption">' +
	'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
	'</div>' +
	'</div>';
	
	document.getElementById( 'preview' ).style.display = "";
	// It is not required to return any value.
	// When false is returned, CKFinder will not close automatically.
	return false;
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

function previewFile(input,tid){
	var file = $("input[type=file]").get(0).files[0];
	if(file){
		var reader = new FileReader();
		reader.onload = function(){
			$("#"+tid).attr("src", reader.result);
		}
		reader.readAsDataURL(file);
	}
}
//สิ้นสุด function file


$(function(){
	edit_data(1);
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
			title: {
				required: true,
			},
			category_id: {
				required: true,
			},
			units_id: {
				required: true,
			},
			status: {
				required: true,
			},
			price: {
				required: true,
				number:true,
			},
			photo: {
				required: true,
			},
		},
		messages: {
			title: {
				required: " กรุณากรอกหมวดหมู่สินค้าด้วยครับ",
			},
			photo: {
				required: " กรุณาเลือกรูปสินค้าครับ",
			},
			category_id: {
				required: " กรุณาเลือกหมวดหมู่สินค้าด้วยครับ",
			},
			price: {
				required: " กรุณากรอกราคาด้วยครับ",
				number: " กรุณากรอกราคาด้วยครับ",
			},
			slogan: {
				required: " กรุณากรอกรายละเอียดด้วยครับ",
			},
			status: {
				required: " กรุณาเลือกสถานะสินค้าด้วยครับ",
			},
			units_id: {
				required: " กรุณาเลือกหน่วยนับด้วยครับ",
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
			n=GetContents(slogan).length;;
			if(n==0){
				ms="<div class='bgc-danger-d1 text-white px-3 pt-3'>";
				ms+="<div class='border-2 brc-white px-3 py-25 radius-round'>";
				ms+="<i class='fa fa-exclamation-circle text-150'></i>";
				ms+="</div></div>";
				ms+="<div class='p-3 mb-0 flex-grow-1'>";
				ms+="<h4 class='text-130'>พบข้อผิดพลาด</h4>";		
				ms+="กรุณากรอกรายละเอียดด้วยครับ";
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
				
				$('#show_data').empty();
				let param=new FormData(document.getElementById('frm-main'));
				//alert($('#form_action').val());
				param.append('slogan',GetContents(slogan));
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
						$('#form_action').val('2');
						}else{
						
					}
				});
			}
			return false;
		},
	});
	
	slogan=CKEDITOR.replace( 'slogan', {
		width:870,
		height:300,
		/*toolbar:
			[ ['Source','youtube','-','Undo','Redo','Cut','Coppy','Paste','PasteText','PasteFromWord','RemoveFormat','-','Outdent', 'Indent', '-', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','-', 'Table', 'HorizontalRule', 'SpecialChar','Image', 'Flash', 'Smiley', '-', 'Link', 'Unlink'],
			'/',
		['Styles','Format','Font','FontSize','TextColor','BGColor','Bold', 'Italic', 'Underline', '-', 'Subscript', 'Superscript', '-', 'NumberedList', 'BulletedList'] ],*/
		filebrowserBrowseUrl : 'ckfinder/ckfinder2.php',
		filebrowserImageBrowseUrl : 'ckfinder/ckfinder2.php?Type=Images',
		filebrowserFlashBrowseUrl : 'ckfinder/ckfinder2.php?Type=Flash',
		filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	
	} );			
	
});							