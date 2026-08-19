# E-Commerce Website

A PHP and MySQL web application for managing and browsing stores, products, and categories through a customer-facing website and an administrator dashboard.

## Overview

This project is a database-driven web application built with **PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap**.

The system is organized into two main parts:

* A **public website** for browsing categories, discovering stores, searching within categories, viewing store information and products, and rating stores.
* An **admin dashboard** for managing products, stores, categories, and administrator profiles.

The project uses **MySQLi** for database access and stores uploaded images in a local `upload` directory.

## Features

### Public Website

#### Categories

The main website loads categories from the database and displays the number of stores associated with each category.

Users can select a category to explore its stores.

#### Store Discovery

After selecting a category, users can:

* View the category name and description.
* See the category's calculated rating.
* Search for stores by name within the selected category.
* Open a dedicated store page.

The store listing is dynamically loaded from the MySQL database.

#### Store Details

Each store has a dedicated page displaying:

* Store name
* Store description
* Store image
* Address
* Phone number
* Products
* Store rating

The store page also provides a rating interface that allows visitors to submit a rating from 0 to 5 using half-point increments.

#### Store Ratings

The application maintains store ratings using dedicated database records.

When a visitor submits a rating:

1. The submitted rating is read from the form.
2. The existing rating total and count are retrieved.
3. The aggregate rating is updated.
4. A record is created in the `is_rated` table.
5. The visitor's machine identifier is checked to prevent another rating from the same machine for the same store.

The project uses the machine identifier returned by the system's `getmac` command as part of this mechanism.

#### Product Listings

Products are retrieved dynamically from the `product` table.

Each product can contain:

* Name
* Description
* Current price
* Previous/original price
* Quantity
* Product images
* Store association
* Active/inactive status

The public product page retrieves product images from the `img_product` table and renders the available products.

## Admin Dashboard

The project includes a dedicated administrator dashboard for managing the application's data.

### Admin Authentication

Administrators have a dedicated login and registration flow.

The login process:

* Accepts email and password.
* Hashes the submitted password using MD5.
* Looks up administrator records in MySQL.
* Checks the administrator status.
* Stores the administrator ID in a cookie after successful authentication.
* Redirects authenticated administrators to the dashboard.

### Product Management

Administrators can:

* View products.
* Add products.
* Edit products.
* Delete products.
* Assign products to stores.
* Set current and previous prices.
* Set available quantity.
* Set product status.
* Upload multiple product images.

When creating a product, the application inserts the product into the `product` table and stores uploaded image paths in the `img_product` table.

### Store Management

Administrators can:

* View stores.
* Add stores.
* Edit stores.
* Delete stores.
* Assign stores to categories.
* Upload store images.
* Define store address and phone number.

Store data is stored in the `stores` table and linked to categories through `category_id`.

### Category Management

Administrators can:

* View categories.
* Add categories.
* Edit categories.
* Delete categories.

Categories contain at least a name and description and are used to group stores.

### Administrator Profile

The dashboard includes a profile section where administrator profile information can be viewed and edited.

## Application Structure

```text
e-commerce-website/
│
├── DashBoard/
│   ├── category/
│   │   ├── addcategory.php
│   │   ├── deletecategory.php
│   │   ├── editcategory.php
│   │   └── viewcategory.php
│   │
│   ├── header/
│   │
│   ├── index/
│   │
│   ├── login/
│   │   ├── login.php
│   │   ├── sign up.php
│   │   └── error.php
│   │
│   ├── product/
│   │   ├── addproduct.php
│   │   ├── deleteproduct.php
│   │   ├── editproduct.php
│   │   └── viewproduct.php
│   │
│   ├── profile/
│   │   ├── profile.php
│   │   └── editprofile.php
│   │
│   └── store/
│       ├── addstore.php
│       ├── deletestore.php
│       ├── editstore.php
│       └── viewstore.php
│
├── The Website/
│   ├── product/
│   │   ├── css1/
│   │   ├── fonts1/
│   │   ├── js/
│   │   └── viewproduct.php
│   │
│   ├── store/
│   │   ├── store.php
│   │   └── style.css
│   │
│   ├── view store/
│   │   ├── css/
│   │   ├── images/
│   │   ├── js/
│   │   └── viewstore.php
│   │
│   └── website/
│       └── The website.php
│
├── upload/
├── boots.php
├── connection.php
├── script.php
└── star1.png
```

The repository currently contains separate directories for the public website and the administration dashboard.

## Database

The application connects directly to a MySQL database using `mysqli`.

The current connection file expects a local MySQL server and a database named:

```text
store1
```

The connection configuration currently uses:

```text
Host: localhost
Username: root
Password: empty
Database: store1
```

The repository also contains a locally configured project URL used when constructing uploaded-image paths.

### Main Database Entities

Based on the queries used throughout the application, the project works with tables such as:

```text
admin
category
stores
product
img_product
rate
is_rated
```

These tables represent the main relationships between administrators, categories, stores, products, product images, and store ratings.

