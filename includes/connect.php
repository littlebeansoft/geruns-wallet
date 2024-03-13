<?php
	$db_type="mysql";
	$hostname='localhost';
	$dbname='xnbcdaco_ict';
	$user='xnbcdaco_ict';
	$password='8yy9ErKZ83';
	$option=array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	);
	try {
		$conn = new PDO("$db_type:host=$hostname;dbname=$dbname", $user, $password,$option);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
    {
		echo "Connection failed: " . $e->getMessage();
	}
		$sql="select * ";
		$sql .=" from web_config ";
		$query=$conn->prepare($sql);
		try{
		$query->execute();
		$i=1;
		while($data=$query->fetch(PDO::FETCH_ASSOC)){
		foreach($data as $key=>$value){
		$web[$key]=$value;
		}
		}
		}catch(PDOException $er){
		echo 'Error :'.$er->getMessage();
		}
?>