<?php session_start();
	//include('../../includes/connect.php');
	include('../../includes/function_db.php');
	//echo '0';
	$_POST['stamp']=time();
	$_POST['username']=$_SESSION['username'];	
	$tbname="menu2";
	$cdb=new control_db();
	switch ($_POST['form_action']){
		//เพิ่มข้อมูล
		case '1':
		//print_r($_POST);
		$sql="select rec_order from $tbname where menu_id='$_POST[menu_id]' order by rec_order desc limit 0,1 ";
		$query=$cdb->conn->prepare($sql);
		try{
			$query->execute();
			$count = $query->rowCount();
			if($count<1){
				$_POST['rec_order']=1;
				}else{
				$data=$query->fetch(PDO::FETCH_ASSOC);
				$_POST['rec_order']=$data['rec_order']+1;
			}
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		unset($_POST['form_action'],$_POST['id']);
		echo $cdb->insert_data($tbname,$_POST);
		break;
		//แก้ไขข้อมูล
		case '2':
		$id=$_POST['id'];
		unset($_POST['form_action'],$_POST['id']);
		//ตรวจสอบว่าข้อมูลที่แก้ไขอยู่หมวดเดิมหรือไม่ ถ้าไม่ให้ค้นหาลำดับของข้อมูลหมวดที่ทำการแก้ไข
		$sql="select menu_id from menu2 where menu2_id='$id'";
		$query=$cdb->conn->prepare($sql);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		if($data['menu_id']!==$_POST['menu_id']){
			$sql="select rec_order from $tbname where menu_id='$_POST[menu_id]' order by rec_order desc limit 0,1 ";
			$query=$cdb->conn->prepare($sql);
			try{
				$query->execute();
				$count = $query->rowCount();
				if($count<1){
					$_POST['rec_order']=1;
					}else{
					$data=$query->fetch(PDO::FETCH_ASSOC);
					$_POST['rec_order']=$data['rec_order']+1;
				}
				}catch(PDOException $er){
				echo 'Error :'.$er->getMessage();
			}			
		}
		echo $cdb->update_data($tbname,$_POST,"menu2_id='$id'");
		break;
		// ลบข้อมูล
		case '3':
		echo $cdb->delete_data($tbname,"menu2_id='$_POST[id]'");
		break;
		// เช็ค url ซ้ำ
		case '4':
		unset($_POST['form_action'],$_POST['stamp'],$_POST['username']);
		$sql="select menu2_url from menu2 where menu2_url=:menu2_url and menu_id=:menu_id ";
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
		$sql="select menu2_id as id,menu2_title,menu2_url,menu_id,menu2_icon,menu2_file ";
		$sql .=" from $tbname ";
		$sql .=" where menu2_id=:id ";
		//echo $sql;
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
		//ดึงข้อมูลเพื่อแสดงผล
		case '6':
		$sql="select menu_id,menu_title from menu where menu_type='2' order by menu_id ";
		$query=$cdb->conn->prepare($sql);
		$query->execute($param);
		$count = $query->rowCount();
		if($count>0){
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
				$menu[$data['menu_id']]=$data['menu_title'];
			}
		}
		$no_field=array('page','qpage','form_action','stamp','username');
		$sql="select menu2_id as id,menu2_title as title,menu2_url,menu2_icon,menu2_file,rec_order,status,menu_id";
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
		$sql .=" order by menu_id,rec_order ";
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
					if($key=='menu_id'){
						$json_data[$i]['menu']=$menu[$value];
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
		case '99':
			print_r($_POST);
		break;
	}
?>