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
  
   
 
      $query =mysqli_query($con, "insert  into tblprescription(patientID,doctorid,medicinename,quantity,morning,afternoon,evening,night,comments) values('$vid','".$_SESSION['id']."','$medicinename','$quantity','$morning','$afternoon','$evening','$night','$comments')");
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
	<head>
		<title>Doctor | Manage Consultation</title>
		
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
<span>Manage Patient</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">

<?php
                               $vid=$_GET['viewid'];

                               
                               $ret=mysqli_query($con,"select consultation.*,doctorspecilization.specilization from consultation join doctorspecilization on consultation.specialty=doctorspecilization.id where consultation.id='$vid'");
                               
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
    <th scope>Lab Report</th>
    <td><a href="postimages/<?php  echo $row['image'];?>" download="<?php  echo $row['image'];?>">Download Lab Report</a></td>
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
 
<?php }?>

<?php  

$ret=mysqli_query($con,"select * from tblprescription where patientID='$vid'");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="8" >Medical Prescription</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Medicine Name</th>
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
 <td><?php  echo $row['quantity'];?></td>
 <td><?php  echo $row['morning'];?>,<?php  echo $row['afternoon'];?>,<?php  echo $row['evening'];?>,<?php  echo $row['night'];?></td> 
  
  <td><?php  echo $row['comments'];?></td>
  <td><?php  echo $row['creationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>

<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Add Medical Prescription</button></p>  

<?php  ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Medical Prescription</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                            <form method="post" name="submit">

      <tr>
    <th>Medicine Name :</th>
    <td>
    <input name="medicinename" placeholder="Medicine Name" class="form-control wd-450" required="true"></td>
  </tr>                          
     <tr>
    <th>Quantity :</th>
    <td>
    <input name="quantity" placeholder="In terms of tablets/teaspoons" class="form-control wd-450" required="true"></td>
  </tr> 
  
  <tr>
    <th>Time :</th>
    <td>
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label">
                                    <input class="form-check-input" name="morning" value="Morning" type="checkbox"> Morning
                                  </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <label class="form-check-label">
                                    <input class="form-check-input" name="afternoon" value="Afternoon" type="checkbox"> Afternoon
                                  </label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label">
                                    <input class="form-check-input" name="evening" value="Evening" type="checkbox"> Evening
                                  </label>
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <label class="form-check-label">
                                    <input class="form-check-input" name="night" value="Night" type="checkbox"> Night
                                  </label>
                                </div>
    </td>
  </tr>
                         
     <tr>
    <th>Doctor Comments :</th>
    <td>
    <textarea name="comments" placeholder="" rows="4" cols="4" class="form-control wd-450" required="true"></textarea></td>
  </tr>  
   
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  
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
