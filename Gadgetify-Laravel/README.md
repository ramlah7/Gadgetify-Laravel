# Gadgetify E-Commerce

Gadgetify is a modern E-commerce application built with **Laravel 11**, featuring a complete Admin Dashboard for product management and a customer-facing storefront with specific cart and checkout functionality.

## Features

### For Customers
*   **Browse Products**: View active products with images and prices.
*   **Shopping Cart**: Add items, adjust quantities, and remove items.
*   **Checkout Flow**: Seamless checkout with shipping address input.
*   **Order History**: Track past purchases and view order details.
*   **Authentication**: Secure Register/Login system.

### For Administrators
*   **Dashboard**: Protected admin route (Middleware secured).
*   **Product Management**: 
    *   Create, Edit, Delete products.
    *   Upload and manage product images.
    *   Manage stock levels and prices.
    *   Soft delete functionality for products.

## Technology Stack
*   **Framework**: Laravel 11.x
*   **Language**: PHP 8.2+
*   **Frontend**: Blade Templates, Bootstrap 5
*   **Database**: MySQL
*   **Authentication**: Laravel UI

## Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/gadgetify-laravel.git
    cd gadgetify-laravel
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    npm run build
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your database credentials in the `.env` file.*

4.  **Database Migration**
    ```bash
    php artisan migrate
    ```

5.  **Run the Application**
    ```bash
    php artisan serve
    ```

## License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
