<?php include('partials/menu.php'); ?>

<div class = "main-content">
	<div class="wrapper">
		<h1>Manage Foods</h1>

		<br />
			<br />
			<?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
				if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
				if(isset($_SESSION['upload2'])){
                    echo $_SESSION['upload2'];
                    unset($_SESSION['upload2']);
                }
				if(isset($_SESSION['unauthorized'])){
                    echo $_SESSION['unauthorized'];
                    unset($_SESSION['unauthorized']);
                }
				if(isset($_SESSION['remove-failed'])){
                    echo $_SESSION['remove-failed'];
                    unset($_SESSION['remove-failed']);
                }
				if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
		
			?>
			<br><br>	

			<!--Button to Add Admin-->
			<a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
   			<br />	
			   <br />	
            	<table class="tbl-full">
            		<tr>
            			<th>S.N</th>
            			<th>Title</th>
            			<th>Price</th>
						<th>Image</th>
						<th>Featured</th>
						<th>Active</th>
            			<th>Actions</th>
            		</tr>
					<?php
					//Query to get all Foods
					$sql = "SELECT *FROM tbl_food";

					//Execute the Query
					$res = mysqli_query($conn, $sql);

						//Count Rows to check whether we have data in database or not
						$count = mysqli_num_rows($res);//Function to get all the rows in database

						//Create variable to Assign the value of Serial number
						$sn=1;
						
						if($count>0)
						{
							//we have data in database
							while($rows =mysqli_fetch_assoc($res))
							{
								//while loop to get data from database
								//It will run as long as we have data in table
								//Get individual Data
								$id=$rows['id'];
								$title=$rows['title'];
								$price=$rows['price'];
								$image_name=$rows['image_name'];
								$featured=$rows['featured'];
								$active=$rows['active'];

								//Display values in Table
								?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td>Ksh <?php echo $price; ?></td>
									<td>
										<?php 
											//Check whether we have image or not
											if($image_name=="")
											{
												//We do not have Image Display error message
												echo "<div class='error'>Image not Added.</div>";
											}
											else
											{
												//We have Image ,Display Image
												?>
													<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

												<?php
											}
										?>
									</td>
									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
									<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
									<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
									</td>
								</tr>

								
								<?php

							}
						}
						else{
							//No Food in database
							//Write html code inside php
							echo "<tr><td colspan='7' class='error'> Food Not Added Yet.</td></tr>";
						}

					?>

            	</table>

	</div>
</div>

<?php include('partials/footer.php'); ?>