<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$id=intval($_GET['id']);// get value
if(isset($_POST['submit']))
{
$cityname=$_POST['cityname'];
$sql=mysqli_query($con,"update  tblcity set cityname='$cityname' where id='$id'");
$_SESSION['msg']="City updated successfully !!";
} 

?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
     <title>Admin | Edit City</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets2/img/fav.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets2/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets2/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets2/css/feathericon.min.css">
		
		<link rel="stylesheet" href="assets2/plugins/morris/morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets2/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets2/js/html5shiv.min.js"></script>
			<script src="assets2/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			         			<?php

include('include/header.php');

?>
			
			<!-- Sidebar -->
              			<?php

include('include/sidebar.php');

?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
                	<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h3 class="mainTitle">Admin | Edit City</h3>
																	</div>
								
							</div>
						</section>
					
									<div class="row">
						<div class="col-12">
	
						
							<div class="card">
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-9">
											<div class="panel panel-white">
													
												<div class="panel-body">
								<p style="color:blue;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>	
								<?php 

$id=intval($_GET['id']);
	$sql=mysqli_query($con,"select * from tblcity where id='$id'");
while($row=mysqli_fetch_array($sql))
{														
	?>
												<form role="form" name="dcotorspcl" method="post" enctype="multipart/form-data">
														<div class="form-group">
															<label for="exampleInputEmail1">
																<b>Edit City Name</b>
															</label>

		<input type="text" name="cityname" class="form-control" value="<?php echo $row['cityname'];?>" >
	
														</div>
		
												
				<?php } ?>										
													<br /> 	
														
														<center><button type="submit" name="submit" class="btn btn-o btn-primary">
															Update
														</button></center>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						
		
							
							
							
						</div>
					</div>
						
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets2/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets2/js/popper.min.js"></script>
        <script src="assets2/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets2/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<script src="assets2/plugins/raphael/raphael.min.js"></script>    
		<script src="assets2/plugins/morris/morris.min.js"></script>  
		<script src="assets2/js/chart.morris.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets2/js/script.js"></script>
		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>