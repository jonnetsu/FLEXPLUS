<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();


if(isset($_GET['id']) & !empty($_GET['id'])){

    $id = $_GET['id'];
    $sql = "SELECT `image` FROM `tasks` WHERE `id`='$id' ";
    $res = mysqli_query($con, $sql);
    $r = mysqli_fetch_assoc($res);
    if(!empty($r['`image`'])){
        if(unlink($r['`image`'])){
            $delsql = "UPDATE `tasks` SET `image`='' WHERE `id`='$id' ";
            if(mysqli_query($con, $delsql)){
                
                echo "<script>window.location.href='update-post-image.php?id={$id}';</script>";
            }
        }else{
            $delsql = "UPDATE `tasks` SET `image`='' WHERE `id`='$id' ";
            if(mysqli_query($con, $delsql)){
                header("location:update-post-image.php?id={$id}");
            }
        }

}else{
    $delsql = "UPDATE `tasks` SET `image`='' WHERE `id`='$id' ";
    if(mysqli_query($con, $delsql)){
        echo "<script>window.location.href='update-post-image.php?id={$id}';</script>";
    }
}
}else{
echo "<script>window.location.href='update-post-image.php?id={$id}';</script>";
}

