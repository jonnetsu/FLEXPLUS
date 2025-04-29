<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';
include 'includes/mail-settings.php';


check_login();
$title="Dashboard";
$today = date("Y-m-d");
include 'includes/header.php'; 

//ini_set('display_errors', 1); error_reporting(E_ALL);

if(!isset($_GET['cid'])){
    echo "<script>window.location.href='digital-courses.php';</script>";
  }
  
$cid=$_GET['cid'];//product category ID


$uid = $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$username = $row['username'];
$email = $row['email'];

$activity_balance = $row['earnings'];
$referral_balance = $row['ref_bonus'];

// Get Basic Course
if (isset($_POST['submitOne'])) {
    $category = $_POST['cid'];
    $amount = $_POST['amount'];
    $coursefile = $_POST['coursefile'];

            if (!isset($coursefile)) {
                $msg = "Something went wrong! Please try another course";
                $type = "warning";
            } else {
            // Send email with the PDF attachment
            $toEmail = $email;
            $subject = "Course Purchase Confirmation";
            $mailHeaders = "MIME-Version: 1.0" . "\r\n";
            $mailHeaders .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $mailHeaders .= 'From: Puriearn <' . $noreply_email . '>' . "\r\n";
            $mailHeaders .= "Date: " . date('r') . " \r\n";
            $mailHeaders .= "Return-Path: " . $site_email . "\r\n";
            $mailHeaders .= "Errors-To: " . $site_email . "\r\n";
            $mailHeaders .= "Reply-to: " . $site_email . " \r\n";
            $mailHeaders .= "Organization: " . $site_title . " \r\n";
            $mailHeaders .= "X-Sender: " . $site_email . " \r\n";
            $mailHeaders .= "X-Priority: 3 \r\n";
            $mailHeaders .= "X-MSMail-Priority: Normal \r\n";
            $mailHeaders .= "X-Mailer: PHP/" . phpversion();
            $content = '
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8" />
                    <title>Course Purchase Confirmation</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f6f6f6;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #ffffff;
                        }
                        h1 {
                            font-size: 24px;
                            font-weight: bold;
                            color: #1b70f1;
                            margin-top: 0;
                        }
                        p {
                            font-size: 16px;
                            line-height: 1.5;
                            color: #000000;
                        }
                        .code {
                            font-size: 32px;
                            font-weight: bold;
                            color: #1b70f1;
                            text-transform: uppercase;
                        }
                        .footer {
                            font-size: 14px;
                            color: #808080;
                            margin-top: 20px;
                        }
                        .logo {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="logo">
                            <img src="https://puriearn.com/images/logo.png" alt="Logo" width="200" height="auto" />
                        </div>
                        <h1>Course Purchase Confirmation</h1>
                        <p>
                            <b>Hello ' . $username . ',</b><br />
                            Thank you for purchasing the course. Please find the attached PDF file.
                        </p>
                        <p class="footer">
                            If you have any questions, please contact us at support@example.com.
                        </p>
                    </div>
                </body>
            </html>';

            $file_path = "../admin/ebooks/pdfs/" . htmlentities($coursefile);

            // Check if the file exists before attaching
            if (file_exists($file_path)) {
                $attachment = chunk_split(base64_encode(file_get_contents($file_path)));
                $file_type = mime_content_type($file_path);

                $boundary = md5(time());

                $headers .= "\r\nMIME-Version: 1.0\r\n";
                $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

                $message = "--$boundary\r\n";
                $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
                $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $message .= "$content\r\n";
                $message .= "--$boundary\r\n";
                $message .= "Content-Type: $file_type; name=\"$coursefile\"\r\n";
                $message .= "Content-Disposition: attachment; filename=\"$coursefile\"\r\n";
                $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $message .= $attachment . "\r\n";
                $message .= "--$boundary--";

                mail($toEmail, $subject, $message, $mailHeaders);

                $msg = "Course successfully requested! Course will be sent to your email.";
                $type = "success";
            } else {
                $msg = "Course file not found.";
                $type = "warning";
            }
        }
} 


