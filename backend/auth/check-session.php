<?php
session_start();

header('Content-Type: application/json');
header('Cache-Control: no-store');

// Used by auth-guard.js to validate the session client-side without exposing PHP.
if (!empty($_SESSION['user_id'])) {
    echo json_encode([
        'authenticated' => true,
        'user_id'       => $_SESSION['user_id'],
        'name'          => $_SESSION['name'],
        'role'          => $_SESSION['role'],
    ]);
} else {
    echo json_encode(['authenticated' => false]);
}
