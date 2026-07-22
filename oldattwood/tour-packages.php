<?php
session_start();
include('include/config.php');
error_reporting(0);
?>

<!doctype html>
<html>

<!-- restora/Recipes.html   11:53:25 GMT -->
<head>
<meta charset="utf-8">
<!--bootstrap-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Recipes</title>
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
<!--wow-->
<link href="css/animate.html" rel="stylesheet">
<!--TILT-EFFECT-->
<link href="css/tilt.css" rel="stylesheet" type="text/css">
<!--MENU-GALLERY-->
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/menu-gallery.css" />
<link rel="stylesheet" type="text/css" href="css/recipe-gallery.css" />
<script src="js/modernizr.custom.js"></script>


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
<!--HISTORY-SLIDER--->

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

 
 <section id="page-title" style="background: url('img/slider/slide6.jpg') center center no-repeat; background-size: cover;">
  <div class="story-head text-center">
    <div class="story-head-black">
      <div class="container">
        <h2>Tour Packages</h2>
        <p>Make People Fullfill their dreams!</p>
        <span><a href="index.php">HOME</a> > <a href="index.php">The Packages</a> > <b class="content-subhead">Packages</b></span> </div>
    </div>
  </div>
</section>
  
  <!--CONTENT-SLIDER-->
  <div class="container-fluid">
    <div class="container padd-70"> 
      <!-- title column-->
      <div class="col-md-12 text-center slider-2">
       
        
        <h2 class="content-subhead">Tour Packages</h2>
       
        <span class="contact-underline"></span> </div>
      <div class="clearfix"></div>
  
  <div style="font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h2 style="text-align: center; margin-bottom: 30px; font-size: 36px; color: red;">Our Featured Safari Packages</h2>

    
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
      <!-- Safari Package 1 -->






     <?php 
$query = mysqli_query($con, "SELECT * FROM adverts");

while ($row = mysqli_fetch_array($query)) {
?>


      <div style="flex: 1; min-width: 250px; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <img src="admin/postimages/<?php echo htmlentities($row['simage']); ?>" alt="Attwood" style="width: 100%; height: 200px; object-fit: cover;">
        <div style="padding: 15px; text-align: center;">
          <h3 style="color: #8B4513; margin-bottom: 15px; font-size: 20px;"><?php echo htmlentities($row['title']); ?></h3>
          <div style="display: flex; flex-direction: column; gap: 10px;">
            <a href="packages-detail.php?id=<?php echo urlencode($row['id']); ?>" style="background-color: skyblue; color: white; padding: 10px 0; text-decoration: none; border-radius: 4px; font-weight: bold;">READ MORE</a>
            
          </div>
        </div>
      </div>
      
  

<?php } ?>

      
  

      
    
      
 
</div>
</div>
      
    </div>
  </div>
  
  <!--NEWSLATTER-->
  <div class="container-fluid newslatter-bg">
    <div class="newslatter-bg-org padd-50">
      <div class="container"> 
        <!--title-->
        <div class="col-md-12 text-center">
          <h2>Subscribe our Newsletter</h2>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-offset-2 col-md-8">
          <div class="row">
            <div class="col-sm-8 col-md-8">
              <input type="email" placeholder="Enter your email address">
            </div>
            <div class="col-sm-4 col-md-4"><a href="#">SUBSCRIBE NOW!</a></div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include('include/footer.php');?>


  <!--payment column-->
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

<!---TILT EFFECT-effect to menu-gallery--> 
<script src="js/imagesloaded.pkgd.min.js"></script> 

<!--MENU-GALLERY--> 
<script src="js/masonry.pkgd.min.js"></script> 
<script src="js/classie.js"></script> 
<script src="js/main-gallery.js"></script> 
<script>
		(function() {
			var support = { transitions: Modernizr.csstransitions },
				// transition end event name
				transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
				transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
				onEndTransition = function( el, callback ) {
					var onEndCallbackFn = function( ev ) {
						if( support.transitions ) {
							if( ev.target != this ) return;
							this.removeEventListener( transEndEventName, onEndCallbackFn );
						}
						if( callback && typeof callback === 'function' ) { callback.call(this); }
					};
					if( support.transitions ) {
						el.addEventListener( transEndEventName, onEndCallbackFn );
					}
					else {
						onEndCallbackFn();
					}
				};

			new GridFx(document.querySelector('.grid'), {
				imgPosition : {
					x : -0.5,
					y : 1
				},
				onOpenItem : function(instance, item) {
					instance.items.forEach(function(el) {
						if(item != el) {
							var delay = Math.floor(Math.random() * 50);
							el.style.WebkitTransition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), -webkit-transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
							el.style.transition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
							el.style.WebkitTransform = 'scale3d(0.1,0.1,1)';
							el.style.transform = 'scale3d(0.1,0.1,1)';
							el.style.opacity = 0;
						}
					});
				},
				onCloseItem : function(instance, item) {
					instance.items.forEach(function(el) {
						if(item != el) {
							el.style.WebkitTransition = 'opacity .4s, -webkit-transform .4s';
							el.style.transition = 'opacity .4s, transform .4s';
							el.style.WebkitTransform = 'scale3d(1,1,1)';
							el.style.transform = 'scale3d(1,1,1)';
							el.style.opacity = 1;

							onEndTransition(el, function() {
								el.style.transition = 'none';
								el.style.WebkitTransform = 'none';
							});
						}
					});
				}
			});
		})();
	</script> 
<!--SLIDER--> 
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

<!-- restora/Recipes.html   11:53:25 GMT -->
</html>
