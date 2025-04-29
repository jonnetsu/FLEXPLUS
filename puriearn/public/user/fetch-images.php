<?php
include('../../config/puri-conn.php');

// Fetch image URLs from the database
$query = "SELECT image_url FROM images WHERE status= '1' ";
$result = mysqli_query($con, $query);

$imageUrls = array();
if ($result) {
    // Fetch each row and store the image URLs in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $image=$row['image_url'];
        $imagepath="../admin/banners/$image";
        $imageUrls[] = $imagepath;
    }
}

// Return the image URLs as JSON response
header('Content-Type: application/json');
echo json_encode($imageUrls);
?>
