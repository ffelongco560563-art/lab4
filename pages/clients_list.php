<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id ASC");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Clients List</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .data-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .data-table th { background: #111827; color: white; text-align: left; padding: 15px; }
    .data-table td { padding: 15px; border-bottom: 1px solid #e5e7eb; }
    .data-table tr:hover { background: #f9fafb; }
    .action-link { color: #2563eb; text-decoration: none; font-weight: 600; }
    .container { padding: 20px; max-width: 1200px; margin: auto; }
  </style>
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h2 class="page-title">Clients</h2>
    <a href="clients_add.php" class="btn">+ Add New Client</a>
  </div>

  <table class="data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th style="text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><strong>#<?php echo $row['client_id']; ?></strong></td>
          <td><?php echo $row['full_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>
          <td style="text-align: center;">
            <a href="clients_edit.php?id=<?php echo $row['client_id']; ?>" class="action-link">Edit</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>