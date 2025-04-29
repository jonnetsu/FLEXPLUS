<?php
session_start();
// Database connection
include('../../config/puri-conn.php');

// Check if session variables are set
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    // Handle the case where session variables are not set
    $response = array(
        'success' => false,
        'messageOne' => 'Session expired!',
        'messageTwo' => 'Please log in again.'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// Get user's id and username from the session
$uid = $_SESSION['id'];
$username = $_SESSION['username'];

// Get the current date
$today = date("Y-m-d");

// Check for the task activity and give user a bonus
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$res = $stmt->get_result();
$rtask = $res->fetch_assoc();

if ($rtask) {
    $earnings = $rtask['job_balance'];
    $lastTask = $rtask['lastTask']; // Assuming `lastTask` is a column in `users` table
    $TaskBonus = 100;
    $new_earnings = $earnings + $TaskBonus;

    if ($lastTask !== $today) {
        $sql1 = "UPDATE `users` SET `job_balance` = ?, `lastTask` = ? WHERE `id` = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("isi", $new_earnings, $today, $uid);
        $result1 = $stmt1->execute();

        if ($result1) {
            $userid = $uid;


            $jobsql = "INSERT INTO `user_job_tasks` (`user_id`, `job_id`, `completed`, `status`) VALUES (?, '0', '1', 'Confirmed')";
            $stmt3 = $con->prepare($jobsql);
            $stmt3->bind_param("i", $userid); // No need to bind '0', '1', and 'Confirmed' as they are constant strings in the query
            $result3 = $stmt3->execute();
            
            // Set a bonus message to send as a notification
            $bonus_message = "Congrats! You just received your daily task reward for today.";
            $notificationsql = "INSERT INTO `notifications` (`receiver_id`, `action_type`, `body`) VALUES (?, 'Task', ?)";
            $stmt2 = $con->prepare($notificationsql);
            $stmt2->bind_param("is", $userid, $bonus_message);
            $result2 = $stmt2->execute();

            // Set result and message
            $success = true;
            $messageOne = 'Daily Task unlocked!';
            $messageTwo = '₦100 will be added to your ads job earnings';
        } else {
            $success = false;
            $messageOne = 'An Error Occurred!';
            $messageTwo = '₦0 would be added to your ads job earnings';
        }
    } else {
        // Set result and message
        $success = false;
        $messageOne = 'You have unlocked for today!';
        $messageTwo = 'Come back tomorrow!';
    }
} else {
    $success = false;
    $messageOne = 'User not found!';
    $messageTwo = '₦0 would be added to your ads job earnings';
}

// Prepare the response as JSON
$response = array(
    'success' => $success,
    'messageOne' => $messageOne,
    'messageTwo' => $messageTwo
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
