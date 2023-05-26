<?php
    //Include constants file
    include('../config/constants.php');
    //echo "Delete page";

    
    //Check whether the values id and image_name are being passed on button or not
    if(isset($_GET['id']) AND isset($_GET['image_name']) )
    {
        //Get the Value and Delete
       //echo "Get value and Delete";
       $id =$_GET['id'];
       $image_name =$_GET['image_name'];
       //Remove the Physical image file if available
       if($image_name!="")
       {
        //Image is available.Remove it
        // Remove the physical image file from the server
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);

        if($remove==false)
        {
            // If image file cannot be removed, set an error message and redirect
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }

       }

       //SQL Query to Delete data From database 
       $sql = "DELETE FROM tbl_category WHERE id=$id";
       //Execute the Query
       $res = mysqli_query($conn, $sql);

       //Check whether the data is deleted from database or not
       if($res==true)
        {
            // If category is deleted successfully, set a success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
            //redirect to manage category page with message 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // If category deletion fails, set an error message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            //redirect to manage category page with message 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //Redirect to manage Category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
