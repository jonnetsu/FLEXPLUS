<?php
session_start();
error_reporting(0);
include('../../config/puri-conn.php');
include('include/checklogin.php');
check_login();
include('include/header.php');
include('include/sidebar.php');
$title = "Admins";

if (isset($_GET['del'])) {
    mysqli_query($con, "DELETE FROM `coupons` WHERE `id` = '" . $_GET['id'] . "'");
    echo "<script>window.location.href='all-coupons.php';</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_codes'])) {
    $selectedCodes = $_POST['selected_codes'];

    // Prepare the coupon codes for copying
    $copyContent = implode("\n", $selectedCodes);

    // Set the appropriate headers to force a plain text response
    header('Content-Type: text/plain');
    header('Content-Disposition: inline');

    // Output the copy content
    echo $copyContent;
    exit;
}
?>

<div class="container-fluid py-4">
    <div class="card" style="padding:30px;">
        <h5 class="card-header">All Users</h5>
        <div class="table-responsive table-wrapper-top text-nowrap">
        <button id="copyButton" type="button" onclick="copySelectedCodes()" class="btn btn-primary">Copy to Clipboard</button>

            <p style="padding-left:10vw;color:#cb0c9f;"><?php if ($msg) {
                                                                    echo htmlentities($msg);
                                                                } ?> </h5>
            <form id="generateFileForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              

                <table class="table table-bordered" id="dataTables-example">
                    <thead>
                        <tr class="text-nowrap">
                            <th></th>
                            <th>SN</th>
                            <th>Code</th>
                            <th>Vendor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `coupons` ";
                        $result = mysqli_query($con, $query);
                        $cnt = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $vid = $row['vendor_id'];
                                $couponCode = $row['coupon_code'];
                        ?>
                        <tr>
                            <td><input type="checkbox" name="selected_codes[]"
                                    value="<?php echo $couponCode; ?>"></td>

                            <td><?php echo $cnt++; ?></td>
                            <td>
                                <button onclick="copyToClipboard('<?php echo $couponCode; ?>')"
                                    class="btn btn-primary">
                                    <i class="fa fa-copy"></i>
                                </button>
                                <?php echo htmlentities($row['coupon_code']); ?>
                            </td>
                            <td>
                                <?php
                                        $query2 = "SELECT * FROM `users`  WHERE `id`='$vid' ";
                                        $query_run = mysqli_query($con, $query2);
                                        $data = mysqli_fetch_array($query_run);
                                        ?>
                                <?php echo $data['username']; ?>
                            </td>
                            <td>
                                <?php
                                        if ($row['status'] == '1') { ?>
                                <span class="btn btn-warning">Used </span>
                                <?php } else { ?>
                                <span class="btn btn-success">Active
                                </span>
                                <?php } ?>
                            </td>
                            <td class="align-middle">
                                <a href="?id=<?php echo $row['id']; ?>&del=delete"
                                    onClick="return confirm('Are you sure you want to delete coupon?')"
                                    class="btn btn-danger deactivate-account">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }
                        } else {
                            echo "No Record Found!";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<div style="margin-left:10vw;height:30vh;"></div>

<script>
    function copyToClipboard(text) {
        // Create a temporary textarea element
        var textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);

        // Select the text and copy it to the clipboard
        textarea.select();
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(textarea);

        // Show a notification or perform any other action upon successful copying
        alert('Coupon code copied to clipboard: ' + text);
    }

    function copySelectedCodes() {
        var selectedCodes = [];
        var checkboxes = document.getElementsByName("selected_codes[]");

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedCodes.push(checkboxes[i].value);
            }
        }

        if (selectedCodes.length > 0) {
            var copyButton = document.getElementById("copyButton");
            copyButton.style.display = "block";

            // Create a temporary textarea element
            var textarea = document.createElement('textarea');
            textarea.value = selectedCodes.join("\n");
            document.body.appendChild(textarea);

            // Select the text and copy it to the clipboard
            textarea.select();
            document.execCommand('copy');

            // Remove the temporary textarea
            document.body.removeChild(textarea);

            // Show a notification or perform any other action upon successful copying
            alert('Coupon codes copied to clipboard.');

            // Hide the button after copying
            copyButton.style.display = "none";
        } else {
            alert('Please select at least one coupon code.');
        }
    }
</script>

<?php include('include/footer.php'); ?>
