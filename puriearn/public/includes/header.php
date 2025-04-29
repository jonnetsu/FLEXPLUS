<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Description -->
<meta name="description" content="Puriearn - Join Puriearn,the leading CPA Affiliate marketing platform,and start earning money with your smartphone by completing simple tasks. Enjoy fast payouts, secure transactions and flexible earning opportunities. Sign up today and unlock your financial potential!">

<!-- Keywords -->
<meta name="keywords" content="Puriearn, CPA Affiliate Marketing, Earn Money Online,Smartphone Earnings, Task Advert Jobs,Easy Cash,Flexible Income,Fast Payouts,Legit Update,Legit online paying update, Secure Earnings, Influencer Earnings, Online Jobs, Extra Income">

<!-- Author -->
<meta name="author" content="Puriearn">

<!-- Robots -->
<meta name="robots" content="index, follow">

<!-- Open Graph Tags -->
<meta property="og:title" content="Puriearn - Earn Money with Your Smartphone | CPA Affiliate Marketing Platform">
<meta property="og:description" content="Puriearn - Join Puriearn and start earning money with your smartphone by completing simple tasks. Enjoy fast payouts,secure transactions, and flexible earning opportunities. Sign up today!">
<meta property="og:image" content="images/favicon.png">
<meta property="og:url" content="https://www.puriearn.com">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Puriearn - Earn Money with Your Smartphone | CPA Affiliate Marketing Platform">
<meta name="twitter:description" content="Puriearn - Puriearn - Join Puriearn and start earning money with your smartphone by completing simple tasks. Enjoy fast payouts,secure transactions, and flexible earning opportunities. Sign up today!">
<meta name="twitter:image" content="assets/images/favicon.png">

<!-- Mobile Specific Metas -->
<meta name="theme-color" content="#06b32a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#06b32a">

<!-- Title -->
<title>Puriearn - CPA Marketing</title>

<!-- Specify the favicon -->
<link rel="shortcut icon" href="assets/images/favicon.png">

<link href="//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <!--//google-fonts -->
    <!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style-starter.css">

<!--/Header-->
<header id="site-header" class="fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light stroke py-lg-0">
                <h1 >
                   <a class="navbar-brand pe-xl-5 pe-lg-4" href="index.php" 
                   style="font-weight:500;font-size:20px !important;display:flex;flex-direction:row;align-items:center;justify-content:center;">
                        <img src="assets/images/favicon.png" class="logo" style="width:50px;margin-left:-11px;">
                        <h4 style="font-weight:500;margin-left:-6px;font-size:27px;margin-top;10px !important;">PURIEARN</h4>
                    </a></h1>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                    <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-lg-auto my-2 my-lg-0 navbar-nav-scroll">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">Services</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="how-it-works.php">How it works</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="vendors.php">Code Vendors</a>
                        </li>
                       
                    </ul>
                    <ul class="navbar-nav search-right mt-lg-0 mt-2">
                       
                        <?php                         
                        if(!isset($_SESSION['email'])){	
                        ?>
                        <li class="nav-item me-lg-3"><a href="user/login.php" class="phone-btn btn btn-primary btn-style d-none d-lg-block btn-style ms-2">Sign In</a></li>
                        <?php
                           }else{
                        ?>
                        <li class="nav-item me-lg-3"><a href="user/" class="phone-btn btn btn-primary btn-style d-none d-lg-block btn-style ms-2">Dashboard</a></li>
                        <?php  } ?>
                    </ul>

                    <!-- //toggle switch for light and dark theme -->

                    <!-- search popup -->
                    <div id="search" class="w3lpop-overlay">
                        <div class="w3lpopup">
                            <form action="#formsearch" method="GET" class="d-sm-flex">
                                <input class="form-control me-2" type="search" placeholder="Search here..." aria-label="Search" required="">
                                <button class="btn btn-style btn-primary" type="submit">Search</button>
                                <a class="close" href="#formsearch">&times;</a>
                            </form>
                        </div>
                    </div>
                    <!-- /search popup -->
                </div>
                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper" style="margin-top:7px;">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
                <!-- //toggle switch for light and dark theme -->
            </nav>
        </div>
    </header>
    <!--//Header-->