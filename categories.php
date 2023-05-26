<?php include('partials-front/menu.php');?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Display all categories that are active
                //Sql Query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether category is available or not
                if($count > 0)
                {
                    //categories Available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //Get category id
                        $id = $row['id'];
                        //Get category title
                        $title = $row['title'];
                        //Get category image
                        $image_name = $row['image_name'];
                        
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                            <?php 
                            //Check whether the image is available or not
                                if($image_name=="")
                                {
                                    //Image not Available. Display Message
                                    echo "<div class='error'>Image not Found</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>

                        <?php
                    }
                }
                else
                {
                    //categories not Available
                    echo "<div class='error'>Categories Not Found</div>";
                }
            
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>