<?php
session_start();
include('../../config/puri-conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_id'])) {
    $userId = $_SESSION['id'];
    $taskId = $_POST['task_id'];
    
    // Check if the draft already exists
    $checkDraftQuery = "SELECT * FROM tiktok_user_drafts WHERE user_id = $userId AND task_id = $taskId";
    $checkDraftResult = mysqli_query($con, $checkDraftQuery);
    
    if(mysqli_num_rows($checkDraftResult) == 0) {
        // Insert the draft into the tiktok_user_drafts table
        $insertDraftQuery = "INSERT INTO tiktok_user_drafts (user_id, task_id, status) VALUES ($userId, $taskId, 'draft')";
        if(mysqli_query($con, $insertDraftQuery)) {
            $_SESSION['msg'] = "Task has been saved as draft.";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['msg'] = "Failed to save task as draft. Please try again.";
            $_SESSION['type'] = "danger";
        }
    } else {
        $_SESSION['msg'] = "You already have this task saved as draft.";
        $_SESSION['type'] = "warning";
    }
}

header("Location: tiktok-task.php");
exit();
?>
