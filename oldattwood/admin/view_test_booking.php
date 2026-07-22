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
        <title>Admin - Manage Consultation</title>
		
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
              <?php include('include/sidebar.php');?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
                	<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h5 class="mainTitle">Admin | View Test Booking</h5>
																	</div>
								
							</div>
						</section>
					
									<div class="row">
						<div class="col-12">
	
						
							
										
													
											
													<p style="color:blue;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>	
							
<?php
                               $vid=$_GET['viewid'];

                               
$ret=mysqli_query($con,"select testbooking.*,medicaltestusers.name,medicaltestusers.email,medicaltestusers.name,medicaltestusers.gender,medicaltestusers.age,separatepayments.location,separatepayments.residence,separatepayments.sampledate,separatepayments.creationDate,separatepayments.sampletime,separatepayments.mpesacode,medicaltestusers.mobileno,relatedtest.testnameID,tests.testname, tblcity.cityname from testbooking join medicaltestusers on testbooking.email=medicaltestusers.email join relatedtest on testbooking.rname=relatedtest.rname join tests on relatedtest.testnameID=tests.id join separatepayments on testbooking.email=separatepayments.email join tblcity on separatepayments.location=tblcity.id where testbooking.id='$vid' ORDER BY separatepayments.creationDate DESC");

                               
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<div class="table-responsive">

<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
 Patient Details</td></tr>



    <tr>
    <th scope>Patient Name</th>
    <td><?php  echo $row['name'];?></td>
    <th scope>Patient Email</th>
    <td><?php  echo $row['email'];?></td>
  </tr>
  <tr>
    <th scope>Test Name</th>
    <td><?php  echo $row['testname'];?></td>
    <th>Related TestName</th>
    <td><?php  echo $row['rname'];?></td>
  </tr>
    <tr>
    <th>Patient Gender</th>
    <td><?php  echo $row['gender'];?></td>
     <th>Patient Age</th>
    <td><?php  echo $row['age'];?></td>
  </tr>
   <tr>
    <th>City</th>
    <td><?php  echo $row['cityname'];?></td>
     <th>Specific Location</th>
    <td><?php  echo $row['residence'];?></td>
  </tr>
  <tr>
    <th>Sample CollectionDate</th>
    <td><?php  echo $row['sampledate'];?></td>
     <th>Sample CollectionTime</th>
    <td><?php  echo $row['sampletime'];?></td>
  </tr>  
  <tr>
    <th>M-Pesa Code</th>
    <td><?php  echo $row['mpesacode'];?></td>
     <th>Booking Date</th>
    <td><?php  echo $row['creationDate'];?></td>
  </tr>
   <tr>
    <th>Patient MobileNo.</th>
    <td><?php  echo $row['mobileno'];?></td>
     <th></th>
    <td></td>
  </tr>
 
 


</table>
</div>

<?php }?>
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