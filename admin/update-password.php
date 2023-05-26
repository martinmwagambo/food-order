<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
                $ID = 0; // define default value for $ID
                if(isset($_GET['ID'])){ // remove condition from if statement
                    $ID=$_GET['ID'];
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="Password" name="current_password" placeholder=" Current Password" >
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="Password" name="new_password" placeholder=" New Password" >
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="Password" name="confirm_password" placeholder=" Confirm Password" >
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="ID" value="<?php echo $ID;?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php 
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo"Button Clicked";  
        
        //1.Get the data from Form
        $ID = $_POST['ID'];
        $current_password =md5($_POST['current_password']);
        $new_password =md5($_POST['new_password']);
        $confirm_password =md5($_POST['confirm_password']); //Password Encryption with MD5

        //2.SQL to check whether the user with current ID and Current Password Exists or not
        if(isset($ID)){ // check whether $ID is set
            $sql ="SELECT * FROM tbl_admin WHERE ID=$ID  AND Password ='$current_password'";

            //Execute the Query
            $res =mysqli_query($conn,$sql);

            if($res==true){
                //Check whether data is available or not
                $count=mysqli_num_rows($res);
                if($count==1){
                    //User Exists and Password can be changed
                    //echo "User Found";
                    //Check if New and Confirm password match
                    if($new_password==$confirm_password){
                        //update passsword
                        $sql2 = "UPDATE tbl_admin SET
                            Password='$new_password'
                            WHERE ID=$ID
                        ";

                        //Execute the Query
                        $res2 = mysqli_query($conn,$sql2);

                        //Check for Query execution or not
                        if ($res2==TRUE){
                            //display success Message
                            //Create a Session variable to Display Message
                            $_SESSION['change-pwd']= "<div class='success'>Password Changed Successfully.</div>";
                            //Redirect Page to Manage Admin
                            header("Location:".SITEURL.'admin/manage-admin.php');
                        }
                        else{
                            //Display Error Message
                            //Create a Session variable to Display Message
                            $_SESSION['change-pwd']= "<div class='error'>Failed to change password.</div>";
                            //Redirect Page to Manage Admin
                            header("Location:".SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else{
                        //Redirect to manage Admin with error message
                        //Create a Session variable to Display Message
                        $_SESSION['pwd-not-match']= "<div class='error'>Password Did not match.</div>";
                        //Redirect Page to Manage Admin
                        header("Location:".SITEURL.'admin/manage-admin.php');

                    }
                    
                }
                else
                {
                    //User does not Exist Set Message and redirect
                    //Create a Session variable to Display Message
                    $_SESSION['user-not-found']= "<div class='error'>User Not Found.</div>";
                    //Redirect Page to Manage Admin
                    header("Location:".SITEURL.'admin/manage-admin.php');
                }
            }

            //3.Check whether the New Password and Confirm Password match or not
            //4.Change Password if all above is true
        }
    } 
?>

<?php include('partials/footer.php'); ?>
