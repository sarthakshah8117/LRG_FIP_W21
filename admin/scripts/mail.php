<?php

	function sendemail($email, $subject, $message){

		# php mailer script
		require 'PHPMailerAutoload.php'; 

		# email from title
		$from = "Movie Mania";

		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPKeepAlive = true;
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = "mail.jaskaransingh.co.in";
		$mail->Port = 26;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = "info@jaskaransingh.co.in";
		$mail->Password = "!login.2021";
		$mail->setFrom("info@jaskaransingh.co.in", $from);
		$mail->addReplyTo("info@jaskaransingh.co.in", "Jaskaran Singh");
		
		$mail->AddAddress($email);
		$mail->Subject = $subject;
		$mail->msgHTML($message);
		$mail->AltBody = strip_tags($message);
		$res=$mail->send();
		$mail->ClearAllRecipients(); 
		$mail->ClearAttachments(); 
		
		return 1;
	}

?>