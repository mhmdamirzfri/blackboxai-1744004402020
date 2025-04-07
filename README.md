
Built by https://www.blackbox.ai

---

```markdown
# RentalSync

RentalSync is a web-based rental management application designed to simplify the management of shared living spaces for landlords and tenants. It provides functionalities such as user registration, login, tenant management, payment tracking, chores management, maintenance requests, and messaging.

## Project Overview

This project is structured in PHP and uses a MySQL database to store user and rental management data. The main features include user authentication, role-based access (landlords and tenants), and a dashboard for each role to manage relevant tasks and information.

## Installation

To set up the project locally, follow these instructions:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/rentalsync.git
   cd rentalsync
   ```

2. **Create a database**:
   Access your MySQL server and run the following command:
   ```sql
   CREATE DATABASE rental_app;
   ```

3. **Setup your database**:
   Make sure to configure the database connection settings in `db_connect.php`.
   - Set the `$username` and `$password` variables accordingly.

4. **Run the database setup**:
   ```bash
   php init_db.php
   ```
   This script creates tables and adds sample users.

5. **Start a local server** (e.g., using XAMPP, MAMP, or built-in PHP server):
   ```bash
   php -S localhost:8000
   ```

6. **Access the application**:
   Open your web browser and navigate to `http://localhost:8000`.

## Usage

1. **Login**: Use the login page (accessed at `index.php`) to log in using the sample accounts:
   - **Tenant**: 
     - Email: `tenant@example.com`
     - Password: `tenant123`
   - **Landlord**: 
     - Email: `landlord@example.com`
     - Password: `landlord123`
  
2. **Manage your dashboard**: After logging in, you will be directed to the appropriate dashboard (tenant or landlord) where you can manage payments, chores, maintenance requests, and communicate with landlords or tenants.

## Features

- User authentication and role management (tenant and landlord)
- Dashboard for tenants with payment tracking, chores, maintenance request forms, and messaging.
- Dashboard for landlords with an overview of tenants, payments, maintenance requests, and messaging.
- Unit and property management
- Responsive UI built with Tailwind CSS

## Dependencies

Ensure you have the following extensions installed on your PHP environment:

- PDO (for database interaction)
- OpenSSL (for password hashing)
  
No other specific packages are required; the application primarily relies on built-in PHP functionalities.

## Project Structure

The project consists of the following files and directories:

```
/rentalsync
├── db_connect.php           # Database connection file
├── db_setup.php             # Setup script for creating database and tables
├── functions.php            # Helper functions for authentication and session management
├── init_db.php              # Initializes the database and inserts test data
├── index.php                # Login page
├── register.php             # Registration page for new users
├── logout.php               # Logout script
├── home.php                 # Redirects based on user session
├── dashboard_tenant.php     # Tenant dashboard interface
├── dashboard_landlord.php   # Landlord dashboard interface
```

## Conclusion

RentalSync aims to streamline the management of rental spaces by providing an easy-to-use interface for landlords and tenants alike. By following the installation and usage guidelines, you can set up your own instance of RentalSync to manage your living arrangements effectively.
```