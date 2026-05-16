<?php
// ============================================================
// QuickBuy — Database Connection
// Uses PDO with MySQL driver.
// Adjust host/dbname/user/pass to match your environment.
// ============================================================

$host   = 'localhost';
$dbname = 'quickbuy';
$user   = 'root';
$pass   = '';

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed: ' . $e->getMessage());
}
