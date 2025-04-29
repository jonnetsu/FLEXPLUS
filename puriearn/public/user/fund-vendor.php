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
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Fund Vendor Account</h4>
                    <p style="padding-top:5px;"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <p>To Fund your account, kindly make payment into the account below</p>
						
    <div class="card-body bg-primary py-3 mb-3" 
                      style="display:flex;flex-direction:column;align-items:center;
                      justify-content:center;border-radius:5px;"> 
                        <div>
                            <h6 class="mb-3 text-white">Bank: Moniepoint MFB</h6>
                            <h6 class="mb-3 text-white">Account Name: Ivest Integrated Services</h6>
                            <h6 class="mb-3 text-white">Account Number: <span style="color:#fff">9037703700</span> <span class="copy-btn" style="color:#fff" data-clipboard-text="9037703700"><i class="fa fa-copy"></i></span></h6>
                        </div>
    </div>


        <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
              <span class="" style="color:#000000;"><strong style="color:red;">Note: </strong><br>Use your username as description.</span>

              <p>Send payment receipt to us on Whatsapp.</p>
               <a href="https://wa.me/2348023349637?text=I%20have%20paid%20for%20funding%20and%20here%20is%20my%20receipt.%20Kindly%20confirm" 
                    class="btn btn-primary"><i class="fa fa-whatsapp"></i> Go to Whatsapp</a>
              </div>

            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        var clipboard = new ClipboardJS('.copy-btn');

        clipboard.on('success', function(e) {
            toastr.success('Copied to clipboard!');
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            toastr.error('Copy failed!');
        });
    });
</script>

<?php include 'includes/footer.php'; ?>
