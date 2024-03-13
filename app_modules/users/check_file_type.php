<?php //print_r($_POST);
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
?>