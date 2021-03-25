<?php

    require "../config/dbconnect.php";

    if(isset($_GET['id'])){
        $uid = trim($_GET['id']);
        $db = new Db();
        $db->query("DELETE FROM `tbl_user` WHERE `user_id`='$uid'");

        echo "<script> window.location.replace('index.php'); </script>";
    }

?>