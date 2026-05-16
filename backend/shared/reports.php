<?php
// Shared: Store Manager + Warehouse Manager + Category Manager reports
// Canonical schema: products(buying_price, selling_price, quantity)
// Note: original queries used 'order_value' from products — that column does not exist.
//       Fixed to use buying_price/selling_price.
include __DIR__ . '/../includes/db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reports</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h2>Reports</h2>

<div class="overview-grid">
  <div class="overview-card">
    <h3>Total Profit</h3>
    <?php
    try {
      // Estimated profit: 10% of gross revenue
      $stmt = $conn->query("SELECT SUM((selling_price - buying_price) * quantity) FROM products");
      echo "<p>£" . number_format($stmt->fetchColumn(), 2) . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="overview-card">
    <h3>Revenue</h3>
    <?php
    try {
      $stmt = $conn->query("SELECT SUM(selling_price * quantity) / 12 FROM products");
      echo "<p>£" . number_format($stmt->fetchColumn(), 2) . " /mo</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="overview-card">
    <h3>Sales (Units/mo)</h3>
    <?php
    try {
      $stmt = $conn->query("SELECT SUM(quantity) / 12 FROM products");
      echo "<p>" . number_format($stmt->fetchColumn(), 0) . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="overview-card">
    <h3>Net Purchase Value</h3>
    <?php
    try {
      $stmt = $conn->query("SELECT SUM(buying_price * quantity) FROM products");
      echo "<p>£" . number_format($stmt->fetchColumn(), 2) . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="overview-card">
    <h3>Net Sales Value</h3>
    <?php
    try {
      $stmt = $conn->query("SELECT SUM(selling_price * quantity) FROM products");
      echo "<p>£" . number_format($stmt->fetchColumn(), 2) . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="overview-card">
    <h3>Month-over-Month Profit</h3>
    <?php
    try {
      $stmt = $conn->query("SELECT SUM((selling_price - buying_price) * quantity) / 12 FROM products");
      echo "<p>£" . number_format($stmt->fetchColumn(), 2) . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
</div>

<h2>Revenue &amp; Profit Chart</h2>
<canvas id="revenueProfitChart"></canvas>

<script>
  const totalProfitEl = document.querySelector('.overview-card:nth-child(1) p');
  const revenueEl     = document.querySelector('.overview-card:nth-child(2) p');

  const totalProfit = parseFloat(totalProfitEl.textContent.replace(/[£, /mo]/g, ''));
  const revenue     = parseFloat(revenueEl.textContent.replace(/[£, /mo]/g, ''));

  new Chart(document.getElementById('revenueProfitChart'), {
    type: 'line',
    data: {
      labels: ['Total Profit', 'Monthly Revenue'],
      datasets: [{
        label: 'Amount (£)',
        data: [totalProfit, revenue],
        backgroundColor: ['rgba(255,99,132,0.2)', 'rgba(54,162,235,0.2)'],
        borderColor:     ['rgba(255,99,132,1)',   'rgba(54,162,235,1)'],
        borderWidth: 1,
        tension: 0.4
      }]
    },
    options: { scales: { y: { beginAtZero: true } } }
  });
</script>

</body>
</html>
