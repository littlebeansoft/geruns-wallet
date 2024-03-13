<?php
	echo 'ok';
	require("phpmailer/class.phpmailer.php");	
	//echo '0';
	function random_string($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function send_mail($reciver_address,$reciver_name,$subject,$body){
		$mail = new PHPMailer();
		$mail->CharSet = "utf-8"; 		
		$mail->IsSMTP();
		$mail->Mailer = "smtp";
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username = "mail_system@pet.nfe.go.th";  // Gmail username หรือหากท่านใช้ G-suite / WorkSpace ให้ใช้อีเมล์ @you@yourdomain แทน
		$mail->Password = "1qaz2wsx3edc4rfv"; 		
		$mail->SetFrom("mail_system@djunghoo.com", "no-reply");
		//$mail->AddReplyTo($replyto, $replyto_name);//ชื่อ Mail ให้ลูกค้าตอบกลับ
	$mail->Subject = $subject;//ชื่อหัวเรื่อง
	
	$mail->MsgHTML($body);
	
	$mail->AddAddress($reciver_address, $reciver_name); // ผู้รับคนที่หนึ่ง
	//$mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง
	
	if(!$mail->Send()) {
	$re=1;
	//    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	$re=0;
	//    echo "Message sent!";
	}
	return $re;
	}
	$remail='djunghoo@gmail.com';
	$rename="Thananchai Juime";
	$subject="ยืนยันการลงทะเบียนใช้งานระบบสารสนเทศผู้พิการ";
	$password=random_string(10);
	$body="<table><tbody>";
	$body.="<tr><td style='font-size:15px;'>ตามที่คุณ ได้ทำการสมัครใช้งานระบบสารสนเทศผู้พิการ พัฒนาโดยสำนักงาน กศน.จังหวัดเพชรบุรีนั้น</td></tr>";
	$body.="<tr><td style='font-size:15px;'>ระบบได้ทำการส่งรายละเอียดบัญชีผู้ใช้งานสำหรับเข้าสู่ระบบของคุณดังนี้</td></tr>";
	$body.="<tr><td style='font-size:15px;'>--------------------------------------------------------------------------------</td></tr>";
	$body.="<tr><th style='font-size:15px;' align='left'>Username : </th></tr>";
	$body.="<tr><th style='font-size:15px;' align='left'>Password : $password</th></tr>";
	$body.="<tr><td style='font-size:15px;'>--------------------------------------------------------------------------------</td></tr>";
	$body.="<tr><td style='font-size:15px;'>คุณสามารถเปลี่ยนแปลงรหัสผ่านได้ที่เมนูเปลี่ยนรหัสผ่านหลังการเข้าสู่ระบบ</td></tr>";
	$body.="<tr><td style='font-size:15px;'>และโปรดเก็บรักษารหัสผ่านของคุณให้ปลอดภัยที่สุด</td></tr>";
	$body.="</tbody></table>";
	echo send_mail($remail,$rename,$subject,$body);
?>