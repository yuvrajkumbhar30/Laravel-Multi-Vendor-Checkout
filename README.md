# Laravel Multi Vendor Checkout System

## 🚀 Project Overview
This project is a multi-vendor e-commerce checkout system built with Laravel.

Customers can add products from multiple vendors into a single cart, and during checkout, the system automatically splits orders vendor-wise.

---

## ✨ Features

- Multi-vendor cart system
- Order splitting per vendor
- Stock validation
- Payment simulation
- Admin panel for Orders with filters:
  - Vendor
  - Customer
  - Order status
- Event-driven architecture (OrderPlaced event, PaymentSucceeded)

---

## 🛠 Tech Stack

- Laravel 12
- MySQL
- Blade + Bootstrap
- jQuery

---

## ⚙️ Setup Instructions

```bash
git clone https://github.com/yuvrajkumbhar30/Laravel-Multi-Vendor-Checkout.git
cd Laravel-Multi-Vendor-Checkout

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate:fresh --seed

php artisan serve

## 🧠 Architecture Decisions

### 1. Service Layer for Business Logic
Business logic such as cart management and checkout processing is handled in dedicated service classes (`CartService`, `CheckoutService`) instead of controllers.

**Why:**
- Keeps controllers thin and focused on request/response
- Improves code readability and maintainability
- Allows reuse of logic across multiple entry points (API, web, jobs)

---

### 2. Multi-Vendor Order Splitting
During checkout, cart items are grouped by vendor and separate orders are created per vendor.

**Why:**
- Reflects real-world marketplace behavior (Amazon, Flipkart)
- Enables independent vendor order processing and fulfillment

---

### 3. Database Transactions
Checkout process is wrapped in a database transaction.

**Why:**
- Ensures data consistency
- Prevents partial order creation if any step fails

---

### 4. Inventory Race Condition Protection
Row-level locking (`lockForUpdate`) is used when updating product stock.

**Why:**
- Prevents overselling when multiple users place orders simultaneously
- Ensures accurate inventory management

---

### 5. Event-Driven Architecture
Events like `OrderPlaced` and `PaymentSucceeded` are used with listeners.

**Why:**
- Decouples core business logic from side effects
- Makes system extensible (e.g., notifications, analytics, integrations)
- Improves maintainability

---

### 6. Form Request Validation
Validation logic is handled using Laravel Form Request classes.

**Why:**
- Keeps controllers clean
- Centralizes validation rules
- Improves reusability and readability

---

### 7. API Authentication using Laravel Sanctum // working on IT
Sanctum is used for token-based authentication.

**Why:**
- Secure API access
- Removes dependency on hardcoded user IDs
- Scalable for future frontend/mobile integration

---

### 8. Role-Based Access Control (Gates) // working on IT
Laravel Gates are used to restrict admin routes.

**Why:**
- Ensures only authorized users can access admin features
- Simple and effective role-based authorization

---

### 9. Eloquent Relationships & Eager Loading
Relationships between models (Cart, Product, Vendor, Order) are defined and eager loaded.

**Why:**
- Reduces database queries (avoids N+1 problem)
- Improves performance and clean data access