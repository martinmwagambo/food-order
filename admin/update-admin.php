<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class= "wrapper">
            <h1>Update Admin</h1>
            <br><br>

            <?php
                //1.Get Id of Selected Admin
                $ID = $_GET['ID'];
                //2.Crete Sql query to get the Details
                $sql = "SELECT * FROM tbl_admin WHERE ID=$ID";
                //Execute the Query
                $res= mysqli_query($conn,$sql);

                //Check if Query is executed or not
                if($res==true){
                    //Check whether data is available or not
                    $count = mysqli_num_rows($res);
                    //Check if there is data in database
                    if($count==1){
                        //Get Details
                        //echo"Admin Available";
                        $row =mysqli_fetch_assoc($res);
                        $Full_Name=$row['Full_Name'];
                        $Username =$row['Username'];
                    }
                    else{
                        //Redirect  to Manage Admin Page
                        //validation
                        header('Location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            
            
            ?>
            <br><br>

            <form action=""method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="Full_Name" value="<?php echo $Full_Name;?>"></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="Username" value="<?php echo $Username;?>"></td>
                </tr>
                    <td colspan="2">
                        <input type="hidden" name="ID" value="<?php echo $ID;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>   
                </tr>

            </table>
        </form>
        </div>
    
    </div>

    <?php
        //Check whether SUBMIT button is clicked or not
        if(isset($_POST['submit'])){
            //echo "Button Clicked";
            //Get all Values from Form to Update
            $ID =$_POST['ID'];
            $Full_Name =$_POST['Full_Name'];
            $Username =$_POST['Username'];

            //Crete a SQL query to update Admin
            $sql ="UPDATE tbl_admin SET
            Full_name = '$Full_Name',
            Username ='$Username'
            WHERE ID ='$ID'
            ";

            //Execute Query
            $res =mysqli_query($conn,$sql);

            //Check if Query Executed Successfully
            if($res==true){
                //Query Executed Successfully
                //Create a Session variable to Display Message
            $_SESSION['update']= "<div class='success'>Admin Updated Successfully</div>";
            //Redirect Page to Manage Admin
            header("Location:".SITEURL.'admin/manage-admin.php');

            }else{
                //Failed to Update Admin
                //Create a Session variable to Display Message
            $_SESSION['update']= "<div class='error'>Failed to Update Admin</div>";
            //Redirect Page to Manage Admin
            header("Location:".SITEURL.'admin/manage-admin.php');
            }
        }
    ?>


<?php include('partials/footer.php'); ?>