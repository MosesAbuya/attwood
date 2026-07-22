<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$id=intval($_GET['id']);// get doctor id
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$meaning=$_POST['meaning'];


$sql=mysqli_query($con,"Update daywords set name='$name',meaning='$meaning' where id='$id'");
if($sql)
{
$msg="Word updated Successfully";

}
}
?>
    
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Admin - Word</title>
		
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
		
			<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
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
									<h3 class="mainTitle">Admin | Edit Word </h3>
																	</div>
								
							</div>
						</section>
						<div class="card card-table">
								<div class="card-header">
									<h5 class="over-title margin-bottom-15" style="color: green">Edit Word <span class="text-bold"></span></h5>

								</div>
							<div class="card card-table">
							
								<div class="card-body">
									<div class="booking-doc-info">
																		<div class="col-md-7 col-lg-8 col-xl-12">
											<div class="panel panel-white">
													
												<div class="panel-body">
													<h5 style="color: green; font-size:18px; ">
<?php if($msg) { echo htmlentities($msg);}?> </h5>
								                                    <?php
                                    $id=intval($_GET['id']);
                                   


$sql=mysqli_query($con,"select * from daywords where id='$id'");


while($data=mysqli_fetch_array($sql))
   
{
?>

<p><b>Date Entered: </b><?php echo htmlentities($data['CreationDate']);?></p>
<?php if($data['updationDate']){?>
<p><b>Date Updated: </b><?php echo htmlentities($data['UpdationDate']);?></p>
<?php } ?>
<hr />
                                                    
                                                        <form role="form" name="adddoc" method="post" enctype="multipart/form-data">
                                                      

                                                        <div class="form-group">
                                                            <label for="title">
                                                                <b> Name</b>
                                                            </label>
    <input type="text" name="name" class="form-control" value="<?php echo htmlentities($data['name']);?>" >
                                                        </div>

                                                   

<div class="form-group">
                                                            


<div class="form-group">
                                                            <label for="blogcontent">
                                                               <b>Word Meaning</b>
                                                            </label>
                    <textarea name="meaning" rows="10" class="form-control"><?php echo htmlentities($data['meaning']);?></textarea>
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