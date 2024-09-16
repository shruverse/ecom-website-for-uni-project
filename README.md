# PHP Website Project

This project was created in my 2nd year as a part of my web development learning. It’s a fully functional website developed using **WAMPServer**, **Bootstrap**, **HTML**, **CSS**, and **PHP**. The website includes both an **admin** and a **client** side, with features like **form validation** and a **payment gateway**.

## Features

- **Admin Side:**
  - Manage users and products.
  - View and track orders.
  - Generate reports.

- **Client Side:**
  - User registration and login with validation.
  - Browse products and add them to the cart.
  - Place orders and make payments.

- **Form Validation:**
  - Client-side and server-side validation for all forms.

- **Payment Gateway Integration:**
  - Users can securely make payments for their orders.

## Technologies Used

- **WAMPServer:** Local server environment for developing and testing.
- **PHP:** Backend scripting language to handle form submissions, session management, and database operations.
- **Bootstrap:** For responsive, mobile-first UI design.
- **HTML5/CSS3:** Markup and styling for building user interfaces.
- **MySQL:** Database to store user data, product info, and transactions.

## Installation and Setup

1. Download and install [WAMPServer](http://www.wampserver.com/en/).
2. Clone this repository:
   ```bash
   git clone https://github.com/shruverse/ecom-website-for-uni-project.git
3. Move the project to your WAMP www directory.
   ```bash
   mv your-repo-name C:/wamp/www/your-project
4. Create a new MySQL database in phpMyAdmin and import the database.sql file provided in the project.
5. Configure your database connection in config.php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "your_database_name";
6. Start WAMPServer and navigate to http://localhost/your-project in your browser.

## Usage
- Admin Login: Use the admin credentials to access the admin dashboard for managing users, products, and orders.
- Client Registration and Payment: Register as a new user, browse products, and make payments through the integrated gateway.

## License
This project is available for learning and personal use. Feel free to explore and improve upon it. However, I take no responsibility if:
- Students copy this code for academic submissions.
- Someone uses this website to charge others for services.
