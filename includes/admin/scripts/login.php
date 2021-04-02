<?php
// session
$count = 0;
$login_count = 0;

	function decryptpass($Ciphertext, $password){

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

if(!isset($_SESSION['STATUS'])){
    $_SESSION['STATUS'] = 0;
}
function login($username, $password, $ip)
{
    $pdo = Database::getInstance()->getConnection();
    ## TODO: Finish the following query to check if the username and password are matching in the DB
    $get_user_query = 'SELECT * FROM tbl_user WHERE user_name = :username';
    $user_set = $pdo->prepare($get_user_query);
    $user_set->execute(
        array(
            ':username'=>$username
        )
    );

    if ($found_user = $user_set->fetch(PDO::FETCH_ASSOC)) {
        //We found user in the DB, we want to compare password!
        $found_user_id = $found_user['user_id'];
        $found_email = $found_user['user_email'];
        $encrypted_password = $found_user['user_pass'];
		
		#compare passwords and proceed if correct
		if(decryptpass($encrypted_password,$found_email)==$password){
			
			//Write thhe username and userid into session
			$_SESSION['user_id'] = $found_user_id;
			$_SESSION['user_name'] = $found_user['user_fname'];

			
			//Update the user IP by the current logged in one
			$update_user_query = 'UPDATE tbl_user SET user_ip= :user_ip WHERE user_id=:user_id';
			$update_user_set = $pdo->prepare($update_user_query);
			$update_user_set->execute(
				array(
					':user_ip'=>$ip,
					':user_id'=>$found_user_id
				)
			);

			// successful login count 
			$_SESSION['success_login'] = $_SESSION['login_success']+1;
			$login_success = 'UPDATE tbl_user SET login_success=:login_success WHERE user_name=:username AND user_pass=:password';
			$count_login = $pdo->prepare($login_success);
			$count_login->execute(
				array(
					':username'=>$username,
					':password'=>$password,
					':login_success'=>$_SESSION['success_login']
				)
			) ;
			//Redirect user back to index.php
			redirect_to('index.php');
		}
		else{
			$_SESSION['STATUS']+=1;
			//This is invalid attempt, reject it!
			return 'please enter correct password!!!';
		}
    } else {
        $_SESSION['STATUS']+=1;
        //This is invalid attempt, reject it!
        return 'please enter correct username!!!';
    }
    if(isset($id)){
        redirect_to('admin_login.php');
    }

    else {
        //user doesn't exit
        $message = 'user doesnt exist';
    }

    return $message;
}

function confirm_logged_in()
{
    if (!isset($_SESSION['user_id'])) {
        redirect_to("admin_login.php");
    }
}


function logout()
{
    session_destroy();

    redirect_to('admin_login.php');
}
