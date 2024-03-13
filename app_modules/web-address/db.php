<?php session_start();
	//include('../../includes/connect.php');
	include('../../includes/function_db.php');
	//echo '0';
	$_POST['stamp']=time();
	$_POST['username']=$_SESSION['username'];
	$tbname="web_config";
	$cdb=new control_db();
	switch ($_POST['form_action']){
		//เพิ่มข้อมูล
		case '1':
		echo $cdb->insert_data($tbname,$_POST);
		break;
		//แก้ไขข้อมูล
		case '2':
		$id=1;
		unset($_POST['form_action'],$_POST['id']);
		echo $cdb->update_data($tbname,$_POST,"id='$id'");
		break;
		// ลบข้อมูล
		case '3':
		echo $cdb->delete_data($tbname,"id='$_POST[id]'");
		break;
		// เช็ค url ซ้ำ
		case '4':
		unset($_POST['form_action'],$_POST['stamp'],$_POST['username']);
		$sql="select menu_url from menu where menu_url=:menu_url";
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
		unset($_POST['form_action'],$_POST['stamp'],$_POST['username']);
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
		$no_field=array('page','qpage','form_action','stamp');
		$sql="select id,title from units";
		$query=$cdb->conn->prepare($sql);
		$query->execute();
		while($data=$query->fetch(PDO::FETCH_ASSOC)){
			$units[$data['id']]=$data['title'];
		}
		$sql="select id,title from category";
		$query=$cdb->conn->prepare($sql);
		$query->execute();
		while($data=$query->fetch(PDO::FETCH_ASSOC)){
			$category[$data['id']]=$data['title'];
		}		
		$sql="select * ";
		$sql .=" from $tbname where 1=1 ";
		foreach($_POST as $key=>$value){
			if(!in_array($key,$no_field)){
				if($value<>''){
					$field=str_replace('s_','',$key);
					if(strpos($key,'title')<>''){
						$param[$field]="%$value%";
						$sql.=" and $field like :$field ";
						}else{
						$param[$field]=$value;
						$sql.=" and $field=:$field ";
					}
				}
			}
		}
		$sql .=" order by category_id,rec_order ";
		//echo $sql;
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
		$sql .=" limit $start,$_POST[qpage] ";
		//echo $sql;
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute($param);
			$count = $query->rowCount();
			$i=1;
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
				foreach($data as $key=>$value){
					if($key=='units_id'){
						$json_data[$i][$key]=$units[$value];
						}else{
						if($key=='price'){
						$json_data[$i][$key]=number_format($value);
						}else{
						$json_data[$i][$key]=$value;
						}
					}
					if($key=='category_id'){
						$json_data[$i][$key]=$category[$value];
					}
				}
				++$i;
			}
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		$json=json_encode($json_data);
		echo $json;
		break;
		//ดึงข้อมูลเพื่อทำการสลับข้อมูล
		case '7':
		$pid='category_id';
		$sql="select id,title from $tbname where $pid='$_POST[id]' order by rec_order";
		$query=$cdb->conn->prepare($sql);
		//print_r($_POST);
		try{
			$query->execute();
			$count = $query->rowCount();
			$i=1;
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
			//print_r($data);
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
		$tb=$tbname;
		$pk='id';
		//print_r($_POST);
		$_POST['oid']=$_POST['oposition'];
		$_POST['nid']=$_POST['nposition'];
		$_POST['ort']=$_POST['order_type'];
		//rec_order($_POST);
		switch($_POST['ort']){
			case '1'://สลับตำแหน่ง
			$sql="select rec_order from $tb where $pk='$_POST[oid]'";
			//echo $sql;
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$a=$query->fetch(PDO::FETCH_ASSOC);
			$sql="select rec_order from $tb where $pk='$_POST[nid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$a2=$query->fetch(PDO::FETCH_ASSOC);
			$sql="update $tb set rec_order='$a2[rec_order]' where $pk='$_POST[oid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$sql="update $tb set rec_order='$a[rec_order]' where $pk='$_POST[nid]'";
			$query2=$cdb->conn->prepare($sql);
			$query2->execute();
			if($query and $query2){echo '0';}else{echo '1';}
			break;
			case '2'://อยู่ก่อนหน้า
			//หาตำแหน่งของ id เดิม
			$sql="select rec_order from $tb where $pk='$_POST[oid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			//หาตำแหน่งของ id ใหม่
			$sql="select rec_order from $tb where $pk='$_POST[nid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			//echo 'ops='.$ops.' nps='.$nps.'<br>';
			if($ops>$nps){
				$sql="select $pk,rec_order from $tb where rec_order between ";
				$sql .="'$nps' and '$ops'";
				$sql .=" order by rec_order ";
				}else{
				$sql="select $pk,rec_order from $tb where rec_order between ";
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
					$sql= "update $tb set rec_order='".$np[1]['rec_order']."' where $pk='".$_POST['oid']."'";
					$query=$cdb->conn->prepare($sql);
					$query->execute();
					while($i<$count){
						$sql= "update $tb set rec_order='".$np[$i+1]['rec_order']."' where $pk='".$np[$i]['id']."'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
					}else{
					$sql= "update $tb set rec_order='".$np[$count-1]['rec_order']."' where $pk='".$_POST['oid']."'";
					$query=$cdb->conn->prepare($sql);
					$query->execute();
					if($query){$ok=0;}else{$ok=1;}
					$i=1;
					$max=$count-1;
					while($i<$max){
						$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$np[$i+1]['id']."'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
				}
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}
			echo $ok;
			break;
			case '3'://อยู่ด้านหลัง
			//หาตำแหน่งของ id เดิม
			$sql="select rec_order from $tb where $pk='$_POST[oid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			//หาตำแหน่งของ id ใหม่
			$sql="select rec_order from $tb where $pk='$_POST[nid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			if($ops>$nps){
				$sql="select $pk,rec_order from $tb where rec_order between ";
				$sql .="'$nps' and '$ops'";
				$sql .=" order by rec_order ";
				}else{
				$sql="select $pk,rec_order from $tb where rec_order between ";
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
					$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$_POST['oid']."'";
					$query=$cdb->conn->prepare($sql);
					$query->execute($_POST);
					if($query){$ok=0;}else{$ok=1;}
					while($i<$count){
						$sql= "update $tb set rec_order='".$np[$i+1]['rec_order']."' where $pk='".$np[$i]['id']."'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
					}else{
					$sql= "update $tb set rec_order='".$np[$count]['rec_order']."' where $pk='".$_POST['oid']."'";
					$query=$cdb->conn->prepare($sql);
					$query->execute();
					if($query){$ok=0;}else{$ok=1;}
					$i=2;
					$max=$count+1;
					while($i<$max){
						$sql= "update $tb set rec_order='".$np[$i-1]['rec_order']."' where $pk='".$np[$i]['id']."'";
						$query=$cdb->conn->prepare($sql);
						$query->execute();
						if($query){$ok=$ok+0;}else{$ok=$ok+1;}
						++$i;
					}
				}
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}
			echo $ok;
			break;
			case '4'://ตำแหน่งแรก
			//หาตำแหน่งของ id เดิม
			$sql="select rec_order from $tb where $pk='$_POST[oid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			$sql="select $pk,rec_order from $tb order by rec_order limit 0,1";
			//echo $sql;
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			$sql="select $pk,rec_order from $tb where rec_order between ";
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
			$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$_POST['oid']."'";
			//echo $sql.'</br>';
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			if($query){$ok=0;}else{$ok=1;}
			while($i<$count){
				$sql= "update $tb set rec_order='".$np[$i+1]['rec_order']."' where $pk='".$np[$i]['id']."'";
				//	echo $sql.'</br>';			
				$query=$cdb->conn->prepare($sql);
				$query->execute();
				if($query){$ok=$ok+0;}else{$ok=$ok+1;}
				++$i;
			}
			echo $ok;
			break;
			case '5'://ตำแหน่งสุดท้าย
			$sql="select rec_order from $tb where $pk='$_POST[oid]'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$ops=$data['rec_order'];
			$sql="select $pk,rec_order from $tb order by rec_order desc limit 0,1";
			//echo $sql;
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_ASSOC);
			$nps=$data['rec_order'];
			$sql="select $pk,rec_order from $tb where rec_order between ";
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
			$sql= "update $tb set rec_order='".$np[$count]['rec_order']."' where $pk='".$_POST['oid']."'";
			$query=$cdb->conn->prepare($sql);
			$query->execute();
			if($query){$ok=0;}else{$ok=1;}
			$i=1;
			while($i<$count){
				$sql= "update $tb set rec_order='".$np[$i]['rec_order']."' where $pk='".$np[$i+1]['id']."'";
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
		$fn=explode('.',$_POST['fname']);
		$co=count($fn);
		$file_type=strtolower($fn[--$co]);
		switch($_POST['file_type']){
			case 'pdf': $ft=array('pdf');$error='เฉพาะไฟล์ pdf เท่านั้นครับ';break;
			case 'image':$ft=array('pdf','jpg','jpeg','bmp','gif','png');$error='เฉพาะไฟล์รูปภาพ และ pdf เท่านั้นครับ';break;
			case 'photo':$ft=array('jpg','jpeg','bmp','gif','png');$error='เฉพาะไฟล์รูปภาพเท่านั้นครับ';break;
			case 'word':$ft=array('doc','docx');$error='เฉพาะไฟล์ microsoft word เท่านั้นครับ';break;
			case 'exel':$ft=array('xls','xlsx');$error='เฉพาะไฟล์ microsoft excel เท่านั้นครับ';break;
			case 'doc':$ft=array('pdf','doc','docx');$error='เฉพาะไฟล์ pdf และ microsoft word เท่านั้นครับ';break;
			case 'jpg':$ft=array('jpg','jpeg');$error='เฉพาะไฟล์รูปภาพ jpg เท่านั้นครับ';break;
			case 'img_tr':$ft=array('png','gif');$error="เฉพาะไฟล์รูปภาพ png หรือ gif เท่านั้นครับ";break;
		}
		if(in_array($file_type,$ft)){
			echo 'ok';
			}else{
			echo $error;
		}
		break;
	}
?>