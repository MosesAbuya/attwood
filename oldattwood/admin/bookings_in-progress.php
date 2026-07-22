<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from testbooking where id = '".$_GET['id']."'");
                  $_SESSION['msg']="Test Booking deleted successfully !!";
		  }
else

if(isset($_GET['cancel']))
	{

mysqli_query($con,"update testbooking set Status='1' where id ='".$_GET['vid']."'");
         

if($sql)
{
$_SESSION="Test Booking Successfully Marked In-progress";	
}


}

if (isset($_GET['cancel'])) {
	# code...
	mysqli_query($con,"update testbooking set Status='2' where id ='".$_GET['vvid']."'");
if($sql)
{

	$_SESSION="Test Booking Successfully Marked Completed";
}
}


 ?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
           <title>Admin - Test Bookings</title>
		
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
              <?php include('include/sidebar.php');?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
                	<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
								<h3 class="mainTitle">Admin | Test Bookings</h3>			</div>
								
							</div>
						</section>
					
								<div class="card card-table">
								<div class="card-header">
									<h5 class="over-title margin-bottom-15" style="color: green">Manage <span class="text-bold">Bookings In-progress</span></h5>

								</div>
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
							<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>		
								<div class="table-responsive">
<table class="table table-hover" id="sample-table-1">
<thead>
<tr>
<th class="center">#</th>
<th>Patient Name</th>

<th>Patient Email</th>
<th>Test Name</th>
<th><center>Related<br>Test Name</center></th>
<th>Quantity</th>
<th>Amount</th>
<th><center>Test Booking<br>Date/Time</center></th>
<th><center>Test<br>Booking Status</center></th>
<th><center>Confirm<br>Test Booking</center></th>
<th><center>Action</center></th>
</tr>
</thead>
<tbody>
<?php


$sql=mysqli_query($con,"select testbooking.*,medicaltestusers.name,medicaltestusers.email,relatedtest.testnameID,tests.testname from testbooking join medicaltestusers on testbooking.email=medicaltestusers.email join relatedtest on testbooking.rname=relatedtest.rname join tests on relatedtest.testnameID=tests.id where testbooking.Status='2' order by testbooking.bookingDate DESC");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<tr>
<td class="center"><?php echo $cnt;?>.</td>
<td>
<?php echo $row['name'];?></td>

<td><?php echo $row['email'];?></td>
<td><?php echo $row['testname'];?></td>
<td><?php echo $row['rname'];?></td>
<td><?php echo $row['quantity'];?></td>

<td><?php echo $row['subtotal'];?></td>
<td><?php echo $row['bookingDate'];?></td>
<td><span class="badge badge-pill bg-warning-light">
	<?php 
if($row['Status']==0)

{
echo "Not yet Confirmed";

} 
else if ($row['Status']==1)  
{
echo "Completed";
}
 else
 {
 	echo "In-progress";
 }
										?>									

										</span></td>

																<td><a href="bookings_in-progress.php?vid=<?php echo $row['id']?>&cancel=update" onclick="return confirm('Mark this testbooking as completed?')"><span class="badge badge-pill bg-info-light">Completed</span></a> /


<a href="bookings_in-progress.php?vvid=<?php echo $row['id']?>&cancel=update" onclick="return confirm('Mark this testbooking as In-progress?')"> <span class="badge badge-pill bg-danger-light">In-progress</span></a>
</td>

<td>



<a href="view_test_booking.php?viewid=<?php echo $row['id'];?>" class="btn btn-sm bg-info-light">
											<i class="far fa-eye"></i> View
										</a>

<a href="bookings_in-progress.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm bg-danger-light">
																				<i class="far fa-trash-alt"></i> Delete
																			</a>

</td>
</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
</table>
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


			<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>



			<!-- jQuery -->
		<script src="assets2/js/jquery.min.js"></script>
		
		



		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>