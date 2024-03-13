<?php session_start();
	ini_set('session.gc_maxlifetime', 86400);
	session_set_cookie_params(86400);	
	include('../../includes/connect.php');
	//print_r($_POST);
	$tbname="users";
	switch($_POST['form_action']){
		/*case 1://ลงทะเบียน
		$_POST['stamp']=date('Y-m-d H:i:s');
		$_POST['password']=md5($_POST['password']);
		unset($_POST['cpassword'],$_POST['form_action']);
		$_POST['status']=1;
		$_SESSION['teacher_email']=$_POST['teacher_email'];
		$_POST['username']=$_POST['teacher_email'];
		echo insert_db($tbname,$_POST,$conn);
		break;
		case 2://ตรวจสอบ email ว่าซ้ำหรือไม่
		unset($_POST['form_action']);
		//print_r($_POST);
		$sql="select teacher_id from $tbname where teacher_mail=:teacher_mail ";
		$query=$conn->prepare($sql);
		try{
			$query->execute($_POST);
			echo $query->rowCount();
			}catch(PDOException $er){
			//echo 'Error :'.$er->getMessage();
		}
		break;*/
		case 3://login
		//print_r($_POST);
		//$_POST['password']=md5($_POST['login-password']);
		if(isset($_POST['rem'])){$rem='1';}else{$rem='2';}
		unset($_POST['form_action'],$_POST['rem']);
		//print_r($_POST);
		$sql="select * from users ";
		$sql.=" where username=:username and password=:password";
		$query=$conn->prepare($sql);
		try{
			$query->execute($_POST);
			$count= $query->rowCount();
			if($count>0){
				$data=$query->fetch(PDO::FETCH_ASSOC);
				echo "true";
				foreach($data as $key=>$value){
					$_SESSION[$key]=$value;
				}
				if($rem=='1'){
					foreach($data as $key=>$value){
						setcookie($key,$value,time()+3600);
					}
				}
			}else{echo "false";}
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
	}
?>	