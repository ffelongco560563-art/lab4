<?php
include "../db.php";
 
$clients = mysqli_query($conn, "SELECT * FROM clients ORDER BY full_name ASC");
$services = mysqli_query($conn, "SELECT * FROM services WHERE is_active=1 ORDER BY service_name ASC");
 
if (isset($_POST['create'])) {
  $client_id = $_POST['client_id'];
  $service_id = $_POST['service_id'];
  $booking_date = $_POST['booking_date'];
  $hours = $_POST['hours'];
 
  $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hourly_rate FROM services WHERE service_id=$service_id"));
  $rate = $s['hourly_rate'];
  $total = $rate * $hours;
 
  mysqli_query($conn, "INSERT INTO bookings (client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status)
    VALUES ($client_id, $service_id, '$booking_date', $hours, $rate, $total, 'PENDING')");
 
  header("Location: bookings_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create Booking</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .form-container { max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-card { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: left; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: #374151; }
        .form-group select, .form-group input { width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; box-sizing: border-box; }
        .btn-create { width: 100%; background: #2563eb; color: white; padding: 14px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-create:hover { background: #1d4ed8; }
    </style>
</head>
<body>
<?php include "../nav.php"; ?>

<div class="form-container">
    <h2 style="text-align: center; font-size: 35px; margin-bottom: 30px;">Create Booking</h2>
    <div class="form-card">
        <form method="post">
          <div class="form-group">
            <label>Select Client</label>
            <select name="client_id">
              <?php while($c = mysqli_fetch_assoc($clients)) { ?>
                <option value="<?php echo $c['client_id']; ?>"><?php echo $c['full_name']; ?></option>
              <?php } ?>
            </select>
          </div>
         
          <div class="form-group">
            <label>Select Service</label>
            <select name="service_id">
              <?php while($s = mysqli_fetch_assoc($services)) { ?>
                <option value="<?php echo $s['service_id']; ?>"><?php echo $s['service_name']; ?> (₱<?php echo $s['hourly_rate']; ?>/hr)</option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Booking Date</label>
            <input type="date" name="booking_date" required>
          </div>

          <div class="form-group">
            <label>Hours Required</label>
            <input type="number" name="hours" min="1" value="1" required>
          </div>
         
          <button type="submit" name="create" class="btn-create">Save Booking</button>
        </form>
    </div>
</div>
</body>
</html>