<?php
session_start();
// Database connection
include('../../config/puri-conn.php');
date_default_timezone_set('Africa/Lagos'); // Set the time zone to Nigeria (West Africa Time)
// Get users id or username from the session
$userId= $_SESSION['id'];
$username=$_SESSION['username'];

$sql = "SELECT * FROM `users` WHERE `id`=$userId";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$couponBalance=$row['coupon_account_bal'];
$newCouponBalance=$couponBalance - 3000;
$planId=1;
$amount=3000;
// Get the current date
$today = date("Y-m-d");


if ($couponBalance < 3000) {
    $response = array(
      'success' => false,
      'message' => 'Low account balance. Please recharge your account.'
    );
  } else {
    // Generate the coupon code
    $couponCode = generateCouponCode($username);

    // Save the coupon code into the database
    $escapedCouponCode = mysqli_real_escape_string($con, $couponCode);
    $sql = "INSERT INTO `coupons` (vendor_id, plan_id, coupon_code,amount) VALUES ('$userId', '$planId', '$escapedCouponCode','$amount')";
    $result = mysqli_query($con, $sql);

if ($result) {
    $sql1="UPDATE `users` SET `coupon_account_bal`='$newCouponBalance' WHERE `id`='$userId' ";
    $result1=mysqli_query($con,$sql1);
    $response = array(
      'success' => true,
      'message' => 'Coupon code generated successfully.',
      'couponCode' => $couponCode
    );
  } else {
    $response = array(
      'success' => false,
      'message' => 'Failed to generate coupon code.'
    );
  }
  }
  header('Content-Type: application/json');
  echo json_encode($response);

    
function generateCouponCode() {
    $userId= $_SESSION['id'];
  $codePrefix = substr(getUserName($userId), 0, 3); // Get the first three characters of the user name
  
  $code = $codePrefix . generateRandomString(9); // Generate a random string of 9 characters
  
  return strtoupper($code); // Convert the code to uppercase
}

function getUserName($userId) {
    $username=$_SESSION['username'];

  $userName = $username;
  
  return $userName;
}

function generateRandomString($length) {
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }
  
  return $randomString;
}