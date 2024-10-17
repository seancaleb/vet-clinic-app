<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Veterinary Clinic Appointment System

A Laravel-based appointment booking system for veterinary clinics that allows users to book, manage, and cancel pet appointments. Features include user authentication, appointment management, email notifications, and a responsive front-end built with Tailwind CSS.

## Features

-   User registration and login with email verification
-   Appointment booking, editing, and cancellation
-   Admin panel for appointment and user management
-   Email notifications for appointment confirmations and reminders
-   Responsive user interfaces

## Installation

> Note: Make sure PHP is installed on your machine to be able to run this project.

### 1. Clone this repository

```bash
git clone <REPO_URL> <YOUR_PROJECT_NAME>
```

-   Go to project directory `cd <YOUR_PROJECT_NAME>`
-   Run `npm install`

### 2. Setting up the project

-   Create a database (this project uses **mysql**)
-   Create a **.env** file and copy the contents from **.env.example**
-   Run the command below to generate a new app key

```
php artisan key:generate
```

### 3. Configuring the database (migration and data scaffolding)

-   Initialize the following values in your **.env** file to be able to connect to your database

```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

-   Run migrations and seed data in the database

```
php artisan migrate:fresh --seed
```

### 4. Set up Gmail SMTP

-   Generate an app password from your Google account

> You can follow the instructions [here](https://knowledge.workspace.google.com/kb/how-to-create-app-passwords-000009237) to generate an app password from Google that can be used to integrate Gmail in this application

-   Initialize the following values in your **.env** file to be able to integrate Gmail SMTP

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=<YOUR_MAIL_USERNAME> // ex. vethub.app@gmail.com
MAIL_PASSWORD=<YOUR_MAIL_APP_PASSWORD>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="<YOUR_MAIL_ADDRESS>" // ex. vethub.app@gmail.com
MAIL_FROM_NAME="<YOUR_MAIL_NAME>" // ex. VetHub
```

### 5. Run the project locally

-   To run the project locally, run `php artisan serve` and `npm run dev`

## Running tests

### 1. Configuring the testing environment

-   Create a **.env.testing** file and copy the contents from **.env**
-   Modify the following values in your **.env.testing** file to be able to connect to your mirror database for testing

> Note: We'll be using sqlite as the default mirror database for testing

```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=:memory:
```

### 2. Run tests

-   To run tests, run `php artisan test`
