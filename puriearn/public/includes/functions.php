<?php 


// Function to sanitize the input
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input=htmlentities($input);
  
    return $input;
  }

?>