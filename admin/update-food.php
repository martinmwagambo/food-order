<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('partials/menu.php'); ?>

<?php


if (isset($_GET['id'])) {
    // Get the ID and all other details
    $id = $_GET['id'];
    // Create SQL query to get all other details
    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

    // Execute the Query
    $res2 = mysqli_query($conn, $sql2);

    // Get the Data based on the executed query
    $row2 = mysqli_fetch_assoc($res2);

    // Get individual values
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    // Redirect to manage food
    header('location:' . SITEURL . 'admin/manage-food.php');
    exit;
}
?>

   <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>

            <br><br>
                <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" ><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image=="")
                                    {
                                        echo "<div class='error'>Image not Available</div>";

                                    }
                                    else
                                    {
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width="150px">
                                        <?php
                                    }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                            <?php
                            //Create Php code to display categories from database
                                    //1.Create SQL to get all active categories
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    //Executing query
                                    $res =mysqli_query($conn, $sql);
                                    //Count rows to check whether we have category or not
                                    $count = mysqli_num_rows($res);

                                    //if count is greater than zero we have categories else we do not have categories
                                    if($count > 0)
                                    {
                                        //we have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //Get category name
                                            $category_title = $row['title'];
                                            //Get category id
                                            $category_id = $row['id'];
                                            
                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                                <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                            
                                        }
                                    }
                                    else
                                    {
                                        //We do not have categories
                                    
                                           echo "<option value='0'>No Category Available.</option>";
                                        
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

                            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>                    
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
<?php
                        if(isset($_POST['submit']))
                            {
                                //echo "Clicked";
                                //1.Get all the details from form
                                $id =$_POST['id'];
                                $title =$_POST['title'];
                                $description =$_POST['description'];
                                $price =$_POST['price'];
                                $current_image =$_POST['current_image'];
                                $category=$_POST['category'];

                                $featured =$_POST['featured'];
                                $active=$_POST['active'];
                                //2.Upload the image if selected
                                //check if upload buttonnis clicked or not
                                if(isset($_FILES['image']))
                                {
                                    //upload Button Clicked
                                    //get the name of the uploaded file
                                    $image_name = $_FILES['image']['name'];
                                    //check if image is available or not
                                    if($image_name!="")
                                    {
                                        //Image is Available
                                        //Rename the Image
                                        //$ext=end(explode('.', $image_name));
                                        $images = explode('.', $image_name);
                                        $ext = end($images);
                                        //Rename the Image
                                        $image_name= "Food-Name-".rand(0000, 9999).'.'.$ext;//food_food_834.jpg

                                        //Get source and Destination path
                                        $src_path = $_FILES['image']['tmp_name'];

                                        $dst_path = "../images/food/".$image_name;

                                        //Upload the image
                                        $upload = move_uploaded_file($src_path, $dst_path);

                                        //Check whether the image is uploaded or not
                                        //and if image is not uploaded then we will stop the process and redirect with error message
                                        if($upload==false)
                                        {
                                            //set message
                                            $_SESSION['upload2'] = "<div class = 'error'>Failed to Upload New Image.</div>";
                                            //redirect to manage food page
                                            header('location:'.SITEURL.'admin/manage-food.php');
                                            //stop the process
                                            die();
                                        }
                                        //3.Remove the image if new image is uploaded and current image exists
                                        //B.remove current Image
                                        //check if current image is available or not
                                        if($current_image!="")
                                        {
                                            $remove_path = "../images/food/".$current_image;
                                            $remove =@unlink($remove_path);
                                            //Check whether the image is removed or not
                                            if($remove==false)
                                            {
                                                //Redirect to manage food with session message
                                                $_SESSION['remove-failed'] = "<div class = 'error'>Failed to remove current image.</div>";
                                                //redirect to manage food page
                                                header('location:'.SITEURL.'admin/manage-food.php');
                                                die();
                                            }
                                        }
                                        
                                    }
                                    else
                                    {
                                        $image_name = $current_image;//default image when image is not selected
                                    }
                                }
                                else
                                {
                                    $image_name = $current_image; //default image when button is not clicked
                                }
                                
                        //4.Update the food in database
                        // Update the food in the database
                        $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = '$price',
                        image_name='$image_name',
                        category_id ='$category',
                        featured ='$featured',
                        active = '$active'
                        WHERE id = $id
                        ";

                        //execute the Query
                        $res3 = mysqli_query($conn, $sql3);

                        //Redirect to Manage Food with session message
                        if($res3==true)
                        {
                            //echo "Food Updated Successfully";
                            $_SESSION['upload2'] = "<div class = 'success'>Food Updated successfully.</div>";
                            //redirect manage food page
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                            
                        }
                        
                }
                    
                    ?>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">                        
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>   
                    </tr>
                    </table>
                </form>
        </div>
   </div> 

<?php include('partials/footer.php'); ?>