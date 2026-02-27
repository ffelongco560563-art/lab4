<?php
include "../db.php";
$message = "";
if (isset($_POST['save'])) {
  $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "INSERT INTO clients (full_name, email, phone, address) VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Client</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .form-card { background: white; padding: 30px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width: 500px; margin: 40px auto; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 5px; color: #374151; }
    .form-group input { width: 100%; padding: 12px; border: 1px solid #000000; border-radius: 8px; box-sizing: border-box; }
    .btn-submit { width: 100%; border: none; cursor: pointer; background: #2563eb; color: white; padding: 14px; border-radius: 10px; font-weight: 600; font-size: 16px; transition: 0.3s; }
    .btn-submit:hover { background: #1d4ed8; }
  </style>
</head>
<body>
<?php include "../nav.php"; ?>
X
<div class="form-card">
  <h2 class="page-title">Add Client</h2>
  <?php if($message): ?>
    <div style="background: #a51919; color: #f3f3f3; padding: 10px; border-radius: 8px; margin-bottom: 15px;"><?php echo $message; ?></div>
  <?php endif; ?>
 
  <form method="post">
    <div class="form-group">
      <label>Full Name*</label>
      <input type="text" name="full_name" placeholder="Enter you full name">
    </div>
    <div class="form-group">
      <label>Email Address*</label>
      <input type="email" name="email" placeholder="Enter you email">
    </div>
    <div class="form-group">
      <label>Phone Number</label>
      <input type="text" name="phone" placeholder="Enter you number">
    </div>
    <div class="form-group">
      <label>Address</label>
      <input type="text" name="address" placeholder="Enter your address">
    </div>
    <button type="submit" name="save" class="btn-submit">Save Client</button>
  </form>
  <p style="text-align: center; margin-top: 15px;"><a href="clients_list.php" style="color: #ffffff; text-decoration: none;">Cancel</a></p>
</div>
</body>
</html>