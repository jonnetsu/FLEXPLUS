<?php
require_once '../../../config/conn.php';

if (!empty($_POST["username"])) {
    $username = $_POST["username"];

    // Validate the username
    if (preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        // Check if the username exists in the database
        $sql = mysqli_query($con, "SELECT `username` FROM `users` WHERE `username`='$username'");
        $count = mysqli_num_rows($sql);

        if ($count > 0) {
            // Username already exists
            ?>
            <span style='color:#ff4e00;padding-left:0px;font-size:13px;'>An account with this username already exists!</span>
            <i id="username-checkmark" class="fas fa-times" style="color: red;"></i>
            <script>$('#submit1').prop('disabled', true);</script>
            <?php
        } else {
            // Username is available
            ?>
            <span style='color:green;padding-left:0px;font-size:13px;'>Username Available</span>
            <i id="username-checkmark" class="fas fa-check" style="color: green;"></i>
            <script>$('#submit1').prop('disabled', false);</script>
            <?php
        }
    } else {
        // Username contains invalid characters or spaces
        ?>
        <span style='color:#ff4e00;padding-left:0px;font-size:13px;'>Invalid username. Only letters, numbers, and underscores are allowed, and no spaces.</span>
        <i id="username-checkmark" class="fas fa-times" style="color: red;"></i>
        <script>$('#submit1').prop('disabled', true);</script>
        <?php
    }
}
?>
