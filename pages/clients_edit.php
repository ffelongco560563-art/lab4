<?php
include "../db.php";
 
$id = $_GET['id'];
 
$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "UPDATE clients
            SET full_name='$full_name', email='$email', phone='$phone', address='$address'
            WHERE client_id=$id";
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
  <title>Edit Client</title>
  <link rel="stylesheet" href="../styles.css">
  <style>

    .form-container {
      max-width: 600px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .form-card { 
      background: white; 
      padding: 40px; 
      border-radius: 16px; 
      box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
    }
    .form-group { margin-bottom: 20px; }
    .form-group label { 
      display: block; 
      font-weight: 600; 
      margin-bottom: 8px; 
      color: blackS; 
      font-size: 14px;
    }
    .form-group input { 
      width: 100%; 
      padding: 12px; 
      border: 1px solid #000000;
      border-radius: 10px; 
      box-sizing: border-box; 
      font-size: 15px;
      transition: border-color 0.3s;    
    }
    .form-group input:focus {
      outline: none;
      border-color: #2563eb; 
    }
    .btn-update { 
      width: 100%; 
      border: none; 
      cursor: pointer; 
      background: #2563eb; 
      color: white; 
      padding: 14px; 
      border-radius: 12px; 
      font-weight: 600; 
      font-size: 16px; 
      transition: background 0.3s; 
    }
    .btn-update:hover { background: #1d4ed8; }
    .cancel-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #000000;
      text-decoration: none;
      font-size: 14px;
    }
  </style>
</head>
<body>
<?php include "../nav.php"; ?>

<div class="form-container">
  <h2 class="page-title">Edit Client Details</h2>

  <div class="form-card">
    <?php if($message): ?>
      <div style="background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #fecaca;">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
   
    <form method="post">
      <div class="form-group">
        <label>Full Name*</label>
        <input type="text" name="full_name" value="<?php echo $client['full_name']; ?>" required>
      </div>
      <div class="form-group">
        <label>Email Address*</label>
        <input type="email" name="email" value="<?php echo $client['email']; ?>" required>
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" value="<?php echo $client['phone']; ?>">
      </div>
      <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" value="<?php echo $client['address']; ?>">
      </div>
      <button type="submit" name="update" class="btn-update">Update Client Info</button>
    </form>
    
    <a href="clients_list.php" class="cancel-link">Cancel</a>
  </div>
</div>
</body>
</html>