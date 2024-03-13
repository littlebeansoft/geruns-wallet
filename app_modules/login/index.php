<?php session_start();
	ini_set('session.gc_maxlifetime', 86400);
	session_set_cookie_params(86400);	
	include('includes/connect.php');
	if(isset($_SESSION['user_type_id'])){
		if($_SESSION['user_type_id']<3){
			echo '<meta http-equiv="refresh" content="0;url='.$web['domain'].'" /">';
			}else{
			echo '<meta http-equiv="refresh" content="0;url='.$web['domain'].'none_edu/" /">';
		}
		}elseif(isset($_COOKIE['username'])){
		foreach($_COOKIE['username'] as $key=>$value){
			$_SESSION[$key]=$value;
		}
		echo '<meta http-equiv="refresh" content="0;url='.$web['domain'].'login/" /">';
	}
?>
<!doctype html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
		<base href="../" />
		
		<title><?php echo $web['title'];?></title>
		
		<!-- include common vendor stylesheets & fontawesome -->
		<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
		
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/fontawesome.css">
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/regular.css">
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/brands.css">
		<link rel="stylesheet" type="text/css" href="node_modules/@fortawesome/fontawesome-free/css/solid.css">
		
		
		
		<!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->
		
		
		<!-- include fonts -->
		<link rel="stylesheet" type="text/css" href="dist/css/ace-font.css">
		
		
		
		<!-- ace.css -->
		<link rel="stylesheet" type="text/css" href="dist/css/ace.css">
		
		
		<!-- favicon -->
		<link rel="icon" type="image/png" href="assets/favicon.png" />
		
		<!-- "Login" page styles, specific to this page for demo only -->
		<link rel="stylesheet" type="text/css" href="./views/pages/page-login/@page-style.css">
	</head>
	
	<body>
		<div class="body-container">
			
			<div class="main-container container bgc-transparent">
				
				<div class="main-content minh-100 justify-content-center">
					<div class="p-2 p-md-4">
						<div class="row justify-content-center" id="row-1">
							<div class="col-12 col-lg-6 col-xl-5 bgc-white shadow radius-1 overflow-hidden">
								
								<div class="row" id="row-2">
									
									<div id="id-col-main" class="col-12 py-lg-5 bgc-white px-0">
										
										
										<div class="tab-content tab-sliding border-0 p-0" data-swipe="right">
											
											<div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
												<!-- show this in desktop -->
												<div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
													<h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130">
														<i class="fa fa-coffee text-orange-m1 mr-1"></i>
														เข้าสู่ระบบ
													</h4>
												</div>
												
												<!-- show this in mobile device -->
												<div class="d-lg-none text-secondary-m1 my-4 text-center">
													<a href="dashboard.html">
														<i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
													</a>
													<h1 class="text-170">
														<span class="text-blue-d1">
															Ace <span class="text-80 text-dark-tp3">Application</span>
														</span>
													</h1>
													
													Welcome back
												</div>
												
												
												<form id="frm-login" name='frm-login' autocomplete="off" class="form-row mt-4">
													<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-1 col-lg-8 offset-lg-2">
														<div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
															<input id="username" name="username" placeholder="Username" type="text" class="frm form-control form-control-lg pr-4 shadow-none" />
															<i class="fa fa-user text-grey-m2 ml-n4"></i>
															<label class="floating-label text-grey-l1 ml-n3" for="username">
																Username
															</label>
														</div>
													</div>
													
													
													<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-1 col-lg-8 offset-lg-2 mt-2 mt-md-1">
														<div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
															<input id="password" name="password" placeholder="Password" type="password" class="frm form-control form-control-lg pr-4 shadow-none" />
															<i class="fa fa-key text-grey-m2 ml-n4"></i>
															<label class="floating-label text-grey-l1 ml-n3" for="password">
																Password
															</label>
														</div>
													</div>
													
													<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
														<label class="d-inline-block mt-3 mb-0 text-dark-l1">
															<input type="checkbox" class="mr-1" id="rem" name="rem" value='1' />
															Remember me
														</label>
														<input type="hidden" id="form_action" name="form_action" value="3"/>
														<button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4">
															Sign In
														</button>
														<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8  text-right text-md-right mt-n2 mb-2">
															<a href="#" class="text-primary-m1 text-95" data-toggle="tab" data-target="#id-tab-forgot">
																Forgot Password?
															</a>
														</div>
													</div>
												</form>
												<div id="results"></div>
											</div>
											<div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">
												<div class="position-tl ml-3 mt-2">
													<a href="#" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp" data-toggle="tab" data-target="#id-tab-login">
														<i class="fa fa-arrow-left"></i>
													</a>
												</div>
												
												
												<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5 px-0">
													<h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l2 pb-1 text-130">
														<i class="fa fa-key text-brown-m1 mr-1"></i>
														Recover Password
													</h4>
												</div>
												
												
												<form autocomplete="off" class="form-row mt-4">
													<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
														<label class="text-secondary-d3 mb-3">
															Enter your email address and we'll send you the instructions:
														</label>
														<div class="d-flex align-items-center">
															<input type="email" class="form-control form-control-lg pr-4 shadow-none" id="id-recover-email" placeholder="Email" />
															<i class="fa fa-envelope text-grey-m2 ml-n4"></i>
														</div>
													</div>
													
													<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-1">
														<button type="button" class="btn btn-orange btn-block px-4 btn-bold mt-2 mb-4">
															Continue
														</button>
													</div>
												</form>
												
												
												<div class="form-row w-100">
													<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">
														
														<hr class="brc-default-l2 mt-0 mb-2 w-100" />
														
														<div class="p-0 px-md-2 text-dark-tp4 my-3">
															<a class="text-blue-d1 text-600 btn-text-slide-x" data-toggle="tab" data-target="#id-tab-login" href="#">
																<i class="btn-text-2 fa fa-arrow-left text-110 align-text-bottom mr-2"></i>Back to Login
															</a>
														</div>
														
													</div>
												</div>
											</div>
											
										</div><!-- .tab-content -->
									</div>
									
								</div><!-- /.row -->
								
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="d-lg-none my-3 text-white-tp1 text-center">
							<i class="fa fa-leaf text-success-l3 mr-1 text-110"></i> Ace Company &copy; 2021
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
		
		<!-- include common vendor scripts used in demo pages -->
		<script src="node_modules/jquery/dist/jquery.js"></script>
		<script src="node_modules/popper.js/dist/umd/popper.js"></script>
		<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
		
		
		<!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->
		
		
		<!-- include ace.js -->
		<script src="dist/js/ace.js"></script>
		
		
		
		<!-- demo.js is only for Ace's demo and you shouldn't use it -->
		<script src="app/browser/demo.js"></script>
		
		
		
		<!-- "Login" page script to enable its demo functionality -->
		<script src="./views/pages/page-login/@page-script.js"></script>
		<script src="node_modules/jquery-validation/dist/jquery.validate.js"></script>
		
	</body>
	<script>
		$(function(){
		
		$.ajaxSetup({
		cache: false,
		contentType: false,
		processData: false
	}); 
	
	
	var $invalidClass = 'brc-danger-tp2'
	var $validClass = 'brc-info-tp2'
	
	$('#frm-login').validate({
		errorElement: 'span',
		errorClass: 'form-text form-error text-danger-m2',
		focusInvalid: false,
		ignore: "",
		rules: {
			username: {
				required: true,
			},
			password: {
				required: true,
			},
		},
		messages: {
			username: {
				required: " ",
			},
			password: {
				required: " ",
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
			//parent.append('<span class="form-text d-inline-block ml-sm-2"><i class=" fa fa-check text-success-m1 text-120"></i></span>')
		},
		
		errorPlacement: function (error, element) {
			// prepend 'fa-exclamation-circle' icon
			//error.prepend('<i class="form-text fa fa-exclamation-circle text-danger-m1 text-100 mr-1 ml-2"></i>')
			
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
			let param=new FormData(document.getElementById('frm-login'));
			//alert(param);
			$.post('app_modules/login/db.php',param)
			.done(function(data){
				//alert(data);
				obj = jQuery.parseJSON(data);
				
				switch(obj['result']){
					case 'true':
					location.href = "<?php echo $web['domain'];?>manage-examination/";
						break;
					break;
					case 'false':
					$('#results').html('<div class="text-center alert alert-danger">Username หรือ Password ไม่ถูกต้อง</div>');							
					break;
					case 'no_permission':
					$('#results').html('<div class="text-center alert alert-danger">Username ยังไม่ได้รับการอนุมัติ โปรดติดต่อผู้ดูแลระบบครับ</div>');									
					break;
					case 'denie':
					$('#results').html('<div class="text-center alert alert-danger">Username ถูกระงับการใช้งาน โปรดติดต่อผู้ดูแลระบบครับ</div>');									
					break;
				}
			});
			return false;
		},
	});
});		
</script>

</html>	