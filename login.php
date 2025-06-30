<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "letslearn";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    
    // Verify hashed password
if ($pass == $row['password'])  // plain password check
 {
        echo "<script>alert('Login successful!'); window.location.href='home.html';</script>";
    } else {
        echo "<script>alert('Invalid password.'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Email not registered.'); window.location.href='index.html';</script>";
}

mysqli_close($conn);
?>
