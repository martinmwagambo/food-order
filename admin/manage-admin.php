   <?php include('partials/menu.php'); ?>


    <!--Main Content Section starts-->
    <div class= "main-content">
        <div class = "wrapper">
            <h1>Manage Admin</h1>
			<br><br>
			<?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
				if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
				if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
				if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
				if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
				if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
			?>
			<br><br>

			<!--Button to Add Admin-->
			<a href="<?php echo SITEURL;?>admin/add-admin.php" class="btn-primary">Add Admin</a>
   			<br />	
			   <br />
            <div class ="clearfix"></div>

            	<table class="tbl-full">
            		<tr>
            			<th>S.N</th>
            			<th>Full Name</th>
            			<th>Username</th>
            			<th>Actions</th>
            		</tr>
					<?php
						//Query to get all admins
						$sql = "SELECT * FROM tbl_admin";

						//Execuete the query
						$res = mysqli_query($conn, $sql);

						//Check whether the query is executed or not
						if($res==TRUE)
						{
							//Count Rows to check whether we have data in database or not
							$count = mysqli_num_rows($res);//Function to get all the rows in database

							$sn=1;

							//check the num of rows
							if($count>0)
							{
								//We have data in database 
								//while loop to fetch data
								while($row=mysqli_fetch_assoc($res))
								{
									//get individual data
									$ID=$row['ID'];
									$Full_Name=$row['Full_Name'];
									$Username=$row['Username'];

									//Display the values
									?>
										<tr>
											<td><?php echo $sn++;?></td>
											<td><?php echo $Full_Name?></td>
											<td><?php echo $Username?></td>
											<td>
												<a href="<?php echo SITEURL;?>admin/update-password.php?ID=<?php echo $ID; ?>" class="btn-primary">Update Password</a>
												<a href="<?php echo SITEURL;?>admin/update-admin.php?ID=<?php echo $ID; ?>" class="btn-secondary">Update Admin</a>
												<a href="<?php echo SITEURL;?>admin/delete-admin.php?ID=<?php echo $ID; ?>" class="btn-danger">Delete Admin</a>
											</td>
										</tr>

									<?php
								}
							}
							else
							{
								//We do not have data in database
								//echo <div class>
							}
						}
					?>
            	</table>

        </div>
    </div>
    <!--Main Content Section ends-->

<?php include('partials/footer.php'); ?>