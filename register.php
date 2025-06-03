<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "user_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
$gender = $_POST['gender'];

// Insert into database
$sql = "INSERT INTO users (name, age, email, password, gender) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sisss", $name, $age, $email, $password, $gender);

if ($stmt->execute()) {
    echo "<h2>Registration Successful!</h2>";
    echo "<p><a href='register.html'>Go Back</a></p>";
} else {
    echo "<h3>Error: " . $stmt->error . "</h3>";
}

$stmt->close();
$conn->close();
?>
