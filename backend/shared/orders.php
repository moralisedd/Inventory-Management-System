<?php
// Shared: Store Manager + Warehouse Manager orders page
// Canonical schema: orders(order_id, product_name, order_value, quantity, expected_delivery, status, created_by_user_id)
include __DIR__ . '/../includes/db_config.php';

// Handle new order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $conn->prepare(
            "INSERT INTO orders (product_name, order_value, quantity, expected_delivery, status)
             VALUES (:product_name, :order_value, :quantity, :expected_delivery, 'Confirmed')"
        );
        $stmt->execute([
            ':product_name'      => $_POST['product_name'],
            ':order_value'       => $_POST['order_value'],
            ':quantity'          => $_POST['quantity'],
            ':expected_delivery' => $_POST['expected_delivery'],
        ]);
        header('Location: orders.php');
        exit;
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Orders</title>
</head>
<body>

<?php if (!empty($error)): ?>
  <p style="color:red;">Error: <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<h2>Orders</h2>

<form action="orders.php" method="get">
  <input type="text" name="search" placeholder="Search orders..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
  <button type="submit">Search</button>
</form>

<h3>Overall Orders</h3>

<div class="stats-grid">
  <div class="stat-card">
    <h4>Total Orders</h4>
    <?php
    try {
      echo "<p>" . $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn() . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="stat-card">
    <h4>Out for Delivery</h4>
    <?php
    try {
      $s = $conn->query("SELECT COUNT(*), SUM(order_value) FROM orders WHERE status = 'Out for Delivery'");
      $r = $s->fetch(PDO::FETCH_NUM);
      echo "<p>" . $r[0] . " (£" . number_format($r[1], 2) . ")</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="stat-card">
    <h4>Total Returned</h4>
    <?php
    try {
      $s = $conn->query("SELECT COUNT(*), SUM(order_value) FROM orders WHERE status = 'Returned'");
      $r = $s->fetch(PDO::FETCH_NUM);
      echo "<p>" . $r[0] . " (£" . number_format($r[1], 2) . ")</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="stat-card">
    <h4>Delayed</h4>
    <?php
    try {
      $s = $conn->query("SELECT COUNT(*), SUM(order_value) FROM orders WHERE status = 'Delayed'");
      $r = $s->fetch(PDO::FETCH_NUM);
      echo "<p>" . $r[0] . " (£" . number_format($r[1], 2) . ")</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
</div>

<button id="addOrderBtn">Add Order</button>
<button id="filterBtn">Filter</button>
<button id="ordersHistoryBtn">Orders History</button>

<div id="filterOptions" style="display:none;">
  <label>Quantity:
    <select id="filterQuantity">
      <option value="">All</option>
      <option value="asc">Low → High</option>
      <option value="desc">High → Low</option>
    </select>
  </label>
  <label>Order Value:
    <select id="filterOrderValue">
      <option value="">All</option>
      <option value="asc">Low → High</option>
      <option value="desc">High → Low</option>
    </select>
  </label>
  <button onclick="applyFilters()">Apply</button>
</div>

<div class="popup-overlay" id="popupOverlay"></div>
<div class="popup" id="addOrderPopup">
  <h3>New Order</h3>
  <form id="addOrderForm" action="orders.php" method="post">
    <label>Product Name: <input type="text" name="product_name" required></label><br><br>
    <label>Order Value (£): <input type="number" name="order_value" step="0.01" required></label><br><br>
    <label>Quantity: <input type="number" name="quantity" required></label><br><br>
    <label>Expected Delivery: <input type="date" name="expected_delivery" required></label><br><br>
    <button type="submit">Add Order</button>
    <button type="button" onclick="closePopup()">Cancel</button>
  </form>
</div>

<table id="orderTable">
  <thead>
    <tr>
      <th>Product</th>
      <th>Order Value</th>
      <th>Quantity</th>
      <th>Order ID</th>
      <th>Expected Delivery</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
      if (!empty($_GET['search'])) {
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE product_name LIKE :s OR order_id LIKE :s ORDER BY created_at DESC");
        $stmt->execute([':s' => '%' . $search . '%']);
      } else {
        $stmt = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
      }
      while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>£" . number_format($row['order_value'], 2) . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['order_id'] . "</td>";
        echo "<td>" . $row['expected_delivery'] . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
      }
    } catch (PDOException $e) {
      echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
    }
    $conn = null;
    ?>
  </tbody>
</table>

<script>
  const addOrderBtn    = document.getElementById('addOrderBtn');
  const addOrderPopup  = document.getElementById('addOrderPopup');
  const popupOverlay   = document.getElementById('popupOverlay');
  const filterBtn      = document.getElementById('filterBtn');
  const filterOptions  = document.getElementById('filterOptions');

  addOrderBtn.addEventListener('click', () => {
    addOrderPopup.style.display = 'block';
    popupOverlay.style.display  = 'block';
  });

  function closePopup() {
    addOrderPopup.style.display = 'none';
    popupOverlay.style.display  = 'none';
  }

  filterBtn.addEventListener('click', () => {
    filterOptions.style.display = filterOptions.style.display === 'none' ? 'block' : 'none';
  });

  function applyFilters() {
    const qDir = document.getElementById('filterQuantity').value;
    const vDir = document.getElementById('filterOrderValue').value;
    const tbody = document.querySelector('#orderTable tbody');
    const rows  = Array.from(tbody.querySelectorAll('tr'));

    if (qDir) {
      rows.sort((a, b) => {
        const qa = parseInt(a.cells[2].textContent);
        const qb = parseInt(b.cells[2].textContent);
        return qDir === 'asc' ? qa - qb : qb - qa;
      });
    } else if (vDir) {
      rows.sort((a, b) => {
        const va = parseFloat(a.cells[1].textContent.replace(/[£,]/g, ''));
        const vb = parseFloat(b.cells[1].textContent.replace(/[£,]/g, ''));
        return vDir === 'asc' ? va - vb : vb - va;
      });
    }
    rows.forEach(r => tbody.appendChild(r));
  }

  document.getElementById('ordersHistoryBtn').addEventListener('click', () => {
    fetch('orders-history.php')
      .then(r => r.text())
      .then(html => { document.querySelector('#orderTable tbody').innerHTML = html; })
      .catch(e => console.error('Error fetching orders history:', e));
  });
</script>

</body>
</html>
