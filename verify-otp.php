<?php
session_start();

if (!isset($_SESSION["reset_email"])) {
    header("Location: forgot.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];
    $newpass = $_POST["newpass"];
    $email = $_SESSION["reset_email"];

    if ($otp == $_SESSION["otp"]) {
        $conn = mysqli_connect("localhost", "root", "", "letslearn");
        if (!$conn) {
            die("Connection failed!");
        }

        $update = mysqli_query($conn, "UPDATE users SET password='$newpass' WHERE email='$email'");
        if ($update) {
            session_unset();
            session_destroy();
            echo "<script>alert('Password updated successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Failed to update password');</script>";
        }
        mysqli_close($conn);
    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head><title>Verify OTP</title></head>
<body>
  <form method="POST">
    <input type="text" name="otp" placeholder="Enter OTP" required>
    <input type="password" name="newpass" placeholder="New Password" required>
    <button type="submit">Reset Password</button>
  </form>
</body>
</html>
