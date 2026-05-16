<?php
// Store Manager — Inventory (full version with popup, filter, CSV download)
// Canonical schema columns: product_name, buying_price, selling_price, image_path, quantity, threshold_value, expiry_date, availability
include __DIR__ . '/../includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $target_dir  = __DIR__ . '/../../assets/uploads/';
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $ext         = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $error = 'Only JPG, JPEG, PNG, and GIF files are allowed.';
        } elseif (file_exists($target_file)) {
            $error = 'File already exists.';
        } elseif (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $error = 'Upload failed.';
        } else {
            $qty = (int) $_POST['quantity'];
            if ($qty > 10)      $availability = 'In Stock';
            elseif ($qty >= 1)  $availability = 'Low Quantity';
            else                $availability = 'Out of Stock';

            $stmt = $conn->prepare(
                "INSERT INTO products (image_path, product_name, buying_price, selling_price, quantity, threshold_value, expiry_date, availability)
                 VALUES (:image_path, :product_name, :buying_price, :selling_price, :quantity, :threshold_value, :expiry_date, :availability)"
            );
            $stmt->execute([
                ':image_path'     => 'assets/uploads/' . basename($_FILES['image']['name']),
                ':product_name'   => $_POST['name'],
                ':buying_price'   => $_POST['buying_price'],
                ':selling_price'  => $_POST['selling_price'] ?? $_POST['buying_price'],
                ':quantity'       => $qty,
                ':threshold_value'=> $_POST['threshold_value'],
                ':expiry_date'    => $_POST['expiry_date'] ?: null,
                ':availability'   => $availability,
            ]);
            $success = 'Product added successfully.';
        }
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Product Management</title>
</head>
<body>

<?php if (!empty($error)):   echo "<p style='color:red'>"   . htmlspecialchars($error)   . "</p>"; endif; ?>
<?php if (!empty($success)): echo "<p style='color:green'>" . htmlspecialchars($success) . "</p>"; endif; ?>

<h2>Product Management</h2>

<form action="inventory.php" method="get">
  <input type="text" name="search" placeholder="Search by name..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
  <button type="submit">Search</button>
</form>

<div class="stats-grid">
  <div class="stat-card">
    <h3>Total Products</h3>
    <?php
    try {
      echo "<p>" . $conn->query("SELECT COUNT(*) FROM products")->fetchColumn() . "</p>";
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
  <div class="stat-card">
    <h3>Last Added</h3>
    <?php
    try {
      $lastAdded = $conn->query("SELECT created_at FROM products ORDER BY created_at DESC LIMIT 1")->fetchColumn();
      if ($lastAdded) {
        $days = date_diff(new DateTime($lastAdded), new DateTime())->days;
        echo "<p>" . ($days === 0 ? 'Today' : $days . ' day(s) ago') . "</p>";
      } else {
        echo "<p>No products yet</p>";
      }
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    ?>
  </div>
</div>

<button id="addProductBtn">Add Product</button>
<button id="filterBtn">Filter</button>
<button id="downloadBtn">Download CSV</button>

<div id="filterOptions" style="display:none; margin:10px 0;">
  <label>Name: <input type="text" id="filterName"></label>
  <label>Availability:
    <select id="filterAvailability">
      <option value="">All</option>
      <option value="In Stock">In Stock</option>
      <option value="Low Quantity">Low Quantity</option>
      <option value="Out of Stock">Out of Stock</option>
    </select>
  </label>
  <button onclick="applyFilters()">Apply</button>
</div>

<div class="popup-overlay" id="popupOverlay"></div>
<div class="popup" id="addProductPopup">
  <h3>Add Product</h3>
  <form action="inventory.php" method="post" enctype="multipart/form-data">
    <label>Image: <input type="file" name="image" accept="image/*" required></label><br><br>
    <label>Name: <input type="text" name="name" required></label><br><br>
    <label>Buying Price (£): <input type="number" name="buying_price" step="0.01" required></label><br><br>
    <label>Selling Price (£): <input type="number" name="selling_price" step="0.01" required></label><br><br>
    <label>Quantity: <input type="number" name="quantity" required></label><br><br>
    <label>Threshold Value: <input type="number" name="threshold_value" required></label><br><br>
    <label>Expiry Date: <input type="date" name="expiry_date"></label><br><br>
    <button type="submit">Submit</button>
    <button type="button" onclick="closePopup()">Cancel</button>
  </form>
</div>

<h2>Products</h2>

<table id="productTable">
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Buying Price</th>
      <th>Selling Price</th>
      <th>Quantity</th>
      <th>Threshold</th>
      <th>Expiry Date</th>
      <th>Availability</th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
      if (!empty($_GET['search'])) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE :s ORDER BY product_name");
        $stmt->execute([':s' => '%' . $_GET['search'] . '%']);
      } else {
        $stmt = $conn->query("SELECT * FROM products ORDER BY product_name");
      }
      while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['product_name']) . "'></td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>£" . number_format($row['buying_price'],  2) . "</td>";
        echo "<td>£" . number_format($row['selling_price'], 2) . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['threshold_value'] . "</td>";
        echo "<td>" . ($row['expiry_date'] ?? '—') . "</td>";
        echo "<td>" . htmlspecialchars($row['availability']) . "</td>";
        echo "</tr>";
      }
    } catch (PDOException $e) {
      echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
    }
    $conn = null;
    ?>
  </tbody>
