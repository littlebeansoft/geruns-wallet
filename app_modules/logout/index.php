<?php session_start();
	include('includes/connect.php');
	foreach($_COOKIE as $key => $value){
		setcookie($key,'',-1,"/");		
	}
	session_destroy();
?>
<meta http-equiv="refresh" content="0;url=<?php echo $web['domain'];?>dashboard/">
