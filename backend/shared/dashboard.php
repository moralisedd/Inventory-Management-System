<?php
// Shared: Store Manager + Warehouse Manager dashboard.
// Fetch all stats up front so the chart inline script can reuse values without re-querying.
include __DIR__ . '/../includes/db_config.php';

// Aggregate order stats in one query.
try {
    $row = $conn->query("
        SELECT
            COUNT(*)                                     AS total_orders,
            SUM(order_value)                             AS total_value,
            SUM(quantity)                                AS total_qty,
            COUNT(CASE WHEN status = 'Returned' THEN 1 END) AS returned_count,
            SUM(CASE WHEN status = 'Returned' THEN order_value ELSE 0 END) AS returned_value
        FROM orders
    ")->fetch();
} catch (PDOException $e) {
    $row = ['total_orders' => 0, 'total_value' => 0, 'total_qty' => 0, 'returned_count' => 0, 'returned_value' => 0];
}

// Product revenue/cost totals — reused in the chart below.
try {
    $products = $conn->query("
        SELECT
            COUNT(*)                       AS total_products,
            SUM(selling_price * quantity)  AS revenue,
            SUM(buying_price  * quantity)  AS cost
        FROM products
    ")->fetch();
} catch (PDOException $e) {
    $products = ['total_products' => 0, 'revenue' => 0, 'cost' => 0];
}

// Order counts by status for the doughnut chart.
$statuses = ['Confirmed', 'Out for Delivery', 'Delayed', 'Returned'];
$statusCounts = [];
try {
    $s = $conn->prepare("SELECT COUNT(*) FROM orders WHERE status = :s");
    foreach ($statuses as $status) {
        $s->execute([':s' => $status]);
        $statusCounts[] = (int) $s->fetchColumn();
    }
} catch (PDOException $e) {
    $statusCounts = [0, 0, 0, 0];
}

// Low-stock products for the preview cards.
try {
    $lowStock = $conn->query("SELECT * FROM products WHERE quantity < threshold_value LIMIT 3")->fetchAll();
} catch (PDOException $e) {
    $lowStock = [];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h2>Dashboard</h2>

<div class="grid-container">
  <div class="grid-item">
    <h3>Total Orders</h3>
    <p><?php echo (int) $row['total_orders']; ?></p>
  </div>
  <div class="grid-item">
    <h3>Total Order Value</h3>
    <p>£<?php echo number_format($row['total_value'], 2); ?></p>
  </div>
  <div class="grid-item">
    <h3>Total Returned</h3>
    <p><?php echo (int) $row['returned_count']; ?></p>
  </div>
  <div class="grid-item">
    <h3>Returned Value</h3>
    <p>£<?php echo number_format($row['returned_value'], 2); ?></p>
  </div>
</div>

<div class="grid-container" style="margin-top:20px;">
  <div class="grid-item">
    <h3>Total Quantity Ordered</h3>
    <p><?php echo (int) $row['total_qty']; ?></p>
  </div>
  <div class="grid-item">
    <h3>Total Products</h3>
    <p><?php echo (int) $products['total_products']; ?></p>
  </div>
  <div class="grid-item">
    <h3>Revenue (Selling)</h3>
    <p>£<?php echo number_format($products['revenue'], 2); ?></p>
  </div>
  <div class="grid-item">
    <h3>Net Purchase Value</h3>
    <p>£<?php echo number_format($products['cost'], 2); ?></p>
  </div>
</div>

<?php if ($lowStock): ?>
<div class="grid-container" style="margin-top:20px;">
  <?php foreach ($lowStock as $item): ?>
    <div class="grid-item">
      <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" style="max-width:100px;">
      <h4><?php echo htmlspecialchars($item['product_name']); ?></h4>
      <p>Quantity: <?php echo $item['quantity']; ?></p>
      <p>Buying Price: £<?php echo number_format($item['buying_price'], 2); ?></p>
    </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<h2>Sales vs Purchase Chart</h2>
<canvas id="salesPurchaseChart"></canvas>

<h2>Orders by Status Chart</h2>
<canvas id="ordersChart"></canvas>

<script>
  new Chart(document.getElementById('salesPurchaseChart'), {
    type: 'bar',
    data: {
      labels: ['Revenue (Selling)', 'Net Purchase Cost'],
      datasets: [{
        label: 'Amount (£)',
        data: [<?php echo (float) $products['revenue']; ?>, <?php echo (float) $products['cost']; ?>],
        backgroundColor: ['rgba(54,162,235,0.2)', 'rgba(255,99,132,0.2)'],
        borderColor:     ['rgba(54,162,235,1)',   'rgba(255,99,132,1)'],
        borderWidth: 1
      }]
    },
    options: { scales: { y: { beginAtZero: true } } }
  });

  new Chart(document.getElementById('ordersChart'), {
    type: 'doughnut',
    data: {
      labels: ['Confirmed', 'Out for Delivery', 'Delayed', 'Returned'],
      datasets: [{
        data: [<?php echo implode(',', $statusCounts); ?>],
        backgroundColor: [
          'rgba(54,162,235,0.6)',
          'rgba(75,192,192,0.6)',
          'rgba(255,206,86,0.6)',
          'rgba(255,99,132,0.6)'
        ]
      }]
    }
  });
</script>

</body>
</html>
