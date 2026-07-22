<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $medicinename=$_POST['medicinename'];
    $quantity=$_POST['quantity'];
    $morning=$_POST['morning'];
    $afternoon=$_POST['afternoon'];
    $evening=$_POST['evening'];
    $night=$_POST['night'];
    $comments=$_POST['comments'];
  
   
 
      $query =mysqli_query($con, "insert  into tblprescription(consultationID,doctorid,medicinename,quantity,morning,afternoon,evening,night,comments) values('$vid','".$_SESSION['id']."','$medicinename','$quantity','$morning','$afternoon','$evening','$night','$comments')");
    if ($query) {
    echo '<script>alert("Prescription has been successifully submitted.")</script>';
    echo "<script>window.location.href ='consultation-details.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin - Patient Details</title>
		
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
									<h3 class="mainTitle">Admin | Patient Details</h3>
																	</div>
								
							</div>
						</section>
					
								<div class="card card-table">
								<div class="card-header">
								

								</div>
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
								<?php
                               $vid=$_GET['viewid'];

                               
                               $ret=mysqli_query($con,"select consultation.*,doctorspecilization.specilization from consultation join doctorspecilization on consultation.specialty=doctorspecilization.id where consultation.id='$vid'");
                               
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
    <th scope>Lab Report</th>
    <td><a href="postimages/<?php  echo $row['image'];?>" download="<?php  echo $row['image'];?>"><u>Download Lab Report</u></a></td>
  </tr>
  <tr>
    <th scope>Complaint</th>
    <td><?php  echo $row['complaint'];?></td>
    <th>Patient Age</th>
    <td><?php  echo $row['age'];?></td>
  </tr>
    <tr>
    <th>Patient Gender</th>
    <td><?php  echo $row['gender'];?></td>
     <th>Patient Reg Date</th>
    <td><?php  echo $row['postingDate'];?></td>
  </tr>
   <tr>
    <th>Patient Relationship</th>
    <td><?php  echo $row['patient'];?></td>
     <th>Other Relationship</th>
    <td><?php  echo $row['other'];?></td>
  </tr>
  <tr>
    <th>Doctor Specilization</th>
    <td><?php  echo $row['specilization'];?></td>
     <th>Complaint Details</th>
    <td><?php  echo $row['complainexplanation'];?></td>
  </tr>
   <tr>
    <th>Medical History</th>
    <td><?php  echo $row['history'];?></td>
     <th>Reported Allergies</th>
    <td><?php  echo $row['allergies'];?></td>
  </tr>
  <tr>
    <th>Current Medication</th>
    <td><?php  echo $row['currentmedication'];?></td>
     
  </tr>
 


</table>
</div>
 
<?php }?>

<?php  

$ret=mysqli_query($con,"select tblprescription.*, consultation.name as name from tblprescription join consultation on tblprescription.consultationID=consultation.id where consultation.userid='$vid'");



 ?>
 <div class="table-responsive">
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="8" style="color: blue" >Medical Prescriptions</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Medicine Name</th>
<th>Patient Name</th>
<th>Quantity</th>
<th>Time</th>
<th>Doctor Comments</th>
<th>Visit Date</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['medicinename'];?></td>
 <td><?php  echo $row['name'];?></td>
 <td><?php  echo $row['quantity'];?></td>
 <td><p><?php  echo $row['morning'];?></p><p><?php  echo $row['afternoon'];?></p><p><?php  echo $row['evening'];?></p><p><?php  echo $row['night'];?></p></td> 
  
  <td><?php  echo $row['comments'];?></td>
  <td><?php  echo $row['creationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
</div>

 

<?php  ?>
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