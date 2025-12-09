# Gadgetify - Project Documentation

## 1. Project Overview
**Gadgetify** is a Laravel-based E-commerce application that allows:
- **Admins** to manage products (CRUD), upload images, and view inventory.
- **Customers** to browse products, add them to a cart, manage cart items, place orders (checkout), and view their purchase history.

**Technologies Used:**
- **Framework:** Laravel 11.x (PHP)
- **Database:** MySQL
- **Frontend:** Blade Templates, Bootstrap 5 (via Laravel UI)
- **Authentication:** Laravel UI (Session-based)

---

## 2. Database Structure (Schema)

The database consists of the following key tables.

### `users`
Stores all registered users and administrators.
- `id` (PK)
- `name` (String)
- `email` (String, Unique)
- `password` (String)
- `is_admin` (Boolean, Default: `false`) - Determines admin access.
- `created_at`, `updated_at`

### `products`
Stores the catalog of items available for sale.
- `id` (PK)
- `name` (String, Unique)
- `slug` (String, Unique) - SEO friendly URL segment.
- `description` (Text)
- `price` (Decimal 10,2)
- `stock` (Integer)
- `image_path` (String) - Path to image in `storage/app/public`.
- `is_active` (Boolean) - Soft delete mechanism (logic-based).
- `created_at`, `updated_at`

### `cart_items`
Stores temporary items for a user's shopping session.
- `id` (PK)
- `user_id` (FK -> `users.id`)
- `product_id` (FK -> `products.id`)
- `quantity` (Integer, Default: 1)
- `created_at`, `updated_at`

### `orders`
Stores completed purchase records.
- `id` (PK)
- `user_id` (FK -> `users.id`)
- `total_price` (Decimal 10,2)
- `status` (String, Default: 'pending')
- `shipping_address` (Text)
- `created_at`, `updated_at`

### `order_items`
Stores the snapshot of items within a specific order.
- `id` (PK)
- `order_id` (FK -> `orders.id`)
- `product_id` (FK -> `products.id`)
- `quantity` (Integer)
- `price_at_purchase` (Decimal 10,2) - Price frozen at time of purchase.
- `created_at`, `updated_at`

---

## 3. Backend Architecture

### Models (`app/Models`)
- **User.php**:
    - Has many `orders`.
    - Has attribute `is_admin`.
- **Product.php**:
    - Scope `active()`: Filters only active products.
    - Fillable: `name`, `slug`, `description`, `price`, `stock`, `image_path`, `is_active`.
- **CartItem.php**:
    - Belongs to `user` and `product`.
    - Fillable: `user_id`, `product_id`, `quantity`.
- **Order.php**:
    - Belongs to `user`.
    - Has many `items` (`OrderItem`).
    - Fillable: `user_id`, `total_price`, `status`, `shipping_address`.
- **OrderItem.php**:
    - Belongs to `order` and `product`.

### Middleware (`app/Http/Middleware`)
- **AdminMiddleware.php**:
    - Registered alias: `admin`.
    - Logic: Checks if `Auth::check() && Auth::user()->is_admin`. Aborts 403 otherwise.

### Controllers (`app/Http/Controllers`)

#### Admin Side (`Admin\` Namespace)
- **Admin\ProductController.php**:
    - `index()`: Paginated list of products.
    - `create()`, `store()`: Validate request (`ProductRequest`), handle image upload, create product.
    - `edit()`, `update()`: Update details, handle new image upload (replaces old), update slug.
    - `destroy()`: Sets `is_active` to false (Soft delete).

#### Customer Side
- **ProductController.php**:
    - `index()`: Lists `active` products for the storefront.
- **CartController.php**:
    - `index()`: Shows current cart items and total.
    - `addItem(Request)`: `firstOrNew` logic. Increments quantity if exists, creates if new. Validates stock.
    - `removeItem(CartItem)`: Deletes item. Ensures user owns the item.
- **CheckoutController.php**:
    - `processOrder(Request)`:
        - DB Transaction.
        - Checks cart empty.
        - Creates `Order`.
        - Moves `CartItems` -> `OrderItems`.
        - Decrements Product `stock`.
        - Deletes `CartItems`.
- **OrderController.php**:
    - `history()`: Lists logged-in user's past orders.

---

## 4. Frontend Architecture (Views)

Located in `resources/views`.

### Layouts
- **layouts/app.blade.php**: Main customer layout. Contains Navbar (with Cart/Orders links) and Flash Message logic (Success/Error alerts).
- **layouts/admin.blade.php**: Admin specific layout.

### Admin Views (`admin/products/`)
- `index.blade.php`: Table of products with Edit/Delete buttons.
- `create.blade.php`: Form to add new product.
- `edit.blade.php`: Form to edit product.

### Customer Views
- **products/index.blade.php**: Grid view of all products with "Add to Cart" forms.
- **cart/index.blade.php**: Cart table, total calculation, and Checkout form (Address input + Place Order button).
- **orders/index.blade.php**: Accordion list of past orders and their details.

---

## 5. Routes (`routes/web.php`)

### Public
- `GET /` -> `ProductController@index` (Home/Shop)
- `Auth::routes()` (Login/Register/Logout)

### Protected (Customer - `auth` middleware)
- `GET /cart` -> `CartController@index`
- `POST /cart/add` -> `CartController@addItem`
- `DELETE /cart/remove/{item}` -> `CartController@removeItem`
- `POST /checkout` -> `CheckoutController@processOrder`
- `GET /orders/history` -> `OrderController@history`

### Protected (Admin - `auth` + `admin` middleware)
- Group prefix: `admin`
- `Resource products` -> `Admin\ProductController`

---

## 6. Key Logic Flows

### Adding to Cart
1. User clicks "Add to Cart" on `products.index`.
2. Form submits `product_id` and `quantity=1` to `cart.add`.
3. `CartController` validates stock.
4. If item exists for user, quantity += 1. Else, create new record.
5. Redirect back with success message.

### Checkout Process
1. User views Cart (`cart.index`).
2. Fills "Shipping Address" and clicks "Place Order".
3. `CheckoutController` starts DB Transaction.
4. Calculates Total.
5. Entails Order creation, Inventory reduction, and Cart clearing.
6. Redirects to Ship with generic success message.
