<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Category Manager');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reports</title>
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="icon" type="image/svg+xml" href="/assets/images/QuickBuyIcon.svg" />
  <script defer src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
  <script defer src="/js/index.js"></script>
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
                  <img src="/assets/images/Dashboard + Icon.svg" alt="Navigate to Dashboard" />
              </a>
          </div>

          <div class="inventory-icon">
              <a href="/pages/category-manager/inventory.php">
                  <img src="/assets/images/Inventory + Icon.svg" alt="Navigate to Inventory" />
              </a>
          </div>

          <div class="reports-icon">
              <a href="/pages/category-manager/reports.php">
                  <img src="/assets/images/ACTIVE Reports + Icon.svg" alt="Navigate to Reports" />
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
    <main class="reports-main-content">
      
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
            <img src="/assets/images/Notification Icon.svg" alt="Notification Icon" height="100%" />
          </div>

          <div class="profile-icon">
            <img src="/assets/images/Avatar Icon.svg" alt="Profile Avatar" />
          </div>
        </div>
      </div>
      <!-- Top Search Bar -->

      <!-- Overview Section -->
      <section class="overview-container">
        <h2 id="h2-overview">Overview</h2>
        <div class="overview-cards">
          <div class="card">
            <p class="amount">£21,180</p>
            <p class="label">Total Profit</p>
          </div>
          <div class="card">
            <p class="amount">£18,300</p>
            <p class="label" id="rlabel">Revenue</p>
          </div>
          <div class="card">
            <p class="amount">17,432</p>
            <p class="label" id="slabel">Sales</p>
          </div>
        </div>
        <div class="overview-cards">
          <div class="card">
            <p class="amount">£117,432</p>
            <p class="label">Net Purchase Value</p>
          </div>
          <div class="card">
            <p class="amount">£80,432</p>
            <p class="label">Net Sales Value</p>
          </div>
          <div class="card">
            <p class="amount">£30,432</p>
            <p class="label">MoM Profit</p>
          </div>
        </div>
      </section>

      <!-- Chart Section -->
      <section id="chart" class="chart-section">
        <div class="chart-header">
          <div class="chart-title">Profit & Revenue</div>
        </div>
        <div class="chart-container">
          <div class="chart">
            <canvas id="rev-line-chart" width="1550px" height="250px"></canvas>
          </div>
        </div>
      </section>

      <!-- Best Selling Section -->
      <section class="best-selling-section">
        <div class="products-section">
          <div class="section-header">
            <h2>Best Selling Products</h2>
            <a href="#" class="see-all">See All</a>
          </div>
          <div class="products-table">
            <table>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Product ID</th>
                  <th>Category</th>
                  <th>Remaining Quantity</th>
                  <th>Turn Over</th>
                  <th>Increase By</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tomato</td>
                  <td>23567</td>
                  <td>Vegetable</td>
                  <td>225 kg</td>
                  <td>£17,000</td>
                  <td class="increase">2.3%</td>
                </tr>
                <tr>
                  <td>Onion</td>
                  <td>25831</td>
                  <td>Vegetable</td>
                  <td>200 kg</td>
                  <td>£12,000</td>
                  <td class="increase">1.3%</td>
                </tr>
                <tr>
                  <td>Maggi</td>
                  <td>56841</td>
                  <td>Snacks</td>
                  <td>150 kg</td>
                  <td>£10,000</td>
                  <td class="increase">1.1%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
    <!-- Main Content -->
  </div>
</body>

</html>