<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Warehouse Manager');
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
                <a href="/pages/warehouse-manager/dashboard.php">
                    <img src="/assets/images/ACTIVE Dashboard + Icon.svg" alt="Navigate to Dashboard" />
                </a>
            </div>

            <div class="reports-icon">
                <a href="/pages/warehouse-manager/reports.php">
                    <img src="/assets/images/Reports + Icon.svg" alt="Navigate to Reports" />
                </a>
            </div>

            <div class="orders-icon">
                <a href="/pages/warehouse-manager/orders.php">
                    <img src="/assets/images/Orders + Icon.svg" alt="Navigate to Orders" />
                </a>
            </div>

            <div class="manage-icon">
                <a href="/pages/warehouse-manager/manage-store.php">
                    <img src="/assets/images/Manage Store + Icon.svg" alt="Navigate to Manage Store" />
                </a>
            </div>

            <div class="settings-icon">
                <a href="/pages/warehouse-manager/settings.php">
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
            <div class="order-sum-text">
                <h3>Order Summary</h3>
            </div>
            <!-- Header -->

            <!-- Grid -->

            <div class="grid-container">
                <!-- Purchase Overview Section -->
                <div class="item item-1">
                    <h3>Purchase Overview</h3>
                    <div class="purchaseoverview-sections">

                        <!-- Purchased Box -->
                        <div class="purchased-box">
                            <div class="purchaseoveriew-icons">
                                <img src="/assets/images/Purchased Icon.svg" alt="Purchased Icon">
                            </div>
                            <div class="purchased-value">
                                <h3>82</h3> <!-- Replace with database values -->
                            </div>
                            <div class="purchasedoverview-text">
                                <img src="/assets/images/Purchased Text.svg" alt="Purchased Text">
                            </div>
                        </div>
                        <!-- Purchased Box -->

                        <!-- Cost Box -->
                        <div class="cost-box">

                            <div class="purchaseoveriew-icons">
                                <img src="/assets/images/Cost Icon.svg" alt="Cost Icon">
                            </div>

                            <div class="cost-value">
                                <h3>£12,343</h3> <!-- Replace with database values -->
                            </div>

                            <div class="purchasedoverview-text">
                                <img src="/assets/images/Cost Text.svg" alt="Cost Text">
                            </div>
                        </div>
                        <!-- Cost Box -->

                        <!-- Canceled Box -->
                        <div class="canceled-box">

                            <div class="purchaseoveriew-icons">
                                <img src="/assets/images/Canceled Icon.svg" alt="Canceled Icon">
                            </div>

                            <div class="canceled-value">
                                <h3>5</h3> <!-- Replace with database values -->
                            </div>

                            <div class="purchasedoverview-text">
                                <img src="/assets/images/Canceled Text.svg" alt="Canceled Text">
                            </div>
                        </div>
                        <!-- Canceled Box -->

                        <!-- Returned Box -->
                        <div class="returned-box">

                            <div class="purchaseoveriew-icons">
                                <img src="/assets/images/Profit Icon.svg" alt="Returned Icon">
                            </div>

                            <div class="returned-value">
                                <h3>£13,200</h3> <!-- Replace with database values -->
                            </div>

                            <div class="purchasedoverview-text">
                                <img src="/assets/images/Returned Text.svg" alt="Returned Text">
                            </div>
                        </div>
                        <!-- Returned Box -->
                    </div>
                </div>
                <!-- Purchase Overview Section -->

                <!-- Inventory Summary Section -->
                <div class="item item-2">
                    <h3>Inventory Summary</h3>
                    <div class="invsummary-sections">

                        <!-- Quantity Box -->
                        <div class="quantity-box">

                            <div class="quantity-to-be-recieved-icons">
                                <img src="/assets/images/Quantity Icon.svg" alt="Quantity Icon">
                            </div>

                            <div class="quantity-value">
                                <h3>868</h3> <!-- Replace with database values -->
                            </div>

                            <div class="quantity-to-be-recieved-text">
                                <img src="/assets/images/Quantity in Hand text.svg" alt="Quantity Text">
                            </div>

                        </div>
                        <!-- Quantity Box -->

                        <!-- To be received Box -->
                        <div class="to-be-recieved-box">

                            <div class="quantity-to-be-recieved-icons">
                                <img src="/assets/images/To Be Received Icon.svg" alt="To Be Received Icon">
                            </div>

                            <div class="received-value">
                                <h3>200</h3> <!-- Replace with database values -->
                            </div>

                            <div class="quantity-to-be-recieved-text">
                                <img src="/assets/images/To Be Received Text.svg" alt="To be received Text">
                            </div>

                        </div>
                        <!-- To be received Box -->
                    </div>
                </div>
                <!-- Inventory Summary Section -->

                <!-- Sales Overview Section -->
                <div class="item item-3">
                    <h3>Sales Overview</h3>
                    <div class="salesoverview-sections">

                        <!-- Sales Box -->

                        <div class="sales-box">

                            <div class="sales-revenue-profit-cost-icons">
                                <img src="/assets/images/Sales Icon.svg" alt="Sales Icon">
                            </div>

                            <div class="sales-value">
                                <h3>832</h3> <!-- Replace with database values -->
                            </div>

                            <div class="sales-revenue-profit-cost-text">
                                <img src="/assets/images/Sales Text.svg" alt="Sales Text">
                            </div>

                        </div>
                        <!-- Sales Box -->

                        <!-- Revenue Box -->
                        <div class="revenue-box">
                            <div class="sales-revenue-profit-cost-icons">
                                <img src="/assets/images/Revenue Icon.svg" alt="Revenue Icon">
                            </div>
                            <div class="revenue-value">
                                <h3>£18,300</h3> <!-- Replace with database values -->
                            </div>
                            <div class="sales-revenue-profit-cost-text">
                                <img src="/assets/images/Revenue Text.svg" alt="Revenue Text">
                            </div>
                        </div>
                        <!-- Revenue Box -->

                        <!-- Profit Box -->
                        <div class="profit-box">
                            <div class="sales-revenue-profit-cost-icons">
                                <img src="/assets/images/Profit Icon.svg" alt="Profit Icon">
                            </div>
                            <div class="Profit-value">
                                <h3>£868</h3> <!-- Replace with database values -->
                            </div>
                            <div class="sales-revenue-profit-cost-text">
                                <img src="/assets/images/Profit Text.svg" alt="Profit Text">
                            </div>
                        </div>
                        <!-- Profit Box -->

                        <!-- Cost Box -->
                        <div class="cost-box">
                            <div class="sales-revenue-profit-cost-icons">
                                <img src="/assets/images/Cost Icon.svg" alt="Cost Icon">
                            </div>
                            <div class="Cost-value">
                                <h3>£17,432</h3> <!-- Replace with database values -->
                            </div>
                            <div class="sales-revenue-profit-cost-text">
                                <img src="/assets/images/Cost Text.svg" alt="Cost Text">
                            </div>
                        </div>
                        <!-- Cost Box -->
                    </div>
                </div>
                <!-- Sales Overview Section -->

                <!-- Low Stock Section -->
                <div class="item item-4">

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
                                <img src="/assets/images/Tata Salt Item.svg" alt="Example Item 1"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Low</button></td> <!-- Replace with database values - if low then glow then or make it so anything placed in low stock place = low -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 1 -->

                            <!-- Row 2 -->
                            <tr>
                                <td class="item-picture">
                                <img src="/assets/images/Lays Item.svg" alt="Example Item 2"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Low</button></td> <!-- Replace with database values - if low then glow then or make it so anything placed in low stock place = low -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 2 -->

                            <!-- Row 3 -->
                            <tr>
                                <td class="item-picture">
                                <img src="/assets/images/Lays Item.svg" alt="Example Item 3"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Low</button></td> <!-- Replace with database values - if low then glow then or make it so anything placed in low stock place = low -->
                            </tr>
                            <!-- Row 3 -->
                        </table>
                    </div>
                </div>
                <!-- Low Stock Section -->

                <!-- Sales & Purchase Section -->
                <div class="item item-5">

                    <div class="H3-see-all-button">
                        <h3>Sales & Purchase</h3>
                    </div>

                    <div class="chart-container">
                        <div class="chart">
                            <canvas id="barchart" width="760px" height="210px"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Sales & Purchase Section -->

                <!-- Order Summary Section -->
                <div class="item item-6">
                    
                    <div class="H3-see-all-button">
                        <h3>Order Summary</h3>
                    </div>

                    <div class="chart-container">
                        <div class="chart">
                            <canvas id="line-chart" width="690px" height="200px"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Selling Section -->
                <div class="item item-7">

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
                                <img src="/assets/images/Tata Salt Item.svg" alt="Example Item 1"></a>
                                </td>
                                <td>Item name</td> <!-- Replace with database values -->
                                <td>Quantity</td> <!-- Replace with database values -->
                                <td><button class="status-button">Medium</button></td> <!-- Replace with database values -->
                            </tr>
                            <tr class="row-divider"></tr>
                            <!-- Row 1 -->
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