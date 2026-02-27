<?php
include "../db.php";
$sql = "SELECT b.*, c.full_name AS client_name, s.service_name FROM bookings b 
        JOIN clients c ON b.client_id = c.client_id 
        JOIN services s ON b.service_id = s.service_id 
        ORDER BY b.booking_id ASC";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bookings List</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .container { padding: 20px; max-width: 1200px; margin: auto; text-align: center; }
        .data-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 20px; }
        .data-table th { background: #000000; color: white; text-align: left; padding: 15px; text-transform: uppercase; }
        .data-table td { padding: 15px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .action-link { color: #2563eb; text-decoration: none; font-weight: 600; }
        .btn-new { background: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; float: right; }
    </style>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <div style="overflow: hidden; margin-bottom: 20px;">
        <h2 class="page-title" style="display: inline-block; float: left;">Bookings</h2>
        <a href="bookings_create.php" class="btn-new">+ Create Booking</a>
    </div>
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th><th>Client</th><th>Service</th><th>Date</th><th>Hours</th><th>Total</th><th>Status</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($b = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><strong><?php echo $b['booking_id']; ?></strong></td>
            <td><?php echo $b['client_name']; ?></td>
            <td><?php echo $b['service_name']; ?></td>
            <td><?php echo $b['booking_date']; ?>
            <td><?php echo $b['hours']; ?></td>
            <td>₱<?php echo number_format($b['total_cost'],2); ?></td>
            <td><?php echo $b['status']; ?></td>
            <td>
              <a href="payments_add.php?booking_id=<?php echo $b['booking_id']; ?>" class="action-link">Process Payment</a>
            </td>
          </tr>
      <?php } ?>
</table>
</body>
</html>