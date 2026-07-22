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
echo "<script>alert('Specialist Successfully Assigned');</script>";

}

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Manage Consultation</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

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
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Admin | Manage Patient Consultation</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Admin</span>
</li>
<li class="active">
<span>Manage Patients</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
<?php
                               $vid=$_GET['viewid'];

                               
                               $ret=mysqli_query($con,"select consultation.*,doctorspecilization.specilization,users.fullName as fullName from consultation join doctorspecilization on consultation.specialty=doctorspecilization.id join users on consultation.userid=users.id where consultation.id='$vid'");
                               
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
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
 <div class="form-group">
	<h3><center>Assign <i style="color: blue" ><?php  echo $row['name'];?> </i>to a Specific Doctor under <i style="color: blue" ><?php  echo $row['specilization'];?></i> Specialists.</center></h3>
</div>
<?php }?>
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
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
