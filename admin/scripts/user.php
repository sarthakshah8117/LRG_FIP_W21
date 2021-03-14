<?php
	
	function decrypt($Ciphertext, $password){

		# convert the string from base64 encoded
		$ivHashCiphertext = base64_decode($Ciphertext);

		# method used to decrypt the Ciphertext
		$method = "AES-256-CBC";
		$iv = substr($ivHashCiphertext, 0, 16);
		$hash = substr($ivHashCiphertext, 16, 32);
		$ciphertext = substr($ivHashCiphertext, 48);
		$key = hash('sha256', $password, true);
		
		# if encryption isnt successfull maybe due to wrong key or wrong text
		if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null; 
		
		# if encryption is successfull return the raw string
		return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
	}
	
	function sendemail($email, $subject, $message){

		# php mailer script
		require 'PHPMailerAutoload.php'; 

		# email from title
		$from = "Sign in details";

		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = "mail.jaskaransingh.co.in";
		$mail->Port = 25;
		$mail->SMTPAuth = false;
		$mail->SMTPSecure = 'none';
		$mail->Username = "info@jaskaransingh.co.in";
		$mail->Password = "@login.2021";
		$mail->setFrom("info@jaskaransingh.co.in", $from);
		$mail->addReplyTo("info@jaskaransingh.co.in", "Online PHPMailer Library");
		
		$mail->AddAddress($email);
		$mail->Subject = $subject;
		$mail->msgHTML($message);
		$mail->AltBody = strip_tags($message);
		$mail->send();
		$mail->ClearAllRecipients(); 
		$mail->ClearAttachments(); 
		
		return 1;
	}

function createUser($user_data)
{
    ## 1. Run the proper SQL query to insert user
    $pdo = Database::getInstance()->getConnection();

    $create_user_query = 'INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email, last_login, login_success)';
    $create_user_query .= ' VALUES(:fname, :username, :password, :email, :login, :succ)';
    
    $create_user_set = $pdo->prepare($create_user_query);
   
	$create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$user_data['fname'],
            ':username'=>$user_data['username'],
            ':password'=>$user_data['password'],
            ':email'=>$user_data['email'],
			':login'=>date('d-m-Y, h:i a'),
			':succ'=>1
        )
    );


    ## 2. Redirect to index.php if create user successfully (*maybe with some message???),
    # otherwise, showing the error message

    if ($create_user_result) {
		# if successfull send email
		$subject = "Account Password";

		# decrypt password
		$pass    = decrypt($user_data['password'],strtolower($user_data['email'])); 

		# get host and URL
		$url 	 = "https://".$_SERVER['HTTP_HOST']."/user/login.php"; 
		$message = "<p>Hi ".$user_data['fname'].", your account has been created successfully.</p>
		<p>Login at $url using username <b>".$user_data['username']."</b> and password <b>$pass</b>";

		 # send email with online phpmailer library
		sendemail(strtolower($user_data['email']),$subject, $message);
        redirect_to('index.php');
    } else {
        return 'The user did not go through!! ';
    }
}
