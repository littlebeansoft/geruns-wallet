<?php session_start();
	//include('../../includes/connect.php');
	include('../../includes/function_db.php');
	require("../../phpmailer/class.phpmailer.php");	
	
	function random_string($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function send_mail($reciver_address,$reciver_name,$subject,$body){
		$mail = new PHPMailer();
		$mail->CharSet = "utf-8"; 		
		$mail->IsSMTP();
		$mail->Mailer = "smtp";
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username = "mail_system@pet.nfe.go.th";  // Gmail username หรือหากท่านใช้ G-suite / WorkSpace ให้ใช้อีเมล์ @you@yourdomain แทน
		$mail->Password = "1qaz2wsx3edc4rfv"; 		
		$mail->SetFrom("mail_system@pet.nfe.go.th", "no-reply");
		//$mail->AddReplyTo($replyto, $replyto_name);//ชื่อ Mail ให้ลูกค้าตอบกลับ
		$mail->Subject = $subject;//ชื่อหัวเรื่อง
		
		$mail->MsgHTML($body);
		
		$mail->AddAddress($reciver_address, $reciver_name); // ผู้รับคนที่หนึ่ง
		//$mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง
		
		if(!$mail->Send()) {
			$re=1;
			//    echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			$re=0;
			//    echo "Message sent!";
		}
		return $re;
	}
	
	//echo '0';
	$_POST['stamp']=time();
	$tbname="users";
	$cdb=new control_db();
	switch ($_POST['form_action']){
		//เพิ่มข้อมูล
		case '1':
		//print_r($_POST);
		/*if($_POST['schoolid2']<>''){
			$_POST['schoolid']=$_POST['schoolid2'];
		}*/
		unset($_POST['form_action'],$_POST['id']);
		$remail=$_POST['username'];
		$rename=$_POST['FirstName'].' '.$_POST['LastName'];
		$subject="ข้อมูลผู้ใช้งานระบบคลังข้อสอบ สำนักงาน กศน.";
		$password=random_string(10);
		$_POST['password']=md5($password);
		$body="<table><tbody>";
		$body.="<tr><td style='font-size:15px;'>ข้อมูลการเข้าใช้งานระบบคลังข้อสอบ สำนักงาน กศน. ของ <strong>คุณ$rename</strong> ดังนี้</td></tr>";
		$body.="<tr><td style='font-size:15px; color:#FFFFFF'>-</td></tr>";
		$body.="<tr><th style='font-size:15px;' align='left'>Username : $remail</th></tr>";
		$body.="<tr><th style='font-size:15px;' align='left'>Password : $password</th></tr>";
		$body.="<tr><td style='font-size:15px; color:#FFFFFF'>-</td></tr>";
		$body.="<tr><td style='font-size:15px;'>คุณสามารถเข้าสู่ระบบได้ที่ http://exam.nfe.go.th/ndec3/login/</td></tr>";		
		$body.="<tr><td style='font-size:15px; color:#FFFFFF'>-</td></tr>";
		$body.="<tr><td style='font-size:15px;'>คุณสามารถเปลี่ยนแปลงรหัสผ่านได้ที่เมนูเปลี่ยนรหัสผ่านหลังการเข้าสู่ระบบ</td></tr>";
		$body.="<tr><td style='font-size:15px;'>และโปรดเก็บรักษารหัสผ่านของคุณให้ปลอดภัยที่สุด</td></tr>";
		$body.="<tr><td style='font-size:15px; color:#FFFFFF;'>-</td></tr>";
		$body.="<tr><td style='font-size:15px;'>Email ฉบับนี้ส่งโดยระบบอัตโนมัติ ไม่สามารถใช้ติดต่อสื่อสารได้ โปรดอย่าตอบกลับ Email Address นี้</td></tr>";
		$body.="<tr><td style='font-size:15px;'>หากท่านมีข้อสงสัย และหรือข้อแนะนำเกี่ยวกับระบบโปรดติดต่อ</td></tr>";
		$body.="<tr><td style='font-size:15px;'>กลุ่มพัฒนาระบบทดสอบ สำนักงาน กศน.</td></tr>";
		$body.="<tr><td style='font-size:15px;'>Phone : 0639595891 </td></tr>";
		$body.="<tr><td style='font-size:15px;'>E-Mail : nfetesting@nfe.go.th</td></tr>";
		
		$body.="</tbody></table>";
		$re=$cdb->insert_data($tbname,$_POST);
		//echo $re;
		if($re==0){
			echo send_mail($remail,$rename,$subject,$body);
		}
		break;
		//แก้ไขข้อมูล
		case '2':
		//print_r($_POST);
		$id=$_POST['id'];
		/*if($_POST['schoolid2']<>''){
			$_POST['schoolid']=$_POST['schoolid2'];
		}*/		
		unset($_POST['form_action'],$_POST['id'],$_POST['stamp']);
		//ตรวจสอบว่าข้อมูลที่แก้ไขอยู่หมวดเดิมหรือไม่ ถ้าไม่ให้ค้นหาลำดับของข้อมูลหมวดที่ทำการแก้ไข
		//print_r($_POST);
		echo $cdb->update_data($tbname,$_POST,"id='$id'");
		break;
		// ลบข้อมูล
		case '3':
		echo $cdb->delete_data($tbname,"id='$_POST[id]'");
		break;
		// เช็ค url ซ้ำ
		case '4':
		unset($_POST['form_action'],$_POST['stamp']);
		$sql="select id from $tbname where username=:username";
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($_POST);
			$count = $query->rowCount();
			echo $count;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
		//ดึงข้อมูลเพื่อแก้ไขข้อมูล
		case '5':
		$sql="select * ";
		$sql .=" from $tbname ";
		$sql .=" where id=:id ";
		//echo $sql;
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
		//ดึงข้อมูลเพื่อแสดงผล
		case '6':
		
		$no_field=array('page','qpage','form_action','stamp','username');
		$sql="select users.id,users.FirstName,users.LastName,prefix.prefix_name ";
		$sql .=" ,users.username,users.user_status as status ";
		$sql.=" ,user_type.title";
		$sql .=",user_status.title as utitle";
		//$sql .=",school.schoolname ";
		$sql .=" from $tbname ";
		$sql .=" left JOIN prefix ON users.prefix_id = prefix.prefix_id ";
		$sql .=" left JOIN user_type ON users.user_type_id = user_type.id ";
		$sql .=" inner JOIN user_status ON users.user_status = user_status.id ";
		//$sql .=" left JOIN school ON users.schoolid = school.schoolid ";
		$sql .=" where 1=1 and users.username not like '$_SESSION[username]' ";
		if($_SESSION['user_type_id']=='2'){
			$sql .=" and users.user_type_id not like '1'";
		}
		foreach($_POST as $key=>$value){
			if(!in_array($key,$no_field)){
				if($value<>''){
					$field=str_replace('s_','',$key);
					if(strpos($key,'title')<>''){
						$param[$field]="%$value%";
						$sql.=" and $field like :$field ";
						}else{
						$param[$field]="%$value%";
						$sql.=" and $field like :$field ";
					}
				}
			}
		}
		$sql .=" order by users.id ";
		//echo $sql;
		// คำนวณจำนวนหน้า	
		/*echo '<pre>';
			print_r($param);
		echo '</pre>';*/
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
		$sql .=" limit $start,$_POST[qpage] ";
		//echo $sql;
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($param);
			$count = $query->rowCount();
			$i=1;
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
				foreach($data as $key=>$value){
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
		//ดึงข้อมูลเพื่อทำการสลับข้อมูล sort_data
		case '7':
		$pid='menu_id';
		$sql="select menu2_id as id,menu2_title as title from $tbname where $pid='$_POST[pid]' order by rec_order";
		$query=$cdb->conn->prepare($sql);
		//print_r($_POST);
		try{
			$query->execute();
			$count = $query->rowCount();
			$i=1;
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
				foreach($data as $key=>$value){
					$json_data[$i][$key]=$value;
				}
				if($data['id']==$_POST['id']){$x=$i;}
				unset($json_data[$x]);
				++$i;
			}
			$json=json_encode($json_data);
			echo $json;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
		//สลับตำแหน่งข้อมูล function sort
		case '8':
		$tb="menu2";
		$pk='menu2_id';
		$pid='menu_id';
		//print_r($_POST);
		$_POST['oid']=$_POST['oposition'];
		$_POST['nid']=$_POST['nposition'];
		$_POST['ort']=$_POST['order_type'];
		//rec_order($_POST);
		switch($_POST['ort']){
			case '1'://สลับตำแหน่ง
			$sql="select rec_order from $tb where $pk='$_POST[oid]' and $pid='$_POST[pid]'";
			//echo $sql;
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$a=$query->fetch(PDO::FETCH_ASSOC);
			$sql="select rec_order from $tb where $pk='$_POST[nid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$a2=$query->fetch(PDO::FETCH_ASSOC);
			$sql="update $tb set rec_order='$a2[rec_order]' where $pk='$_POST[oid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$sql="update $tb set rec_order='$a[rec_order]' where $pk='$_POST[nid]' and $pid='$_POST[pid]'";
			$query2=$cdb->conn->prepare($sql);
			$query2->execute();
			if($query and $query2){echo '0';}else{echo '1';}
			break;
			case '2'://อยู่ก่อนหน้า
			//หาตำแหน่งของ id เดิม
			$sql="select rec_order from $tb where $pk='$_POST[oid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			//หาตำแหน่งของ id ใหม่
			$sql="select rec_order from $tb where $pk='$_POST[nid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			//echo 'ops='.$ops.' nps='.$nps.'<br>';
			if($ops>$nps){
				$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' and rec_order between ";
				$sql .="'$nps' and '$ops'";
				$sql .=" order by rec_order ";
				}else{
				$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' and rec_order between ";
				$sql .="'$ops' and '$nps'";
				$sql .=" order by rec_order ";
			}
			//echo $sql.'<br>';
			$query=$cdb->conn->prepare($sql);
			try{
				$query->execute();
				$count = $query->rowCount();
				$i=1;
				while($data=$query->fetch(PDO::FETCH_ASSOC)){
					//print_r($data);
					$np[$i]['id']=$data[$pk];
					$np[$i]['rec_order']=$data['rec_order'];
					++$i;
				}
				$i=1;
				if($ops>$nps){
					$sql= "update $tb set rec_order='".$np[1]['rec_order']."' where $pk='".$_POST['oid']."' and $pid='$_POST[pid]'";
					$query=$cdb->conn->prepare($sql);
					$query->execute();
					while($i<$count){
						$sql= "update $tb set rec_order='".$np[$i+1]['rec_order']."' where $pk='".$np[$i]['id']."' and $pid='$_POST[pid]'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
					}else{
					$sql= "update $tb set rec_order='".$np[$count-1]['rec_order']."' where $pk='".$_POST['oid']."' and $pid='$_POST[pid]'";
					$query=$cdb->conn->prepare($sql);
					$query->execute();
					if($query){$ok=0;}else{$ok=1;}
					$i=1;
					$max=$count-1;
					while($i<$max){
						$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$np[$i+1]['id']."' and $pid='$_POST[pid]'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
				}
				echo $ok;
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}
			break;
			case '3'://อยู่ด้านหลัง
			//หาตำแหน่งของ id เดิม
			$sql="select rec_order from $tb where $pk='$_POST[oid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			//หาตำแหน่งของ id ใหม่
			$sql="select rec_order from $tb where $pk='$_POST[nid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			if($ops>$nps){
				$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' and rec_order between ";
				$sql .="'$nps' and '$ops'";
				$sql .=" order by rec_order ";
				}else{
				$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' and rec_order between ";
				$sql .="'$ops' and '$nps'";
				$sql .=" order by rec_order ";
			}
			$query=$cdb->conn->prepare($sql);
			try{
				$query->execute();
				$count = $query->rowCount();
				$i=1;
				while($data=$query->fetch(PDO::FETCH_ASSOC)){
					$np[$i]['id']=$data[$pk];
					$np[$i]['rec_order']=$data['rec_order'];
					++$i;
				}
				$i=2;
				if($ops>$nps){
					$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$_POST['oid']."' and $pid='$_POST[pid]'";
					$query=$cdb->conn->prepare($sql);
					$query->execute($_POST);
					if($query){$ok=0;}else{$ok=1;}
					while($i<$count){
						$sql= "update $tb set rec_order='".$np[$i+1]['rec_order']."' where $pk='".$np[$i]['id']."' and $pid='$_POST[pid]'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
					}else{
					$sql= "update $tb set rec_order='".$np[$count]['rec_order']."' where $pk='".$_POST['oid']."' and $pid='$_POST[pid]'";
					$query=$cdb->conn->prepare($sql);
					$query->execute();
					if($query){$ok=0;}else{$ok=1;}
					$i=2;
					$max=$count+1;
					while($i<$max){
						$sql= "update $tb set rec_order='".$np[$i-1]['rec_order']."' where $pk='".$np[$i]['id']."' and $pid='$_POST[pid]'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
					echo $ok;
				}
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}
			break;
			case '4'://ตำแหน่งแรก
			//หาตำแหน่งของ id เดิม
			$sql="select rec_order from $tb where $pk='$_POST[oid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' order by rec_order limit 0,1";
			//echo $sql;
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' and rec_order between ";
			$sql .="'$nps' and '$ops'";
			$sql .=" order by rec_order ";
			//echo $sql.'<br>';
			$query=$cdb->conn->prepare($sql);
			try{
				$query->execute();
				$count = $query->rowCount();
				$i=1;
				while($data=$query->fetch(PDO::FETCH_ASSOC)){
					$np[$i]['id']=$data[$pk];
					$np[$i]['rec_order']=$data['rec_order'];
					++$i;
				}
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}
			$i=1;
			$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$_POST['oid']."' and $pid='$_POST[pid]'";
			//echo $sql.'</br>';
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			if($query){$ok=0;}else{$ok=1;}
			while($i<$count){
				$sql= "update $tb set rec_order='".$np[$i+1]['rec_order']."' where $pk='".$np[$i]['id']."' and $pid='$_POST[pid]'";
				//	echo $sql.'</br>';			
				$query=$cdb->conn->prepare($sql);
				$query->execute();
				if($query){$ok=$ok+0;}else{$ok=$ok+1;}
				++$i;
			}
			echo $ok;
			break;
			case '5'://ตำแหน่งสุดท้าย
			$sql="select rec_order from $tb where $pk='$_POST[oid]' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' order by rec_order desc limit 0,1";
			//echo $sql;
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			$sql="select $pk,rec_order from $tb where $pid='$_POST[pid]' and rec_order between ";
			$sql .="'$ops' and '$nps'";
			$sql .=" order by rec_order ";
			$query=$cdb->conn->prepare($sql);
			try{
				$query->execute();
				$count = $query->rowCount();
				$i=1;
				while($data=$query->fetch(PDO::FETCH_ASSOC)){
					$np[$i]['id']=$data[$pk];
					$np[$i]['rec_order']=$data['rec_order'];
					++$i;
				}
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}
			$sql= "update $tb set rec_order='".$np[$count]['rec_order']."' where $pk='".$_POST['oid']."' and $pid='$_POST[pid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			if($query){$ok=0;}else{$ok=1;}
			$i=1;
			while($i<$count){
				$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$np[$i+1]['id']."' and $pid='$_POST[pid]'";
				$query=$cdb->conn->prepare($sql);
				$query->execute();
				if($query){$ok=$ok+0;}else{$ok=$ok+1;}
				++$i;
			}
			echo $ok;
			break;
		}
		break;
		case '9':
		$sql="select username,FirstName,LastName ";
		$sql .=" from $tbname ";
		$sql .=" where id=:id ";
		//echo $sql;
		//print_r($_POST);
		unset($_POST['form_action'],$_POST['stamp']);
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($_POST);
			$data=$query->fetch(PDO::FETCH_ASSOC);
			foreach($data as $key=>$value){
				$_POST[$key]=$value;
			}
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		$id=$_POST['id'];
		$subject="รหัสผ่านเข้าใช้งานจองรถห้องสมุดเคลื่อนที่ สำนักงาน กศน.จังหวัดเพชรบุรี";
		$remail=$_POST['username'];
		$rename=$_POST['FirstName'].' '.$_POST['LastName'];
		$password=random_string(10);
		$_POST['password']=md5($password);
		//print_r($_POST);		
		unset($_POST['id'],$_POST['username'],$_POST['FirstName'],$_POST['LastName']);
		$body="<table><tbody>";
		$body.="<tr><td style='font-size:15px;'>ข้อมูลการเข้าใช้งานจองรถห้องสมุดเคลื่อนที่ ของ <strong>คุณ$rename</strong> ดังนี้</td></tr>";
		$body.="<tr><td style='font-size:15px; color:#FFFFFF'>-</td></tr>";
		$body.="<tr><th style='font-size:15px;' align='left'>Username : $remail</th></tr>";
		$body.="<tr><th style='font-size:15px;' align='left'>Password : $password</th></tr>";
		$body.="<tr><td style='font-size:15px; color:#FFFFFF'>-</td></tr>";
		$body.="<tr><td style='font-size:15px;'>คุณสามารถเข้าสู่ระบบได้ที่ https://https://www.djunghoo.com/mlbs/bn/login/</td></tr>";		
		$body.="<tr><td style='font-size:15px; color:#FFFFFF'>-</td></tr>";
		$body.="<tr><td style='font-size:15px;'>คุณสามารถเปลี่ยนแปลงรหัสผ่านได้ที่เมนูเปลี่ยนรหัสผ่านหลังการเข้าสู่ระบบ</td></tr>";
		$body.="<tr><td style='font-size:15px;'>และโปรดเก็บรักษารหัสผ่านของคุณให้ปลอดภัยที่สุด</td></tr>";
		$body.="<tr><td style='font-size:15px; color:#FFFFFF;'>-</td></tr>";
		$body.="<tr><td style='font-size:15px;'>Email ฉบับนี้ส่งโดยระบบอัตโนมัติ ไม่สามารถใช้ติดต่อสื่อสารได้ โปรดอย่าตอบกลับ Email Address นี้</td></tr>";
		$body.="<tr><td style='font-size:15px;'>หากท่านมีข้อสงสัย และหรือข้อแนะนำเกี่ยวกับระบบโปรดติดต่อ</td></tr>";
		$body.="<tr><td style='font-size:15px;'>นายธนัญชัย  จุ้ยมี นักเทคโนโลยีสารสนเทศ สังกัดสำนักงาน กศน.จังหวัดเพชรบุรี</td></tr>";
		$body.="<tr><td style='font-size:15px;'>Phone : 032426209 </td></tr>";
		$body.="<tr><td style='font-size:15px;'>E-Mail : pbi_nfedc@nfe.go.th</td></tr>";
		$body.="<tr><td style='font-size:15px;'>LineID : the_once</td></tr>";
		
		$body.="</tbody></table>";
		$re= $cdb->update_data($tbname,$_POST,"id='$id'");
		//echo $re;
		if($re==0){
			echo send_mail($remail,$rename,$subject,$body);
		}
		$cdb=null;
		break;
	}
?>