//Get Advance Course
if (isset($_POST['submitTwo'])) {
    $category = $_POST['cid'];
    $amount = $_POST['amount'];
    $coursefile = $_POST['coursefile'];
    $newbal = $referral_balance - $amount;

    if ($referral_balance < $amount) {
        $msg = "Your  Affiliate Earning is too low for this purchase";
        $type = "warning";
    } else {
        $sql1 = "INSERT INTO `transactions` (`user_id`,`account_type`,`type`,`amount`,`created_at`)
            VALUES  ('$uid','$category','Course Purchase','$amount','$today')";
        $result1 = mysqli_query($con, $sql1);

        if ($result1) {
            $updateQuery = "UPDATE `users` SET `ref_bonus`='$newbal' WHERE `id`='$uid'";
            $result2 = mysqli_query($con, $updateQuery);

            // Send email with the PDF attachment
            $toEmail = $email;
            $subject = "Course Purchase Confirmation";
            $mailHeaders = "MIME-Version: 1.0" . "\r\n";
            $mailHeaders .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $mailHeaders .= 'From: Puriearn <' . $noreply_email . '>' . "\r\n";
            $mailHeaders .= "Date: " . date('r') . " \r\n";
            $mailHeaders .= "Return-Path: " . $site_email . "\r\n";
            $mailHeaders .= "Errors-To: " . $site_email . "\r\n";
            $mailHeaders .= "Reply-to: " . $site_email . " \r\n";
            $mailHeaders .= "Organization: " . $site_title . " \r\n";
            $mailHeaders .= "X-Sender: " . $site_email . " \r\n";
            $mailHeaders .= "X-Priority: 3 \r\n";
            $mailHeaders .= "X-MSMail-Priority: Normal \r\n";
            $mailHeaders .= "X-Mailer: PHP/" . phpversion();
            $content = '
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8" />
                    <title>Course Purchase Confirmation</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f6f6f6;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #ffffff;
                        }
                        h1 {
                            font-size: 24px;
                            font-weight: bold;
                            color: #1b70f1;
                            margin-top: 0;
                        }
                        p {
                            font-size: 16px;
                            line-height: 1.5;
                            color: #000000;
                        }
                        .code {
                            font-size: 32px;
                            font-weight: bold;
                            color: #1b70f1;
                            text-transform: uppercase;
                        }
                        .footer {
                            font-size: 14px;
                            color: #808080;
                            margin-top: 20px;
                        }
                        .logo {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="logo">
                            <img src="https://puriearn.com/images/logo.png" alt="Logo" width="200" height="auto" />
                        </div>
                        <h1>Course Purchase Confirmation</h1>
                        <p>
                            <b>Hello ' . $username . ',</b><br />
                            Thank you for purchasing the course. Please find the attached PDF file.
                        </p>
                        <p class="footer">
                            If you have any questions, please contact us at support@example.com.
                        </p>
                    </div>
                </body>
            </html>';

            $file_path = "../admin/ebooks/pdfs/" . htmlentities($coursefile);

            // Check if the file exists before attaching
            if (file_exists($file_path)) {
                $attachment = chunk_split(base64_encode(file_get_contents($file_path)));
                $file_type = mime_content_type($file_path);

                $boundary = md5(time());

                $headers .= "\r\nMIME-Version: 1.0\r\n";
                $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

                $message = "--$boundary\r\n";
                $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
                $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $message .= "$content\r\n";
                $message .= "--$boundary\r\n";
                $message .= "Content-Type: $file_type; name=\"$coursefile\"\r\n";
                $message .= "Content-Disposition: attachment; filename=\"$coursefile\"\r\n";
                $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $message .= $attachment . "\r\n";
                $message .= "--$boundary--";

                mail($toEmail, $subject, $message, $mailHeaders);

                $msg = "Course successfully purchased! Course will be sent to your email.";
                $type = "success";
            } else {
                $msg = "Course file not found.";
                $type = "warning";
            }
        } else {
            $msg = "Something went wrong, please try again";
            $type = "warning";
        }
    }
}

