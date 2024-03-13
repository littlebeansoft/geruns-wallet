<?php include('../../includes/connect.php');
	//print_r($_POST);
	$ar=array('ZIPCODE_ID','DISTRICT_CODE','PROVINCE_ID','AMPHUR_ID','DISTRICT_ID');
	$sql="select * ";
	$sql .=" ,prefix.prefix_name ";
	$sql .=" ,zipcode2.ZIPCODE as zipcode";
	$sql .=" ,zipcodes.ZIPCODE as zipcode2";
	$sql .=" from teacher ";
	$sql .=" left JOIN prefix ON teacher.prefix_id = prefix.prefix_id ";
	$sql .=" left JOIN zipcode2 ON teacher.dis_code = zipcode2.DISTRICT_CODE ";
	$sql .=" left JOIN zipcodes ON teacher.dis_code2 = zipcodes.DISTRICT_CODE ";
	$sql .=" where teacher.teacher_id=:teacher_id ";	
	$query=$conn->prepare($sql);
	try{
		$query->execute($_POST);
		$data=$query->fetch(PDO::FETCH_ASSOC);
			foreach($data as $key=>$value){
			if(!in_array($key,$ar)){
			//if($key=='zipcodes'){$key='zipcode2';}
				$json_data[$key]=$value;
			}
		}
		}catch(PDOException $er){
		echo 'Error :'.$er->getMessage();
	}
	$json=json_encode($json_data);
	echo $json;
?>