<?php
// Shared: all roles — Manage Store page
// Canonical schema: store_branches(branch_id, branch_name, address, postcode, country)
// Note: original code queried 'manage_store' table (wrong name). Fixed to 'store_branches'.
include __DIR__ . '/../includes/db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Manage Store</title>
</head>
<body>

<h2>Manage Store</h2>

<div class="cards-container">
  <?php
  try {
    $stmt = $conn->query("SELECT * FROM store_branches ORDER BY branch_id");
    while ($row = $stmt->fetch()) {
  ?>
    <div class="card">
      <div class="card-section">
        <p class="label">Store Branch</p>
      </div>
      <div class="card-section">
        <p><strong>Branch Name:</strong> <?php echo htmlspecialchars($row['branch_name']); ?></p>
        <p><strong>Address:</strong>     <?php echo htmlspecialchars($row['address']); ?></p>
        <p><strong>Postcode:</strong>    <?php echo htmlspecialchars($row['postcode']); ?></p>
        <p><strong>Country:</strong>     <?php echo htmlspecialchars($row['country']); ?></p>
      </div>
    </div>
  <?php
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>
</div>

</body>
</html>
