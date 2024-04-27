# E-commerce Website for means wear
This is a web-based e-commerce platform built using PHP, MySQL, and Bootstrap/css. It includes features such as multi-user authentication, product management, shopping cart functionality, and an admin dashboard.

## Table of Contents
- Features
- Setup Instructions
- Usage
- Admin Panel
- Database Schema


## Features
- User Authentication:
    - Users can register, login, and manage their accounts.
    - Admins have access to additional functionalities.
- Product Management:
  - Browse and search products.
  - Add products to the shopping cart.
  - Checkout process with order confirmation.
- Admin Panel:
  - Add, update, or delete products.
  - View total sales, users, and orders.
  - Manage banners.
## Setup Instructions
To run this project locally, follow these steps:

1. Clone the repository:
```
git clone https://github.com/eng-abhijit/ajshop-mens-wear.git
```
2. Import Database:
- Import the attendance.sql file into your MySQL database.
3. Configure Database Connection:
- Open config.php file.
- Update the database connection details (hostname, username, password, database name).
4. Start the Development Server:
- Use PHP's built-in web server or configure your local web server.
5. Access the Website:
- Open your web browser and navigate to http://localhost/project_aarhat/home.php
## Usage
1.User Authentication:
- Register a new account or login with existing credentials.
2. Browsing and Shopping:
- Browse through the product catalog.
- Click on a product to view details and add it to the cart.
- Proceed to checkout and place an order.
3. Admin Features:
- Access the admin panel using `/admin` route.
- Login with admin credentials.
- Manage products, and update banners.
## Admin Panel
The admin panel is accessible at `/admin` route. Use your admin credentials to log in and access the following features:

- Product Management:
  - Add new products.
  - Update existing products.
  - Delete products.

- Banner Management:
  - Add or remove banners for promotions.
## Database Schema
The database schema includes the following tables:

- **`users`**: Stores user account information.
- **`products`**: Contains product details.
- **`cart`**: Manages the user's shopping cart.
- **`add_banner`**: Manages banners for promotional purposes.
- **`add_category`**:  product category
- **`add_sub_category`**: product sub category
- **`orders`**: Stores order information.
- **`message`**: Manages banners for promotional purposes.

