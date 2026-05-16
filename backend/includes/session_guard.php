<?php
/**
 * session_guard.php - Auth helpers. Include at the top of every protected page.
 *
 * Usage:
 *   require_auth();                 // any authenticated user
 *   require_role('Store Manager');  // specific role; wrong role lands on their own dashboard
 */

const ROLE_DASHBOARDS = [
    'Store Manager'     => '/pages/store-manager/dashboard.php',
    'Warehouse Manager' => '/pages/warehouse-manager/dashboard.php',
    'Category Manager'  => '/pages/category-manager/dashboard.php',
    'Sales Associate'   => '/pages/sales-associate/dashboard.php',
];

function require_auth(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['user_id'])) {
        header('Location: /pages/auth/login.php');
        exit;
    }
}

function require_role(string $role): void
{
    require_auth();
    if ($_SESSION['role'] === $role) {
        return; // fast path - correct role
    }
    // Wrong role: redirect to that user's own dashboard rather than a generic error.
    $redirect = ROLE_DASHBOARDS[$_SESSION['role']] ?? '/pages/auth/login.php';
    header('Location: ' . $redirect);
    exit;
}
