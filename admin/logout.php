<?php
    //Include contsnts Constants.php for SITEURL
    include('../config/constants.php');

    //1.destory the session
    session_destroy();//Unsets $_SESSION['user']

    //2.redirect to login page
    header("Location:".SITEURL.'admin/login.php');
?>