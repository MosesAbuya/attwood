<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from consultation where id = '".$_GET['id']."'");
                  $_SESSION['msg']="Transaction deleted successfully !!";
		  }
else

if(isset($_GET['cancel']))
	{

mysqli_query($con,"update consultation set Status='1' where id ='".$_GET['vid']."'");
         

if($sql)
{
$_SESSION="Transaction successfully marked unpaid";	
}


}

if (isset($_GET['cancel'])) {
	# code...
	mysqli_query($con,"update consultation set Status='2' where id ='".$_GET['vvid']."'");
if($sql)
{

	$_SESSION="Transaction successfully marked paid";
}
}


 ?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin - View Patients' Consultations</title>
		
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
									<h3 class="mainTitle">Admin | View Patients' Consultations</h3>
																	</div>
								
							</div>
						</section>
					
								<div class="card card-table">
								<div class="card-header">
									<h5 class="over-title margin-bottom-15" style="color: green">Manage <span class="text-bold">Patients Consultations</span></h5>

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

<th>Account Name</th>
<th>Patient Gender</th>



<th>Doctor Specilization</th>
<th>Payment Status</th>
<th>Confirm Payment</th>
<th>Member Since </th>
<th>Doctor assignmt<br>Date/Time</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php


$sql=mysqli_query($con,"select consultation.*,doctorspecilization.specilization,users.fullName as fullName from consultation join doctorspecilization on consultation.specialty=doctorspecilization.id join users on consultation.userid=users.id");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<tr>
<td class="center"><?php echo $cnt;?>.</td>
<td>
<?php echo $row['name'];?></td>

<td><?php echo $row['fullName'];?></td>


<td><?php echo $row['gender'];?></td>

<td><?php echo $row['specilization'];?></td>
<td><span class="badge badge-pill bg-warning-light">
	<?php 
if($row['Status']==0)

{
echo "Not yet Confirmed";

} 
else if ($row['Status']==1)  
{
echo "Paid";
}
 else
 {
 	echo "Unpaid";
 }
										?>
											








										</span></td>

																<td><a href="consultations.php?vid=<?php echo $row['id']?>&cancel=update" onclick="return confirm('Do you really want to Confirm this Payment')"><span class="badge badge-pill bg-info-light">Paid</span></a> /


<a href="consultations.php?vvid=<?php echo $row['id']?>&cancel=update"  onclick="return confirm('Do you really want to Cancel this Payment')"> <span class="badge badge-pill bg-danger-light">Unpaid</span></a>
</td>
<td><?php echo $row['postingDate'];?></td>
<td><?php echo $row['updationDate'];?>
</td>
<td>



<a href="view-consultation.php?viewid=<?php echo $row['id'];?>" class="btn btn-sm bg-info-light">
											<i class="far fa-eye"></i> View
										</a>

<a href="consultations.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm bg-danger-light">
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