<?php session_start();
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params(86400);
include('main.php');
$part = explode('/', $_SERVER['REQUEST_URI']);

include('header.php');
//include('menu_horizontal.php');
/*if(isset($_SESSION['username'])){
			$_SESSION['user_type_id']=1;
			//session_destroy();
		}*/
?>
<div class="main-container container-plus bgc-white">
	<?php
	include('menu_left.php');
	?>

	<div role="main" class="main-content">
		<?php
		/*echo $_SERVER['REQUEST_URI'];
		print_r($part);*/
		if (array_key_exists($part[1], $view)) {
			include($view[$part[1]]['appFile']);
		}
		include('footer_page.php');
		//include('web_control.php');
		?>
	</div>
</div>

<!-- include common vendor scripts used in demo pages -->
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="includes/function.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckfinder/ckfinder.js"></script>
<script src="node_modules/select2/dist/js/select2.js"></script>

<script src="node_modules/summernote/dist/summernote-lite.js"></script>


<!-- include vendor scripts used in "Dashboard" page. see "/views//pages/partials/dashboard/@vendor-scripts.hbs" -->

<script src="node_modules/jquery-validation/dist/jquery.validate.js"></script>
<script src="node_modules/bootbox/bootbox.all.js"></script>
<script src="node_modules/fullcalendar/main.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script src="node_modules/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.js"></script>


<!-- include ace.js -->
<script src="dist/js/ace.js"></script>
<!-- "Calendar" page script to enable its demo functionality -->


<script>
	var folder = "<?php echo $view[$part[1]]['appFolder']; ?>";
	//ฟังก์ชั่นตั้งค่าเพื่อให้คำสั่ง $.post รับค่าจาก new FormData(document.getel) โดยเอา
	$.ajaxSetup({
		cache: false,
		contentType: false,
		processData: false
	});
</script>
<script src="<?php echo $view[$part[1]]['appFolder']; ?>function.js"></script>
</body>

</html>