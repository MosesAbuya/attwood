<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
  {
    
   
    $appointmentTime=$_POST['appointmentTime'];
   $appointmentDate=$_POST['appointmentDate'];
    $weekday=$_POST['weekday'];
  
  
   
 
      $query =mysqli_query($con, "insert  into testtimings(appointmentDate,appointmentTime,weekday) values('$appointmentDate','$appointmentTime','$weekday')");
    if ($query) {
    

    //$_SESSION['msg']="Timing updated successfully !!";
     $msg="Timing updated successfully !!"; 
  
  }
  else
    {
      
      //$_SESSION['error']="Timing not updated successfully . Please try again.";
      $error="Timing not updated successfully . Please try again."; 
    }

  
}

?>


<?php

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from testtimings where id = '".$_GET['id']."'");
                
                  	 	 $error="Time slot deleted successfully !!";
		  }
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Hometiba</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets3/img/fav.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets2/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets2/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets2/css/feathericon.min.css">
		
		<link rel="stylesheet" href="assets2/plugins/morris/morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets2/css/style.css">


        <!-- Favicons -->
		<link href="assets2/img/fav.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets2/css2/bootstrap.min.css">

		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets2/css2/bootstrap-datetimepicker.min.css">
		
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets2/pluginss/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets2/pluginss/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets2/css2/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets3/js/html5shiv.min.js"></script>
			<script src="assets3/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<?php

include('include/header.php');
?>
			
					<?php

include('include/sidebar.php');
?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
                	<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h3 class="mainTitle">Admin | Schedule Timings</h3>
																	</div>
								
							</div>
						</section>
					
							<div class="container-fluid container-fullw bg-white">
							
							<div class="row">
								<div class="col-md-7 col-lg-8 col-xl-12">
						
							<div class="row">
								<div class="col-sm-12">

								

										<div class="card-body">
											
											<div class="profile-box">
												<div class="row">

													<div class="col-lg-4">
														
														<p><a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a></p>
													</div>
			<div class="col-sm-12">  										
<p style="color:blue;"><?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>
								<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?></p>	
								</div>
												</div>     
												
												<?php 
																		

$sql=mysqli_query($con,"select * from testtimings");

while($data=mysqli_fetch_array($sql))
{
?>
							<div class="row">
								<div class="col-md-12">
									<div class="card dash-card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														
														<div class="dash-widget-info">
															<h4><b>Day</b></h4>
															<p><i style="color: blue"><?php echo $data['weekday'];?></i></p>
														</div>
													</div>
												</div>
												
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														
														<div class="dash-widget-info">
															<h4><b>Appt Date/Time</h4></b>
															<p><?php echo $data['appointmentDate'];?> (<?php echo $data['appointmentTime'];?>)</p>
														</div>
													</div>
												</div>
												
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget">
														
														<div class="dash-widget-info">
															<h4><b>Action</b>
															</h4>


															
															
															<a href="schedule_tests_timings.php?id=<?php echo $data['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-sm bg-danger-light">
																				<i class="far fa-trash-alt"></i> Delete Slot
																			</a>
			
														</div>

													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
														
														<?php  }?>			
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
		
        	<!-- Add Time Slot Modal -->
		<div class="modal fade custom-modal" id="add_time_slot">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Time Slots</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form name="submit" method="post">
							<div class="hours-info">
								<div class="row form-row hours-cont">
									<div class="col-12 col-md-12">
										<div class="row form-row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Appointment Date</label>
													<div class="cal-icon">

													<input type="text" name="appointmentDate" class="form-control datetimepicker" value="CURDATE()">
														</div>
												</div> 
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Appointment Time</label>
													<input type="text" name="appointmentTime" placeholder="e.g 7.45 am" class="form-control">
														
												</div> 
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Select Day</label>
													<select name="weekday" class="form-control" required="true">
														<option>-</option>
														<option>Monday</option>
														<option>Tuesday</option>  
														<option>Wednesday</option>
														<option>Thursday</option>
														<option>Friday</option>
														<option>Saturday</option>
														<option>Sunday</option>
													</select>
												</div> 
											</div>
									
											







										</div>
										<div class="submit-section text-center">
								<button type="submit" name="submit" class="btn btn-primary submit-btn">Save Changes</button>
							</div>
									</div>
								
								</div>
								
							</div>
							
							
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Time Slot Modal -->


		<!-- Edit Time Slot Modal -->
		<div class="modal fade custom-modal" id="edit_time_slot">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Time Slots</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="hours-info">
								<div class="row form-row hours-cont">
									<div class="col-12 col-md-10">
										<div class="row form-row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Start Time</label>
													<select class="form-control">
														<option>-</option>
														<option selected>12.00 am</option>
														<option>12.30 am</option>  
														<option>1.00 am</option>
														<option>1.30 am</option>
													</select>
												</div> 
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>End Time</label>
													<select class="form-control">
														<option>-</option>
														<option>12.00 am</option>
														<option selected>12.30 am</option>  
														<option>1.00 am</option>
														<option>1.30 am</option>
													</select>
												</div> 
											</div>
										</div>
									</div>
								</div>
								
								<div class="row form-row hours-cont">
									<div class="col-12 col-md-10">
										<div class="row form-row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Start Time</label>
													<select class="form-control">
														<option>-</option>
														<option>12.00 am</option>
														<option selected>12.30 am</option>
														<option>1.00 am</option>
														<option>1.30 am</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>End Time</label>
													<select class="form-control">
														<option>-</option>
														<option>12.00 am</option>
														<option>12.30 am</option>
														<option selected>1.00 am</option>
														<option>1.30 am</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
								</div>
								
								<div class="row form-row hours-cont">
									<div class="col-12 col-md-10">
										<div class="row form-row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Start Time</label>
													<select class="form-control">
														<option>-</option>
														<option>12.00 am</option>
														<option>12.30 am</option>
														<option selected>1.00 am</option>
														<option>1.30 am</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>End Time</label>
													<select class="form-control">
														<option>-</option>
														<option>12.00 am</option>
														<option>12.30 am</option>
														<option>1.00 am</option>
														<option selected>1.30 am</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
								</div>

							</div>
							
							<div class="add-more mb-3">
								<a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
							</div>
							<div class="submit-section text-center">
								<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Time Slot Modal -->



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
		<script src="assets2/js2/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets2/js2/popper.min.js"></script>
		<script src="assets2/js2/bootstrap.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets2/js2/moment.min.js"></script>
		<script src="assets2/js2/bootstrap-datetimepicker.min.js"></script>
		
		
		<!-- Custom JS -->
		<script src="assets2/js2/script.js"></script>
		
	

	
		

		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>