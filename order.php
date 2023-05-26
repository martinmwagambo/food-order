<?php include('partials-front/menu.php');?>

<?php
    //check   whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //Get the food id and details of the selected food
        $food_id = $_GET['food_id'];
        //Get the details of the selected food
        $sql="SELECT * FROM tbl_food WHERE id = $food_id";
        //Execute the Query
        $res=mysqli_query($conn,$sql);
        //count the rows
        $count=mysqli_num_rows($res);
        //Check whether the data is available or not
        if($count==1)
        {
            //we have data 
            //Get the data from database
            $row = mysqli_fetch_assoc($res);
            $title =$row['title'];
            $price =$row['price'];
            $image_name =$row['image_name'];
        }
        else
        {
            //food not available
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    }    
    else
    {
        //food not available
        //Redirect to homepage
        header('location:'.SITEURL);
    }
?>

    <!-- FOOD SEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                            ?>
                    </div>
    
                        <div class="food-menu-desc">
                            <h3><?php echo $title; ?></h3>

                            <input type="hidden" name="food" value="<?php echo $title; ?>">
                            <p class="food-price">Ksh <?php echo $price; ?></p>

                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Martin Mwagambo" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0712345678" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. mg@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
                //Check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get all details from the form. food, price and qty
                    //Get id
                    
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    //total =price * qty
                    $total = $price * $qty;

                    //Order date
                    $order_date = date("Y-m-d h:i:sa");
                    //status ordered, on Delivery, Delivered, Cancelled
                    $status = "Ordered";

                    $customer_name=$_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];

                    //save the order in database
                    //Sql to save data
                    $sql2 = "INSERT INTO tbl_order SET
                    
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact', 
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'";

                    
                    //echo $sql2;die();

                    //execute the sql
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query executed or not 
                    if($res2==true)
                    {
                        //Query executed and Order Saved
                        //display success message session
                        $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully</div>";
                        //redirect to home page
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to save order
                        //display success message session
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food</div>";
                        //redirect to home page
                        header('location:'.SITEURL);
                    }
                    
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php');?>