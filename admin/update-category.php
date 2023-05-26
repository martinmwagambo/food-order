<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the Id and all other details
                //echo "Getting the data";
                $id = $_GET['id'];
                //create SQL query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id = $id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1){
                    //Get the Data
                    $row =mysqli_fetch_assoc($res);
					$title=$row['title'];
					$current_image=$row['image_name'];
					$featured=$row['featured'];
					$active =$row['active'];
                }
                else{
                    //Redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class = 'error'>Category not Found.</div>";
                    //redirect to Add category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //Redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                            <tr>
                                <td>Title: </td>
                                <td>
                                    <input type="text" name="title" value=" <?php echo $title; ?>" placeholder=" New Title">
                                </td>
                            </tr>
                            <tr>
                                <td>Current Image:</td>
                                <td>
                                    <?php
                                        if($current_image!="")
                                        {
                                            //display the image
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
                                            <?php

                                        }
                                        else
                                        {
                                            echo "<div class='error'>No Image Found</div>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>New Image: </td>
                                <td>
                                    <input type="file" name="image">
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
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                                </td>
                            </tr>

                        </table>
            </form>

        <?php
            //Check if button is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";
                //1.get all values from our form
                $id =$_POST['id'];
                $title =$_POST['title'];
                $current_image =$_POST['current_image'];
                $featured =$_POST['featured'];
                $active=$_POST['active'];

                //2.Updating new Image if selected
                //check if image is selcted or not
                if(isset($_FILES['image']))
                {
                    //get the name of the uploaded file
                    $image_name = $_FILES['image']['name'];
                    //check if image is available or not
                    if($image_name!="")
                    {
                        //Image Available
                        //A.Uploaded New Image 
                        //Auto rename our Image
                        //get the Extension of our image(jpg, png, gif,etc)
                        $ext = end(explode('.',$image_name));
                        //Rename the Image
                        $image_name= "food_category_".rand(000, 999).'.'.$ext;//food_category_834.jpg

                        $source_path =$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //Upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //Check whether the image is uploaded or not
                        //and if image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false){
                            //set message
                            $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                            //redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();

                        }
                        //B.remove current Image
                        //check if current image is available or not
                        if($current_image!=""){
                        $remove_path = "../images/category/".$current_image;
                        $remove =unlink($remove_path);

                        //Check whether the image is removed or not
                        //and if image is not removed then we will stop the process and redirect with error message
                        if($remove==false)
                        {
                            //set message
                            $_SESSION['failed-remove'] = "<div class = 'error'>Failed to remove Image.</div>";
                            //redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();
                        }
                    }

                    }
                    else
                    {
                        //if not selected retain the current image
                        $image_name =$current_image;
                    }
                    //get the path of the uploaded file
                    //$image_path = $_FILES['image']['tmp_name'];
                    //get the size of the uploaded file
                    //$image_size = $_FILES['image']['size'];
                    //get the mime type of the uploaded file
                    //$image_type = $_FILES['image']['type'];
                    //get the extension of the uploaded file
                    //$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    //get the new name of the uploaded file
                }
                else
                {
                    $image_name =$current_image;
                }

                //3.Update the database
                // Update the category in the database
                $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name='$image_name',
                featured ='$featured',
                active = '$active'
                WHERE id = $id";

                //execute the Query

                $res2 = mysqli_query($conn, $sql2);


                //4.redirect to manage category with message
                if($res2==true)
                {
                    //echo "Category Updated Successfully";
                    //Redirect to manage category with session message
                    $_SESSION['update'] = "<div class = 'success'>Category updated Successfully.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else
                {
                    //Redirect to manage category with session message
                    $_SESSION['update'] = "<div class = 'error'>Failed to update Category.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else{
                //echo "not clicked";
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
