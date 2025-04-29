<?php
$uid= $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`='$uid' ";
$res = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($res);
$fullname=$user['fullname'];
$username=$user['username'];
$profile_pic=$user['user_picture'];

$initials = substr($fullname, 0, 2);

$is_vendor=$user['is_vendor'];
$is_publisher=$user['is_publisher'];
$cashback_status=$user['cashback_status'];

$tiktok_balance=number_format($user['tiktok_balance']);
$referral_balance=number_format($user['ref_bonus']);
$indirect_referral_balance=number_format($user['indirect_ref_bonus']);


// Query to count unread notifications
$countUnreadQuery = "SELECT COUNT(*) AS unread_count FROM notifications WHERE receiver_id = ? AND is_read = 0";
$stmtCountUnread = mysqli_prepare($con, $countUnreadQuery);
mysqli_stmt_bind_param($stmtCountUnread, "s", $uid); // Assuming you have an active session with the user's ID
mysqli_stmt_execute($stmtCountUnread);
$resultCountUnread = mysqli_stmt_get_result($stmtCountUnread);
$countUnread = 0;

if ($rowCountUnread = mysqli_fetch_assoc($resultCountUnread)) {
$countUnread = $rowCountUnread['unread_count'];
}
?> 
<!DOCTYPE html><html lang="en"><head>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Puriearn">
    <meta name="keywords" content="Puriearn, cpa marketing">
    <meta name="author" content="Puriearn">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Puri Earn</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <!-- ico-font-->
    

    <!-- Mobile Specific Metas -->
<meta name="theme-color" content="#06b32a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#06b32a">

      <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/echart.css">
    <link rel="stylesheet" type="text/css" href="css/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link id="color" rel="stylesheet" href="css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">


	
  </head>
  <body> 
    <style>
      .rounded-circle{
        display:flex;
        flex-direction:row;
        align-items:center;
        justify-content:center;
        width:50px;
        height:40px;
        border-radius:25px;
        margin-right:10px;
      }
      .product-cost{
    display:flex;
    flex-direction:row;
    align-items:center;
    justify-content:space-between;
}
.f-w-600{
    text-align:right;
}
.product-icon{
    margin-top:-40px;
    width:80px !important;
    height:80px !important;
    display:flex;
    flex-direction:row;
    align-items:center;
    justify-content:center;
    background:#06b32a;
}
.mb-3{
    margin-bottom:20px !important;
}
.b-icon{
   width:30px;
}
.d-text{
    margin-top:-5px ;
    margin-bottom:5px !important;
}
    </style>
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader"> 
        <div class="loader4"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->


    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative"> 
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus="">
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"> </div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">  
            <div class="logo-wrapper"> <a href="index.php"><img class="img-fluid for-light" src="images/logo_dark.png" alt="logo-light"><img class="img-fluid for-dark" src="images/logo.png" alt="logo-dark"></a></div>
            <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div> <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
            <!--
              <div class="d-flex align-items-center gap-2 ">
                <h4 class="f-w-600">Welcome <?php echo $username; ?></h4><img class="mt-0" src="images/hand.gif" alt="hand-gif">
              </div>
             -->
            </div>
            <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">
            <p class="text-gray mb-0"><label id="lblGreetings"></label></p> </span></div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus"> 
             
              <li> 
                <div class="mode"><i class="moon" data-feather="moon"> </i></div>
              </li>
              <li class="onhover-dropdown notification-down">
                <div class="notification-box"> 
                  <svg> 
                    <use href="images/icon-sprite.svg#notification-header"></use>
                  </svg><span class="badge rounded-pill badge-secondary"><?php echo $countUnread; ?> </span>
                </div>
                <div class="onhover-show-div notification-dropdown"> 
                  <div class="card mb-0"> 
                    <div class="card-header">
                      <div class="common-space"> 
                        <h4 class="text-start f-w-600">Notifications</h4>
                        <div><span><?php echo $countUnread; ?> New</span></div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="notitications-bar">
                      
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel" aria-labelledby="pills-aboutus-tab">
                            <div class="user-message"> 
                              
                              <ul> 
                              <?php
                                $userid=$_SESSION['id']; 
                                $query="SELECT * FROM `notifications` WHERE `receiver_id`='$userid' and `is_read`='0' ORDER BY `notification_id` DESC LIMIT 5";
                                $result=mysqli_query($con,$query);
                                  $cnt=+1;
                                  if(mysqli_num_rows($result)>0){
                                  while($row=mysqli_fetch_array($result)){
                                    $type=$row['action_type'];
                            
                                    $date_string=$row['created_at'];// date retrieved from database
                                    $timestamp = strtotime($date_string); // convert date string to Unix timestamp
                                    $date = date(" l, jS \of F Y", $timestamp);// format timestamp into words

                              ?>
                                <li>
                                  <div class="user-alerts">
                                  <?php 
														if ($type == 'Vendor Bonus'){
														echo "
														<div class='rounded-circle img-fluid bg-secondary text-white'>
														<i class='fa fa-arrow-down '></i>
														</div>";
														 
														  }elseif($type == 'Withdrawal'){
															echo "
															<div class='rounded-circle img-fluid bg-warning text-white'>
															<i class='fa fa-arrow-up '></i>
															</div>";
														}elseif($type == 'Airtime'){
															echo "
															<div class='rounded-circle img-fluid bg-primary text-white'>
															<i class='fa fa-arrow-up '></i>
															</div>";
														  }elseif($type == 'Referral'){
															echo "
															<div class='rounded-circle img-fluid bg-success text-white'>
															<i class='fa fa-arrow-down '></i>
															</div>";
														  }elseif($type == 'Admin'){
															echo "
															<div class='rounded-circle img-fluid bg-primary text-white'>
															<i class='fa fa-user '></i>
															</div>";
														  }else{
															echo "
															<div class='rounded-circle img-fluid bg-primary text-white'>
															<i class='fa fa-arrow-up '></i>
															</div>";
														  }
														?>
                                    <div class="user-name">
                                      <div> 
                                      
                                        <span class="f-light f-w-500 f-12"><?php echo htmlentities($row['body']);?></span>
                                      </div>
                                      <div> 
                                       
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <?php  } 
                                }else{
                                echo" <div class='' style='height:60px;display:flex;align-items:center;justify-content:center;'> 
                                You don't have any new notification yet </div> ";
                                }
                              ?>	
                              </ul>
                            </div>
                          </div>
                         
                          <div class="card-footer pb-0 pr-0 pl-0"> 
                            <div class="text-center"> <a class="f-w-700" href="notifications.php">
                                <button class="btn btn-primary" type="button" title="btn btn-primary">Check all</button></a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="profile-nav onhover-dropdown"> 
                <div class="media profile-media"><img class="b-r-10" src="../admin/profilepics/<?php echo $profile_pic; ?>" alt="">
                  <div class="media-body d-xxl-block d-none box-col-none">
                    <div class="d-flex align-items-center gap-2"> <span><?php echo htmlentities($user['fullname']);?> </span><i class="middle fa fa-angle-down"> </i></div>
                    <p class="mb-0 font-roboto"><?php echo htmlentities($user['username']);?></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div ">
                  <li><a href="profile.php"><i data-feather="user"></i><span>My Profile</span></a></li>
                  <li> <a href="security.php"> <i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a class="btn btn-pill btn-outline-primary btn-sm mb-3" href="logout.php">Log Out</a></li>
                </ul>
              </li>
            </ul>
          </div>
          
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg" style="border-radius:0px;">
          <div class="logo-wrapper"><a href="index.php">
            <img class="img-fluid" src="images/logo.png" alt="" style="width:120px;"></a>
            <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="index.php"><img class="img-fluid" src="images/logo-icon.png" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="index.php"><img class="img-fluid" src="images/logo-icon.png" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <!--
                <li class="pin-title sidebar-main-title">
                  <div> 
                    <h6>Pinned</h6>
                  </div>
                </li>
                --> 
                  <li class="sidebar-list">
                  <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="index.php">
                  <i class="fa fa-home text-white"></i>                   
                   <span>Dashboard</span></a>
                  </li>
                  <li class="sidebar-list">
                  <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="courses.php">
                    <i class="fa fa-graduation-cap text-white"></i>                   
                    <span>CPA Course</span></a>
                  </li>
                  <?php 
									if ($cashback_status == '0'){ ?>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="claim-cashback.php">
                    <i class="fa fa-money text-white"></i>                   
                    <span>Claim Cashback</span></a>
                  </li>
                  <?php  } ?>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">    
                    <i class="fa fa-bank text-white"></i> 
                   <span>Withdrawal</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="history.php">History</a></li>
                      <li><a href="withdrawal.php">Withdraw Earnings</a></li>
                      <li><a href="withdraw-settings.php">Withdrawal Settings</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="team.php">
                    <i class="fa fa-users text-white"></i>                   
                    <span>Affiliate Teams</span></a>
                  </li>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="advert-task.php">
                    <i class="fa fa-tasks text-white"></i>                   
                    <span>Advert Task</span></a>
                  </li>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="tiktok-task.php">
                    <i class="fa fa-video-camera text-white"></i>                   
                    <span>Tiktok Pay</span></a>
                  </li>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="advertise-with-us.php">
                    <i class="fa fa-bullhorn text-white"></i>                   
                    <span>Advertise With Us</span></a>
                  </li>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" 
                    href="profile.php">
                    <i class="fa fa-user text-white"></i>                   
                    <span>Profile</span></a>
                  </li>
                  <?php 
									if ($is_vendor == '1'){ ?>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">    
                    <i class="fas fa-store-alt text-white"></i> 
                     <span>Vendor</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="coupons.php">Generate Coupon</a></li>
                      <li><a href="fund-vendor.php">Fund Coupon</a></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" 
                    href="">
                    <i class="fa fa-fire text-white"></i>                   
                    <span>Earn More 
                      <span style="font-size:10px;">(Coming Soon)</span></span></a>
                  </li>
              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>
        <!-- Page Sidebar Ends-->
    