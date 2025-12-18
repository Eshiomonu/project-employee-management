# Projects & Employee Management System

## Set Up
Clone the repository
composer install
npm install
npm run dev

## Environmental Config
Copy .env.example to .env and update database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_manager
DB_USERNAME=root
DB_PASSWORD=
Generate app key:

php artisan key:generate

## How to run migration
php artisan migrate


## Running the Application
php artisan serve
Visit http://127.0.0.1:8000


## Run tests:
php artisan test


## Notes
Ownership enforced through policies, not inline checks

Soft deletes allow safe recovery

