<?php include('partials/menu.php'); ?>

    <div class="main-content" >
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <br><br>

            <!-- Add category Form starts-->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder=" Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            <!-- Add category Form Ends-->

            <?php
                //Check whether submit button is clicked or not
                if(isset($_POST['submit'])){
                    //echo "clicked";
                    //1.Get the value from Category form
                    $title= $_POST['title'];

                    //For Radio inout type we need to check if value is set or not
                    if(isset($_POST['featured'])){
                        //get value from form
                        $featured = $_POST['featured'];
                    }
                    else{
                        //set default value
                        $featured = "No";
                    }
                if(isset($_POST['active'])){
                    //get value from form
                    $active = $_POST['active'];
                }
                else{
                    //set default value
                    $active = "No";
                }
                //Check wheter tha image is set or not and set the value for image name accordingly
                //print_r($_FILES['image']);

                //die();//break the code here
                if(isset($_FILES['image']['name'])){
                    //upload the image
                    //upload the image we need image name and source path and destination path
                    $image_name=$_FILES['image']['name'];

                    //upload the image only if is selected
                    if($image_name!="")
                    {
                   
                        //Auto rename our Image
                        //get the Extension of our image(jpg, png, gif,etc)food1.jpg
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
                            //redirect to Add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();

                        }
                }

                }else{
                    //dont upload image and set the image name value as blank
                    $image_name ="";
                }

                //2.Create SQL to insert category into database
                $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //Execute the query and save in database
                $res= mysqli_query($conn, $sql);

                //4.Check whether query executed and data is added or nor
                if($res==true){
                    //Query Executed and category Added
                    $_SESSION['add'] ="<div class='success'>Category Added successfully</div>";
                    //Redirect to Manage Category Page
                    header('Location:'.SITEURL.'admin/manage-category.php');
                }else{
                    //Failed to Add Category
                     //Query Executed and category Added
                     $_SESSION['add'] ="<div class='error'>Failed to Add category</div>";
                     //Redirect to Manage Category Page
                     header('Location:'.SITEURL.'admin/add-category.php');
                }
            }
                
            ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>