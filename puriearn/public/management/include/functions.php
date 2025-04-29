<?php
// Function to sanitize the input
function sanitize_input($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  $input=htmlentities($input);

  return $input;
}
 
function sanitize_input2($input) {
  $input = trim($input);
  $input = stripslashes($input);

  return $input;
}

  // Function to sanitize the file name
  function sanitizeFileName($fileName)
  {
      $fileName = preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
      $fileName = time() . "_" . $fileName;
      return $fileName;
  }


  // Generate coupon codes
function generateCouponCodes($name, $count, $con) {
  $codes = array();

  for ($i = 0; $i < $count; $i++) {
    $code = generateCouponCode($name, $con);
    $codes[] = $code;
  }

  return $codes;
}

// Generate coupon code
function generateCouponCode($name, $con) {
  $namePrefix = strtoupper(substr($name, 0, 3)); // Extract first three letters and convert to uppercase
  $code = $namePrefix . generateRandomCharacters(9); // Append random characters to the name prefix

  // Check if the generated code already exists in the database
  $exists = checkCodeExists($code, $con);

  // If code exists, recursively generate a new one
  if ($exists) {
    return generateCouponCode($name, $con);
  }

  // Insert the generated code into the database
  insertCouponCode($code, $con);

  return $code;
}

// Insert coupon code into the database
function insertCouponCode($code, $con) {
  // Perform a database query to insert the code into the table
  $vendorId = 0; // Replace with the actual vendor ID
  $planId = 1; // Replace with the actual plan ID
  $amount = 3000; // Replace with the actual amount
  $status = '0'; // Replace with the actual status
  $createdAt = date('Y-m-d H:i:s'); // Current date and time

  $sql = "INSERT INTO coupons (vendor_id, plan_id, amount, coupon_code, status, created_at) VALUES ('$vendorId', '$planId', '$amount', '$code', '$status', '$createdAt')";
  mysqli_query($con, $sql);
}

// Generate random characters
function generateRandomCharacters($length) {
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Possible characters for the code
  $code = '';

  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $code;
}

// Check if code exists in the database
function checkCodeExists($code, $con) {
  // Perform a database query to check if the code exists
  $sql = "SELECT COUNT(*) FROM coupons WHERE `coupon_code` = '$code'";
  $result = mysqli_query($con, $sql);
  $count = mysqli_fetch_row($result)[0];

  return $count > 0;
}

?>