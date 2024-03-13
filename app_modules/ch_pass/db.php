<?php session_start();
	//include('../../includes/connect.php');
	include('../../includes/function_db.php');
	//echo '0';
	//$_POST['stamp']=time();
	$tbname="users";
	$cdb=new control_db();
	//print_r($_POST);
	switch ($_POST['form_action']){
		//เพิ่มข้อมูล
		case '1':
		$date=getdate(time());
		$_POST['post_date']=date('d/m/').($date['year']+543);
		$_POST['post_time']=date("H:m:s");
		$sql="select news_id from $tbname where post_date='$_POST[post_date]' ";
		$query=$cdb->conn->prepare($sql);
		$query->execute();
		$co=$query->rowCount();
		if($co<1){
			$_POST['news_id']=1;
			}else{
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$_POST['news_id']=$data['news_id']+1;
		}
		unset($_POST['form_action'],$_POST['id']);
		echo $cdb->insert_data($tbname,$_POST);
		break;
		//แก้ไขข้อมูล
		case '2':
		//print_r($_POST);
		//$_POST['username']=$_SESSION['username'];
		$_POST['password']=md5($_POST['password']);
		unset($_POST['form_action'],$_POST['old_password'],$_POST['cpassword']);
		echo $cdb->update_data($tbname,$_POST,"username='$_SESSION[username]'");
		break;
		// ลบข้อมูล
		case '3':
		echo $cdb->delete_data($tbname,"id='$_POST[id]'");
		break;
		// เช็ค url ซ้ำ
		case '4':
		$_POST['password']=md5($_POST['old_password']);
		$_POST['username']=$_SESSION['username'];
		unset($_POST['form_action'],$_POST['stamp'],$_POST['old_password']);
		$sql="select id from users where password=:password and username=:username";
		//print_r($_POST);
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($_POST);
			$count = $query->rowCount();
			if($count<1){
				echo 'false';
				}else{
				echo 'true';
				}
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
		//ดึงข้อมูลเพื่อแก้ไขข้อมูล
		case '5':
		$sql="select * ";
		$sql .=" from $tbname ";
		$sql .=" where id=:id ";
		unset($_POST['form_action'],$_POST['stamp']);
		//print_r($_POST);
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($_POST);
			$data=$query->fetch(PDO::FETCH_ASSOC);
			foreach($data as $key=>$value){
				if($value==''){$value=' ';}
				$json_data[$key]=$value;
			}
			$json=json_encode($json_data);
			echo $json;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
		//ดึงข้อมูลเพื่อแสดง
		case '6':
		//print_r($_POST);
		$jon=array('firstname','lastname');
		$no_field=array('page','qpage','form_action','stamp');
		$sql="select $tbname.id,$tbname.news_id,$tbname.post_date,$tbname.post_time,$tbname.news_title ";
		$sql .=" ,$tbname.category_id,$tbname.sub_category_id,$tbname.caller_name";
		$sql .=",$tbname.news_status,$tbname.web_status ";
		$sql .=" ,CONCAT(users.firstname,' ',users.lastname) as em ";
		$sql .=" from $tbname ";
		$sql .=" left join users on $tbname.username=users.username ";
		$sql .=" where 1=1 ";
		foreach($_POST as $key=>$value){
			if(!in_array($key,$no_field)){
				if($value<>''){
					$s=strpos($key,'sss_');
					if($s!==false){
						$field=str_replace('sss_','',$key);
						$param[$field]=$value;
						if(in_array($field,$jon)){
							$sql.=" and users.$field like :$field ";							
							}else{
							$sql.=" and $tbname.$field like :$field ";
						}
					}
					$l=strpos($key,'lll_');
					if($l!==false){
						$field=str_replace('lll_','',$key);						
						$param[$field]="%$value%";
						if(in_array($field,$jon)){
							$sql.=" and users.$field like :$field ";										
							}else{
							$sql.=" and $tbname.$field like :$field ";				
						}
					}
				}
			}
		}
		//echo '<br>'.$sql.'<br>';
		// คำนวณจำนวนหน้า	
		$query=$cdb->conn->prepare($sql);
		$query->execute($param);
		$count = $query->rowCount();
		$json_data['pagination']['max_data']=$count;
		//คำนวณ record เริ่มต้น
		if($_POST['page']==1){
			$json_data['pagination']['state']='แสดง 1 - '.$_POST['qpage']. ' จาก '.number_format($count).' รายการ';
			$start=0;
			}else{
			$start=($_POST['page']-1)*$_POST['qpage'];
			$json_data['pagination']['state']='แสดง '.($start+1).' - '.($start+$_POST['qpage']). ' จาก '.number_format($count).' รายการ';
		}
		$json_data['pagination']['max_loop']=ceil(($count/$_POST['qpage']));
		//
		$sql .=" order by $tbname.category_id,$tbname.sub_category_id,$tbname.news_date,$tbname.news_id,$tbname.stamp ";		
		$sql .=" limit $start,$_POST[qpage] ";
		//echo $sql;
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($param);
			$count = $query->rowCount();
			$i=1;
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
				foreach($data as $key=>$value){
					if($key=='category_id'){
						$json_data[$i]['category']=$cat[$value];
					}
					if($key=='sub_category_id'){
						$json_data[$i]['sub_category']=$sub_cat[$value];
					}
					if($key=='news_status'){
						$json_data[$i]['news_status2']=$nst[$value];
					}
					if($key=='web_status'){
						if($value==1){
							$json_data[$i]['web_status2']='<i class="text-success fas fa-check-square"></i>';
							}else{
							$json_data[$i]['web_status2']='<i class="text-danger fas fa-window-close"></i>';
						}
					}
					$json_data[$i][$key]=$value;
				}
				++$i;
			}
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		$json=json_encode($json_data);
		echo $json;	
		break;
	}
	?>