# QuickBuy Inventory Management System

Multi-role inventory management app for a fictitious grocery chain, QuickBuy Ltd.
Four roles: Store Manager, Warehouse Manager, Category Manager, Sales Associate.

## 🌐 Live Web Application: https://quickbuyltd.xo.je/

<img width="1918" height="1079" alt="image" src="https://github.com/user-attachments/assets/4e51975f-aef4-46f1-b9a9-2aa12e28ae64" />

<img width="1910" height="1077" alt="image" src="https://github.com/user-attachments/assets/5e4dac86-2b9b-410d-8772-c191675b6535" />

<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/b89edca6-5c70-4902-878e-f6b437ba8ca0" />

---

## Prerequisites

| Tool | Version |
|---|---|
| PHP | 8.0+ |
| MySQL / MariaDB | 8.0+ / 10.6+ |

PHP ships with XAMPP at `C:\xampp\php\php.exe`.

---

## Local Setup

### 1. Clone the repo

```bash
git clone <repo-url>
cd "Inventory Management System"
```

### 2. Import the database

Open phpMyAdmin (`http://localhost/phpmyadmin`), create a `quickbuy` database, then import `database/quickbuy_schema.sql`.

Or via CLI:

```bash
mysql -u root -p -e "CREATE DATABASE quickbuy;"
mysql -u root -p quickbuy < database/quickbuy_schema.sql
```

### 3. Configure the database connection

Edit `backend/includes/db_config.php`:

```php
$host   = 'localhost';
$dbname = 'quickbuy';
$user   = 'root';
$pass   = '';   // blank for default XAMPP
```

### 4. Create the uploads folder

```bash
mkdir assets/uploads
```

### 5. Start the server

Run from the repo root:

```bash
# Windows (XAMPP)
C:\xampp\php\php.exe -S localhost:8000

# macOS / Linux
php -S localhost:8000
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## Test Accounts

Password for all accounts: **`quickbuy123`**

| Name | Email | Role |
|---|---|---|
| John Doe | john.doe@quickbuy.co.uk | Store Manager |
| Jane Smith | jane.smith@quickbuy.co.uk | Warehouse Manager |
| Alice Johnson | alice.j@quickbuy.co.uk | Category Manager |
| Bob Brown | bob.brown@quickbuy.co.uk | Sales Associate |

---

## Project Structure

```
Inventory Management System/
├── index.php             Root redirect to /pages/auth/login.php
├── .htaccess             Directory listing disabled; RewriteRule for root
├── assets/               Fonts, SVG icons, uploaded product images (runtime, git-ignored)
├── css/                  base.css, style.css, dashboard.css, order.css, report.css, modal.css, auth.css
├── js/                   auth-guard.js, index.js, script.js, report.js
├── database/             quickbuy_schema.sql (canonical; only file to use)
├── pages/
│   ├── auth/             login.php, register.php, account-type.php
│   ├── shared/           product-details.php
│   ├── store-manager/    dashboard, inventory, orders, reports, invoice, low-quantity, top-selling, manage-store, settings
│   ├── warehouse-manager/
│   ├── category-manager/
│   └── sales-associate/
└── backend/
    ├── includes/         db_config.php, session_guard.php
    ├── auth/             login.php, logout.php, check-session.php
    ├── shared/           PHP logic shared across roles
    ├── store-manager/    inventory.php, low-quantity.php
    └── category-manager/ inventory.php, dashboard.php
```

---

## User Roles

| Role | Key Pages |
|---|---|
| Store Manager | Dashboard, Inventory, Orders, Reports, Invoice, Low Quantity, Top Selling, Manage Store |
| Warehouse Manager | Dashboard, Orders, Reports, Manage Store |
| Category Manager | Dashboard, Inventory, Reports, Manage Store |
| Sales Associate | Dashboard, Manage Store |

---

## Auth Flow

1. `POST /backend/auth/login.php` verifies email and bcrypt password hash.
2. On success: session is regenerated, role stored in `$_SESSION['role']`, user redirected to their dashboard.
3. Every protected page calls `require_role()` from `session_guard.php` before any HTML output.
4. `auth-guard.js` provides a secondary client-side check via `/backend/auth/check-session.php`.
5. Logout: `backend/auth/logout.php` destroys the session and redirects to login.
