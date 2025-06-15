# Library Management System

This is a library management system built with the Laravel framework. It provides functionalities for managing books, users, and book loans with distinct roles for administrators and clients.

## Features

- User authentication (login, registration, logout)
- Admin dashboard with statistics on users, books, and loans
- Book management (CRUD operations)
- Loan management (CRUD operations, book return handling)
- User management (CRUD operations with role assignment)
- Client dashboard showing available books and current loans
- Book borrowing functionality for clients

## Installation

### Requirements

- PHP 8.2 or higher
- Composer
- Laravel Framework 12.x
- A database supported by Laravel (e.g., MySQL, SQLite)

### Steps

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd keepbook
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy the example environment file and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your database settings in the `.env` file.

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. (Optional) Seed the database with initial data:
   ```bash
   php artisan db:seed
   ```

8. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

- Access the application in your browser at `http://localhost:8000`.
- Use the login and registration pages to authenticate.
- Admin users can manage books, loans, and users via the admin dashboard (`/admin/dashboard`).
- Client users can view available books and borrow them via the client dashboard (`/client/dashboard`).

## License

This project is licensed under the MIT License.
