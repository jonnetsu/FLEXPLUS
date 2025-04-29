<?php
session_start();
include('../../config/puri-conn.php');

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "You need to be logged in to complete tasks.";
    exit;
}

$uid = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = intval($_POST['task_id']);

    // Check if the task is already marked as done using a prepared statement
    $check_query = "SELECT * FROM claim_task WHERE user_id=? AND task_id=?";
    if ($stmt = mysqli_prepare($con, $check_query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $uid, $task_id);
        mysqli_stmt_execute($stmt);
        $check_res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($check_res) > 0) {
            echo "Task already completed.";
            mysqli_stmt_close($stmt);
            exit;
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
        exit;
    }

    // Insert the completed task into the database using a prepared statement
    $insert_query = "INSERT INTO claim_task (user_id, task_id, completed_at) VALUES (?, ?, NOW())";
    if ($stmt = mysqli_prepare($con, $insert_query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $uid, $task_id);
        if (mysqli_stmt_execute($stmt)) {

              // Only mark task as done and update cashback if it's the 4th step
       if ($task_id == 4) {

            // Update the task status
            $update_task_query = "UPDATE claim_task SET status='1' WHERE id=?";
            if ($update_stmt = mysqli_prepare($con, $update_task_query)) {
                mysqli_stmt_bind_param($update_stmt, 'i', $task_id);
                mysqli_stmt_execute($update_stmt);
                mysqli_stmt_close($update_stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($con);
                mysqli_stmt_close($stmt);
                exit;
            }

            // Update the user's cashback
            $update_cashback_query = "UPDATE users SET cashback = cashback + 2000 WHERE id=?";
            if ($cashback_stmt = mysqli_prepare($con, $update_cashback_query)) {
                mysqli_stmt_bind_param($cashback_stmt, 'i', $uid);
                mysqli_stmt_execute($cashback_stmt);
                mysqli_stmt_close($cashback_stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($con);
                mysqli_stmt_close($stmt);
                exit;
            }
        }
            echo "Task marked as done successfully.";
        } else {
            echo "Error marking task as done: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }

} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($con);
?>
