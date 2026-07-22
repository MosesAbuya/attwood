<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin - Patients' Consultation Report</title>
		
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
									<h3 class="mainTitle">Admin | Patients' Consultation Report</h3>
																	</div>
								
							</div>
						</section>
					
									<div class="card card-table">
							
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
								
<?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

?>
<h5 align="center" style="color:blue">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
	<div class="table-responsive">
<table class="table table-hover" id="sample-table-1">
<thead>
<tr>
<tr>
<th class="center">#</th>
<th>Account Name</th>
<th>Patient Name</th>
<th>Patient Gender</th>
<th>Patient Age </th>
<th>Health Complaint </th>
<th>Doctor Specilization</th>
<th>Consultation Mode</th>
<th>Assigned Date/Time</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php


$sql=mysqli_query($con,"select consultation.*,doctorspecilization.specilization,doctors.doctorName as doctorName, users.fullName as fullName from consultation join doctorspecilization on consultation.specialty=doctorspecilization.id join doctors on consultation.doctor=doctors.id join users on consultation.userid=users.id where date(postingDate) between '$fdate' and '$tdate'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

<tr>
<td class="center"><?php echo $cnt;?>.</td>
<td><?php echo $row['fullName'];?></td>
<td class="hidden-xs"><?php echo $row['name'];?></td>
<td><?php echo $row['gender'];?></td>

<td><?php echo $row['age'];?></td>
<td><?php echo $row['complaint'];?></td>
<td><?php echo $row['specilization'];?></td>
<td><?php echo $row['consultationmode'];?></td>
<td><?php echo $row['updationDate'];?></td>


<td>


<a href="view-patient.php?viewid=<?php echo $row['id'];?>" class="btn btn-sm bg-info-light">
											<i class="far fa-eye"></i> View
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
		<script src="assets2/js/jquery.min.js"></script>
		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>