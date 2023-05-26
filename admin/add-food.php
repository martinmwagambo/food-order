<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br /> <br>
            <?php 
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            
            <form action=""method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder=" Title of the Food"></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder=" Description of the food"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" placeholder=" Enter the Price">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
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
                                            //Get category id
                                            $id = $row['id'];
                                            //Get category name
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //We do not have categories
                                        ?>
                                            <option value="0">No Category Found</option>
                                        <?php
                                    }

                                    //2.Display on Dropdown

                                ?>

                           </select>
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
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>   
                    </tr>
    
                </table>
            </form>

            <?php
                // Process the value from form and save it in database
                //check whether the submit button is clicked or not

                if(isset($_POST['submit']))
                {
                    //Button Clicked
                    //echo"Button Clicked";  
                    
                    //1.Get the data from Form
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $category=$_POST['category'];

                    //check if featured and active are checked
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";//setting to default value
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";//setting to default value
                    }
                    //2.Upload the Image if selected
                    //Check whether the image is selected or not to upload image only if selected
                    if(isset($_FILES['image']['name'])){
                        //get the details of the selected image
                        $image_name=$_FILES['image']['name'];
                        //check whether is selected and only upload if image is selected
                        if($image_name!="")
                        {
                       
                            //Auto rename our Image
                            //get the Extension of our image(jpg, png, gif,etc)food1.jpg
                            $ext = end(explode('.',$image_name));
                            //Rename the Image
                            $image_name= "food_name_".rand(000, 9999).'.'.$ext;//food_name_834.jpg
    
                            $src =$_FILES['image']['tmp_name'];
    
                            $dst="../images/food/".$image_name;
    
                            //Upload the image
                            $upload = move_uploaded_file($src,$dst);
                            //Check whether the image is uploaded or not
                            //and if image is not uploaded then we will stop the process and redirect with error message
                            if($upload==false){
                                //set message
                                $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                                //redirect to Add Food page
                                header('location:'.SITEURL.'admin/add-food.php');
                                //stop the process
                                die();
    
                            }
                    }

                    }
                    else
                    {
                        $image_name="";//setting default value as blank
                    }

                    //3.Insert into database
                    //Create SQL to insert food into database
                    //For Numerical values we do not need to pass the value in single quotes but in string it is compulsory 
                        $sql2="INSERT INTO tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                            ";

                    //Execute the query and save in database
                    $res2= mysqli_query($conn, $sql2);

                    //4.Redirect with message to manage Food page
                    //4.Check whether query executed and data is added or nor
                    if($res2==true){
                        //Query Executed and Food Added
                        $_SESSION['add'] ="<div class='success'>Food Added Successfully</div>";
                        //Redirect to Manage Food Page
                        header('Location:'.SITEURL.'admin/manage-food.php');
                    }else{
                        //Failed to Add FOOD
                        //Query Executed and category Added
                        $_SESSION['add'] ="<div class='error'>Failed to Add Food</div>";
                        //Redirect to Manage food Page
                        header('Location:'.SITEURL.'admin/manage-food.php');
                    }
                }   
            ?>
        </div>
    </div>
    
<?php include('partials/footer.php'); ?>