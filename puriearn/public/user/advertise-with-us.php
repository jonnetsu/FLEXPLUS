<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

check_login();
$title = "Dashboard";
include 'includes/header.php'; 
$today = date("Y-m-d");

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
$ads_balance =$user['ads_balance'];
?>

<style>
.mb-3 {
    margin-bottom: 10px !important;
}
.mt-3 {
    margin-top: 10px !important;
}
.mt-5 {
    margin-top: 30px !important;
}
.ads-caption{
    line-height:35px !important;
    font-weight:600;
}
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Advertise With Us</h4>
                    <p style="padding-top:5px;"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <div class="col-xl-12 col-sm-6">
      <div class="card height-equal" style="height:150px;">
        <div class="card-body" style="background:url('images/ads.jpg');background-size:cover;background-position:center;border-radius:5px;" 
          style="display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:5px;"> 
          <span class="f-w-500 f-16 mb-3 text-center text-white">Ads Account Balance</span>
          <h1 class=" text-white mb-3" style="font-size:30px;">&#8358;<?php echo number_format($ads_balance); ?></h1>
          <a href="https://wa.me/2348023349637?text=I%20want%20to%20fund%20my%20ads%20account%20with" class="btn btn-secondary">Fund Account</a>
        </div>
      </div>
    </div>


       <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
        <h1 class="ads-caption"><span class="text-success">Affordable Advertising Solutions</span> 
           that Make Your Marketing Campaign Hit That Target.</h1>
                <p class="mt-2">
                Puriearn is an innovative advertising platform where you can pay people to perform any task you need. Whether it's sharing your ads on their WhatsApp status, reviewing an app, or tweeting about your business or music , streaming your song, it's all possible here. Advertisers can effortlessly track their campaign progress and even verify task completion through screenshots provided by users. It's the ultimate tool to ensure your ads are truly making an impact through our ads station.
                </p>       
                <a class="btn btn-success" href="add-campaign.php">Create Campaign </a>                
              </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
