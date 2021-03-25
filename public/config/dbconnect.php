<?php
	
	date_default_timezone_set("America/Toronto");
	class Db{
		
		public $con;
		private $host = "localhost";
		private $user = "root";
		private $password = "";
		private $dbname = "lrg_data";
		
		# create connection and return the pointer
		public function Connect(){
			return $this->con = mysqli_connect($this->host,$this->user,$this->password,$this->dbname);
		}
		
		# close mysqli connection
		public function Close(){
			return mysqli_close($this->con);
		}
		
		# method to insert data from database
		public function query($query){
			if(mysqli_query($this->Connect(),$query)){
				return "success";
			}
			else{
				return "Failed to create record! ".mysqli_error($this->con);
			}
		}
		
		# method to fetch data from database
		public function fetch($sql){
			$data = [];
			$sql = mysqli_query($this->Connect(),$sql);
			while($row=mysqli_fetch_assoc($sql)){
				$data[]=$row;
			}
			
			return $data;
		}
		
	}
	
	function cleandata($data){
		#remove illegal strings from data to prevent mysqli injection
		return addslashes(strip_tags(trim($data)));
	}
	
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
	
?>