<?php include('../../includes/connect.php');
	//print_r($_POST);
	$pid=$_POST['pid'];
	
	for($i=0, $sum=0; $i<12;$i++){
		$sum += (int)($pid{$i})*(13-$i);
	}
	if((11-($sum%11))%10 == (int)($pid{12})){
		
		$sql="select person_id from person where person_code=:pid";
		$query=$conn->prepare($sql);
		try{
			$query->execute($_POST);
			$count=$query->rowCount();
			echo $count;
			}catch(PDOException $er){
			echo 'Error :'.$er->getMessage();
		}
		}else{
		echo 'no';
	}
?>