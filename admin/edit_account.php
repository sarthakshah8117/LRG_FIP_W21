<?php
	session_start(); # initialize session
	ob_clean();
	require "../config/dbconnect.php";
	$response = "";
	
	# check if logged in
	if(isset($_SESSION['user'])){
		$userid = (isset($_GET['user'])) ? trim($_GET['user']):$_SESSION['user'];
		
		# fetch user details from db
		$db = new Db();
		$data = $db->fetch("SELECT *FROM `tbl_user` WHERE `user_id`='$userid'");
	}
	else{
		# redirect to login if not logged in
		header("location:admin_login.php");
	}
	
	# receive form data
	if(isset($_POST['username'])){
		$username = cleandata(strtolower($_POST['username']));
		$fname = cleandata(strtolower($_POST['fname']));
		$lname = cleandata(strtolower($_POST['lname']));
		$pos = cleandata(strtolower($_POST['position']));
		$email = cleandata(strtolower($_POST['email']));
		$pass1 = cleandata($_POST['password1']);
		$pass2 = cleandata($_POST['password2']);
		$userid = trim($_POST['userid']);
		
		# encrypt password
		$pass = encrypt($pass1,$email);
		
		# check if passwords match
		if($pass1!=$pass2){
			$response = "Passwords dont match!";
		}
		else{
			# update user details
			$db = new Db();
			$result = $db->query("UPDATE `tbl_user` SET `user_fname`='$fname',`user_lname`='$lname',`position`='$pos',`user_name`='$username',`user_pass`='$pass',`user_email`='$email' WHERE `user_id`='$userid'");
			if($result=="success"){
				# update status to confirm one has logged in
				$expiry = strtotime("2030-12-01"); # expiry time for all accounts
				$db->query("UPDATE `tbl_user` SET `status`='1',`expiry`='$expiry' WHERE `user_id`='$userid'");
				
				if(isset($_GET['user'])){
					echo "<script>
						alert('Account updated successfully!'); window.location.replace('index.php');
					</script>";
				}
				else{
					# logout and login again
					unset($_SESSION['user']);
					header("location:admin_login.php");
				}
			}
			else{
				$response = $result;
			}
		}
	}
	
	ob_end_flush();

?>

<html>
	<title>Edit Account</title>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div class="maind"><br>
			<h3>Edit account</h3><br>
			<p style="color:#ff4500"><?php echo $response; ?></p><br>
			<form method="post">
				<input type="hidden" name="userid" value="<?php echo $userid; ?>">
				<p>First Name</p> <p><input type="text" name="fname" value="<?php echo $data[0]['user_fname']; ?>" required></p><br>
				<p>Last Name</p> <p><input type="text" name="lname" value="<?php echo $data[0]['user_lname']; ?>" required></p><br>
				<p>Username</p> <p><input type="text" name="username" value="<?php echo $data[0]['user_name']; ?>" required></p><br>
				<p>Email</p> <p><input type="email" name="email" value="<?php echo $data[0]['user_email']; ?>" required></p><br>
				<p>Position</p> <p><input type="text" name="position" value="<?php echo $data[0]['position']; ?>" required></p><br>
				<p>Password</p> <p><input type="password" name="password1" required></p><br>
				<p>Verify Password</p> <p><input type="password" name="password2" value="" required></p><br>
				<p style="text-align:right"><button type="submit" class="btn">Save</button></p>
			</form>
		</div>
	</body>
</html>

