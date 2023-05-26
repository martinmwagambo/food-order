<?php 
    //Start Session
    session_start();

    //Cretae Constants to store non repeating Values
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');
    define('SITEURL','http://localhost/food-order/');


    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);  //Database Connection //Error failed to connect to database
    $db_selct = mysqli_select_db($conn,DB_NAME);//Selecting the Database

?>