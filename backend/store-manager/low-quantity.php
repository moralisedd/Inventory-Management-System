<?php
// Store Manager — Low Quantity Products
// Canonical schema: products(product_id, product_name, image_path, category, buying_price, quantity, expiry_date, threshold_value, availability)
// Note: original queried 'unit' column which does not exist in schema — removed.
include __DIR__ . '/../includes/db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Low Quantity Products</title>
</head>
<body>

<h2>Low Quantity Products</h2>

<table>
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Product ID</th>
      <th>Category</th>
      <th>Buying Price (£)</th>
      <th>Quantity</th>
      <th>Expiry Date</th>
      <th>Threshold Value</th>
      <th>Availability</th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
      $stmt = $conn->query("SELECT * FROM products WHERE quantity < threshold_value ORDER BY quantity ASC");
      while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['product_name']) . "'></td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['category'] ?? '—') . "</td>";
        echo "<td>£" . number_format($row['buying_price'], 2) . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . ($row['expiry_date'] ?? '—') . "</td>";
        echo "<td>" . $row['threshold_value'] . "</td>";
        echo "<td>" . htmlspecialchars($row['availability']) . "</td>";
        echo "</tr>";
      }
    } catch (PDOException $e) {
      echo "<tr><td colspan='9'>Error: " . $e->getMessage() . "</td></tr>";
    }
    $conn = null;
    ?>
  </tbody>
</table>

</body>
</html>
