<?php 
session_start();
// Database connection
include('../config/config.php');

include "includes/header.php" 
?>
<style>
    .content-text li {
        list-style-type: disc !important;
        padding-left: 0px !important;
        margin-left:5%;
        margin-bottom:10px;
    }
    .bullet-list li {
        position: relative;
        padding-left: 0px;
        margin-bottom: 10px;
    }

    .bullet-list li::before {
        content: "";
        position: absolute;
        top: 5px;
        left: 0;
        width: 8px;
        height: 8px;
        background-color: #ff7f50; /* Adjust the color as desired */
        border-radius: 50%;
    }
</style>
 <!-- About-area start -->
 <section class="about-area about-1 pt-100 pb-60">
        <div class="container">
            <div class="row align-items-center gx-xl-5">
             
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="content-title mb-40">
                        
                        <h4 class="title mb-30 mt-0" style="margin-left:5vw; !important">
                        FEATURES OF EARNIX INCOME 
                        </h4>
                        <div class="content-text">
                            <li>Multiple Earning benefit for activities.</li>
                            <li>Compensation plan/prize to dedicated and active members. </li>
                            <li>Highest commission through Coupon code sales. </li>
                            <li>Members are entitled to monthly income as they promote the program. </li>
                            <li>Multiple withdrawal mode for members </li>
                            <li>Automated withdrawal mode for members. </li>
                            <li>Multiple Earning benefit for affiliates. </li>
                            <li>Digital courses (Highly improved) </li>
                            <li>Daily earning through spinning, daily task and sponsored post. </li>
                            <li>Members get access to loan up to ₦100k for your business with best interest rate in 12 months,T&C. </li>
                            <li>High payout for activities earnings (Non referrals) </li>
                            <li>High commission for affiliate. </li>
                            <li>Members have access to advertise on Earnix Income ads space. </li>
                            <li>Weekly giveaways and GIFTBOX. </li>
                            <li>VTU Automated airtime and data recharge through earnings.</li>
                            <li>Members have access to free betting tips with 95% accuracy.</li>
                            <li>Members have access to incentives, access to food and quality lifestyle. </li>
                        </div>
                       
                    </div>
                </div>
            </div>   
        </div>
    </section>
    <!-- About-area end -->
    <div style="height:50px"></div>
<?php include "includes/footer.php" ?>
