<?php
session_start();
error_reporting(0);
include('include/config.php');
if(isset($_POST['submit']))
  {
$name=$_POST['name'];
$email=$_POST['email'];
$contactno=$_POST['contactno'];
$message=$_POST['message'];
$sql="INSERT INTO  booking(name,email,contactno,message) VALUES(:name,:email,:contactno,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Your Message has been sent successfuly');</script>";
}
else 
{
echo "<script>alert('Your Message has been sent successfuly');</script>";
}

}

?>

<!doctype html>
<html>

<!-- restora/contact.html   11:53:29 GMT -->
<head>
<meta charset="utf-8">
<!--bootstrap-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="keywords" content="Attwood Travel Agency, Kenya safaris, African tours, holiday packages Kenya, travel agency Nairobi, affordable travel, luxury safari, East Africa tours, wildlife adventure, guided travel packages">
<meta name="description" content="Attwood Travel Agency Ltd offers tailor-made safari tours, luxury holiday packages, and affordable travel solutions across Kenya and East Africa. Discover unforgettable adventures with expert guidance.">

<title>Contact</title>
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
  <div class="contact-head-img text-center">
    <div class="contact-head-img-black">
      <div class="container">
        <h2>Contact Us Via the Form</h2>
        <p>Contact Us</p>
        <span><a href="#">HOME</a>&nbsp; >&nbsp; <b class="content-subhead">CONTACT US</b></span> </div>
    </div>
  </div>
</section>
  
  <!--TOP-->
  <div class="container padd-50">
    <div class="col-md-8 contact-page-head-border">
      <div class="contact-page-head">
        <h2>How can we help you</h2>
        <p>Please give as much detail as possible so we can route your question properly.</p>
      </div>
      <div class="row">

        <form method="post">
        <div class="col-md-11" style="padding:0;">
          <div class="col-sm-6 col-md-12 black"> <span class="input input--nariko">
            <input class="input__field input__field--nariko" name="name" type="text" id="input-20" style="background-color:transparent;" />
            <label class="input__label input__label--nariko" for="input-20"> <span class="input__label-content input__label-content--nariko">Name</span> </label>
            </span> </div>
          <!--Last name-->

          <div class="col-sm-6 col-md-6 black"> <span class="input input--nariko">
            <input class="input__field input__field--nariko" name="email" type="text" id="input-20" style="background-color:transparent;" />
            <label class="input__label input__label--nariko" for="input-20"> <span class="input__label-content input__label-content--nariko">Email Address</span> </label>
            </span> </div>
          
          <div class="clearfix"></div>
          <!--Phone Number-->
          <div class="col-sm-6 col-md-6 black"> <span class="input input--nariko">
            <input class="input__field input__field--nariko" type="text" name="contactno" id="input-20" style="background-color:transparent;" />
            <label class="input__label input__label--nariko" for="input-20"> <span class="input__label-content input__label-content--nariko">Phone Number</span> </label>
            </span> </div>
          <!--Email Address-->
          
          <div class="clearfix"></div>
          <!--Message-->
          <div class="col-md-12 message"> <span class="input input--nariko black">
            <textarea class="input__field input__field--nariko textarea" type="text" name="message" id="input-20" style="background-color:transparent;"></textarea>
            <label class="input__label input__label--nariko" for="input-20"> <span class="input__label-content input__label-content--nariko" style="color:#191919;">Message</span> </label>
            </span> </div>
          <div class="clearfix"></div>
          <div class="col-md-12 text-right"> <button class="menu-all-btn-wht btn-bg" type="submit" name="submit">SUBMIT</a> </div>
          <div class="clearfix"></div>
        </div>
      </form>
        <div class="col-md-1"></div>
      </div>
    </div>
   <div class="col-md-4">
      <div class="row margin-top">
        <div class="col-md-offset-2 col-md-10">
          <div class="contact-page-head">
            <h2>Contact Information</h2>
            <div class="contact-head-u btn-bg"></div>
          </div>
          <div class="contact-det">
            <div class="contact-icon"><i class="flaticon-placeholder"></i></div>
            <span>ADDRESS <br />
            <p>Twiga Towers, 6th Floor, Room 616, Nairobi. Kenya </p>
            </span> </div>
          <div class="contact-det">
            <div class="contact-icon"><i class="flaticon-phone-call"></i></div>
            <span>PHONE <br />
            <p style="margin-bottom:8px;"><b>PHONE:  +254 725 112 597 </b></p>
           
            </span> </div>
          <div class="contact-det">
            <div class="contact-icon"><i class="flaticon-envelope"></i></div>
            <span>EMAIL <br />
            <p> info@attwoodtravelagency.co.ke</p>
            </span> </div>
          <div class="contact-det">
            <div class="contact-icon"><i class="flaticon2-clock"></i></div>
            <span>OPENING HOURS <br />
            <p>Mon-Sat :- 8AM - 5PM</p>
            <p>Sunday :- <em class="content-subhead">Closed</em>
            </span> </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  

  

  
  <!--NEWSLATTER-->
  <div class="container-fluid newslatter-bg">
    <div class="newslatter-bg-org padd-50">
      <div class="container">
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
<!--CONTACT-STYLE--> 
<script src="js/classie.js"></script> 
<script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input,textarea.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
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
</body>

<!-- restora/contact.html   11:53:39 GMT -->
</html>
