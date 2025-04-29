<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();




if(isset($_GET['id']) & !empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT product_image FROM products WHERE product_id=$id";
    $res = mysqli_query($con, $sql);
    $r = mysqli_fetch_assoc($res);
    if(!empty($r['product_image'])){
        if(unlink($r['product_image'])){
            $delsql = "UPDATE products SET product_image='' WHERE product_id=$id";
            if(mysqli_query($con, $delsql)){
                
                echo "<script>window.location.href='edit-product.php?id={$id}';</script>";
            }
        }else{
            $delsql = "UPDATE products SET product_image='' WHERE product_id=$id";
            if(mysqli_query($con, $delsql)){
                header("location:edit-product.php?id={$id}");
            }
        }

}else{
    $delsql = "UPDATE products SET product_image='' WHERE product_id=$id";
    if(mysqli_query($con, $delsql)){
        echo "<script>window.location.href='edit-product.php?id={$id}';</script>";
    }
}
}else{
echo "<script>window.location.href='edit-product.php?id={$id}';</script>";
}

