<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Login-Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php 
				if (isset($_SESSION['login'])){
					//Displaying Session Message
					echo $_SESSION['login'];
					//Removing Session Message
					unset($_SESSION['login']);
				}
                if (isset($_SESSION['no-login-message'])){
					//Displaying Session Message
					echo $_SESSION['no-login-message'];
					//Removing Session Message
					unset($_SESSION['no-login-message']);
				}
                ?>
                <br><br>

            <!--Login Form starts here-->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="Username" placeholder=" Enter Username"><br> <br>
                Password: <br>
                <input type="Password" name="Password" placeholder=" Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!--Login Form Ends here-->


            <p class="text-center">Created By- <a href="www.Martin.com">Martin Mwagambo</a></p>
        </div>
    </body>
</html>

<?php
    //Check if button is clicked or not
    if(isset($_POST['submit'])){
         //Process for login
         //1.get the data for login form
         $Username = $_POST['Username'];
         $Password = md5($_POST['Password']);

         //2.SQL to check whether the user with username and password exists 
         $sql = "SELECT * FROM tbl_admin WHERE Username='$Username' AND Password ='$Password'";
         
         //3.Execute the Query
         $res = mysqli_query($conn, $sql);
        //4.Count rows to check if user exists or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //User Available and Login Success
            //Create a Session variable to Display Message
            $_SESSION['login']= "<div class='success'>Login Successful.</div>";
            $_SESSION['user']=$Username; //To check whether the user is logged in or not and log out will unset it
            //Redirect Page to Manage Admin
            header("Location:".SITEURL.'admin/');

        }
        else{
            //User not available and Login Failed
            //Create a Session variable to Display Message
            $_SESSION['login']= "<div class='error text-center'>Username or Password is incorrect.</div>";
            //Redirect Page to Manage Admin
            header("Location:".SITEURL.'admin/login.php');
        }
    }
?>