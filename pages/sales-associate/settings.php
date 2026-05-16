<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Sales Associate');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings</title>
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

            <div class="invoices-icon">
                <a href="/pages/sales-associate/dashboard.php">
                    <img src="/assets/images/Invoices + Icon.svg" alt="Navigate to Invoices" />
                </a>
            </div>

            <div class="manage-icon">
                <a href="/pages/sales-associate/manage-store.php">
                    <img src="/assets/images/Manage Store + Icon.svg" alt="Navigate to Manage Store" />
                </a>
            </div>

            <div class="settings-icon">
                <a href="/pages/sales-associate/settings.php">
                    <img src="/assets/images/ACTIVE Settings + Icon.svg" alt="Navigate to Settings" />
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

            <!-- Background Image -->
            <div class="stgs-background-img-container">
                <img src="/assets/images/Settings Background.svg" alt="Settings Background" />
            </div>
            <!-- Background Image -->

            <!-- Settings Container -->
            <div class="settings-container">

                <!-- Top Section-->
                <div class="top-settings-section">
                    <div class="settings-profile-icon">
                        <img src="/assets/images/Settings Profile Icon.svg" alt="Settings Profile Icon" />
                    </div>
                    <div class="settings-profile-text">
                        <img src="/assets/images/Settings Text.svg" alt="Settings Profile Text" />
                    </div>
                    <div class="settings-cancel-button">
                        <img src="/assets/images/Settings Cancel Button.svg" alt="Settings Cancel Button" />
                    </div>
                    <div class="settings-save-button">
                        <img src="/assets/images/Settings Save Button.svg" alt="Settings Save Button" />
                    </div>
                </div>
                <!-- Top Section-->

                <!-- Settings header Section -->
                <div class="settings-header-container">

                    <div class="my-details-header">
                        <h4>My Details</h4>
                    </div>

                    <div class="change-password-header">
                        <h4>Password</h4>
                    </div>

                    <div class="accessibility-header">
                        <h4>Accessibility</h4>
                    </div>

                    <div class="notification-settings-header">
                        <h4>Notification Settings</h4>
                    </div>

                </div>
                <!-- Settings header Section -->

                <!-- My Details Section -->
                <div class="my-details-container">

                    <div class="first-last-name-email-container">

                        <form action="#" method="POST">

                            <div class="first-name-container">
                                <h4>First Name</h4>
                                <input type="text" id="fname" placeholder="Enter first name..." name="fname" />
                            </div>

                            <div class="last-name-container">
                                <h4>Last Name</h4>
                                <input type="text" id="lname" placeholder="Enter last name..." name="lname" />
                            </div>

                            <div class="email-container">
                                <h4>Email</h4>
                                <input type="text" id="email" placeholder="Enter new email..." name="email" />
                            </div>

                            <!-- Account Role -->
                            <div class="account-role-container">
                                <h4>Role</h4>
                                <div class="role-container">
                                    <h5>Store Manager</h5> <!--Replace with database values-->
                                </div>
                            </div>
                            <!-- Account Role -->

                        </form>

                    </div>

                </div>
                <!-- My Details Section -->

                <div class="upload-profile-pic-container">
                    <img src="/assets/images/Upload Profile Pic.svg" alt="Upload Profile Picture Button" />
                </div>


            </div>
            <!-- Settings Container -->


            <!-- Main Content -->
        </div>
</body>

</html>