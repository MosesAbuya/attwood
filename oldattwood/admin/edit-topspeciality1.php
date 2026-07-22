<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$id=intval($_GET['id']);// get doctor id
if(isset($_POST['submit']))
{
$doctorspecilizationid=$_POST['specilization'];
$description=$_POST['description'];

$sql=mysqli_query($con,"Update topspeciality set doctorspecilizationid='$doctorspecilizationid',description='$description' where id='$id'");
if($sql)
{
$msg="Top Speciality Details updated Successfully";

}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin | Edit Top Speciality Details</title>
        
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


    </head>
    <body>
        <div id="app">      
<?php include('include/sidebar.php');?>
            <div class="app-content">
                
                        <?php include('include/header.php');?>
                        <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
                    
                <!-- end: TOP NAVBAR -->
                <div class="main-content" >
                    <div class="wrap-content container" id="container">
                        <!-- start: PAGE TITLE -->
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Admin | Edit Top Speciality Details</h1>
                                                                    </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin</span>
                                    </li>
                                    <li class="active">
                                        <span>Edit Top Speciality Details</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <!-- end: PAGE TITLE -->
                        <!-- start: BASIC EXAMPLE -->
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: green; font-size:18px; ">
<?php if($msg) { echo htmlentities($msg);}?> </h5>
                                    <div class="row margin-top-30">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Edit Top Speciality info</h5>
                                                </div>
                                                <div class="panel-body">
                                    <?php
                                    $id=intval($_GET['id']);
                                   


$sql=mysqli_query($con,"select topspeciality.*,doctorspecilization.specilization from topspeciality join doctorspecilization on topspeciality.doctorspecilizationid=doctorspecilization.id where topspeciality.id='$id'");


while($data=mysqli_fetch_array($sql))
   
{
?>

<p><b>TopSpeciality Reg. Date: </b><?php echo htmlentities($data['creationDate']);?></p>
<?php if($data['updationDate']){?>
<p><b>TopSpeciality Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>
<?php } ?>
<hr />
                                                    
                                                        <form role="form" name="adddoc" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="DoctorSpecialization">
                                                                Specialization
                                                            </label>
                            <select name="specilization" class="form-control" required="required">
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
                                                            


<div class="form-group">
                                                            <label for="address">
                                                                Description
                                                            </label>
                    <textarea name="description" class="form-control"><?php echo htmlentities($data['description']);?></textarea>
                                                        </div>

    



             <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Post Image</b></h4>
<img src="postimages/<?php echo htmlentities($data['simage']);?>" width="150"/>
<br /> <br />
<a href="changetopspecialityimage.php?id=<?php echo htmlentities($data['id']);?>">Update Image</a>
</div>
</div>
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
                                    <div class="col-lg-12 col-md-12">
                                            <div class="panel panel-white">
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: BASIC EXAMPLE -->
            
                    
                    
                        
                        
                    
                        <!-- end: SELECT BOXES -->
                        
                    </div>
                </div>
            </div>
            <!-- start: FOOTER -->
    <?php include('include/footer.php');?>
            <!-- end: FOOTER -->
        
            <!-- start: SETTINGS -->
    <?php include('include/setting.php');?>
            <>
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
