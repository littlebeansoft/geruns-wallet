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
		$_POST['password']=md5($_POST['password']);
		if(isset($_POST['rem'])){$rem=$_POST['rem'];}
		unset($_POST['form_action'],$_POST['rem']);
		//print_r($_POST);
		$sql="select * ";
		$sql .=" ,user_type.title as utitle ";
		$sql .=" from users ";
		$sql .=" inner join user_type on users.user_type_id=user_type.id ";
		$sql.=" where users.username=:username and users.password=:password";
		//print_r($_POST);
		$query=$conn->prepare($sql);
		try{
			$query->execute($_POST);
			$count= $query->rowCount();
			if($count>0){
				$data=$query->fetch(PDO::FETCH_ASSOC);
				$json_data['utid']=$data['user_type_id'];
				switch($data['user_status']){
					case '1':
					$json_data['result']="no_permission";
					break;					
					case '2':
					$json_data['result']= "true";
					foreach($data as $key=>$value){
						$_SESSION[$key]=$value;
					}
					if($rem=='1'){
						//echo $rem;
						foreach($data as $key=>$value){
							setcookie($key,$value,time()+3600,"/");
						}
					}
					break;
					case '3':
					$json_data['result']='denie';
					break;
				}
				}else{
				$json_data['result']="false";
			}
			$json=json_encode($json_data);
			echo $json;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
	}
?>