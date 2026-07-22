<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets2/img/faviconnn.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets2/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets2/css/font-awesome.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="assets2/css/feathericon.min.css">

    <!-- Morris Chart CSS -->
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

    <!-- Header -->
    <?php include('include/header.php'); ?>
    <!-- /Header -->

    <!-- Sidebar -->
    <?php include('include/sidebar.php'); ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <!-- Doctors Count -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-primary border-primary">
                                    <i class="fe fe-user-plus"></i>
                                </span>
                                <?php
                                $result1 = mysqli_query($con, "SELECT * FROM adverts");
                                $num_rows1 = mysqli_num_rows($result1);
                                ?>
                                <div class="dash-count">
                                    <h3><?php echo htmlentities($num_rows1); ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Total Packages</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Words Count -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-success">
                                    <i class="fe fe-users"></i>
                                </span>
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM blog");
                                $num_rows = mysqli_num_rows($result);
                                ?>
                                <div class="dash-count">
                                    <h3><?php echo htmlentities($num_rows); ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Total Blogs</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- /row -->

        </div> <!-- /container-fluid -->

    </div> <!-- /page-wrapper -->

</div> <!-- /main-wrapper -->

<!-- Scripts -->
<script src="assets2/js/jquery-3.2.1.min.js"></script>
<script src="assets2/js/popper.min.js"></script>
<script src="assets2/js/bootstrap.min.js"></script>
<script src="assets2/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets2/plugins/raphael/raphael.min.js"></script>
<script src="assets2/plugins/morris/morris.min.js"></script>
<script src="assets2/js/chart.morris.js"></script>
<script src="assets2/js/script.js"></script>

</body>
</html>
