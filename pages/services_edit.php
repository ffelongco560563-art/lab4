<?php
include "../db.php";
 
$id = $_GET['id'];
$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);
 
if (isset($_POST['update'])) {
  $name = mysqli_real_escape_string($conn, $_POST['service_name']);
  $rate = mysqli_real_escape_string($conn, $_POST['hourly_rate']);
  $active = isset($_POST['is_active']) ? 1 : 0;
 
  $sql = "UPDATE services SET service_name='$name', hourly_rate='$rate', is_active='$active' WHERE service_id=$id";
  mysqli_query($conn, $sql);
  header("Location: services_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Service</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: left; 
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }
        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn-update {
            width: 100%;
            background: #2563eb;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-update:hover {
            background: #1d4ed8;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include "../nav.php"; ?>

<div class="form-container">
    <h2 class="page-title" style="text-align: center; font-size: 35px; margin-bottom: 30px;">Edit Service</h2>

    <div class="form-card">
        <form method="post">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="service_name" value="<?php echo $service['service_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Hourly Rate (₱)</label>
                <input type="number" step="0.01" name="hourly_rate" value="<?php echo $service['hourly_rate']; ?>" required>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_active" style="width: 20px; height: 20px;" <?php echo $service['is_active'] ? "checked" : ""; ?>> 
                    <span>Active</span>
                </label>
            </div>

            <button type="submit" name="update" class="btn-update">Update Service Details</button>
        </form>
        
        <a href="services_list.php" class="back-link">Back to Services List</a>
    </div>
</div>

</body>
</html>