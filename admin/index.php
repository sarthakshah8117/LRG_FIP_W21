<?php
require_once '../load.php';
confirm_logged_in();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to LGR website</title>
</head>

<body>
    <h2>Welcome to the dashboard page, <?php echo $_SESSION['user_name']; ?>!</h2>

      
 <?php if($_SESSION['user_date'] == NULL): ?>
        <p><strong><?php echo $_SESSION['user_name'];?></strong> Loged in .</p>
    <?php else: ?>
        <p><strong>Last Login: </strong><?php echo $_SESSION['user_date'];?></p>
    <?php endif;?>
    <p><strong>Total Successful login Attempts: </strong><?php echo $_SESSION['success_login'];?></p>
    
    <a href="admin_createuser.php">Create User</a>
    <a href="admin_logout.php">Sign Out</a>
</body>

</html>