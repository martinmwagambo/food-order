<?php 
    //echo "Delete Food Page";
    //Include constants .php file here
    include("../config/constants.php");

    if(isset($_GET['id'])&& isset($_GET['image_name']))//either use && or AND
    {
        //Process to delete
        //Echo"Process to Delete";
        //1.Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //1.Delete Image if available
        //check whether the image is available or not and delete only if available
        if($image_name!="")
        {
            //It has image and need to remove from folder
            //get image path
            $path = "../images/food/".$image_name;

            //remove Image file from folder
            $remove=unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove Image
                $_SESSION['upload'] ="<div class='error'>Failed to Remove image</div>";
                //Redirect to manage food page
                header('Location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of deleting food
                die();
            }
        }
        //2.Delete Food Item from database
        $sql ="DELETE FROM tbl_food WHERE ID=$id";

        //Execute the Query
        $res =mysqli_query($conn, $sql);

        //Check if query executed or not
            if($res==true){
            //3.Redirect to manage Food with Session Message
                //Query Executed Successfully
                //Create a Session variable to Display Message
                $_SESSION['delete']= "<div class='success'>Food Deleted Successfully</div>";
                //Redirect Page to manage food page
                header('Location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                //Failed to delete Food
                //Create a Session variable to Display Message
                $_SESSION['delete']= "<div class='error'>Failed to Delete Food.</div>";
                //Redirect Page to manage food page
                header('Location:'.SITEURL.'admin/manage-food.php');
            }


    }
    else
    {
        //Redirect to manage Food page
        //echo "Redirect";
        $_SESSION['unauthorized'] ="<div class='error'>Unauthorized Access</div>";
        //Redirect to Manage Food Page
        header('Location:'.SITEURL.'admin/manage-food.php');
    }

?>