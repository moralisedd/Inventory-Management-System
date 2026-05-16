-- ============================================================
-- QuickBuy Ltd — Canonical MySQL Schema
-- Engine: MySQL 8.0+ / MariaDB 10.6+
-- Naming: snake_case (matches PHP PDO queries)
-- Safe to re-run: drops all tables first, then recreates and seeds.
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- Drop in reverse dependency order so FK constraints don't block.
DROP TABLE IF EXISTS reports;
DROP TABLE IF EXISTS invoice_details;
DROP TABLE IF EXISTS invoices;
DROP TABLE IF EXISTS customer_order_details;
DROP TABLE IF EXISTS customer_orders;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS low_stock_products;
DROP TABLE IF EXISTS best_selling_products;
DROP TABLE IF EXISTS best_selling_categories;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS stocks;
DROP TABLE IF EXISTS product_filter;
DROP TABLE IF EXISTS product_details;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS store_branches;
DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS colour_blindness_settings;
DROP TABLE IF EXISTS password_recovery;
DROP TABLE IF EXISTS user_details;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS user_role_mapping;
DROP TABLE IF EXISTS user_roles;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- USER MANAGEMENT
-- ============================================================

CREATE TABLE users (
    user_id       INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100)  NOT NULL,
    email         VARCHAR(100)  NOT NULL UNIQUE,
    password_hash VARCHAR(255)  NOT NULL,
    role          ENUM('Store Manager', 'Warehouse Manager', 'Category Manager', 'Sales Associate') NOT NULL,
    is_active     BOOLEAN       DEFAULT TRUE,
    created_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Reference table for role descriptions.
CREATE TABLE user_roles (
    role_id     INT AUTO_INCREMENT PRIMARY KEY,
    role_name   VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

-- Many-to-many mapping kept for potential future multi-role support.
CREATE TABLE user_role_mapping (
    mapping_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    role_id    INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)      ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES user_roles(role_id) ON DELETE CASCADE
);