## Entity Relationships

The main data relationships can be represented as:

```text
Category
   │
   └──< Stores
           │
           └──< Products
                    │
                    └──< Product Images

Stores
   │
   └── Rating Statistics
          │
          └──< Individual Ratings
```

A store belongs to a category, while products belong to stores. Product images are stored separately and linked through the product ID. Store ratings are aggregated through the `rate` table and individual rating records are stored separately.

## Technology Stack

### Backend

* PHP
* MySQL
* MySQLi

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap
* jQuery
* Font Awesome

### UI / Plugins

The public pages use several Bootstrap-based components and frontend plugins, including:

* Bootstrap
* Bootstrap Star Rating
* Owl Carousel
* Fancybox
* W3.CSS
* Font Awesome

## File Uploads

The application supports image uploads for:

* Stores
* Products

Uploaded files are renamed using a timestamp/random value and placed inside the project's `upload/` directory. Product image paths are then stored in the `img_product` table, while store image paths are stored with the store record.

## Application Flow

### Public User Flow

```text
Home
 │
 └── Categories
       │
       └── Select Category
              │
              ├── Search Stores
              │
              └── Select Store
                     │
                     ├── Store Information
                     ├── Contact Information
                     ├── Products
                     └── Rate Store
```

### Admin Flow

```text
Admin Login
    │
    ▼
Dashboard
    │
    ├── Products
    │    ├── Add
    │    ├── Edit
    │    ├── Delete
    │    └── View
    │
    ├── Stores
    │    ├── Add
    │    ├── Edit
    │    ├── Delete
    │    └── View
    │
    ├── Categories
    │    ├── Add
    │    ├── Edit
    │    ├── Delete
    │    └── View
    │
    └── Profile
```

The CRUD operations are implemented through dedicated PHP pages inside the dashboard.

## Getting Started

### Requirements

To run the project locally, you need:

* PHP
* Apache or another PHP-compatible web server
* MySQL
* A browser
* A local development environment such as XAMPP

### Installation

1. Clone the repository:

```bash
git clone https://github.com/OmarSeyam/e-commerce-website.git
```

2. Place the project inside your web server directory.

For XAMPP, for example:

```text
htdocs/e-commerce-website
```

3. Start Apache and MySQL.

4. Create a MySQL database named:

```text
store1
```

5. Import/create the required database tables:

```text
admin
category
stores
product
img_product
rate
is_rated
```

6. Review `connection.php` and update the database credentials and project URL for your environment.

7. Make sure the `upload/` directory exists and is writable by PHP.

8. Open the application through your local web server.

## Configuration

The main database configuration is located in:

```text
connection.php
```

Example:

```php
$connection = mysqli_connect(
    'localhost',
    'root',
    '',
    'store1'
);
```

The project URL is also defined there and should be updated when deploying the application under a different local or production path.

## Security Notes

This project was built as a learning-oriented PHP/MySQL application and should not be deployed directly to production without security improvements.

Areas that should be improved include:

* Replace MD5 password hashing with `password_hash()` and `password_verify()`.
* Use prepared statements instead of concatenating SQL queries.
* Validate and sanitize all user input.
* Validate uploaded file types and sizes.
* Protect admin routes with proper server-side authentication and authorization.
* Replace cookie-only administrator state with a secure session-based authentication system.
* Add CSRF protection to state-changing forms.
* Avoid storing or relying on machine MAC addresses for user identification.
* Protect database credentials through environment configuration.

For example, the current administrator login hashes passwords using MD5 and stores the administrator ID in a cookie.

## Architecture

The project follows a simple server-rendered PHP architecture:

```text
Browser
   │
   ▼
PHP Pages
   │
   ├── HTML / CSS / JavaScript
   │
   ▼
MySQL Database
   │
   └── Uploaded Images
```

The public website and administrator dashboard are separated into different directory structures, while shared database access is provided through the root-level PHP configuration files.

## Project Status

This project is a **learning-oriented full-stack PHP/MySQL web application** demonstrating:

* Server-side PHP development
* MySQL database integration
* CRUD operations
* File uploads
* Relational data modeling
* Admin dashboard development
* Dynamic server-rendered pages
* Search and filtering
* Store rating functionality
* Product and store management

The repository currently contains one commit and no explicit README, description, or license.

## Future Improvements

A modernized version of the project could include:

* MVC architecture
* PDO or a modern database abstraction layer
* Prepared statements throughout the application
* Session-based authentication
* Secure password hashing
* Role-based authorization
* REST API endpoints
* Better database normalization and indexing
* Pagination for products and stores
* Advanced search and filtering
* Shopping cart functionality
* Order management
* Checkout and payment integration
* Customer accounts
* Wishlist functionality
* Product reviews
* Responsive modern UI
* Environment-based configuration
* Automated tests
* Docker-based development setup

## Author

**Omar Seyam**

GitHub: https://github.com/OmarSeyam

## License

No explicit open-source license is currently included in the repository.

---

Built with PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap.
