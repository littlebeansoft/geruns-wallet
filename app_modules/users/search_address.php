<?php include('../../includes/connect.php');
	$sql="select districts.dis_code,districts.dis_name ";
	$sql.=" from zipcodes ";
	$sql.=" inner join districts on zipcodes.DISTRICT_CODE=districts.dis_code";
	$sql.=" where zipcodes.zipcode=:zipcode";
	$sql.=" order by districts.dis_code";
	$query=$conn->prepare($sql);
	try{
		$query->execute($_POST);
		while($a=$query->fetch(PDO::FETCH_ASSOC))
		$j[]=array(
		"dis_code"=>$a['dis_code'],
		"dis_name"=>$a['dis_name'],
		);
		}catch(PDOException $er){
		echo 'Error :'.$er->getMessage();
	}
	
	$sql="select provinces.pro_id,provinces.pro_name,amphures.amp_id,amphures.amp_name ";
	$sql.=" from zipcodes ";
	$sql.=" inner join provinces on zipcodes.PROVINCE_ID=provinces.pro_id";
	$sql.=" inner join amphures on zipcodes.AMPHUR_ID=amphures.amp_id";
	$sql.=" where zipcodes.zipcode=:zipcode";
	$sql.=" limit 0,1";
	$query=$conn->prepare($sql);
	try{
		$query->execute($_POST);
		$a=$query->fetch(PDO::FETCH_ASSOC);
		foreach($a as $key=>$value){
			$json_data[]=array(  
			"pro_name"=>$a['pro_name'],  
			"amp_name"=>$a['amp_name'],  
			"district"=>$j,
			);   
		}
		}catch(PDOException $er){
		echo 'Error :'.$er->getMessage();
	}
	$json_data['district']=$j;
	$json=json_encode($json_data);
	echo $json;
?>