//Fetch course details
$course_query="SELECT * FROM `digital_courses` WHERE id='$cid' "  ;
$result2=mysqli_query($con,$course_query);
if(mysqli_num_rows($result2)>0){
while($row2=mysqli_fetch_assoc($result2)){
$course_id=$row2['id'];
$price=$row2['amount'];
$course_name=$row2['book_name'];
$amount=$row2['amount'];
$description=$row2['description'];
$image=$row2['image_filepath'];
$category=$row2['type'];
$book_filename=$row2['filename'];
?>

            <?php }}?>

            <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12">
                  <h4>Course - <?php echo $course_name; ?></h4>
                  <p style="padding-top:5px;">Course insight and description</p>
                </div>
               
              </div>
            </div>
          </div>

                            <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                            <?php }?>
                          
                            <div class="col">
                                    <div class="card border-0">
                                        
                                        <div class="card-body">
                                            
                                            <div class="d-flex justify-content-between mb-3">

                                                <div class="row">
                                                    <div class="col-6 col-lg-4 col-m-12 col-12">
                                                    <img src="../admin/<?php echo $image;?>" 
                                                    style="border-radius:5px;width:100%;margin-bottom:10px;">
                                                    
                                                    </div>
                                                    <div class="col col-lg-6 col-m-12 col-12">
                                                        <h6 style="margin-bottom:10px;">Description</h6>
                                                        <p class="fs-14 text-dark"><?php echo formatPostDescription($description); ?></p>
                                                    </div>
                                                </div>
                              
                                            </div>
                                          
                                                  <?php 
                                            if($category =="1"){
                                                ?>
                                                  <div class="col col-lg-4 col-m-12 col-12">
                                                  <div class="d-flex align-items-center justify-content-between mb-3">
                                                  <h6></h6>       
                                                  </div>
                                                  <div class="d-flex align-items-center justify-content-between">
                                                  <h6>Type: </h6>
                                                <span class="badge bg-warning ">Free</span> 
                                                <?php
                                            }else{
                                            
                                                ?>
                                                  <div class="col col-lg-4 col-m-12 col-12">
                                                 <div class="d-flex align-items-center justify-content-between mb-3">
                                                  <h6>Price: &#8358;<?php echo number_format($amount);?></h6>       
                                                  </div>
                                                  <div class="d-flex align-items-center justify-content-between">
                                                  <h6>Type: </h6>
                                                <span class="badge bg-danger">Paid</span>
                                                    
                                                    <?php
                                                        }
                                                    ?>        
                                                  </div>

                                                  <?php 
                                            if($category =="1"){
                                                ?>
                                                <form method="post" action="">
                                                    <input type="hidden" name="cid" value="<?php echo htmlentities($row2['id']);?>">
                                                    <input type="hidden" name="amount" value="<?php echo htmlentities($amount);?>">
                                                    <input type="hidden" name="coursefile" value="<?php echo $book_filename;?>">

                                                    <button type="submit"  name="submitOne"
                                                                class="btn badge bg-primary fs-16 mt-3" style="width:100%;">
                                                                Get Course
                                                    </button>
                                                </form>
                                                <?php
                                            }else{
                                            
                                                ?>
                                                   <form method="post" action="">
                                                    <input type="hidden" name="cid" value="<?php echo htmlentities($row2['id']);?>">
                                                    <input type="hidden" name="amount" value="<?php echo htmlentities($amount);?>">
                                                    <input type="hidden" name="coursefile" value="<?php echo $book_filename;?>">

                                                    <button type="submit"  name="submitTwo"
                                                                class="btn badge bg-primary fs-16 mt-3" style="width:100%;">
                                                                Get Course
                                                    </button>
                                                </form>
                                                    <?php
                                                        }
                                                    ?>      

                                                  
                                                   
                                            </div>
                                        </div>
                                       
                                    </div>
                            </div>
				        </div>
					</div>
			</div>
</main>
<br><br>
<?php include 'includes/footer.php' ?>
