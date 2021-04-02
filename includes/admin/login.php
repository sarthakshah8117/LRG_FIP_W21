<?php
	
	require "../config/dbconnect.php";
	
	function login($username, $password, $ip){
		# check if details exist in db
		# account statuses: 0=new user; 1=active user;
		
		$db = new Db();
		$data = $db->fetch("SELECT *FROM `tbl_user` WHERE `user_name`='$username'");
		if(count($data)){
			# decrypt encrypted password
			$db_pass = decryptpass($data[0]['user_pass'],$data[0]['user_email']);
			
			if($db_pass==$password){
				# login success
				if(time()>$data[0]['expiry']){
					# user is suspended due to time expiry
					$result = array("response"=>"Failed! Your account was suspended after delayed login");
				}
				else{
					# account is active
					$result = array("response"=>1,"status"=>$data[0]['status'],"userid"=>$data[0]['user_id']);
					# update IP and Last login
					$day = date("Y-m-d H:i:s"); 
					$last=($data[0]['last_login']) ? strtotime($data[0]['user_date']):time();
					$db->query("UPDATE `tbl_user` SET `user_ip`='$ip',`last_login`='$last',`user_date`='$day' WHERE `user_id`='".$data[0]['user_id']."'");
				}
			}
			else{
				# incorrect password
				$result = array("response"=>"Failed! Incorrect Password");
			}
		}
		else{
			# incorrect username
			$result = array("response"=>"Failed! Incorrect username");
		}
		
		return $result;
	}

?>