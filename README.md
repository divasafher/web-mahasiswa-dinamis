# WebDev Article Management System

CodeIgniter 3.1.13 application with a REST API, JWT authentication, AdminLTE web login, dashboard, and article CRUD.

## Prerequisites

- PHP 7.4+
- MySQL 5.7+
- Composer
- Apache with `mod_rewrite`

## Installation

1. Place the project under your web root, for example `htdocs/upy`.
2. Run `composer install`.
3. Import `database/schema.sql` into MySQL.
4. Update `application/config/config.php` if your base URL is not `http://localhost/upy/`.
5. Update `application/config/database.php` with your MySQL credentials.
6. Ensure Apache allows `.htaccess` overrides.

## Default Credentials

- Admin: `admin@example.com` / `admin123`
- Editor: `editor@example.com` / `admin123`

## API Endpoints

| Method | Endpoint | Auth | Description |
| --- | --- | --- | --- |
| POST | `/api/auth/login` | No | Login and receive JWT |
| GET | `/api/v1/articles` | No | List articles |
| GET | `/api/v1/articles/{id}` | No | Article detail |
| POST | `/api/v1/articles` | Bearer token | Create article |
| PUT | `/api/v1/articles/{id}` | Bearer token | Update article |
| DELETE | `/api/v1/articles/{id}` | Bearer token, admin | Delete article |

## Folder Structure

- `application/controllers/api`: REST API controllers.
- `application/controllers`: Admin panel controllers.
- `application/models`: User and article data access.
- `application/helpers`: Session auth and JWT helpers.
- `application/views`: AdminLTE views.
- `assets/custom`: Custom CSS and JavaScript.
- `database`: DDL and seed data.
- `postman`: Postman collection.

## Running with XAMPP, MAMP, or Laragon

Start Apache and MySQL, import `database/schema.sql`, then open `http://localhost/upy/login`. If your folder name differs, update `base_url` and the Postman `base_url` variable.
