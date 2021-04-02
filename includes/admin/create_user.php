<?php
	session_start(); # initialize session
	ob_clean();
	require "../config/dbconnect.php";
	require "scripts/mail.php";
	$response = "";
	
	# check if logged in
	if(isset($_SESSION['user'])){
		$userid = $_SESSION['user'];
		
		# fetch user details from db
		$db = new Db();
		$data = $db->fetch("SELECT *FROM `tbl_user` WHERE `user_id`='$userid'");
		
		# check if the user has admin priviledge
		if($data[0]['priviledge']=="user"){
			echo "<script>
				alert('You dont have permission to create users'); window.location.replace('index.php');
			</script>";
		}
	}
	else{
		# redirect to login if not logged in
		header("location:admin_login.php");
	}
	
	# receive form data
	if(isset($_POST['username'])){
		$username = cleandata(strtolower($_POST['username']));
		$email = cleandata(strtolower($_POST['email']));
		$expiry = strtotime(str_replace("T",",",$_POST['expiry']));
		$type = cleandata($_POST['usertype']);
		$fname = cleandata(strtolower($_POST['fname']));
		$lname = cleandata(strtolower($_POST['lname']));
		$pos = cleandata(strtolower($_POST['position']));
		$day = date("Y-m-d H:i:s"); 
		
		# generate & encrypt password using user email as the encryption key
		$pass = generatePass(); # generate password
		$password = encrypt($pass,$email); 
	
		# create user account & email password
		$db = new Db();
		$result = $db->query("INSERT INTO `tbl_user` VALUES(NULL,'$fname','$lname','$pos','$username','$type','$password','$email','$day','0','$expiry','','0')");
		if($result=="success"){
			# get host and URL
			$url 	 = "https://".$_SERVER['HTTP_HOST']."/user/admin_login.php"; 
			$message = "<p>Hi ".ucwords(strip_tags(stripslashes($fname))).", your account has been created successfully.</p>
			<p>Login at $url using username <b>$username</b> and password <b>$pass</b> before ".date("F d, Y H:i a",$expiry);
			
			# send email with phpmailer library
			sendemail($email,"Account Password", $message);
			echo "<script>
				alert('Account created successfully!'); window.location.replace('index.php');
			</script>";
		}
		else{
			$response = $result;
		}
	}
	
	ob_end_flush();

?>

<html>
	<title>Create Account</title>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div class="maind"><br>
			<h3>Create user account</h3><br>
			<p style="color:#ff4500"><?php echo $response; ?></p><br>
			<form method="post">
				<input type="hidden" name="userid" value="<?php echo $userid; ?>">
				<p>Account Type</p><p><select name="usertype"><option value="user">User</option><option value="admin">Admin</option></select></p><br>
				<p>First Name</p> <p><input type="text" name="fname" required></p><br>
				<p>Last Name</p> <p><input type="text" name="lname" required></p><br>
				<p>Username</p> <p><input type="text" name="username" required></p><br>
				<p>Email</p> <p><input type="email" name="email" required></p><br>
				<p>Position</p> <p><input type="text" name="position" required></p><br>
				<p>Account Expiry time</p><p><input type="datetime-local" name="expiry" min="<?php echo date('Y-m-d')."T".date('H:i'); ?>"></p><br>
				<p style="text-align:right"><button type="submit" class="btn">Create</button></p>
			</form>
		</div>
	</body>
</html>

