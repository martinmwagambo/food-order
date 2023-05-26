<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />

        <?php 
        //Checking whether sewssion is set or not
				if (isset($_SESSION['add'])){
					//Displaying Session Message
					echo $_SESSION['add'];
					//Removing Session Meassage
					unset($_SESSION['add']);
				}
			?>
			<br /><br /><br />

        <form action=""method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="Full_Name" placeholder=" Enter Your name"></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="Username" placeholder=" Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="Password" placeholder=" Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>   
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname ="food-order";
    // Process the value from form and save it in database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo"Button Clicked";  
        
        //1.Get the data from Form
        $Full_Name = $_POST['Full_Name'];
        $Username =$_POST['Username'];
        $Password =md5($_POST['Password']); //Password Encryption with MD5

        //2.SQL to save data into database
        $sql = "INSERT INTO tbl_admin SET 
            Full_Name = '$Full_Name',
            Username = '$Username',
            Password = '$Password'
        ";

         //Creating a connection
         //$conn = new mysqli($servername,$username,$password,$dbname);

         //check connection
         //if ($conn->connect_error){
            //die ("Connection failed".$conn->connect_error);
         //}
         //$conn = mysqli_connect('localhost','root','');  //Database Connection //Error failed to connect to database
         //$db_selct = mysqli_select_db($conn,'food-order');//Selecting the Database

         //3.Execute Query and Save data in Database 
         $res = mysqli_query($conn,$sql); //or die(mysqli_error());
         //echo $res;

         //Check whether (Query is Executed)data is inserted or not and display appropriate message
         if($res==TRUE){
            //Data Inserted
            //echo"Data Inserted";
            //Create a Session variable to Display Message
            $_SESSION['add']= "<div class='success'>Admin Added Successfully</div>";
            //Redirect Page to Manage Admin
            header("Location:".SITEURL.'admin/manage-admin.php');
         }
         else{
            //Data not inserted
            //echo"Failed to insert Data";
            //Create a Session variable to Display Message
            $_SESSION['add']= "<div class='error'>Failed to Add Admin</div>";
            //Redirect Page to Add Admin
            header("Location:".SITEURL.'admin/add-admin.php');
         }
         

        
    }
?>