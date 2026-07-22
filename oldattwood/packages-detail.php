<?php
session_start();
include('include/config.php');
error_reporting(0);
?>


<!doctype html>
<html>

<!-- restora/blog.html   11:53:03 GMT -->
<head>
<meta charset="utf-8">
<!--bootstrap-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Tour Packages</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<!--favicon-->
<link rel="icon" href="img/fav.png" sizes="16x16">
<!--color-panel-->
<link href="css/jquery.colorpanel.css" rel="stylesheet">
<link href="css/skins-default.css" id="cpswitch" rel="stylesheet">
<!--bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="font/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--Font-online-->
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<!--SLIDER-->
<!--mega menu-->
<link rel="stylesheet" type="text/css" href="css/mega_menu.css" />
<!--revolution slider-->
<link rel="stylesheet" type="text/css" href="css/settings.css">
<link rel="stylesheet" type="text/css" href="css/navigation.css">
<!--main style-->
<link rel="stylesheet" type="text/css" href="css/slider.css" />
<!--responsive-->
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<!--Flat-icon-->
<link href="font/font/flaticon.css" rel="stylesheet" type="text/css">
<!--wow-->
<link href="css/animate.html" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



 <style>
    .social-sidebar {
      position: fixed;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      gap: 15px;
      padding: 10px;
      z-index: 1000;
    }

    .social-sidebar a {
      background: #fff;
      color: red;
      padding: 10px;
      border-radius: 50%;
      text-align: center;
      font-size: 20px;
      width: 40px;
      height: 40px;
      line-height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .social-sidebar a:hover {
      background: red;
      color: #fff;
    }
  </style>
</head>

<body>
<!--Back-to-top-->
<div id="back-to-top">
  <a class="top arrow" href="#top"><i class="fa fa-long-arrow-up"></i></a>
</div>
<!--loader-->


<!--color-panel-->
<div id="colorPanel" class="colorPanel"> <a id="cpToggle" href="#"></a>
  <ul>
    <li><a class="linka" href="css/skins-default.css" style="background-color: rgb(255, 87, 34);"></a></li>
  </ul>
</div>

<!--HEAD-->

<div id="wrapper"> 
  
<?php include('include/header.php');?>


  <section id="page-title" style="background: url('img/ke3.jpg') center center no-repeat; background-size: cover;">
  <div class="story-head text-center">
    <div class="story-head-black">
      <div class="container">
        <h2>Packages Details</h2>
        <p>Make People Fullfill their dreams!</p>
        <span><a href="index.php">HOME</a> > <a href="#">Packages</a> > <b class="content-subhead">Welcome</b></span> </div>
    </div>
  </div>
</section>
  
  <!--TOP-->
  <div class="container"> 
    <!--Left-column-->
    
    <div class="col-xs-12 col-sm-12 col-md-8 padd-70">


<?php 
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input

    $query = mysqli_query($con, "SELECT * FROM adverts WHERE id = $id");

    if ($row = mysqli_fetch_array($query)) {
        // Display the blog content below
    } else {
        echo "<p>Blog post not found.</p>";
    }
} else {
    echo "<p>Invalid blog post.</p>";
}
?>

<?php if (isset($row)) { ?>
  <div class="article">
    <div class="article-img wow animated fadeInDown">
      <img src="admin/postimages/<?php echo htmlentities($row['simage']); ?>" class="img-responsive" />
    </div>

    <div>
      <h3><?php echo htmlentities($row['title']); ?></h3>

      <p class="article-body-span" style="margin-right:0; margin-top:15px;">

      <?php echo html_entity_decode($row['subtitle']); ?>
        
      <?php echo html_entity_decode($row['blogcontent']); ?>
      </p>

      <a class="article-read btn-bg" href="contactus.php" style="background-color: red; color: white;">Submit Quotation</a>


      <div class="blog-social">
        <ul>
          <li><a href="#"><i class="fa fa-share"></i></a>
            <ul class="wow animated fadeInRight">
              <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
<?php } ?>


      <div class="divider"></div>
      
      
   
 
     
   
    </div>
    
    <!--Right-column-->
    
    <div class="col-xs-12 col-sm-12 col-md-4 padd-70">
      <div class="col-md-12">
        <div class="categories">
          <h3 class="content-subhead">Other Packages</h3>
          <span></span>


         <?php 
$query = mysqli_query($con, "SELECT * FROM adverts");

while ($row = mysqli_fetch_array($query)) {
?>
          <ul>



            <li><a href="packages-detail.php?id=<?php echo urlencode($row['id']); ?>"><i class="fa fa-angle-right content-subhead" aria-hidden="true"></i>&nbsp; <?php echo htmlentities($row['title']); ?></a></li>
        
          </ul>


          <?php } ?>
        </div>
      </div>
      <div class="clearfix"></div>
     
     
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
  
<?php include('include/footer.php');?>

  <div class="container-fluid footer-pay-bg">
    <div class="container" style="padding-top:20px; padding-bottom:20px;">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 footer-pay-p">
          <p>©2017 <b class="content-subhead">Restora</b>. All Rights Reserved.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 text-center">
          <div class="payment">
            <p class="payment-p">Payment acceptable on</p>
            <img src="img/pay-1.png" /> <img src="img/pay-2.png" /> <img src="img/pay-3.png" /> <img src="img/pay-4.png" /> <img src="img/pay-5.png" /> </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!--color-panel--> 

<!--Ajax--> 
<script src="js/ajax.js"></script> 
<script src="js/bootstrap.min.js" type="text/javascript"></script> 
<!--COLOR-PANEL--> 
<script src="js/jquery.colorpanel.js"></script> 
<script>
 $('#colorPanel').ColorPanel({
            styleSheet: '#cpswitch'
            , animateContainer: '#wrapper'
            , colors: {
                '#c62828': 'css/skins-pink.css'
                , '#f9a825': 'css/skins-seagreen.css'
        
               
            , }
      
        });
 </script> 
<!--WOW.js--> 
<script src="js/wow.min.html"></script> 
<script>
   new WOW().init();
</script> 
<!--SLIDER--> 
<!-- mega menu --> 
<script type="text/javascript" src="js/mega_menu.js"></script> 
<!-- REVOLUTION JS FILES --> 
<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script> 
<!-- custom --> 
<script type="text/javascript" src="js/custom-slider.js"></script>

<script language=JavaScript>
<!--

var message="";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false")
// --> 
</script>

 <div class="social-sidebar">
    <a href="https://www.facebook.com/share/16HsWzXEFA/" target="_blank" title="Like us on Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://twitter.com" target="_blank" title="Follow us on Twitter">
      <i class="fab fa-twitter"></i>
    </a>
    <a href="https://www.tiktok.com/@attwood.travel.ag?_t=ZM-8vpXR0XV1Fv&_r=1" target="_blank" title="Follow us on TikTok">
      <i class="fab fa-tiktok"></i>
    </a>
    <a href="https://www.instagram.com" target="_blank" title="Follow us on Instagram">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="https://youtube.com/@attwoodtravelagency?si=VOHN3kgplOr99cFF" target="_blank" title="Subscribe on YouTube">
      <i class="fab fa-youtube"></i>
    </a>
    <a href="https://www.linkedin.com/in/attwood-travel-agency-6a7978357" target="_blank" title="Connect on LinkedIn">
      <i class="fab fa-linkedin-in"></i>
    </a>
  </div>

</body>

<!-- restora/blog.html   11:53:17 GMT -->
</html>
