<?php
    //Check user if logged in or not
    //Authorization - Access Control
    if(!isset($_SESSION['user'])){//If User session is not set
        //Redirect to login page with message
        $_SESSION['no-login-message'] =  "<div class='error text-center'> Login to Access Admin panel</div >";
        //Redirect to Login page
        header('Location:'.SITEURL.'admin/login.php'); 

    }
?>