</table>

<div class="pagination">
  <button id="prevBtn" disabled>Previous</button>
  <span id="pageInfo"></span>
  <button id="nextBtn">Next</button>
</div>

<script>
  // Popup
  document.getElementById('addProductBtn').addEventListener('click', () => {
    document.getElementById('addProductPopup').style.display = 'block';
    document.getElementById('popupOverlay').style.display    = 'block';
  });
  function closePopup() {
    document.getElementById('addProductPopup').style.display = 'none';
    document.getElementById('popupOverlay').style.display    = 'none';
  }

  // Filter panel
  document.getElementById('filterBtn').addEventListener('click', () => {
    const el = document.getElementById('filterOptions');
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
  });

  function applyFilters() {
    const name  = document.getElementById('filterName').value.toLowerCase();
    const avail = document.getElementById('filterAvailability').value;
    const rows  = document.querySelectorAll('#productTable tbody tr');
    rows.forEach(row => {
      const rowName  = row.cells[1].textContent.toLowerCase();
      const rowAvail = row.cells[7].textContent;
      row.style.display =
        (name  === '' || rowName.includes(name)) &&
        (avail === '' || rowAvail === avail)
          ? '' : 'none';
    });
  }

  // CSV download
  document.getElementById('downloadBtn').addEventListener('click', () => {
    const rows = document.querySelectorAll('#productTable tr');
    const csv  = Array.from(rows).map(r =>
      Array.from(r.querySelectorAll('th,td'))
        .filter((_, i) => i !== 0) // skip image column
        .map(c => '"' + c.textContent.replace(/"/g, '""') + '"')
        .join(',')
    ).join('\n');
    const a = Object.assign(document.createElement('a'), {
      href: 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv),
      download: 'products.csv'
    });
    document.body.appendChild(a);
    a.click();
    a.remove();
  });

  // Pagination
  let currentPage = 1;
  const rowsPerPage = 10;

  function showPage(page) {
    const rows = Array.from(document.querySelectorAll('#productTable tbody tr'));
    const visible = rows.filter(r => r.style.display !== 'none');
    const start = (page - 1) * rowsPerPage;
    const end   = start + rowsPerPage;

    rows.forEach((r, i) => {
      r.style.display = (i >= start && i < end) ? '' : 'none';
    });

    document.getElementById('prevBtn').disabled = (page === 1);
    document.getElementById('nextBtn').disabled = (end >= rows.length);
    document.getElementById('pageInfo').textContent =
      'Page ' + page + ' of ' + Math.ceil(rows.length / rowsPerPage);
    currentPage = page;
  }

  showPage(currentPage);
  document.getElementById('prevBtn').addEventListener('click', () => showPage(currentPage - 1));
  document.getElementById('nextBtn').addEventListener('click', () => showPage(currentPage + 1));
</script>

</body>
</html>
