<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <style>
    label { display: inline-block; width: 100px; margin-top: 10px; }
    input, select { margin-top: 10px; }
  </style>
  <script>
    function enableEdit() {
      const fields = document.querySelectorAll('input:not([type=hidden]), select');
      fields.forEach(field => field.removeAttribute('readonly'));
      document.getElementById("editBtn").style.display = "none";
      document.getElementById("saveBtn").style.display = "inline";
    }
  </script>
</head>
<body>
  <h2>My Profile</h2>
  
  <form action="update_profile.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" readonly><br>
    
    <label>Mobile:</label>
    <input type="text" name="mobile" value="<?php echo $user['mobile']; ?>" readonly><br>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" readonly><br>
    
    <label>Gender:</label>
    <select name="gender" disabled>
      <option value="Male" <?php if($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
      <option value="Female" <?php if($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
    </select><br><br>

    <button type="button" id="editBtn" onclick="enableEdit()">Edit</button>
    <button type="submit" id="saveBtn" style="display:none;">Save</button>
  </form>
</body>
</html>
