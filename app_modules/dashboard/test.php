<?php //$month=str_pad($_POST['month'],2,"0",STR_PAD_LEFT);
	$month='03';
	$ar[0]=array(
	"title"=> 'บ้านแหลม',
	"start"=> '2022-04-03',
	//"end"=> '2022-04-03T12:00:00',
	"allDay"=>true,
	"className"=> 'bgc-red-d1 text-white text-95'
	);	
	$ar[1]=array(
	"title"=> 'บ้านลาด',
	"start"=> '2022-04-13',
	"end"=> '2022-04-16',
	"allDay"=>true,
	"className"=> 'bgc-red-d1 text-white text-95'
	);	
	$ar[2]=array(
	"title"=> 'บ้านแหลม',
	"start"=> '2022-04-03',
	"allDay"=>true,
	"className"=> 'bgc-red-d1 text-white text-95'
	);	
	
	echo json_encode($ar);
?>