<?php
session_start();
include('include/config.php');
error_reporting(0);
?>

<!doctype html>
<html>

<!-- restora/Pricing-table.html   11:53:27 GMT -->
<head>
<meta charset="utf-8">
<!--bootstrap-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="keywords" content="Attwood Travel Agency, Kenya safaris, African tours, holiday packages Kenya, travel agency Nairobi, affordable travel, luxury safari, East Africa tours, wildlife adventure, guided travel packages">
<meta name="description" content="Attwood Travel Agency Ltd offers tailor-made safari tours, luxury holiday packages, and affordable travel solutions across Kenya and East Africa. Discover unforgettable adventures with expert guidance.">

<title>Job Positions</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<!--favicon-->
<link rel="icon" href="img/fav.png" sizes="16x16">
<!--color-panel-->
<link href="css/jquery.colorpanel.css" rel="stylesheet">
<link href="css/skins-default.css" id="cpswitch" rel="stylesheet">
<!--Bootstrap-->
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
<!--logo-->
<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" />
<!--wow-->
<link href="css/animate.html" rel="stylesheet">
</head>

<body>
<!--Back-to-top-->
<div id="back-to-top">
  <a class="top arrow" href="#top"><i class="fa fa-long-arrow-up"></i></a>
</div>
<!--loader-->
<div id="loading">
  <div id="preloader"></div>
</div>

<!--color-panel-->
<div id="colorPanel" class="colorPanel"> <a id="cpToggle" href="#"></a>
  <ul>
    <li><a class="linka" href="css/skins-default.css" style="background-color: rgb(255, 87, 34);"></a></li>
  </ul>
</div>

<!--HEAD-->
<div id="wrapper"> 
  <?php include('include/header.php');?>

<section id="page-title" style="background: url('img/slider/slider-2.jpg') center center no-repeat; background-size: cover;">
  <div class="error-img text-center">
    <div class="error-img-black">
      <div class="container">
        <h2>Job Positions</h2>
        <p>Find Job</p>
        <span><a href="index.php">HOME</a>&nbsp; > <a href="#">The</a> > <b class="content-subhead">Jobs</b></span> </div>
    </div>
  </div>
</section>
  
  <!---TOP-->
  <div class="container padd-70">
    

      <!--TOP-->
  <div class="container padd-70">
    <div class="col-md-12 text-center events">
      <h2 class="content-subhead">Job Positions</h2>
      <p class="events-p">Dreams Global has offices in Toronto and Los Angeles. Each office conducts its own searches, which can change daily, and each office lists some of its job opportunities on the Internet (recruitment agencies in Canada) separately. Please note that we do not list all of our opportunities on the Internet, especially the senior-level positions, due to the fact that some assignments require a greater level of discretion and confidentiality than others.</p>
      <p class="event-info">We are very responsive to the needs and requirements of the clients we serve.We encourage you to submit your resume for consideration, even if you do not find the ideal position among our career job listings. There may be an opportunity for you that may be just right. Below you will find a listing of the types of searches we conduct on a regular basis. We focus exclusively on C-level, Senior and Middle Management positions within the hospitality industry.</p>
    </div>
    <div class="clearfix"></div>
  </div>
    <div class="col-md-12">
      <div class="row pricing">




      <?php 

$sql = "SELECT * from staff order by id asc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?> 


        <!--pricing column-->
        <div class="col-sm-4 col-md-4">
          <div class="plans-body text-center">
            
            <h3><?php echo htmlentities($result->BlogTitle);?></h3>
            <h2><?php echo htmlentities($result->BlogSubtitle);?></h2>
            <p><?php echo htmlentities($result->BlogContent);?></p>
            
            <a class="plan-btn btn-bg" href="#">Enquire Now</a> </div>
        </div>
        <!--pricing column-->
  
        <!--pricing column-->




 <?php }}?>


        <div class="clearfix"></div>
      </div>
    </div>
  </div>

  
<?php include('include/footer.php');?>


  <!--copyright column-->
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
<!--FAQ'S--> 
<script src="js/cookie.js"></script> 
<script src="js/jquery.accordion.js"></script> 
<script type="text/javascript">
        $(document).ready(function() {
            $('.accordion').accordion({defaultOpen: 'some_id'}); //some_id section1 in demo
        });
    </script> 
<!--WOW.js--> 
<script src="js/wow.min.html"></script> 
<script>
   new WOW().init();
</script> 
<!--client--> 
<script src="js/jquery.bxslider.min.js"></script> 
<script type="text/javascript">
$('.bxslider').bxSlider({
  minSlides: 2,
  maxSlides: 5,
  slideWidth: 234,
  auto:true
});
</script> 
<!--SLIDER--> 
<!-- mega menu --> 
<script type="text/javascript" src="js/mega_menu.js"></script> 
<!-- REVOLUTION JS FILES --> 
<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script> 
<!-- custom --> 
<script type="text/javascript" src="js/custom-slider.js"></script>

<script language="JavaScript">
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
</body>

<!-- restora/Pricing-table.html   11:53:27 GMT -->
</html>
