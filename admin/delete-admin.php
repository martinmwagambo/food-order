<?php
    //Include constants .php file here
    include("../config/constants.php");
    //1.Get ID of Admin to be deleted
    $ID =$_GET['ID'];

    //2.Create SQL query to Delete Admin
    $sql ="DELETE FROM tbl_admin WHERE ID=$ID";

    //Execute the Query
    $res =mysqli_query($conn,$sql);

    //Check if query executed or not
    if($res==true){
        //Query Executred Successfully
        //echo"Admin Deleted Successfully";
        //Create a Session variable to Display Message
        $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect Page to Add Admin
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed to delete Admin
        //echo "Failed to delete Admin";
        //Create a Session variable to Display Message
        $_SESSION['delete']= "<div class='error'>Failed to delete Admin. Try Again Later</div>";
        //Redirect Page to Add Admin
        header("Location:".SITEURL.'admin/delete-admin.php');
    }

    //3.Redirect To Manage Admin Page with Message (Success/Error)


?>