/**
 * auth-guard.js - Client-side session check on every protected page.
 *
 * Derives the expected role from the URL folder structure, then asks
 * check-session.php to confirm the server session is still valid.
 * Redirects on failure rather than showing a broken page.
 */
(function () {
    const ROLE_BY_FOLDER = {
        'store-manager':     'Store Manager',
        'warehouse-manager': 'Warehouse Manager',
        'category-manager':  'Category Manager',
        'sales-associate':   'Sales Associate',
    };

    const DASHBOARDS = {
        'Store Manager':     '/pages/store-manager/dashboard.php',
        'Warehouse Manager': '/pages/warehouse-manager/dashboard.php',
        'Category Manager':  '/pages/category-manager/dashboard.php',
        'Sales Associate':   '/pages/sales-associate/dashboard.php',
    };

    const LOGIN = '/pages/auth/login.php';

    // Null on shared pages - any authenticated role is allowed.
    const folder       = window.location.pathname.split('/').find(p => ROLE_BY_FOLDER[p]) || null;
    const expectedRole = folder ? ROLE_BY_FOLDER[folder] : null;

    fetch('/backend/auth/check-session.php', { credentials: 'same-origin' })
        .then(res => res.json())
        .then(data => {
            if (!data.authenticated) {
                window.location.replace(LOGIN);
                return;
            }
            if (expectedRole && data.role !== expectedRole) {
                // User is logged in but viewing the wrong role's pages.
                window.location.replace(DASHBOARDS[data.role] || LOGIN);
            }
        })
        .catch(() => window.location.replace(LOGIN));
}());
