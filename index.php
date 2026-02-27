 <?php
include "db.php";
 
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
 
$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>
<!doctype html>
<html>
<head>
  
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "nav.php"; ?>
 
<h2>Dashboard</h2>

<div class="dashboard-stats">
  <div class="stat-card">
    <h3>Total Clients</h3>
    <p><?php echo $clients; ?></p>
  </div>
  <div class="stat-card">
    <h3>Total Services</h3>
    <p><?php echo $services; ?></p>
  </div>
  <div class="stat-card">
    <h3>Total Bookings</h3>
    <p><?php echo $bookings; ?></p>
  </div>
  <div class="stat-card">
    <h3>Total Revenue</h3>
    <p>₱<?php echo number_format($revenue,2); ?></p>
  </div>
</div>

<div class="quick-actions">
    <p><span class="quick-links-label">Quick Links:</span></p> 
    <a href="pages/clients_add.php" class="btn">Add New Client</a>
    <a href="pages/bookings_add.php" class="btn">Create New Booking</a>
</div>