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
- Admin panel with filters:
  - Vendor
  - Customer
  - Order status
- Event-driven architecture (OrderPlaced event)

---

## 🛠 Tech Stack

- Laravel (Latest)
- MySQL
- Blade + Bootstrap
- jQuery (AJAX)

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