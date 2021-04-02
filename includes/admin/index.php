<?php
	session_start(); # initialize session
	ob_clean();
	require "../config/dbconnect.php";
	
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
	
	ob_end_flush();

?>

<html>
	<title>Admin Account</title>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div  class="nav">
			<h2>Welcome <?php echo $data[0]['user_fname']; ?> </h2>
			<p style="font-weight:bold;padding-top:10px"> <a href="create_user.php">Create User</a> &nbsp; | &nbsp;
			<a href="logout.php">Logout</a> <?php echo "<span style='float:right'> ".date("h:i a")."</span>"; ?></p>
		</div>
		<div class="main"><br>
			<ul style="list-style:none">
				<li><b>Last Login:</b> <?php echo date("F d, Y - H:i:s",$data[0]['last_login']); ?></li><br>
				<li><b>Total Successful login :</b> <?php echo (isset($_SESSION['STATUS'])) ? $_SESSION['STATUS']:1; ?></li><br>
			</ul>
			
			<table class="tbl" cellpadding="10" border='1'>
				<tr class="tr-head">
					<td>No</td><td>First Name</td><td>Last Name</td><td>Username</td><td>Email</td><td>Position</td><td>password</td><td>Account status</td><td>Action</td>
				</tr>
				<?php
					
					$db = new Db();
					$no = 0;
				
					# select all records if is the admin else only his only data
					if($data[0]['priviledge']=="admin"){
						$data = $db->fetch("SELECT *FROM `tbl_user` ORDER BY `user_fname` ASC");
						foreach($data as $row){
							$name=stripslashes(ucwords($row['user_fname'])); $user=stripslashes(ucwords($row['user_name'])); $email=$row['user_email']; 
							$passw=decryptpass($row['user_pass'],$row['user_email']);  $lname=stripslashes(ucwords($row['user_lname'])); 
							$pos=stripslashes(ucwords($row['position'])); 
							$state = ($row['status']==0) ? "Inactive":"Active"; $uid=$row['user_id']; $no++;
							$del = ($userid==$uid) ? "":"| <a href='deleteacc.php?id=$uid'>Delete</a>";
							
							echo "<tr><td>$uid</td><td>$name</td><td>$lname</td><td>$user</td><td>$email</td><td>$pos</td><td>$passw</td><td>$state</td>
							<td><a href='edit_account.php?user=$uid'>Edit</a> $del</td></tr>";
						}
					}
					else{
						$name=stripslashes(ucwords($data[0]['user_fname'])); $user=stripslashes(ucwords($data[0]['user_name'])); 
						$email=$data[0]['user_email']; $passw=decryptpass($data[0]['user_pass'],$data[0]['user_email']);
						$lname=stripslashes(ucwords($data[0]['user_lname']));  $pos=stripslashes(ucwords($data[0]['position'])); 
						$state = ($data[0]['status']==0) ? "Inactive":"Active"; $uid=$data[0]['user_id']; $no++;
							
						echo "<tr><td>$no</td><td>$name</td><td>$lname</td><td>$user</td><td>$email</td><td>$pos</td><td>$passw</td><td>$state</td>
						<td><a href='edit_account.php?user=$uid'>Edit account</a></td></tr>";
					}
				?>
			</table>
		</div>
	</body>
</html>

