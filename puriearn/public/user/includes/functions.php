<?php 
require_once '../../config/puri-conn.php';

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

// Calculate loan elegibility
function calculateLoanEligibility($referrals) {
  $loanAmount = 0;
  
  if ($referrals >= 70 && $referrals < 140) {
      $loanAmount = 10000;
  } elseif ($referrals >= 140 && $referrals < 210) {
      $loanAmount = 20000;
  } elseif ($referrals >= 210 && $referrals < 280) {
      $loanAmount = 30000;
  } elseif ($referrals >= 280 && $referrals < 350) {
      $loanAmount = 40000;
  } elseif ($referrals >= 350 && $referrals < 420) {
      $loanAmount = 50000;
  } elseif ($referrals >= 420 && $referrals < 490) {
      $loanAmount = 60000;
  } elseif ($referrals >= 490 && $referrals < 560) {
      $loanAmount = 70000;
  } elseif ($referrals >= 560 && $referrals < 630) {
      $loanAmount = 80000;
  } elseif ($referrals >= 630 && $referrals < 700) {
      $loanAmount = 90000;
  } elseif ($referrals >= 700) {
      $loanAmount = 100000;
  }
  
  return $loanAmount;
}


function generateRandomCharacters($length) {
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Possible characters for the code
  $code = '';

  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $code;
}


function formatPostDescription($description) {
  // Convert URLs to clickable links
  $pattern = '/((https?:\/\/)[^\s]+)/i';
  $replacement = '<a href="$1" target="_blank">$1</a>';
  $description = preg_replace($pattern, $replacement, $description);

  return $description;
}


function randString($length, $charset='123456789'){
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
  }

  function generate_unique_referral_code($con, $username) {
    $attempts = 0;
    $max_attempts = 10; // Maximum attempts to generate a unique referral code
    $referral_code = null;

    while ($attempts < $max_attempts) {
        // Generate a referral code
        $random_string = generate_random_string(6);
        $referral_code = substr($username, 0, 5) . '-' . $random_string;

        // Check if the generated referral code already exists
        $queryCheck = "SELECT * FROM users WHERE referral_code = ?";
        $stmtCheck = mysqli_prepare($con, $queryCheck);
        mysqli_stmt_bind_param($stmtCheck, "s", $referral_code);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);

        if (mysqli_num_rows($resultCheck) == 0) {
            return $referral_code; // Unique referral code found
        }

        $attempts++;
    }

    return null; // Failed to generate a unique referral code
}

//Generate coupon code 
function generateCouponCode($name) {
    $namePrefix = strtoupper(substr($name, 0, 3)); // Extract first three letters and convert to uppercase
    $code = $namePrefix . generateRandomCharacters(9); // Append random characters to the name prefix
  
    // Check if the generated code already exists in the database
    $exists = checkCodeExists($code);
  
    // If code exists, recursively generate a new one
    if ($exists) {
      return generateCouponCode($name);
    }
  
    return $code;
  }

  
function generate_random_string($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}

function getRecipientId($username_email) {
    global $con; // Use the global connection variable

    // Sanitize the input
    $username_email = mysqli_real_escape_string($con, $username_email);

    // Prepare the SQL query
    $sql = "SELECT `id` FROM `users` WHERE `username`=? OR `email`=?";
    
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Bind the result
        mysqli_stmt_bind_result($stmt, $recipient_id);
        
        // Fetch the result
        if (mysqli_stmt_fetch($stmt)) {
            // Close statement
            mysqli_stmt_close($stmt);
            return $recipient_id;
        } else {
            // Close statement
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        return false;
    }
}

// Function to get the token from the database by name
function getTokenByName($con, $tokenName) {
    // Prepare the SQL query
    $sql = "SELECT token FROM api_tokens WHERE name = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $tokenName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $token;
}
?>