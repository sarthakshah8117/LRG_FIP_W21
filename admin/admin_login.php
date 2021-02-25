<?php
require_once '../load.php';

$ip = $_SERVER['REMOTE_ADDR'];

if (isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}



if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (!empty($username) && !empty($password)) {
        // log in for user 
        $result = login($username, $password, $ip);
        $message = $result;
    } else {
        $message = 'Please fill out the required fields.';
    }
}
if(isset($_SESSION["locked"])){
        $diff = time() - $_SESSION["locked"];
        if($diff > 10){
            unset($_SESSION["locked"]);
            $_SESSION['STATUS'] = 0;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the admin panel</title>
</head>

<body>
    <?php echo !empty($message)?$message:'';?>
    <form action="admin_login.php" method="post">
        <label for="username">Username:</label>
        <input id="username" type="text" name="username" value="">
        <br><br>
        <label for="password">Password:</label>
        <input id="password" type="password" name="password">
        <br><br>
        <?php 
        // this will help in locking out after 3rd unsuccessful attempt
            if($_SESSION['STATUS'] > 2){
                $_SESSION["locked"] = time();
                echo "<p>Please contact us </p>";
            }
            else{
        ?>
        <button type="submit" name="submit">Login</button>

        <?php } ?>
    </form>
</body>

</html>