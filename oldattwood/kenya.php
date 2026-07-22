<!doctype html>
<html>

<!-- restora/blog.html   11:53:03 GMT -->

<head>
  <meta charset="utf-8">
  <!--bootstrap-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Kenya Packages</title>
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

    <?php include('include/header.php'); ?>



    <section id="page-title" style="background: url('img/ke3.jpg') center center no-repeat; background-size: cover;">
      <div class="story-head text-center">
        <div class="story-head-black">
          <div class="container">
            <h2>Kenya Packages</h2>
            <p>Make People Fullfill their dreams!</p>
            <span><a href="index.php">HOME</a> > <a href="#">Kenya Packages</a> > <b
                class="content-subhead">Welcome</b></span>
          </div>
        </div>
      </div>
    </section>
    <!--TOP-->
    <div class="container">
      <!--Left-column-->

      <div class="col-xs-12 col-sm-12 col-md-8 padd-70">
        <div class="article">
          <div class="article-img wow animated fadeInDown"
            style="position: relative; width: 100%; max-width: 600px; height: 300px; overflow: hidden;">

            <!-- Image -->
            <img id="sliderImage" src="img/ke1.jpg"
              style="width: 100%; height: 100%; object-fit: cover; transition: opacity 0.5s ease;"
              class="img-responsive" />

            <!-- Left arrow -->
            <div onclick="changeSlide(-1)" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%);
              background: rgba(0,0,0,0.5); color: white; padding: 10px; cursor: pointer;
              font-size: 18px; border-radius: 50%;">
              &#10094;
            </div>

            <!-- Right arrow -->
            <div onclick="changeSlide(1)" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);
              background: rgba(0,0,0,0.5); color: white; padding: 10px; cursor: pointer;
              font-size: 18px; border-radius: 50%;">
              &#10095;
            </div>
          </div>

          <script>
            const images = ["img/ke1.jpg", "img/ke2.jpg", "img/ke3.jpg"];
            let currentIndex = 0;
            const sliderImage = document.getElementById("sliderImage");

            function showImage(index) {
              currentIndex = (index + images.length) % images.length;
              sliderImage.src = images[currentIndex];
            }

            function changeSlide(direction) {
              showImage(currentIndex + direction);
            }

            // Auto change every 3 seconds
            setInterval(() => {
              changeSlide(1);
            }, 3000);
          </script>

          <!--blog post-1-->
          <div>

            <h3>Discover Details About Kenya Packages</h3>

            <p class="article-body-span" style="margin-right:0; margin-top:15px;">Kenya is a premier travel destination
              famed for its breathtaking landscapes, diverse wildlife, and rich cultural heritage. At Attwood Travel
              Agency, we offer curated Kenyan packages that take you deep into the heart of this vibrant country.
              Explore the iconic Maasai Mara National Reserve, world-renowned for the Great Wildebeest Migration and
              thrilling Big Five safaris. Discover the flamingo-lined shores of Lake Nakuru, the dramatic escarpments of
              the Great Rift Valley, and the snow-capped peaks of Mount Kenya. For beach lovers, unwind along the
              pristine white sands of Diani, Watamu, or Malindi, where the turquoise Indian Ocean awaits.</p>

            <p class="article-body-span">Our Kenyan tour packages cater to all types of travelers from luxury seekers to
              adventurous backpackers and families. Visit the bustling capital, Nairobi, home to the Giraffe Centre and
              David Sheldrick Elephant Orphanage. Enjoy cultural experiences with the Maasai, Samburu, and other
              indigenous communities. Whether you're looking for a romantic getaway, wildlife expedition, or a family
              holiday, Attwood ensures a seamless and memorable Kenyan adventure tailored just for you. Let us help you
              explore the magic of Kenya!</p>
            <a class="article-read btn-bg" href="contactus.php"
              style="background-color: red; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Submit
              Quotation</a>

            <div class="blog-social">
              <ul>
                <li><a href="#"><i class="fa fa-share "></i></a>
                  <ul class="wow animated fadeInRight">
                    <li><a href="www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="www.instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="divider"></div>






      </div>

      <!--Right-column-->

      <div class="col-xs-12 col-sm-12 col-md-4 padd-70">
        <div class="col-md-12">
          <div class="categories">
            <h3 class="content-subhead" style="color:red;">Destinations</h3>

            <span></span>
            <ul>
              <li><a href="kenya.php"><i class="fa fa-angle-right content-subhead" aria-hidden="true"></i>&nbsp; Kenya
                  Packages</a></li>
              <li><a href="rwanda.php"><i class="fa fa-angle-right content-subhead" aria-hidden="true"></i>&nbsp; Rwanda
                  Packages </a></li>
              <li><a href="uganda.php"><i class="fa fa-angle-right content-subhead" aria-hidden="true"></i>&nbsp; Uganda
                  Packages </a></li>
              <li><a href="tanzania.php"><i class="fa fa-angle-right content-subhead" aria-hidden="true"></i>&nbsp;
                  Tanzania Packages </a></li>
              <li><a href="malawi.php"><i class="fa fa-angle-right content-subhead" aria-hidden="true"></i>&nbsp; Malawi
                  Packages. </a></li>

            </ul>
          </div>
        </div>
        <div class="clearfix"></div>


        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </div>

    <?php include('include/footer.php'); ?>

    <div class="container-fluid footer-pay-bg">
      <div class="container" style="padding-top:20px; padding-bottom:20px;">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 footer-pay-p">
            <p>©2017 <b class="content-subhead">Restora</b>. All Rights Reserved.</p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 text-center">
            <div class="payment">
              <p class="payment-p">Payment acceptable on</p>
              <img src="img/pay-1.png" /> <img src="img/pay-2.png" /> <img src="img/pay-3.png" /> <img
                src="img/pay-4.png" /> <img src="img/pay-5.png" />
            </div>
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


        ,
      }

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
    <a href="https://www.tiktok.com/@attwood.travel.ag?_t=ZM-8vpXR0XV1Fv&_r=1" target="_blank"
      title="Follow us on TikTok">
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