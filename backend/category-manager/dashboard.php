<?php
// Category Manager — Dashboard (product-table variant; no charts)
// Canonical schema: products(product_name, image_path, quantity, availability, threshold_value)
include __DIR__ . '/../includes/db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<form action="dashboard.php" method="get">
  <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
  <button type="submit">Search</button>
</form>

<h3>Low Quantity Products</h3>
<table>
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Availability</th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
      if (!empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE :s AND quantity < threshold_value ORDER BY quantity ASC");
        $stmt->execute([':s' => '%' . $_GET['search'] . '%']);
      } else {
        $stmt = $conn->query("SELECT * FROM products WHERE quantity < threshold_value ORDER BY quantity ASC");
      }
      while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['product_name']) . "'></td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . htmlspecialchars($row['availability']) . "</td>";
        echo "</tr>";
      }
    } catch (PDOException $e) {
      echo "<tr><td colspan='4'>Error: " . $e->getMessage() . "</td></tr>";
    }
    ?>
  </tbody>
</table>

<h3>Top Selling Stock</h3>
<table>
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Availability</th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
      if (!empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE :s AND sales_performance = 'Top-selling' ORDER BY quantity DESC");
        $stmt->execute([':s' => '%' . $_GET['search'] . '%']);
      } else {
        $stmt = $conn->query("SELECT * FROM products WHERE sales_performance = 'Top-selling' ORDER BY quantity DESC");
      }
      while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['product_name']) . "'></td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . htmlspecialchars($row['availability']) . "</td>";
        echo "</tr>";
      }
    } catch (PDOException $e) {
      echo "<tr><td colspan='4'>Error: " . $e->getMessage() . "</td></tr>";
    }
    $conn = null;
    ?>
  </tbody>
</table>

</body>
</html>
