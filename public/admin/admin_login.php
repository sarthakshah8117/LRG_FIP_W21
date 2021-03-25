<?php
	session_start(); # initialize session
	ob_clean();
	require "login.php";
	$response = "";
	$trials = (isset($_SESSION['STATUS'])) ? $_SESSION['STATUS']:0;
	
	# receive form data
	if(isset($_POST['username'])){
		$username = cleandata(strtolower($_POST['username']));
		$password = cleandata($_POST['password']);
		$ip = $_SERVER['REMOTE_ADDR'];
		
		# confirm login
		$result = login($username, $password, $ip);
		if($result['response']==1){
			# login successfull then redirect
			
			$_SESSION['user'] = $result['userid'];
			$status = $result['status'];
			
			if($status==0){
				header("location:edit_account.php");
			}
			elseif($status==1){
				header("location:index.php");
			}
		}
		else{
			$_SESSION['STATUS']=$trials+1;
			$response = $result['response'];
		}
	}
	
	ob_end_flush();

?>

<html>
	<title>Admin Login</title>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div class="maind"><br>
			<h3>Admin Login</h3><br>
			<p style="color:#ff4500"><?php echo $response; ?></p><br>
			<form method="post">
				<p>Username</p> <p><input type="text" name="username" required></p><br>
				<p>Password</p> <p><input type="password" name="password" required></p><br>
				<?php
					if($trials>2){
						echo "<p style='color:#ff4500'>Login Locked after 3 failed attempts!
						&nbsp; <a href='logout.php'>Reset</a></p>";
					}
					else{
						echo "<p style='text-align:right'><button type='submit' class='btn'>Login</button></p>";
					}
				?>
				
			</form>
		</div>
	</body>
</html>

