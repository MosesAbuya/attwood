<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
	 $vid=$_GET['viewid'];
                               

$doctor=$_POST['doctor'];


$sql=mysqli_query($con,"Update consultation set doctor='$doctor' where id='$vid'");
if($sql)
{

$_SESSION['msg']="Specialist Successfully Assigned.";
}

}
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
					<script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'doctorspecilizationid='+val,
	success: function(data){
		$("#doctor").html(data);
	}
	});
}
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
									<h5 class="mainTitle">Admin | Assign Patient to a specific doctor</h5>
																	</div>
								
							</div>
						</section>
					
									<div class="row">
						<div class="col-12">
	
						
						
													<p style="color:blue;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>	
							
<?php
                               $vid=$_GET['viewid'];

                               
                               $ret=mysqli_query($con,"select consultation.*,doctorspecilization.specilization,users.fullName as fullName from consultation join doctorspecilization on consultation.specialty=doctorspecilization.id join users on consultation.userid=users.id where consultation.id='$vid'");
                               
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
    <th>M-Pesa Code</th>
    <td><?php  echo $row['mpesacode'];?></td>
     <th>Account Name</th>
    <td><?php  echo $row['fullName'];?></td>
  </tr>
  <tr>
    <th>Current Medication</th>
    <td><?php  echo $row['currentmedication'];?></td>
     <th>Lab Report</th>
    <td><a href="postimages/<?php  echo $row['image'];?>" download="<?php  echo $row['image'];?>">Download</a></td>
  </tr>
 


</table>
</div>
 <div class="form-group">
<br>
 	<div class="alert alert-warning alert-dismissible fade show" role="alert">
										
	<h5><center>Assign <i style="color: blue" ><?php  echo $row['name'];?> </i>to a Specific Doctor under <i style="color: blue" ><?php  echo $row['specilization'];?></i> Specialists.</center></h5>
	</div>
</div>
<?php }?>
	<div class="card">
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
<form role="form" method="post" >
<div class="form-group">
<label for="DoctorSpecialization">
																Doctor Specialization
															</label>
							<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
																<option value="">Select Specialization</option>
<?php $ret=mysqli_query($con,"select * from doctorspecilization");
while($row=mysqli_fetch_array($ret))
{
?>
																<option value="<?php echo htmlentities($row['id']);?>">
																	<?php echo htmlentities($row['specilization']);?>
																</option>
																<?php } ?>
																
															</select>
														</div>




														<div class="form-group">
															<label for="doctor">
																Doctors
															</label>
						<select name="doctor" class="form-control" id="doctor" required="required">
						<option value="">Select Doctor</option>
						</select>
						
														</div>
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