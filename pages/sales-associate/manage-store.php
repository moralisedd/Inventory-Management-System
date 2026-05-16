<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Sales Associate');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Store</title>
    <script defer src="/js/index.js"></script>
    <link rel="icon" type="image/svg+xml" href="/assets/images/QuickBuyIcon.svg" />
    <link rel="stylesheet" href="/css/style.css" />
    <script src="/js/auth-guard.js"></script>
</head>

<body>
    <div class="page-container">

        <!-- SIDE NAV BAR -->
        <div class="sidebar-container">
            <div class="quickbuy-logo">
                <img src="/assets/images/QuickBuyLogo.svg" alt="QuickBuy Logo" />
            </div>

            <div class="invoices-icon">
                <a href="/pages/sales-associate/dashboard.php">
                    <img src="/assets/images/Invoices + Icon.svg" alt="Navigate to Invoices" />
                </a>
            </div>

            <div class="manage-icon">
                <a href="/pages/sales-associate/manage-store.php">
                    <img src="/assets/images/ACTIVE Manage Store + Icon.svg" alt="Navigate to Manage Store" />
                </a>
            </div>

            <div class="settings-icon">
                <a href="/pages/sales-associate/settings.php">
                    <img src="/assets/images/Settings + Icon.svg" alt="Navigate to Settings" />
                </a>
            </div>

            <div class="logout-icon">
                <a href="/backend/auth/logout.php">
                    <img src="/assets/images/Logout + Icon.svg" alt="Log Out" />
                </a>
            </div>
        </div>
        <!-- SIDE NAV BAR -->

        <!-- MAIN CONTENT -->
        <div class="DASHmain-content-container">

            <!-- Top Search Bar -->
            <div class="gen-topbar-container">
                <div class="Searchbar-NotificationIcon-ProfilePic-container">
                    <div class="searchbox-container">
                        <div class="search-icon">
                            <img src="/assets/images/Search Icon.svg" alt="Search Icon" />
                        </div>
                        <div class="search-box">
                            <input type="text" placeholder="Search product, supplier, etc." />
                        </div>
                    </div>

                    <div class="notification-icon">
                        <img src="/assets/images/Notification Icon.svg" alt="Notification Icon"
                            height="100%" />
                    </div>

                    <div class="profile-icon">
                        <img src="/assets/images/Avatar Icon.svg" alt="Profile Avatar" />
                    </div>
                </div>
            </div>
            <!-- Top Search Bar -->

            <!-- Grid -->
            <div class="grid-container">
                <div class="item item-11">

                    <!-- Manage Store Section -->
                    <div class="manage-store-container">
                        <div class="manage-store-text-button">
                            <h3>Manage Store</h3>
                            <div class="add-store-button">
                                <img src="/assets/images/Add Store Button.svg" alt="Add Store Button" />
                            </div>
                        </div>

                        <div class="store-card-section">

                            <!-- Store Card 1 -->
                            <div class="store-card">
                                <div class="store-branch-section">
                                    <h4>Store Branch</h4>
                                </div>
                                <div class="store-info-section">
                                    <div class="store-info">
                                        <h5>Store Name</h5>
                                        <p>Street Address</p>
                                        <p>City, Zip/Post Code</p>
                                        <p>Country</p>
                                    </div>
                                    <div class="store-edit-button">
                                        <img src="/assets/images/Edit Button.svg" alt="Edit Button" />
                                    </div>
                                </div>
                            </div>
                            <!-- Store Card 1 -->

                            <!-- Store Card 2 -->
                            <div class="store-card">
                                <div class="store-branch-section">
                                    <h4>Store Branch</h4>
                                </div>
                                <div class="store-info-section">
                                    <div class="store-info">
                                        <h5>Store Name</h5>
                                        <p>Street Address</p>
                                        <p>City, Zip/Post Code</p>
                                        <p>Country</p>
                                    </div>
                                    <div class="store-edit-button">
                                        <img src="/assets/images/Edit Button.svg" alt="Edit Button" />
                                    </div>
                                </div>
                            </div>
                            <!-- Store Card 2 -->

                            <!-- Store Card 3 -->
                            <div class="store-card">
                                <div class="store-branch-section">
                                    <h4>Store Branch</h4>
                                </div>
                                <div class="store-info-section">
                                    <div class="store-info">
                                        <h5>Store Name</h5>
                                        <p>Street Address</p>
                                        <p>City, Zip/Post Code</p>
                                        <p>Country</p>
                                    </div>
                                    <div class="store-edit-button">
                                        <img src="/assets/images/Edit Button.svg" alt="Edit Button" />
                                    </div>
                                </div>
                            </div>
                            <!-- Store Card 3 -->

                        </div>
                    </div>
                </div>
                <!-- Manage Store Section -->

            </div>
            <!-- Grid -->

        </div>
        <!-- MAIN CONTENT -->

    </div>
</body>

</html>