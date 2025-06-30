<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $conn = mysqli_connect("localhost", "root", "", "letslearn");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION["reset_email"] = $email;
        $_SESSION["otp"] = rand(100000, 999999);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'yourgmail@gmail.com';         // ← your Gmail
            $mail->Password   = 'your-app-password';           // ← your App Password
            $mail->SMTPSecure = 'tls';git rm --cached Let-a
rm .gitmodules
git commit -m "Removed broken submodule reference"
git push origin main

            $mail->Port       = 587;

            $mail->setFrom('yourgmail@gmail.com', 'Lets Learn');
            $mail->addAddress($email);
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = "Your OTP is: <b>{$_SESSION['otp']}</b>";

            $mail->isHTML(true);
            $mail->send();

            echo "<script>alert('OTP sent to your email'); window.location.href='verify-otp.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Mail Error: " . $mail->ErrorInfo . "');</script>";
        }
    } else {
        echo "<script>alert('Email not found!');</script>";
    }

    mysqli_close($conn);
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head><title>Forgot Password</title></head>
<body>
  <form method="POST">
    <input type="email" name="email" placeholder="Enter your registered email" required>
    <button type="submit">Send OTP</button>
  </form>
</body>
</html>
