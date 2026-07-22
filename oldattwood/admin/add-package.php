<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit'])) {
    // Get form data
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
    $blogcontent = mysqli_real_escape_string($con, $_POST['blogcontent']);

    // Image upload handling
    $imgfile = $_FILES["simage"]["name"];
    $extension = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION));
    
    // Allowed extensions
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    
    if(!in_array($extension, $allowed_extensions)) {
        $_SESSION['error'] = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
    } else {
        // Rename the image file
        $imgnewfile = md5($imgfile) . "." . $extension;
        
        // Move image into directory
        if(move_uploaded_file($_FILES["simage"]["tmp_name"], "postimages/" . $imgnewfile)) {
            
            // Insert data into database
            $sql = "INSERT INTO adverts(title, subtitle, blogcontent, simage) VALUES ('$title', '$subtitle', '$blogcontent', '$imgnewfile')";
            $result = mysqli_query($con, $sql);
            
            if($result) {
                $_SESSION['msg'] = "Advert added successfully!";
                // Redirect to prevent form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $_SESSION['error'] = "Database Error: " . mysqli_error($con);
            }
        } else {
            $_SESSION['error'] = "Error uploading image. Please check permissions.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin - Advert</title>
    
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
    
    <!-- Simple editor styles -->
    <style>
        .simple-editor {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 300px;
            background-color: #fff;
            overflow-y: auto;
            margin-bottom: 10px;
        }
        .editor-toolbar {
            background-color: #f1f1f1;
            padding: 5px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
        }
        .editor-toolbar button {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px 10px;
            margin-right: 2px;
            cursor: pointer;
        }
        .editor-toolbar button:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <?php include('include/header.php'); ?>
        
        <!-- Sidebar -->
        <?php include('include/sidebar.php'); ?>
        <!-- /Sidebar -->
        
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="mainTitle">Admin | Add Package</h3>
                        </div>
                    </div>
                </section>
                
                <div class="card card-table">
                    <div class="card-body">
                        <div class="booking-doc-info">
                            <div class="col-md-7 col-lg-8 col-xl-12">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <!-- Messages -->
                                        <?php if(isset($_SESSION['msg'])) { ?>
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <?php echo htmlentities($_SESSION['msg']); $_SESSION['msg'] = ""; ?>
                                            </div>
                                        <?php } ?>
                                        
                                        <?php if(isset($_SESSION['error'])) { ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <?php echo htmlentities($_SESSION['error']); $_SESSION['error'] = ""; ?>
                                            </div>
                                        <?php } ?>
                                        
                                        <!-- Form -->
                                        <form role="form" name="adddoc" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="title">Package Title</label>
                                                <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="subtitle">Package Sub Title</label>
                                                <input type="text" name="subtitle" class="form-control" placeholder="Enter Sub Title (20-30 words)" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="blogcontent">Package Content</label>
                                                
                                                <!-- Simple Editor Toolbar -->
                                                <div class="editor-toolbar">
                                                    <button type="button" onclick="formatDoc('bold')"><i class="fa fa-bold"></i></button>
                                                    <button type="button" onclick="formatDoc('italic')"><i class="fa fa-italic"></i></button>
                                                    <button type="button" onclick="formatDoc('underline')"><i class="fa fa-underline"></i></button>
                                                    <button type="button" onclick="formatDoc('formatBlock', 'h1')">H1</button>
                                                    <button type="button" onclick="formatDoc('formatBlock', 'h2')">H2</button>
                                                    <button type="button" onclick="formatDoc('insertUnorderedList')"><i class="fa fa-list-ul"></i></button>
                                                    <button type="button" onclick="formatDoc('insertOrderedList')"><i class="fa fa-list-ol"></i></button>
                                                    <button type="button" onclick="formatDoc('justifyLeft')"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" onclick="formatDoc('justifyCenter')"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" onclick="formatDoc('justifyRight')"><i class="fa fa-align-right"></i></button>
                                                    <button type="button" onclick="addLink()"><i class="fa fa-link"></i></button>
                                                </div>
                                                
                                                <!-- Editable Content Area -->
                                                <div id="editor" class="simple-editor" contenteditable="true"></div>
                                                
                                                <!-- Hidden textarea to store HTML content -->
                                                <textarea id="blogcontent" name="blogcontent" style="display:none"></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="simage">Advert Image</label>
                                                <input type="file" class="form-control" id="simage" name="simage" required>
                                            </div>
                                            
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">
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
    <script src="assets2/js/script.js"></script>
    
    <!-- Simple editor script -->
    <script>
        // Format document functions
        function formatDoc(command, value = null) {
            document.execCommand(command, false, value);
            document.getElementById('editor').focus();
        }
        
        // Add link function
        function addLink() {
            var url = prompt('Enter the URL');
            if (url) {
                document.execCommand('createLink', false, url);
            }
        }
        
        // Update hidden textarea before form submission
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form[name="adddoc"]').addEventListener('submit', function() {
                document.getElementById('blogcontent').value = document.getElementById('editor').innerHTML;
                return true;
            });
            
            // Ensure sidebar is properly initialized
            if (typeof initializeSidebar === 'function') {
                initializeSidebar();
            }
        });
    </script>
</body>
</html>