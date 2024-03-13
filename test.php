<?php include('includes/connect.php');
	//print_r($_REQUEST);
	$sql="select id,subject_data_id as sid from course_outcome where level_id='' ";
	$query=$conn->prepare($sql);	
	try{
		$query->execute();
		//echo $query->rowCount();
		$i=1;
		while($data=$query->fetch(PDO::FETCH_ASSOC)){
		$lv=substr($data['sid'],6,1);
		$sq="update course_outcome set level_id='$lv' where id='$data[id]';</br>";
		echo $sq;
			++$i;
		}
		}catch(PDOException $er){
		echo 'Error :'.$er->getMessage();
	}
	
?>