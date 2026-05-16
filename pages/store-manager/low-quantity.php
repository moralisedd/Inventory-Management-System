<?php
require_once __DIR__ . '/../../backend/includes/session_guard.php';
require_role('Store Manager');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Low Quantity Stock</title>
    <link rel="icon" type="image/svg+xml" href="/assets/images/QuickBuyIcon.svg" />
    <link rel="stylesheet" href="/css/style.css" />
    <script src="/js/auth-guard.js"></script>
</head>

<body>
    <div class="LowStockpage-container">

        <!-- Low Stock Section -->

        <div class="lowstock-H3">
            <h3>Low Quantity Stock</h3>
        </div>

        <div class="lowstock-quantity-table-container">
            <table>
                <!-- Row 1 -->
                <tr>
                    <td class="item-picture">
                        <img src="/assets/images/Tata Salt Item.svg" alt="Example Item 1">
                    </td>
                    <td>Item name</td>
                    <td>Quantity</td>
                    <td><button class="status-button">Low</button></td>
                </tr>
                <tr class="row-divider">
                    <td colspan="4"></td>
                </tr>
                <!-- Row 1 -->

                <!-- Row 2 -->
                <tr>
                    <td class="item-picture">
                        <img src="/assets/images/Lays Item.svg" alt="Example Item 2">
                    </td>
                    <td>Item name</td>
                    <td>Quantity</td>
                    <td><button class="status-button">Low</button></td>
                </tr>
                <tr class="row-divider">
                    <td colspan="4"></td>
                </tr>
                <!-- Row 2 -->

                <!-- Row 3 -->
                <tr>
                    <td class="item-picture">
                        <img src="/assets/images/Lays Item.svg" alt="Example Item 3">
                    </td>
                    <td>Item name</td>
                    <td>Quantity</td>
                    <td><button class="status-button">Low</button></td>
                </tr>
                <!-- Row 3 -->
            </table>
        </div>
    </div>
    <!-- Low Stock Section -->
    </div>
</body>

</html>