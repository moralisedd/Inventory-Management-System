<?php
// Shared: Store Manager + Sales Associate invoice page
// Canonical schema: products(product_id, product_name, buying_price, selling_price, quantity, image_path)
//                   invoices(invoice_id, user_id, total_amount), invoice_details(invoice_id, product_id, quantity, rate)
include __DIR__ . '/../includes/db_config.php';

function generateInvoiceNumber(): string
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $num   = '';
    for ($i = 0; $i < 10; $i++) {
        $num .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $num;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('POST only.');
}

try {
    // --- Image upload ---
    $target_dir  = __DIR__ . '/../../Application/Assets/uploads/';
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $ext         = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        exit('Only JPG, JPEG, PNG, and GIF files are allowed.');
    }
    if (file_exists($target_file)) {
        exit('File already exists.');
    }
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        exit('Upload failed.');
    }

    // --- Determine availability ---
    $qty = (int) $_POST['quantity'];
    if ($qty > 10)          $availability = 'In Stock';
    elseif ($qty >= 1)      $availability = 'Low Quantity';
    else                    $availability = 'Out of Stock';

    // --- Insert product ---
    $stmt = $conn->prepare(
        "INSERT INTO products (image_path, product_name, buying_price, quantity, threshold_value, expiry_date, availability, selling_price)
         VALUES (:image_path, :product_name, :buying_price, :quantity, :threshold_value, :expiry_date, :availability, :selling_price)"
    );
    $stmt->execute([
        ':image_path'     => 'Application/Assets/uploads/' . basename($_FILES['image']['name']),
        ':product_name'   => $_POST['name'],
        ':buying_price'   => $_POST['buying_price'],
        ':quantity'       => $qty,
        ':threshold_value'=> $_POST['threshold_value'] ?? 10,
        ':expiry_date'    => $_POST['expiry_date'] ?? null,
        ':availability'   => $availability,
        ':selling_price'  => $_POST['selling_price'] ?? $_POST['buying_price'],
    ]);
    $productId = $conn->lastInsertId();

    // --- Fetch product ---
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :id");
    $stmt->execute([':id' => $productId]);
    $product = $stmt->fetch();

    // --- Insert invoice record ---
    $rate  = (float) $product['selling_price'];
    $total = $rate * $product['quantity'];

    $stmt = $conn->prepare("INSERT INTO invoices (user_id, total_amount) VALUES (:user_id, :total)");
    $stmt->execute([':user_id' => 1, ':total' => $total]); // user_id should come from session
    $invoiceId = $conn->lastInsertId();

    $stmt = $conn->prepare(
        "INSERT INTO invoice_details (invoice_id, product_id, description, quantity, rate)
         VALUES (:invoice_id, :product_id, :description, :quantity, :rate)"
    );
    $stmt->execute([
        ':invoice_id'  => $invoiceId,
        ':product_id'  => $productId,
        ':description' => $product['product_name'],
        ':quantity'    => $product['quantity'],
        ':rate'        => $rate,
    ]);

    $invoiceNumber = generateInvoiceNumber();
    $conn = null;

} catch (PDOException $e) {
    exit('Database error: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
</head>
<body>
  <div class="invoice-container">
    <div class="invoice-header">
      <div class="company-info">
        <h2>QuickBuy Ltd.</h2>
        <p>The Business Centre, 456 Enterprise Way</p>
        <p>Manchester, M2 5WP</p>
        <p>VAT: GB123456789</p>
      </div>
      <div class="invoice-number">
        <h1>Invoice</h1>
        <p><?php echo htmlspecialchars($invoiceNumber); ?></p>
      </div>
    </div>
    <div class="invoice-details">
      <p><strong>Billed to:</strong></p>
      <p>QuickBuy - Manchester Store<br>123 High Street, Manchester, M1 4SD, United Kingdom</p>
    </div>
    <table class="invoice-table">
      <thead>
        <tr>
          <th>Description</th>
          <th>Qty</th>
          <th>Rate (£)</th>
          <th>Line Total (£)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo htmlspecialchars($product['product_name']); ?></td>
          <td><?php echo $product['quantity']; ?></td>
          <td><?php echo number_format($rate, 2); ?></td>
          <td><?php echo number_format($total, 2); ?></td>
        </tr>
      </tbody>
    </table>
    <div class="invoice-summary">
      <p><strong>Total due: £<?php echo number_format($total, 2); ?></strong></p>
    </div>
    <div class="invoice-footer">
      <p>ⓘ Please pay within 15 days of receiving this invoice.</p>
      <p>www.QuickBuy.co.uk | +44 00000 00000 | info@quickbuy.co.uk</p>
    </div>
  </div>
</body>
</html>
