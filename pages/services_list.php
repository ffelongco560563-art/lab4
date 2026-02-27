<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id ASC");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Services List</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container { padding: 20px; max-width: 1200px; margin: auto; text-align: center; }
    
    .data-table { 
        width: 100%; 
        border-collapse: collapse; 
        background: white; 
        border-radius: 12px; 
        overflow: hidden; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
        margin-top: 20px;
    }

    .data-table th { 
        background: #000000;
        color: white; 
        text-align: left; 
        padding: 15px; 
        text-transform: uppercase;
    }

    .data-table td { 
        padding: 15px; 
        border-bottom: 1px solid #e5e7eb; 
        text-align: left;
    }

    .data-table tr:hover { background: #f9fafb; }

    .action-link { 
        color: #2563eb; 
        text-decoration: none; 
        font-weight: 600; 
    }
    .action-link:hover { 
        text-decoration: none !important; 
        color: #1d4ed8; 
    }
  </style>
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
  <h2 class="page-title" style="margin-bottom: 20px;">Services</h2>

  <table class="data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Rate</th>
        <th>Active</th>
        <th style="text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><strong><?php echo $row['service_id']; ?></strong></td>
          <td><?php echo $row['service_name']; ?></td>
          <td>₱<?php echo number_format($row['hourly_rate'], 2); ?></td>
          <td><?php echo $row['is_active'] ? "Yes" : "No"; ?></td>
          <td style="text-align: center;">
            <a href="services_edit.php?id=<?php echo $row['service_id']; ?>" class="action-link">Edit</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>