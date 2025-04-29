<?php
session_start();
include('../../config/puri-conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $points = $_POST['points'];

    $bonus =2000;

    $sql = "UPDATE users SET cashback = cashback + $bonus WHERE id = $uid";
    if (mysqli_query($con, $sql)) {
        echo "Points updated successfully.";
    } else {
        echo "Error updating points: " . mysqli_error($con);
    }
}
?>
