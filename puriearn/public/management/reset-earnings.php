<?php
session_start();
error_reporting(0);
require_once '../../config/puri-conn.php';
include 'includes/functions.php';

$new_earnings = 4700;
$max_earn = 1500;


// Update the reward in the database
$sql = "UPDATE `users` SET `earnings` = ? WHERE `earnings` > ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'ii', $new_earnings, $max_earn);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    // Update successful
    echo "<script>alert('Update successful.');</script>";
} else {
    // Update failed
    echo "<script>alert('Update failed. Please try again.');</script>";
}
?>