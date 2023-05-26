<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Display foods that are Active
                //Sql Query
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether food is available or not
                if($count > 0)
                {
                    //Food Available
                    //categories Available
                    while ($row = mysqli_fetch_assoc($res))
                    {
                        //get all values id, title ,image_name,description and Price
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $description = $row['description'];
                        $price = $row['price'];
                        ?>
                         <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php 
                            //Check whether the image is available or not
                                if($image_name=="")
                                {
                                    //Image not Available. Display Message
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Ksh <?php echo $price; ?></p>
                                <p class="food-detail">
                                        <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    
                    }
                }
                else
                {
                    //Food not Available
                    echo "<div class='error'>Food Not Added</div>";
                }    
            ?>
            <div class="clearfix"></div>          

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>