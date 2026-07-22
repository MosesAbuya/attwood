<?php
session_start();
include('include/config.php');
error_reporting(0);
?>

<!doctype html>
<html>

<!-- restora/event.html   11:53:18 GMT -->
<head>
<meta charset="utf-8">
<!--bootstrap-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="keywords" content="Attwood Travel Agency, Kenya safaris, African tours, holiday packages Kenya, travel agency Nairobi, affordable travel, luxury safari, East Africa tours, wildlife adventure, guided travel packages">
<meta name="description" content="Attwood Travel Agency Ltd offers tailor-made safari tours, luxury holiday packages, and affordable travel solutions across Kenya and East Africa. Discover unforgettable adventures with expert guidance.">

<title>Our Blog</title>
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
<!--TILT-EFFECT-->
<link href="css/tilt.css" rel="stylesheet" type="text/css">

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

<section id="page-title" style="background: url('img/murchison3.jpg') center center no-repeat; background-size: cover;">
  <div class="story-head text-center">
    <div class="story-head-black">
      <div class="container">
        <h2>Our Blogs</h2>
        <p>Make People Fullfill their dreams!</p>
        <span><a href="index.php">HOME</a> > <a href="#">Our Blogs</a> > <b class="content-subhead">Welcome</b></span> </div>
    </div>
  </div>
</section>
  
  <!--TOP-->
  <div class="container padd-70">
    <div class="col-md-12 text-center events">
      <h2 class="content-subhead">Our Blogs</h2>
 
     
    </div>
    
  </div>
  
  
  
<div style="font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h2 style="text-align: center; margin-bottom: 30px; font-size: 36px; color: #333;">Our Featured Safari Packages</h2>
    
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
      <!-- Safari Package 1 -->



<?php 
$query = mysqli_query($con, "SELECT * FROM blog");

while ($row = mysqli_fetch_array($query)) {
?>


      
      <div style="flex: 1; min-width: 250px; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <!-- Fixed size container for the image -->
    <div style="width: 100%; height: 200px; overflow: hidden;">
        <img src="admin/postimages/<?php echo htmlentities($row['simage']); ?>" alt="The Rare Five Northern Kenya Safari" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div style="padding: 15px; text-align: center;">
        <h3 style="color: #8B4513; margin-bottom: 15px; font-size: 20px;"><?php echo htmlentities($row['title']); ?></h3>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <a href="blog-detail.php?id=<?php echo urlencode($row['id']); ?>" style="background-color: skyblue; color: white; padding: 10px 0; text-decoration: none; border-radius: 4px; font-weight: bold;">READ MORE</a>
        </div>
    </div>
</div>
      
  

<?php } ?>




      </div>
  </div>

  
 
  
<?php include('include/footer.php');?>


  <div class="container-fluid footer-pay-bg">
    <div class="container" style="padding-top:20px; padding-bottom:20px;">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 footer-pay-p">
          <p>©2025 <b class="content-subhead">Attwood</b>. All Rights Reserved.</p>
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
<!--TILT EFFECT---> 
<script src="js/imagesloaded.pkgd.min.js"></script> 
<script src="js/main.js"></script> 
<script>
(function() {
			var tiltSettings = [
			{},
			
			];

			function init() {
				var idx = 0;
				[].slice.call(document.querySelectorAll('a.tilter')).forEach(function(el, pos) { 
					idx = pos%2 === 0 ? idx+1 : idx;
					new TiltFx(el, tiltSettings[idx-1]);
				});
			}

			// Preload all images.
			imagesLoaded(document.querySelector('main'), function() {
				document.body.classList.remove('loading');
				init();
			});

			// REMOVE THIS!
			// For Demo purposes only. Prevent the click event.
			[].slice.call(document.querySelectorAll('a[href="#"]')).forEach(function(el) {
				el.addEventListener('click', function(ev) { ev.preventDefault(); });
			});

			var pater = document.querySelector('.pater'),
				paterSVG = pater.querySelector('.pater__svg'),
				pathEl = paterSVG.querySelector('path'),
				paths = {default: pathEl.getAttribute('d'), active: paterSVG.getAttribute('data-path-hover')};

			pater.addEventListener('mouseenter', function() {
				anime.remove(pathEl);
				anime({
					targets: pathEl,
					d: paths.active,
					duration: 400,
					easing: 'easeOutQuad'
				});
			});

			pater.addEventListener('mouseleave', function() {
				anime.remove(pathEl);
				anime({
					targets: pathEl,
					d: paths.default,
					duration: 400,
					easing: 'easeOutExpo'
				});
			});
		})();
</script>
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

<!-- restora/event.html   11:53:25 GMT -->
</html>
