<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('includes/checklogin.php');
include 'includes/functions.php';

check_login();
$title = "Create Campaign";
include 'includes/header.php'; 

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// Fetching user information and balances
$uid = $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`='$uid' ";
$res = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($res);
$fullname = $user['fullname'];
$username = $user['username'];
$profile_pic = $user['user_picture'];
$ads_balance = $user['ads_balance'];
$referral_balance = $user['ref_bonus'];

$initials = substr($fullname, 0, 2);

$is_vendor = $user['is_vendor'];
$is_publisher = $user['is_publisher'];
$cashback_status = $user['cashback_status'];

// Fetch categories and subcategories from the database
$categories_sql = "SELECT * FROM categories";
$categories_result = mysqli_query($con, $categories_sql);

$subcategories_sql = "SELECT * FROM subcategories";
$subcategories_result = mysqli_query($con, $subcategories_sql);

// Calculate the total amount including review charge and fee
$review_charge = 100;
$fee_percentage = 0.05;
$min_amount = 50;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Extract and sanitize form data
   $category = mysqli_real_escape_string($con, $_POST['selected_category_id']);
   $subcategory = mysqli_real_escape_string($con, $_POST['selected_subcategory_id']);

   $title = mysqli_real_escape_string($con, $_POST['title']);
   $description = mysqli_real_escape_string($con, $_POST['description']);
   $amount_per_task = isset($_POST['amount_per_task']) ? (float)mysqli_real_escape_string($con, $_POST['amount_per_task']) : 0.0;
   $num_tasks = isset($_POST['num_tasks']) ? (int)mysqli_real_escape_string($con, $_POST['num_tasks']) : 0;
   $total_amount = isset($_POST['total_amount']) ? (float)mysqli_real_escape_string($con, $_POST['total_amount']) : 0.0;
   $screenshots_required = isset($_POST['screenshots_required']) ? 1 : 0;

    // Calculate total amount with fees
    $joined_amount = $amount_per_task * $num_tasks;
    $fee_amount = $joined_amount * $fee_percentage;
    $total_amount_with_fees = $joined_amount + $review_charge + $fee_amount;

    // Handle screenshot upload
    $sample_upload = '';
    $ads_screenshot_name = '';
    if ($screenshots_required) {
        if (isset($_FILES['sample_upload']) && $_FILES['sample_upload']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../admin/screenshots/';
            $original_filename = basename($_FILES['sample_upload']['name']);
            $extension = pathinfo($original_filename, PATHINFO_EXTENSION);
            $unique_filename = uniqid() . '.' . $extension; // Generate a unique filename
            $upload_file = $upload_dir . $unique_filename;

            if (move_uploaded_file($_FILES['sample_upload']['tmp_name'], $upload_file)) {
                $sample_upload = $unique_filename; // Store only the unique filename
                $ads_screenshot_name = $unique_filename;
            } else {
                // Handle upload error
            }
        }
    }

    // Handle ads banner upload (optional)
    $ads_banner = '';
    $ads_banner_name = '';
    if (isset($_FILES['ads_banner']) && $_FILES['ads_banner']['error'] === UPLOAD_ERR_OK) {
        $banner_upload_dir = '../admin/adverts/';
        $original_banner_filename = basename($_FILES['ads_banner']['name']);
        $banner_extension = pathinfo($original_banner_filename, PATHINFO_EXTENSION);
        $banner_unique_filename = uniqid() . '.' . $banner_extension; // Generate a unique filename
        $banner_upload_file = $banner_upload_dir . $banner_unique_filename;

        if (move_uploaded_file($_FILES['ads_banner']['tmp_name'], $banner_upload_file)) {
            $ads_banner = $banner_unique_filename; // Store only the unique filename
            $ads_banner_name = $banner_unique_filename;
        }
    }
    // Check if the user has enough ads balance or referral balance
    if ($ads_balance >= $total_amount_with_fees) {
        // Deduct from ads balance and insert into job_adverts table
        $new_ads_balance = $ads_balance - $total_amount_with_fees;
        $update_balance_sql = "UPDATE `users` SET `ads_balance` = '$new_ads_balance' WHERE `id` = '$uid'";
        mysqli_query($con, $update_balance_sql);

       $insert_sql = "INSERT INTO job_adverts (user_id, title, category_id, subcategory_id, description, amount_per_task, num_tasks, total_amount, screenshots_required, sample_screenshots, banner, created_at) 
          VALUES ('$uid', '$title', '$category', '$subcategory', '$description', '$amount_per_task', '$num_tasks', '$total_amount_with_fees', '$screenshots_required', '$ads_screenshot_name', '$ads_banner_name', NOW())";

        if (mysqli_query($con, $insert_sql)) {
            // Redirect or show success message
            //header("Location: success_page.php");
            $msg="Ad Uploaded Successfully. Wait for review";
            $type="success";
        } else {
            // Handle error
            $msg="Error: " . mysqli_error($con);
            $type="warning";
        }
    } elseif ($referral_balance >= $total_amount_with_fees) {
        // Deduct from referral balance and insert into job_adverts table
        $new_referral_balance = $referral_balance - $total_amount_with_fees;
        $update_balance_sql = "UPDATE `users` SET `ref_bonus` = '$new_referral_balance' WHERE `id` = '$uid'";
        mysqli_query($con, $update_balance_sql);
        
        $insert_sql = "INSERT INTO job_adverts (user_id, title, category_id, subcategory_id, description, amount_per_task, num_tasks, total_amount, screenshots_required, sample_screenshots, banner, created_at) 
         VALUES ('$uid', '$title', '$category', '$subcategory', '$description', '$amount_per_task', '$num_tasks', '$total_amount_with_fees', '$screenshots_required', '$ads_screenshot_name', '$ads_banner_name', NOW())";

        if (mysqli_query($con, $insert_sql)) {
            // Redirect or show success message
            //header("Location: success_page.php");
            $msg="Ad Uploaded Successfully. Wait for review";
            $type="success";
        } else {
            // Handle error
            $msg="Error: " . mysqli_error($con);
            $type="warning";
        }
    } else {
        // Insufficient balance, show error message
            $msg="Insufficient balance to create the campaign.";
            $type="warning";
    }
}


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

.category-wrapper {
        margin-bottom: 20px;
    }

    .category-item {
        margin-bottom: 20px;
        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
         padding-top:20px;
         padding-bottom:20px;
    }

    .subcategory-list {
        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;
    }

    .subcategory-item {
        margin-right: 20px;
        margin-bottom: 0px;
        cursor: pointer;
        margin-top:3px;
    }

    .subcategory-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 5px;
    }

    .subcategory-item span {
        display: block;
        text-align: center;
    }
    .category-heading{
        margin-bottom:20px;
        font-size:18px;
    }

/* Tooltip container */
.tooltip {
    position: relative;
}

/* Tooltip text */
.tooltip .tooltiptext {
    visibility: hidden;
    width: 200px;
    background-color: #000;
    color: #fff;
    text-align: center;
    border-radius: 50%;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
}

/* Tooltip text visibility */
.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}

</style>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h4>Create Campaign</h4>
                    <p style="padding-top:5px;"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
                         <?php if(isset($msg)){ ?>
                                <div class="alert alert-<?php echo $type?>">
                                <h6 class="alert-heading fw-bold mb-1"><?php echo $type?></h6>
                                <p class="mb-0"><?php echo $msg?></p>
                                </div>
                        <?php }?>
                    <div class="card border-0">
                       
                <div class="card-body ">
                <form id="categoryForm" action="" method="post">
                        <h1 class="category-heading">Select Category</h1>
            <?php 
                    while ($category_row = mysqli_fetch_assoc($categories_result)) { 
                        // Fetch subcategories for this category
                        $category_id = $category_row['id'];
                        $subcategory_sql = "SELECT * FROM subcategories WHERE category_id = $category_id";
                        $subcategory_result = mysqli_query($con, $subcategory_sql);
                        ?>
                        <div class="category-wrapper">
                            <div class="card col-12 category-item" data-category-id="<?php echo $category_row['id']; ?>">
                                <h5 class="mb-1"><?php echo $category_row['name']; ?></h5>
                                <div class="subcategory-list">
                                    <?php 
                                    while ($subcategory_row = mysqli_fetch_assoc($subcategory_result)) { 
                                        // Assuming you have an image URL stored in the database for each subcategory
                                                                              ?>
                                        <div class="subcategory-item" data-subcategory-id="<?php echo $subcategory_row['id']; ?>">
                                            <span><?php echo $subcategory_row['name']; ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            </form>

            <form id="campaignForm" action="" method="post" enctype="multipart/form-data" style="display: none;">
                <h1 class="category-heading" id="selectedCategoryName"></h1>
              <input type="hidden" id="selectedCategoryId" name="selected_category_id" value="">
              <input type="hidden" id="selectedSubCategoryId" name="selected_subcategory_id" value="">

            <div class="form-group mb-3">
                <label for="title" >Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description:-<span style="font-size:13px;">Also add your link here</span></label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="amount_per_task">Amount per Task (NGN):</label>
                <input type="number" class="form-control" id="amount_per_task" name="amount_per_task"  placeholder="min 50 NGN" required>
            </div>
            <div id="min_amount_warning" style="color: red;font-size:12px;margin-bottom:10px;margin-top:10px;"></div>
            <div class="form-group mb-3">
                <label for="num_tasks">Number of Employees:</label>
                <input type="number" class="form-control" id="num_tasks" name="num_tasks" placeholder="min 50" required>
                <div id="min_employees_warning" style="color: red;font-size:12px;margin-top:10px;"></div>
            </div>
            <div class="form-group mb-3">
                <label for="total_amount" class="tooltip">
                    Total Amount (NGN):<i class="fas fa-info-circle"></i>
                </label>
                <input type="number" class="form-control" id="total_amount" name="total_amount" disabled>
                <input type="hidden" id="total_amount" name="total_amount">
                <span>Review fee is ₦<?php echo $review_charge;?> and ads service fee is <?php echo $fee_percentage?>%</span>
            </div> 
            <div class="form-group mb-3">
                <label for="sample_upload">Upload Sample:</label>
                <input type="file" class="form-control" id="sample_upload" name="sample_upload" accept="image/*" style="display: none;">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="screenshots_required" name="screenshots_required">
                <label class="form-check-label" for="screenshots_required">Screenshots Required</label>
            </div>
            <div class="form-group mb-3">
                <label for="ads_banner">Upload Ads Banner (optional):</label>
                <input type="file" class="form-control" id="ads_banner" name="ads_banner" accept="image/*">
            </div>
            <!-- Add other form fields as needed -->
            <button type="submit" class="btn btn-primary mt-3">Submit for Review</button>
        </form>
    </div>
</div>




<script>
   document.addEventListener("DOMContentLoaded", function() {
    const categoryItems = document.querySelectorAll(".category-item");
    const subcategoryItems = document.querySelectorAll(".subcategory-item");
    const amountPerTaskInput = document.getElementById("amount_per_task");
    const numTasksInput = document.getElementById("num_tasks");
    const totalAmountInput = document.getElementById("total_amount");
    const totalAmountDisplay = document.getElementById("total_amount_display");
    const sampleUploadInput = document.getElementById("sample_upload");
    const minEmployeesWarning = document.getElementById("min_employees_warning");
    const minAmountWarning = document.getElementById("min_amount_warning");

    const reviewCharge = <?php echo $review_charge; ?>;
    const feePercentage = <?php echo $fee_percentage; ?>;
    const minAmount = <?php echo $min_amount; ?>;

    categoryItems.forEach(item => {
        item.addEventListener("click", function() {
            const categoryId = item.getAttribute("data-category-id");
            const categoryName = item.querySelector("h5").textContent;
            
            document.getElementById("selectedCategoryId").value = categoryId;
            document.getElementById("selectedCategoryName").textContent = categoryName;
            
            document.getElementById("categoryForm").style.display = "none";
            document.getElementById("campaignForm").style.display = "block";
        });
    });

    subcategoryItems.forEach(item => {
        item.addEventListener("click", function() {
            console.log("Subcategory selected:", subcategoryId);


                    const subcategoryId = subItem.getAttribute("data-subcategory-id");
                    const subcategoryName = subItem.querySelector("span").textContent;

                    document.getElementById("selectedSubCategoryId").value = subcategoryId;
                    document.getElementById("selectedCategoryName").textContent = categoryName + " - " + subcategoryName;

                    // Display campaign form
                    document.getElementById("categoryForm").style.display = "none";
                    document.getElementById("campaignForm").style.display = "block";
        });
    });

    const updateTotalAmount = () => {
        const amountPerTask = parseFloat(amountPerTaskInput.value) || 0;
        const numTasks = parseInt(numTasksInput.value) || 0;
        const feeAmount = amountPerTask * numTasks * feePercentage;
        const totalAmount = amountPerTask * numTasks + reviewCharge + feeAmount;
        totalAmountInput.value = totalAmount.toFixed(2);
        totalAmountDisplay.value = totalAmount.toFixed(2); // Update the displayed value
    };

    amountPerTaskInput.addEventListener("input", updateTotalAmount);
    numTasksInput.addEventListener("input", updateTotalAmount);

    // Show sample upload input if screenshots are required
    const screenshotsRequiredCheckbox = document.getElementById("screenshots_required");
    screenshotsRequiredCheckbox.addEventListener("change", function() {
        if (this.checked) {
            sampleUploadInput.style.display = "block";
        } else {
            sampleUploadInput.style.display = "none";
        }
    });

    // Validate number of employees and display warning
    numTasksInput.addEventListener("input", function() {
        const minEmployees = 50;
        const numEmployees = parseInt(this.value);
        if (numEmployees < minEmployees) {
            minEmployeesWarning.textContent = "Number of employees cannot be less than " + minEmployees;
        } else {
            minEmployeesWarning.textContent = "";
        }
    });

    // Check minimum amount when the user leaves the input field
    amountPerTaskInput.addEventListener("blur", function() {
        const amount = parseFloat(this.value);
        if (amount < minAmount) {
            minAmountWarning.textContent = "Amount per task cannot be less than " + minAmount + " NGN";
        } else {
            minAmountWarning.textContent = "";
        }
    });
});

</script>

<?php include 'includes/footer.php'; ?>
