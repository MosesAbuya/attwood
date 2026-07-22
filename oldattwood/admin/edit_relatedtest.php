
<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$id=intval($_GET['id']);// get doctor id
if(isset($_POST['submit']))
{
$testnameID=$_POST['testname'];
$rname=$_POST['rname'];
$description=$_POST['description'];
$cost=$_POST['cost'];


$sql=mysqli_query($con,"Update relatedtest set testnameID='$testnameID', rname='$rname', description='$description', cost='$cost' where id='$id'");
if($sql)
{
$msg="Related Test Details Updated Successfully";

}
else{
$error="Related Test Details Not Successfully Updated";

}
}
?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin - Related Test</title>
		
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
									<h3 class="mainTitle">Admin | Edit Related Test</h3>
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
												                       <div class="row">
<div class="col-sm-12">  
<!---Success Message--->  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div> 
								           <?php
                                    $id=intval($_GET['id']);
                                   


$sql=mysqli_query($con,"select relatedtest.*,tests.testname from relatedtest join tests on relatedtest.testnameID=tests.id where relatedtest.id='$id'");


while($data=mysqli_fetch_array($sql))
   
{
?>

<p><b>Related Test Reg. Date: </b><?php echo htmlentities($data['creationDate']);?></p>
<?php if($data['updationDate']){?>
<p><b>Related Test Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>
<?php } ?>
<hr />
                                                    
                                                        <form role="form" name="adddoc" method="post">
                                                        <div class="form-group">
                                                            <label for="DoctorTest Name">
                                                              <strong>Test Name</strong>  
                                                            </label>
                            <select name="testname" class="form-control" required="required">
                    <option value="<?php echo htmlentities($data['testnameID']);?>">
                    <?php echo htmlentities($data['testname']);?></option>
<?php $ret=mysqli_query($con,"select * from tests");
while($row=mysqli_fetch_array($ret))
{
?>
                                                                <option value="<?php echo htmlentities($row['id']);?>">
                                                                    <?php echo htmlentities($row['testname']);?>
                                                                </option>
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>




                                                        <div class="form-group ">
 	<label for="fess">
																 <strong>Related Test Name</strong> 
															</label>

<input type="text" class="form-control" id="rname" name="rname" value="<?php echo htmlentities($data['rname']);?>" required>
</div>
                                                            


<div class="form-group">
                                                            <label for="address">
                                                               <strong>Description</strong> 
                                                            </label>
                    <textarea name="description" rows="5" class="form-control"><?php echo htmlentities($data['description']);?></textarea>
                                                        </div>


                                                       


                                                        <div class="form-group ">
 	<label for="fess">
																 <strong>Cost(Exclusive of Pick up Charges)</strong> 
															</label>

<input type="number" class="form-control" id="cost" name="cost" value="<?php echo htmlentities($data['cost']);?>" required>
</div>

    



     

                                                        
                                                        <?php } ?>
                                                        
                                                        <br>
                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                            Update
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