CREATE TABLE colour_blindness_settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT     NOT NULL,
    is_enabled BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE password_recovery (
    recovery_id    INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT          NOT NULL,
    recovery_token VARCHAR(255) NOT NULL,
    expiry_date    TIMESTAMP    NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE user_details (
    detail_id  INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT          NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    email      VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- ============================================================
-- SESSION MANAGEMENT
-- ============================================================

CREATE TABLE sessions (
    session_id  VARCHAR(255) PRIMARY KEY,
    user_id     INT     NOT NULL,
    login_time  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expiry_time TIMESTAMP NULL,
    is_active   BOOLEAN   DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE INDEX idx_sessions_user_id     ON sessions(user_id);
CREATE INDEX idx_sessions_expiry_time ON sessions(expiry_time);

-- Note: expiry_time defaults to 1 hour after login_time.
-- Set this in PHP when inserting: DATE_ADD(NOW(), INTERVAL 1 HOUR)

-- ============================================================
-- PRODUCT MANAGEMENT
-- ============================================================

CREATE TABLE products (
    product_id        INT AUTO_INCREMENT PRIMARY KEY,
    product_name      VARCHAR(255)   NOT NULL,
    image_path        VARCHAR(500),
    buying_price      DECIMAL(10, 2) NOT NULL,
    selling_price     DECIMAL(10, 2) NOT NULL,
    quantity          INT            NOT NULL DEFAULT 0,
    threshold_value   INT            NOT NULL,
    expiry_date       DATE,
    availability      ENUM('In Stock', 'Low Quantity', 'Out of Stock') NOT NULL,
    category          VARCHAR(100),
    stock_level       INT            NOT NULL DEFAULT 0,
    sales_performance ENUM('Top-selling', 'Low-selling'),
    created_at        TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP      DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE product_details (
    detail_id       INT AUTO_INCREMENT PRIMARY KEY,
    product_id      INT NOT NULL,
    description     TEXT,
    dimensions      VARCHAR(100),
    weight          DECIMAL(10, 2),
    manufacturer    VARCHAR(255),
    warranty_period VARCHAR(50),
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE product_filter (
    filter_id    INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL,
    filter_type  ENUM('Category', 'StockLevel', 'SalesPerformance'),
    filter_value VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- ============================================================
-- INVENTORY & STOCK
-- ============================================================

CREATE TABLE stocks (
    stock_id        INT AUTO_INCREMENT PRIMARY KEY,
    product_id      INT NOT NULL,
    opening_stock   INT NOT NULL,
    remaining_stock INT NOT NULL,
    on_the_way      INT NOT NULL DEFAULT 0,
    threshold_value INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT  NOT NULL,
    message         TEXT NOT NULL,
    is_read         BOOLEAN   DEFAULT FALSE,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- ============================================================
-- ANALYTICS SNAPSHOTS
-- Denormalised tables for dashboard display.
-- ============================================================

CREATE TABLE best_selling_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category    VARCHAR(255)   NOT NULL,
    turnover    DECIMAL(10, 2) NOT NULL,
    increase_by DECIMAL(5, 2)  NOT NULL DEFAULT 0.00
);

CREATE TABLE best_selling_products (
    product_id         INT PRIMARY KEY,
    product_name       VARCHAR(255)   NOT NULL,
    category           VARCHAR(255)   NOT NULL,
    total_sales        INT            NOT NULL DEFAULT 0,
    remaining_quantity INT            NOT NULL DEFAULT 0,
    turnover           DECIMAL(10, 2) NOT NULL,
    increase_by        DECIMAL(5, 2)  NOT NULL DEFAULT 0.00,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE low_stock_products (
    product_id      INT PRIMARY KEY,
    product_name    VARCHAR(255) NOT NULL,
    category        VARCHAR(255) NOT NULL,
    remaining_stock INT          NOT NULL,
    threshold_value INT          NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- ============================================================
-- SUPPLIER & STORE MANAGEMENT
-- ============================================================

CREATE TABLE suppliers (
    supplier_id    INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name  VARCHAR(255) NOT NULL,
    contact_number VARCHAR(15)  NOT NULL
);

CREATE TABLE stores (
    store_id      INT AUTO_INCREMENT PRIMARY KEY,
    store_name    VARCHAR(255) NOT NULL,
    stock_in_hand INT          NOT NULL DEFAULT 0
);

CREATE TABLE store_branches (
    branch_id   INT AUTO_INCREMENT PRIMARY KEY,
    branch_name VARCHAR(255) NOT NULL,
    address     VARCHAR(255) NOT NULL,
    postcode    VARCHAR(10)  NOT NULL,
    country     VARCHAR(50)  NOT NULL
);

-- ============================================================
-- ORDERS
-- orders          = stock/purchase orders (managed on the Orders page)
-- customer_orders = customer-facing sales orders
-- ============================================================

CREATE TABLE orders (
    order_id           INT AUTO_INCREMENT PRIMARY KEY,
    product_name       VARCHAR(255)   NOT NULL,
    order_value        DECIMAL(10, 2) NOT NULL,
    quantity           INT            NOT NULL,
    expected_delivery  DATE,
    status             ENUM('Confirmed', 'Out for Delivery', 'Delayed', 'Returned') DEFAULT 'Confirmed',
    created_by_user_id INT,
    created_at         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by_user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

CREATE TABLE customers (
    customer_id  INT AUTO_INCREMENT PRIMARY KEY,
    first_name   VARCHAR(100) NOT NULL,
    last_name    VARCHAR(100) NOT NULL,
    email        VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    address      TEXT
);

CREATE TABLE customer_orders (
    customer_order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id       INT            NOT NULL,
    user_id           INT            NOT NULL,
    order_date        TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    total_amount      DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id)     REFERENCES users(user_id)         ON DELETE CASCADE
);

CREATE TABLE customer_order_details (
    detail_id         INT AUTO_INCREMENT PRIMARY KEY,
    customer_order_id INT            NOT NULL,
    product_id        INT            NOT NULL,
    quantity          INT            NOT NULL,
    price             DECIMAL(10, 2) NOT NULL,
    line_total        DECIMAL(10, 2) AS (quantity * price) STORED,
    FOREIGN KEY (customer_order_id) REFERENCES customer_orders(customer_order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id)        REFERENCES products(product_id)               ON DELETE CASCADE
);

-- ============================================================
-- INVOICES
-- ============================================================

CREATE TABLE invoices (
    invoice_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT            NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    created_at   TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE invoice_details (
    detail_id  INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT            NOT NULL,
    product_id INT            NOT NULL,
    description VARCHAR(255),
    quantity   INT            NOT NULL,
    rate       DECIMAL(10, 2) NOT NULL,
    line_total DECIMAL(10, 2) AS (quantity * rate) STORED,
    FOREIGN KEY (invoice_id) REFERENCES invoices(invoice_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- ============================================================
-- REPORTING
-- ============================================================

CREATE TABLE reports (
    report_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT       NOT NULL,
    report_data JSON,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- ============================================================
-- SAMPLE DATA
-- ============================================================

INSERT INTO user_roles (role_name, description) VALUES
    ('Store Manager',     'Manage store operations and staff'),
    ('Warehouse Manager', 'Oversee warehouse logistics and stock'),
    ('Category Manager',  'Optimise product categories and pricing'),
    ('Sales Associate',   'Assist customers and handle point-of-sale');

-- All accounts use password: quickbuy123
INSERT INTO users (name, email, password_hash, role) VALUES
    ('John Doe',      'john.doe@quickbuy.co.uk',   '$2b$12$lG94zHpyyV2j3gjhF2l0qe0XWE7GVwmom2RGyqYQEXEYwAV9QmWFS', 'Store Manager'),
    ('Jane Smith',    'jane.smith@quickbuy.co.uk',  '$2b$12$trYYndVE1fMc2I/W.1luneGFW2ho8wPdyXJx7bmuq1Z8gMdshh6Pu', 'Warehouse Manager'),
    ('Alice Johnson', 'alice.j@quickbuy.co.uk',     '$2b$12$e4G2BQSaqmQumDV6d2RGIeAXkcB0y8vjplGe/sbYtyGkB8ZMiPCim', 'Category Manager'),
    ('Bob Brown',     'bob.brown@quickbuy.co.uk',   '$2b$12$jBYvPg4rcrzKJDamWRptHuuOFOF0e1wesnWRki2Z4MTqQJqt1S49K', 'Sales Associate');

INSERT INTO suppliers (supplier_name, contact_number) VALUES
    ('DairyCo Supplies',     '01234 567890'),
    ('BakeHouse Ltd.',       '09876 543210'),
    ('Fresh Farms Wholesale','01122 334455'),
    ('QuickBuy Partners',    '02233 445566');

INSERT INTO store_branches (branch_name, address, postcode, country) VALUES
    ('QuickBuy Sheffield', '123 Main Street, Sheffield', 'S1 2AB', 'United Kingdom'),
    ('QuickBuy Barnsley',  '456 Market Road, Barnsley',  'S70 1AB', 'United Kingdom');

INSERT INTO stores (store_name, stock_in_hand) VALUES
    ('QuickBuy Sheffield', 65),
    ('QuickBuy Barnsley',  45);

INSERT INTO products (product_name, buying_price, selling_price, quantity, threshold_value, expiry_date, availability, category, stock_level, sales_performance) VALUES
    ('QuickBuy Whole Milk',          0.95,  1.50,  50,  10, '2026-08-15', 'In Stock',    'Dairy Products', 100, 'Top-selling'),
    ('QuickBuy Bread Loaf',          1.10,  1.80,   5,   5, '2026-06-08', 'Low Quantity','Bakery Items',    50, 'Top-selling'),
    ('QuickBuy Eggs (12-pack)',       2.50,  3.50, 100,  20, '2026-09-01', 'In Stock',   'Dairy Products', 200, 'Top-selling'),
    ('QuickBuy Salted Butter',        1.75,  2.50,   8,  10, '2026-10-10', 'Low Quantity','Dairy Products',  80, 'Low-selling'),
    ('Heinz Baked Beans',             0.85,  1.20, 100,  20, '2027-06-20', 'In Stock',   'Canned Goods',   200, 'Low-selling'),
    ('QuickBuy Chicken Breast',       5.50,  7.99,  20,   5, '2026-06-05', 'In Stock',   'Meat Products',   30, 'Top-selling'),
    ('Bananas (bunch)',               1.20,  1.80,  60,  10, '2026-06-12', 'In Stock',   'Fruits',          80, 'Low-selling'),
    ('Coca-Cola 2L',                  1.85,  2.50,  40,   8, '2027-12-31', 'In Stock',   'Beverages',      120, 'Top-selling'),
    ('Cadbury Dairy Milk Bar',        1.00,  1.50,  80,  15, '2027-01-01', 'In Stock',   'Snacks',         150, 'Top-selling'),
    ('QuickBuy Toilet Rolls 9-Pack',  4.50,  5.99,  35,  10, NULL,         'In Stock',   'Household',      100, 'Low-selling'),
    ('Kellogg''s Corn Flakes',        3.00,  4.20,  45,  10, '2027-05-15', 'In Stock',   'Cereal',          70, 'Top-selling');

INSERT INTO stocks (product_id, opening_stock, remaining_stock, on_the_way, threshold_value) VALUES
    (1, 200, 150, 50, 30),
    (2, 300, 250, 60, 40),
    (3, 400, 300, 70, 50),
    (4, 500, 400, 80, 60);

INSERT INTO best_selling_categories (category, turnover, increase_by) VALUES
    ('Dairy Products', 1500.50, 12.5),
    ('Bakery Items',   1200.75, 10.0),
    ('Beverages',      1800.90, 15.0),
    ('Snacks',         1100.60,  8.0);

INSERT INTO best_selling_products (product_id, product_name, category, total_sales, remaining_quantity, turnover, increase_by) VALUES
    (1, 'QuickBuy Whole Milk',     'Dairy Products', 500, 50,  750.00, 10.5),
    (3, 'QuickBuy Eggs (12-pack)', 'Dairy Products', 300, 100, 1050.00, 8.0),
    (8, 'Coca-Cola 2L',            'Beverages',      240, 40,  740.00, 12.0),
    (9, 'Cadbury Dairy Milk Bar',  'Snacks',         400, 80,  600.00,  9.0);

INSERT INTO low_stock_products (product_id, product_name, category, remaining_stock, threshold_value) VALUES
    (2, 'QuickBuy Bread Loaf',    'Bakery Items',   5, 5),
    (4, 'QuickBuy Salted Butter', 'Dairy Products', 8, 10);

INSERT INTO customers (first_name, last_name, email, phone_number, address) VALUES
    ('Michael', 'Scott', 'michael.scott@example.com', '07700 900001', '1725 Slough Avenue, Scranton'),
    ('Pam',     'Beesly','pam.beesly@example.com',   '07700 900002', 'Apartment 3B, Scranton');

INSERT INTO customer_orders (customer_id, user_id, total_amount) VALUES
    (1, 1, 45.00),
    (2, 2, 30.00);

INSERT INTO customer_order_details (customer_order_id, product_id, quantity, price) VALUES
    (1, 1, 10, 1.50),
    (1, 2,  5, 1.80),
    (2, 3,  6, 3.50);

INSERT INTO orders (product_name, order_value, quantity, expected_delivery, status, created_by_user_id) VALUES
    ('QuickBuy Whole Milk',    150.00, 100, '2026-07-01', 'Confirmed',        1),
    ('QuickBuy Bread Loaf',     88.00,  80, '2026-07-03', 'Out for Delivery', 1),
    ('QuickBuy Salted Butter',  70.00,  40, '2026-07-05', 'Delayed',          2),
    ('Coca-Cola 2L',           185.00, 100, '2026-07-07', 'Returned',         2);
