<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Store Manager');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <link rel="stylesheet" href="/css/base.css" />
    <link rel="stylesheet" href="/css/report.css" />

    <link rel="shortcut icon" href="/assets/images/QuickBuyIcon.svg" type="image/x-icon" />



    <script src="/js/auth-guard.js"></script>
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
          <div class="sidebar-container">
            <div class="quickbuy-logo">
                <img src="/assets/images/QuickBuyLogo.svg" alt="QuickBuy Logo" />
            </div>
  
            <div class="dashboard-icon">
                <a href="/pages/store-manager/dashboard.php">
                    <img src="/assets/images/Dashboard + Icon.svg" alt="Navigate to Dashboard" />
                </a>
            </div>
  
            <div class="inventory-icon">
                <a href="/pages/store-manager/inventory.php">
                    <img src="/assets/images/Inventory + Icon.svg" alt="Navigate to Inventory" />
                </a>
            </div>
  
            <div class="reports-icon">
                <a href="/pages/store-manager/reports.php">
                    <img src="/assets/images/Reports + Icon.svg" alt="Navigate to Reports" />
                </a>
            </div>
  
            <div class="invoices-icon">
                <a href="/pages/store-manager/invoice.php">
                    <img src="/assets/images/ACTIVE Invoices + Icon.svg" alt="Navigate to Invoices" />
                </a>
            </div>
  
            <div class="orders-icon">
                <a href="/pages/store-manager/orders.php">
                    <img src="/assets/images/Orders + Icon.svg" alt="Navigate to Orders" />
                </a>
            </div>
  
            <div class="manage-icon">
                <a href="/pages/store-manager/manage-store.php">
                    <img src="/assets/images/Manage Store + Icon.svg" alt="Navigate to Manage Store" />
                </a>
            </div>
  
            <div class="settings-icon">
                <a href="/pages/store-manager/settings.php">
                    <img src="/assets/images/Settings + Icon.svg" alt="Navigate to Settings" />
                </a>
            </div>
  
            <div class="logout-icon">
                <a href="/backend/auth/logout.php">
                    <img src="/assets/images/Logout + Icon.svg" alt="Log Out" />
                </a>
            </div>
        </div>
          </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header>
                <div class="search-bar">
                    <svg stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Search product, supplier, order" />
                </div>
                <div class="header-actions">
                    <button class="notification-btn">
                        <svg stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </button>
                    <button class="profile-btn">
                        <svg stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                </div>
            </header>



            <div class="invoice-container">
                <div class="invoice-header">
                    <div class="invoice-title">INVOICE</div>
                    <div class="company-logo">
                        <div class="logo"><img src="/assets/images/QuickBuyIcon.svg" alt=""> </div>
                        <div class="company-name" style="margin-top: -50px;">QuickBuy</div>
                    </div>
                </div>

                <div class="billing-details">
                    <div class="billing-address">
                        <div style="margin-bottom: 10px">Billed to</div>
                        QuickBuy - Manchester Store<br>
                        123 High Street<br>
                        Manchester, M1 4SD<br>
                        United Kingdom
                    </div>
                    <div class="invoice-info">
                        QuickBuy Ltd.<br>
                        The Business Centre<br>
                        456 Enterprise Way<br>
                        Manchester, M2 5WP<br>
                        <br>
                        Tax ID/VAT Number: GB123456789
                    </div>
                </div>

                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th style="width: 200px;">Invoice #</th>
                            <th>Services</th>
                            <th style="width: 100px;">Qty</th>
                            <th style="width: 150px;">Rate</th>
                            <th style="width: 150px;" class="text-right">Line total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="4">AB2324-01</td>
                            <td>Item Name</td>
                            <td>1</td>
                            <td>€3,000.00</td>
                            <td class="text-right">€3,000.00</td>
                        </tr>
                        <tr>
                            <td>Item Name</td>
                            <td>1</td>
                            <td>€3,000.00</td>
                            <td class="text-right">€3,000.00</td>
                        </tr>
                        <tr>
                            <td>Item Name</td>
                            <td>1</td>
                            <td>€1,500.00</td>
                            <td class="text-right">€1,500.00</td>
                        </tr>
                        <tr>
                            <td>Item Name</td>
                            <td>1</td>
                            <td>€1,500.00</td>
                            <td class="text-right">€1,500.00</td>
                        </tr>
                    </tbody>
                </table>

                <div class="totals">
                    <div class="total-row">
                        <div>Subtotal</div>
                        <div>€9,000.00</div>
                    </div>
                    <div class="total-row">
                        <div>Tax (10%)</div>
                        <div>€900.00</div>
                    </div>
                    <div class="total-row final">
                        <div>Total due</div>
                        <div>UKE 9,900.00</div>
                    </div>
                </div>

                <div class="payment-notice">
                    ⓘ Please pay within 15 days of receiving this invoice.
                </div>

                <div class="footer">
                    <div>www.QuickBuy.co.uk</div>
                    <div>+44 00000 00000</div>
                    <div>QuickBuy@Gmail.com</div>
                </div>
         