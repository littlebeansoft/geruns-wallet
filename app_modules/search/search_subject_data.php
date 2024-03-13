<?php include('../../includes/connect.php');
	//print_r($_POST);
	$sql="select subject_id,course from subject_data where subject_id=:subject_id and level_id=:level_id";
	$query=$conn->prepare($sql);
	try{
		$query->execute($_POST);
		$count = $query->rowCount();
		$i=1;
		while($data=$query->fetch(PDO::FETCH_ASSOC)){
		$json_data[$data['subject_id']]=$data['course'];
		}
		}catch(PDOException $er){
		echo 'Error :'.$er->getMessage();
	}
	
	$json=json_encode($json_data);
	echo $json;
	//print_r($json_data);
	?>