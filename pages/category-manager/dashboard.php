<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Category Manager');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
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

            <div class="dashboard-icon">
                <a href="/pages/category-manager/dashboard.php">
                    <img src="/assets/images/ACTIVE Dashboard + Icon.svg" alt="Navigate to Dashboard" />
                </a>
            </div>

            <div class="inventory-icon">
                <a href="/pages/category-manager/inventory.php">
                    <img src="/assets/images/Inventory + Icon.svg" alt="Navigate to Inventory" />
                </a>
            </div>

            <div class="reports-icon">
                <a href="/pages/category-manager/reports.php">
                    <img src="/assets/images/Reports + Icon.svg" alt="Navigate to Reports" />
                </a>
            </div>

            <div class="manage-icon">
                <a href="/pages/category-manager/manage-store.php">
                    <img src="/assets/images/Manage Store + Icon.svg" alt="Navigate to Manage Store" />
                </a>
            </div>

            <div class="settings-icon">
                <a href="/pages/category-manager/settings.php">
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

        <!-- Main Content -->
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

            <!-- Header -->
            <div class="cat-text">
                <h3>Categories</h3>
            </div>
            <!-- Header -->

            <!-- Grid -->

            <div class="grid-container">
                <!-- Categories Section -->
                <div class="item cm-categories-section item-8">

                    <div class="category-container">
                        <div class="category">

                            <div class="category-icon">
                                <img src="/assets/images/Category Icon - Fruits.svg"
                                    alt="Fruits Category Icon" />

                                <div class="category-name">
                                    <h4>Fruits</h4>
                                </div>
                            </div>



                            <div class="category-icon">
                                <img src="/assets/images/Category Icon - Veggie.svg"
                                    alt="Veggies Category Icon " />

                                <div class="category-name">
                                    <h4>Veggies</h4>
                                </div>
                            </div>

                            <div class="category-icon">
                                <img src="/assets/images/Category Icon - Fish.svg"
                                    alt="Fish Category Icon" />

                                <div class="category-name">
                                    <h4>Fish</h4>
                                </div>
                            </div>

                            <div class="category-icon">
                                <img src="/assets/images/Category Icon - Meats.svg"
                                    alt="Meats Category Icon" />

                                <div class="category-name">
                                    <h4>Meats</h4>
                                </div>
                            </div>

                            <div class="category-icon">
                                <img src="/assets/images/Category Icon - Dairy.svg"
                                    alt="DairyCategory Icon" />

                                <div class="category-name">
                                    <h4>Dairy</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Categories Section -->

                <!-- Low Stock Section -->
                <div class="item cm-lowstock-section item-9">

                    <div class="H3-see-all-button">
                        <h3>Low Quantity Stock</h3>
                        <div class="see-all-button">
                            <a href="/pages/store-manager/low-quantity.php">
                                <img src="/assets/images/See All Button.svg" alt="See all button">
                            </a>
                        </div>
                    </div>

                    <div class="low-quantity-table">
                        <table>

                            <!-- Row 1 -->
                            <tr>
                                <td class="item-picture">
                                    <img src="/assets/images/Salmon.svg" alt="Example Item 1"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Low</button></td>
                                <!-- Replace with database values - if low then glow then or make it so anything placed in low stock place = low -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 1 -->

                            <!-- Row 2 -->
                            <tr>
                                <td class="item-picture">
                                    <img src="/assets/images/Tomato.svg" alt="Example Item 2"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Low</button></td>
                                <!-- Replace with database values - if low then glow then or make it so anything placed in low stock place = low -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 2 -->

                            <!-- Row 3 -->
                            <tr>
                                <td class="item-picture">
                                    <img src="/assets/images/Chicken.svg" alt="Example Item 3"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Low</button></td>
                                <!-- Replace with database values - if low then glow then or make it so anything placed in low stock place = low -->
                            </tr>
                            <!-- Row 3 -->
                        </table>
                    </div>
                </div>
                <!-- Low Stock Section -->

                <!-- Top Selling Section -->
                <div class="item cm-top-sellingsection item-10">

                    <div class="H3-see-all-button">
                        <h3>Top Selling Stock</h3>
                        <div class="see-all-button">
                            <a href="#">
                                <img src="/assets/images/See All Button.svg" alt="See all button">
                            </a>
                        </div>
                    </div>

                    <div class="top-selling-table">
                        <table>

                            <!-- Row 1 -->
                            <tr>
                                <td class="item-picture">
                                    <img src="/assets/images/Surf Excel.svg" alt="Example Item 1"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Medium</button></td>
                                <!-- Replace with database values -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 1 -->

                            <!-- Row 2 -->
                            <tr>
                                <td class="item-picture">
                                    <img src="/assets/images/Parle G.svg" alt="Example Item 2"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Medium</button></td>
                                <!-- Replace with database values -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 2 -->
                        </table>
                    </div>

                </div>
            </div>
            <!-- Top Selling Section -->


            <!-- Grid -->

        </div>
        <!-- Main Content -->
    </div>
</body>

</html>