# ♻️ RecyTech Platform

## Overview

RecyTech is a web-based platform developed to promote environmental sustainability and encourage recycling activities. The platform allows users to schedule recyclable waste collections, support environmental organizations through donations, purchase eco-friendly products, and participate in community recycling initiatives.

The project follows an MVC architecture and includes both a user-facing interface and an administrative dashboard for managing platform operations.

---

## Features

### User Module

* User registration and authentication
* Email verification
* Profile management
* Password recovery

### Recycling Management

* Schedule recycling collections
* Manage recyclable item categories
* Track collection requests

### Donation System

* Donate to environmental organizations
* Manage donation records
* Organization management

### E-Commerce Module

* Browse eco-friendly products
* Shopping cart management
* Order processing
* Checkout functionality

### Payment Integration

* Stripe payment gateway integration

### Administration Dashboard

* User management
* Product management
* Donation management
* Recycling schedule management
* Statistics and reporting

---

## Technologies Used

### Backend

* PHP
* MySQL

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap

### Additional Tools

* PHPMailer
* Stripe API
* Chart.js

---

## Project Architecture

```text
Admin/
Controller/
Model/
Views/
config.php
connect.php
```

The project follows the MVC (Model-View-Controller) design pattern to ensure maintainability and separation of concerns.

---

## Installation

### Prerequisites

* PHP 8+
* MySQL / MariaDB
* XAMPP, WAMP, or Laragon

### Setup

1. Clone the repository

```bash
git clone https://github.com/your-username/recytech-platform.git
```

2. Import the database

* Open phpMyAdmin
* Create a new database
* Import the provided SQL file

3. Configure database connection

Update:

```php
config.php
connect.php
```

with your database credentials.

4. Launch the application

Place the project inside your web server directory and access it through:

```text
http://localhost/RecyTech
```

---

## Screenshots

Add screenshots of:

* Home Page
* Recycling Schedule
* Donation System
* Product Marketplace
* Admin Dashboard

---

## Learning Outcomes

This project strengthened skills in:

* PHP Development
* MVC Architecture
* Database Design
* CRUD Operations
* Payment Integration
* User Authentication
* Web Application Development

---

## Author

**Amir Bargougui**

AI & Data Engineering Student

---

## License

This project was developed for educational and academic purposes.
