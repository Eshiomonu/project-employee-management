# Projects & Employee Management System
<p>A Laravel full-stack system to manage projects and employees. Includes authentication, authorization, employee assignment, soft deletes, queues, and unit tests.</p>

## Features
-- User authentication (register, login, logout)

-- CRUD for Projects

-- Paginated listing

-- Filter by status



## Installation
Clone the repository


composer install
npm install
npm run dev

Copy .env.example to .env and update database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_manager
DB_USERNAME=root
DB_PASSWORD=
Generate app key:

php artisan key:generate
Database Migration
Run migrations:

php artisan migrate
Creates users, projects, employees tables

Soft deletes enabled for projects and employees

## Running the Application
php artisan serve
Visit http://127.0.0.1:8000



## Unit Tests


## Run tests:
php artisan test


## Notes
Ownership enforced through policies, not inline checks

Soft deletes allow safe recovery

Queue jobs demonstrate background processing

FormRequests ensure validation and security

Views display projects and employees with pagination, filters, and counts

Unit tests ensure security, authorization, and job dispatch correctness