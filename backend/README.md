# backend/

Restructured PHP backend. Replaces the old `sql queries/` folder.

## Structure

```
backend/
├── includes/
│   └── db_config.php          ← PDO connection (edit host/dbname/user/pass)
├── shared/                    ← Files identical across multiple roles
│   ├── dashboard.php          ← SM + WM dashboard (stats grid + charts)
│   ├── orders.php             ← SM + WM orders management
│   ├── invoice.php            ← SM + SA invoice generation
│   ├── managestore.php        ← All roles — store branches display
│   └── reports.php            ← SM + WM + CM financial reports
├── store-manager/
│   ├── inventory.php          ← Full CRUD with popup, filter, CSV download
│   └── low-quantity.php       ← Products below threshold_value
└── category-manager/
    ├── inventory.php          ← Add/view products (no filter/download JS)
    └── dashboard.php          ← Low qty + top-selling product tables
```

## Include path pattern

All files use:
```php
include __DIR__ . '/../includes/db_config.php';
```

## Schema fixes applied

| Original code | Fixed to | Reason |
|---|---|---|
| `include 'db_config.php'` | `include __DIR__ . '/../includes/db_config.php'` | Portable path |
| `$row['name']` | `$row['product_name']` | Canonical column name |
| `FROM manage_store` | `FROM store_branches` | Correct table name |
| `products.order_value` | `products.buying_price` / `selling_price` | `order_value` only exists on `orders` |
| `$row['unit']` | removed | Column does not exist in schema |
| Hard-coded quantity thresholds for status | Use `status` column from `orders` | Schema has explicit status ENUM |

## Manual deletion required

Once satisfied with `backend/`, delete the old `sql queries/` folder manually.
The following files inside it are also superseded:

- `sql queries/database/lowquantity.sql`
- `sql queries/database/productspage.sql`
- `sql queries/database/` (entire folder)
