<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
$testname=$_POST['testname'];



$imgfile=$_FILES["testimage"]["name"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["testimage"]["tmp_name"],"postimages/".$imgnewfile);


$query=mysqli_query($con,"insert into tests(testname,testimage) values('$testname','$imgnewfile')");
if($query)
{

$msg="Test added successfully !!";
}
else{

$error="Something went wrong . Please try again.";    
} 

}
}
?>
<?php
if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from tests where id = '".$_GET['id']."'");
                  $error="Test record deleted successfully!!";
		  }
		  ?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin | Patient Tests</title>
		
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

       
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets2/pluginss/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets2/pluginss/fontawesome/css/all.min.css">

	
			<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets2/plugins/datatables/datatables.min.css">
		
		
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
								<h4 class="mainTitle">Admin | Patient Tests</h4>
																	</div>
								
							</div>
						</section>
					
									<div class="row">
						<div class="col-12">
	
						
							<div class="card">
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
										<div class="wrap-content container" id="container">
						
						
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div>
											<div class="panel panel-white">
												
												<div class="panel-body">
								<!---Success Message--->  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?>	
												<form role="form" name="dcotorspcl" method="post" enctype="multipart/form-data">
														<div class="form-group">
															<label for="exampleInputEmail1">
																<b>Test Name</b>
															</label>
							<input type="text" name="testname" class="form-control"  placeholder="Enter Test Name">
														</div>

                                                    <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<label><b>Test Image</b></label>
<input type="file" class="form-control" id="testimage" name="testimage"  required>
</div>
</div>
</div>
		<br>										
														
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Submit
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
										</div>
									</div>
								</div>
							</div>
							
						
		
				<div class="card card-table">
								<div class="card-header">
									
									<h5 class="over-title margin-bottom-15" style="color: green">Manage <span class="text-bold">Patient Tests</span></h5>

								</div>
								<div class="card-body">
									<div class="table-responsive">
								
								<table class="table table-hover" id="sample-table-1">
				<thead>
											<tr>
												<th class="center">#</th>
												<th>Test Name</th>
												<th>Test Image</th>
												<th class="hidden-xs">Creation Date</th>
												<th>Updation Date</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
<?php
$sql=mysqli_query($con,"select * from tests");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['testname'];?></td>
												<td><img src="postimages/<?php echo htmlentities($row['testimage']);?>" width="60" height="60" /></td>
												<td><?php echo $row['creationDate'];?></td>
												<td><?php echo $row['updationDate'];?>
												</td>
												
												<td >
												
	

	<a href="edit-test.php?id=<?php echo $row['id'];?>" class="btn btn-sm bg-success-light">
																				<i class="far fa-edit"></i> Edit
																			</a>
<a href="tests.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm bg-danger-light">
																				<i class="far fa-trash-alt"></i> Delete
																			</a>
												
												
													
												</td>
											</tr>
											
											<?php 
$cnt=$cnt+1;
											 }?>
											
											
										</tbody>
									</table>
									</div>
								</div>
							</div>
							
							
							
						</div>
					</div>
						
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
			
	
							<!-- /Recent Orders -->
		
		
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


			<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>



			<!-- jQuery -->
		<script src="assets2/js/jquery.min.js"></script>
		
		
		<!-- Datatables JS -->
		<script src="assets2/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets2/plugins/datatables/datatables.min.js"></script>



		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>