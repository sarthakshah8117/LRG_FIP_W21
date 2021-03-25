<?php
require_once '../load.php';
confirm_logged_in();

	function generatePass(){
        # generate numeric and character password from ASCII characters
        
         # initialize empty password
		$pass = ""; 
		for($i=1; $i<4; $i++){
            # A-Z (65-90)
            $part1 = rand(65,90); 
            # A-Z (97-122)
            $part2 = rand(97,122); 
            
             # a random number between 1-100 to be generated and combined with letters
            $part3 = rand(1,100);
            
             # combine unique characters
			$pass.=chr($part1).chr($part2).$part3;
		}
		# return password from function
		return $pass; 
	}
	
	function encrypt($plaintext, $password) {
         # method used to decrypt the Ciphertext
        $method = "AES-256-CBC";
        # create encrypted key from raw password
        $key = hash('sha256', $password, true); 
        # generate 16 bit cipher
		$iv = openssl_random_pseudo_bytes(16); 
		
		# encrypt now the string
		$ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
        
		 # return encrypted password in base64 format
		return base64_encode($iv . $hash . $ciphertext);
    }
    
    # echo encrypt("your raw password","email of the user");

if (isset($_POST['submit'])) {

     # generate password
    $password = generatePass();
    
    # encrypt generated password using user email as the encryption key
	$password = encrypt($password,trim($_POST['email'])); 
	
    $data = array(
        'fname'=>trim($_POST['fname']),
        'username'=>trim($_POST['username']),
        'password'=>$password,
        'email'=>trim($_POST['email']),
    );

    $message = createUser($data);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>

<body>
    <h2>Create User</h2>
    <?php echo !empty($message)?$message:'';?>
    <form action="admin_createuser.php" method="post">
        <label for="first_name">First Name</label>
        <input id="first_name" type="text" name="fname" value=""><br><br>

        <label for="username">Username</label>
        <input id="username" type="text" name="username" value=""><br><br>

        <label for="password">Password</label>
        <input id="password" type="text" name="password" value=""><br><br>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value=""><br><br>

        <button type="submit" name="submit">Create User</button>
    </form>
</body>

</html>