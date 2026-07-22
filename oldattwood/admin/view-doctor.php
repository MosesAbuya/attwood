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
        <title>Admin - View Doctor Details</title>
		
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
									<h3 class="mainTitle">Admin | View Doctor Details</h3>
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
								          <?php
                                    $id=intval($_GET['id']);
                                     
                                     $sql=mysqli_query($con,"select doctors.*,doctorspecilization.specilization from doctors join doctorspecilization on doctors.doctorspecilizationid=doctorspecilization.id where doctors.id='$id'");
while($data=mysqli_fetch_array($sql))
   
{
?>
<h4><?php echo htmlentities($data['doctorName']);?>'s Profile</h4>
<p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']);?></p>
<?php if($data['updationDate']){?>
<p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>
<?php } ?>
<hr />
                                                    
                                                        <form role="form" name="adddoc" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="doctorSpecialization">
                                                                Doctor Specialization
                                                            </label>
                            <select name="doctorspecialization" class="form-control" required="required" readonly>
                    <option value="<?php echo htmlentities($data['doctorspecilizationid']);?>">
                    <?php echo htmlentities($data['specilization']);?></option>
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
                                                            <label for="doctorname">
                                                                 Doctor Name
                                                            </label>
    <input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']);?>" readonly>
                                                        </div>


<div class="form-group">
                                                            <label for="address">
                                                                 Doctor Clinic Address
                                                            </label>
                    <textarea name="clinicaddress" readonly="" class="form-control"><?php echo htmlentities($data['address']);?></textarea>
                                                        </div>
<div class="form-group">
                                                            <label for="fess">
                                                                 Doctor Consultancy Fees
                                                            </label>
        <input type="text" name="docfees" class="form-control" required="required"  value="<?php echo htmlentities($data['docFees']);?>" readonly >
                                                        </div>
    
<div class="form-group">
                                    <label for="fess">
                                                                 Doctor Contact no
                                                            </label>
                    <input type="text" name="doccontact" class="form-control" required="required"  value="<?php echo htmlentities($data['contactno']);?>" readonly>
                                                        </div>

<div class="form-group">
                                    <label for="fess">
                                                                 Doctor Email
                                                            </label>
                    <input type="email" name="docemail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($data['docEmail']);?>" readonly>
                                                        </div>

             <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Current Image</b></h4>
<img src="postimages/<?php echo htmlentities($data['doctorsimage']);?>" width="150"/>


</div>
</div>
</div>

                                                        
                                                        <?php } ?>
                                                        
                                                        
                                                       
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