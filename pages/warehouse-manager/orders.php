<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Warehouse Manager');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="/css/base.css" />
    <link rel="stylesheet" href="/css/dashboard.css" />
    <link rel="stylesheet" href="/css/order.css" />
    <link rel="stylesheet" href="/css/modal.css" />
    <link rel="icon" type="image/svg+xml" href="/assets/images/QuickBuyIcon.svg" />
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
                    <a href="/pages/warehouse-manager/dashboard.php">
                        <img src="/assets/images/Dashboard + Icon.svg" alt="Navigate to Dashboard" />
                    </a>
                </div>
    
                <div class="reports-icon">
                    <a href="/pages/warehouse-manager/reports.php">
                        <img src="/assets/images/Reports + Icon.svg" alt="Navigate to Reports" />
                    </a>
                </div>
    
                <div class="orders-icon">
                    <a href="/pages/warehouse-manager/orders.php">
                        <img src="/assets/images/ACTIVE Orders + Icon.svg" alt="Navigate to Orders" />
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
          </aside>


        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header>
                <div class="search-bar">
                    <svg stroke="currentColor" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" placeholder="Search product, supplier, order">
                </div>
                <div class="header-actions">
                    <button class="notification-btn">
                        <svg stroke="currentColor" fill="none" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </button>
                    <button class="profile-btn">
                        <svg stroke="currentColor" fill="none" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </button>
                </div>
            </header>



            <!-- sectiom -->
                <!-- Overall Order Section -->
        <section class="inventory-overview">
            <h2>Overall Order</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3 class="blue">Total Orders.</h3>
                    <div class="stat-content">
                        <div class="stat-value">37</div>
                        <div class="stat-sub">Last 7 days</div>
                    </div>
                </div>

                <div class="stat-card">
                    <h3 class="orange">Total Received</h3>
                    <div class="stat-content">
                        <div class="stat-group">
                            <div class="stat-value">23</div>
                            <div class="stat-sub">Last 7 days</div>
                        </div>
                        <div class="stat-group">
                            <div class="stat-value">£25000</div>
                            <div class="stat-sub">Revenue</div>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <h3 class="purple">Total Returned</h3>
                    <div class="stat-content">
                        <div class="stat-group">
                            <div class="stat-value">5</div>
                            <div class="stat-sub">Last 7 days</div>
                        </div>
                        <div class="stat-group">
                            <div class="stat-value">£2500</div>
                            <div class="stat-sub">Cost</div>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <h3 class="red">On the way</h3>
                    <div class="stat-content">
                        <div class="stat-group">
                            <div class="stat-value">12</div>
                            <div class="stat-sub">Ordered</div>
                        </div>
                        <div class="stat-group">
                            <div class="stat-value">£2356</div>
                            <div class="stat-sub">Cost</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Orders Section -->
       <section class="products-section">
                <div class="products-header">
                    <h2>Orders</h2>
                    <div class="actions">
                        <button class="btn primary" id="addProductBtn">Add Orders</button>
                        <button class="btn secondary">
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none">
                                <path d="M12 20V10m0 0l-4 4m4-4l4 4"/>
                            </svg>
                            Filters
                        </button>
                        <button class="btn secondary">Orders History</button>
                    </div>
                </div>


            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Products</th>
                            <th>Order Value</th>
                            <th>Quantity</th>
                            <th>Orders ID</th>
                            <th>Expected Delivery</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                           <tr onclick="window.location='/pages/shared/product-details.php';" style="cursor: pointer;">
                               
                            <td>Maggi</td>
                            <td>£4306</td>
                            <td>43 Packets</td>
                            <td>7535</td>
                            <td>11/12/22</td>
                            <td><span class="status in-stock">Delayed</span></td>
                            </a>
                        </tr>
                      

                        <tr>
                            <td>Bru</td>
                            <td>£2557</td>
                            <td>22 Packets</td>
                            <td>5724</td>
                            <td>21/12/22</td>
                            <td><span class="status out-of-stock">Confirmed</span></td>
                        </tr>
                        <tr>
                            <td>Red Bull</td>
                            <td>£4075</td>
                            <td>36 Packets</td>
                            <td>2775</td>
                            <td>5/12/22</td>
                            <td><span class="status returned">Returned</span></td>
                        </tr>
                        <tr>
                            <td>Bourn Vita</td>
                            <td>£5092</td>
                            <td>14 Packets</td>
                            <td>2275</td>
                            <td>8/1/23</td>
                            <td><span class="status out-for-delivery">Out for delivery</span></td>
                        </tr>
                        <tr>
                            <td>Horlicks</td>
                            <td>£5370</td>
                            <td>15 Packets</td>
                            <td>2427</td>
                            <td>9/1/23</td>
                            <td><span class="status returned">Returned</span></td>
                        </tr>
                        <tr>
                            <td>Harpic</td>
                            <td>£6005</td>
                            <td>10 Packets</td>
                            <td>2578</td>
                            <td>8/1/23</td>
                            <td><span class="status out-for-delivery">Out for delivery</span></td>
                        </tr>
                        <tr>
                            <td>Ariel</td>
                            <td>£4078</td>
                            <td>23 Packets</td>
                            <td>2757</td>
                            <td>13/6/23</td>
                            <td><span class="status in-stock">Delayed</span></td>
                        </tr>
                        <tr>
                            <td>Scotch Brite</td>
                            <td>£3599</td>
                            <td>43 Packets</td>
                            <td>3737</td>
                            <td>16/1/23</td>
                            <td><span class="status out-of-stock">Confirmed</span></td>
                        </tr>
                        <tr>
                            <td>Coca Cola</td>
                            <td>£2055</td>
                            <td>41 Packets</td>
                            <td>2474</td>
                            <td>11/11/22</td>
                            <td><span class="status in-stock">Delayed</span></td>
                        </tr>
                    </tbody>
                </table>
                
            <div class="pagination">
                <button class="btn secondary">Previous</button>
                <span>Page 1 of 10</span>
                <button class="btn secondary">Next</button>
            </div>
            </div>

      
        </main>
    </div>

    
    <!-- Add Product Modal -->
<div class="modal-overlay" id="modalOverlay"></div>
<div class="modal" id="addProductModal">
    <h2>New Product</h2>
    <form id="addProductForm">
        <div class="image-upload" id="imageUpload">
            <p>Drag image here<br>or<br>
            <span class="browse-text">Browse image</span></p>
        </div>
        
        <div class="form-row">
            <input type="text" placeholder="Product Name">
        </div>

        <div class="form-row">
            <input type="text" placeholder="Product ID">
        </div>

        <div class="form-row">
            <select>
                <option value="" selected disabled>Select product category</option>
                <option value="beverages">Beverages</option>
                <option value="snacks">Snacks</option>
                <option value="dairy">Dairy</option>
            </select>
        </div>

        <div class="form-row">
            <input type="text" placeholder="Buying Price">
        </div>

        <div class="form-row">
            <input type="text" placeholder="Quantity">
        </div>

        <div class="form-row">
            <input type="text" placeholder="Unit">
        </div>

        <div class="form-row">
            <input type="text" placeholder="Expiry Date">
        </div>

        <div class="form-row">
            <input type="text" placeholder="Threshold Value">
        </div>

        <div class="modal-actions">
            <button type="button" class="btn btn-discard">Discard</button>
            <button type="submit" class="btn btn-add">Add Product</button>
        </div>
    </form>
</div>
  