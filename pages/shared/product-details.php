<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Maggi</title>
    <link rel="stylesheet" href="/css/product-details.css">
    <script src="/js/auth-guard.js"></script>
</head>
<body>
    <div class="product-container">
        <!-- Header -->
        <div class="header">
            <h1 class="product-title">Maggi</h1>
            <div class="action-buttons">
                <button class="btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3Z"/>
                    </svg>
                    Edit
                </button>
                <button class="btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Download
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <ul class="tabs-list">
                <li class="tab-item active">Overview</li>
                <li class="tab-item">Purchases</li>
                <li class="tab-item">Adjustments</li>
                <li class="tab-item">History</li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Left Column -->
            <div class="main-content">
                <!-- Primary Details -->
                <div class="section">
                    <h2 class="section-title">Primary Details</h2>
                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="detail-label">Product name</div>
                            <div class="detail-value">Maggi</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Product ID</div>
                            <div class="detail-value">456567</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Product category</div>
                            <div class="detail-value">Instant food</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Expiry Date</div>
                            <div class="detail-value">13/4/23</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Threshold Value</div>
                            <div class="detail-value">12</div>
                        </div>
                    </div>
                </div>

                <!-- Supplier Details -->
                <div class="section">
                    <h2 class="section-title">Supplier Details</h2>
                    <div class="detail-item">
                        <div class="detail-label">Supplier name</div>
                        <div class="detail-value">Ronald Martin</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Contact Number</div>
                        <div class="detail-value">98789 89757</div>
                    </div>
                </div>

                <!-- Stock Locations -->
                <div class="section">
                    <h2 class="section-title">Stock Locations</h2>
                    <table class="stock-table">
                        <thead>
                            <tr>
                                <th>Store Name</th>
                                <th>Stock in hand</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sulur Branch</td>
                                <td class="stock-value">15</td>
                            </tr>
                            <tr>
                                <td>Singanallur Branch</td>
                                <td class="stock-value">19</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Column -->
            <div class="sidebar">
                <div class="product-image">
                    <img src="/assets/images/Maggi.svg" alt="Maggi">
                </div>
                <div class="stock-info">
                    <div class="stock-item">
                        <div class="stock-item-label">Opening Stock</div>
                        <div class="stock-item-value">40</div>
                    </div>
                    <div class="stock-item">
                        <div class="stock-item-label">Remaining Stock</div>
                        <div class="stock-item-value">34</div>
                    </div>
                    <div class="stock-item">
                        <div class="stock-item-label">On the way</div>
                        <div class="stock-item-value">15</div>
                    </div>
                    <div class="stock-item">
                        <div class="stock-item-label">Threshold value</div>
                        <div class="stock-item-value">12</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>