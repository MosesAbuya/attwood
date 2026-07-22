<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['update']))
{
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$mission=$_POST['mission'];
$welcomenote=$_POST['welcomenote'];



$sql=mysqli_query($con,"update contact set phone='$phone',email='$email',address='$address',mission='$mission',welcomenote='$welcomenote'");
if($sql)
{

$_SESSION['msg']="Contact updated successfully !!";
}
else{

$_SESSION['error']="Something went wrong. Please try again.";    
} 

}

?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin - Contact</title>
		
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
		
		<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			         			<?php

include('include/header.php');

?>
			
			<!-- Sidebar -->
              <?php include('include/sidebar.php');?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
                	<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h3 class="mainTitle">Admin | Contact Info</h3>
																	</div>
								
							</div>
						</section>
					
									<div class="card card-table">
							
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
												<p style="color:blue;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>	

								<?php 

$query=mysqli_query($con,"select phone,email, address,mission,welcomenote from contact");
while($row=mysqli_fetch_array($query))
{

?>
													<form role="form" name="adddoc" method="post" onSubmit="return valid();" >
														<div class="form-group">
															<label for="Page Title">
																 <b>Phone Number</b>
															</label>
					<input type="text" name="phone" class="form-control"  value="<?php echo htmlentities($row['phone'])?>" required="true">
														</div>
																



<div class="form-group">
															<label for="email">
																 <b>Email</b>
															</label>
					<input type="email" name="email" class="form-control"  value="<?php echo htmlentities($row['email'])?>" required="true">
														</div>	

														<div class="form-group">
															<label for="email">
																<b>Location</b>
															</label>
					<input type="text" name="address" class="form-control"  value="<?php echo htmlentities($row['address'])?>" required="true">
														</div>



														<div class="form-group">
															<label for="details">
																 <b>Mission</b>
															</label>
					<textarea name="mission" class="form-control"  rows="5" required="true"> <?php echo htmlentities($row['mission'])?></textarea>
														</div>			


														<div class="form-group">
															<label for="details">
																<b> Welcome Note</b>
															</label>
					<textarea name="welcomenote" class="form-control"  rows="5" required="true"> <?php echo htmlentities($row['welcomenote'])?></textarea>
														</div>								
														
														

														
														
														
														<button type="submit" name="update" class="btn btn-o btn-primary">
															Update and Post
														</button>
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
<?php } ?>