<?php
// POST-only handler. GET requests from bookmarks/links just go to login page.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /pages/auth/login.php');
    exit;
}

session_start();
require_once __DIR__ . '/../includes/db_config.php';

$email    = trim($_POST['uname'] ?? '');
$password = $_POST['psw'] ?? '';

if ($email === '' || $password === '') {
    header('Location: /pages/auth/login.php?error=missing');
    exit;
}

try {
    $stmt = $conn->prepare(
        'SELECT user_id, name, password_hash, role FROM users WHERE email = ? AND is_active = 1 LIMIT 1'
    );
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password_hash'])) {
        header('Location: /pages/auth/login.php?error=invalid');
        exit;
    }

    // Prevent session fixation after credential check.
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['name']    = $user['name'];
    $_SESSION['role']    = $user['role'];

    $dashboards = [
        'Store Manager'     => '/pages/store-manager/dashboard.php',
        'Warehouse Manager' => '/pages/warehouse-manager/dashboard.php',
        'Category Manager'  => '/pages/category-manager/dashboard.php',
        'Sales Associate'   => '/pages/sales-associate/dashboard.php',
    ];

    header('Location: ' . ($dashboards[$user['role']] ?? '/pages/auth/login.php'));
    exit;

} catch (PDOException $e) {
    error_log('Login DB error: ' . $e->getMessage());
    header('Location: /pages/auth/login.php?error=server');
    exit;
}
