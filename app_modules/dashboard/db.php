<?php session_start();
	//include('../../includes/connect.php');
	include('../../includes/function_db.php');
	
	$cdb=new control_db();
	switch($_POST['form_action']){
		case '1':
		$sql="select booking.id,booking.startdate,booking.enddate ";
		$sql.=",booking.type_id";
		$sql .=",school.schoolname ";
		$sql.=" from booking ";
		$sql .=" inner join school on booking.schoolid=school.schoolid ";
		
		$query=$cdb->conn->prepare($sql);	
		try{
			$query->execute($_POST);
			while($data=$query->fetch(PDO::FETCH_ASSOC)){
				switch($data['type_id']){
					case '1':
					$cls="bgc-red-d1 text-white text-95";
					break;
					case '2':
					$cls="bgc-blue-d1 text-white text-95";
					break;
					case '3':
					$cls="bgc-green-d1 text-white text-95";
					break;
				}
				$json_data[]=array(
				"id"=>$data['id'],
				"title"=> $data['schoolname'],
				"start"=> $data['startdate'],
				"end"=> $data['enddate'],
				"allDay"=>true,
				"className"=> $cls
				);
			}
			$json=json_encode($json_data);
			echo $json;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		break;
		case '2':
		$sql="select booking.id,booking.title,booking.department,booking.place ";
		$sql .=",booking.startdate,booking.enddate,booking.teacher ";
		$sql .=",school.schoolname,booking_type.title as btitle ";
		$sql.=" from booking ";
		$sql .=" inner join school on booking.schoolid=school.schoolid ";
		$sql .=" inner join booking_type on booking.type_id=booking_type.id ";
		$sql.=" where booking.id=:id";
		unset($_POST['form_action']);
		$query=$cdb->conn->prepare($sql);		
		try{
			$query->execute($_POST);
			$data=$query->fetch(PDO::FETCH_ASSOC);
			foreach($data as $key=>$value){
				if($key=='startdate' || $key=='enddate'){
					$value=set_date($value,'th');
				}
				$json_data[$key]=$value;
			}
			$json=json_encode($json_data);
			echo $json;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		
		break;
	}
?>