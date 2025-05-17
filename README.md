# Laravel 12 Setup Instructions

This guide will walk you through the setup process for a Laravel 12 application running on PHP 8.2. Follow these steps to get started with the project.

## Prerequisites

- PHP 8.2 or higher
- Composer (for managing PHP dependencies)
- A database (MySQL, PostgreSQL, etc.)
- Laravel 12
- Node 18

## 1. Clone the Repository
```bash
git clone https://github.com/sowidan1/National-Care.git
```
## 2. Copy the .env file

```bash
cp .env.example .env
```

## Prerequisites
- put variables needed in .env

## 3. Install Dependencies
```bash
composer install
```
## 4. Generate Application Key
```bash
php artisan key:generate
```

## 6. Run Database Migrations
```bash
php artisan migrate:fresh --seed
```

## 7. Run Local Env
```bash
php artisan ser
```

## 8. Run Node For styling
```bash
npm run dev
```

### If you are deploying the application to production, be sure to configure appropriate caching and optimize the application:
```bash
php artisan optimize:clear
