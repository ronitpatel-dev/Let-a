<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "letslearn";

// Connect to MySQL database
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data safely
$name   = $_POST['name']   ?? '';
$mobile = $_POST['mobile'] ?? '';
$email  = $_POST['email']  ?? '';
$pass   = $_POST['pass']   ?? '';
$gender = $_POST['gender'] ?? '';

// Debug: Print input values (optional)
// echo "$name, $mobile, $email, $pass, $gender";

// Check if email already exists (optional)
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('This email is already registered!'); window.location.href='register.html';</script>";
} else {
    // Insert data directly
    $sql = "INSERT INTO users (name, mobile, email, password, gender)
            VALUES ('$name', '$mobile', '$email', '$pass', '$gender')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration Successful!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>
