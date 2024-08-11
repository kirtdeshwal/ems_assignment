# Laravel Project Setup Guide

This document provides instructions on how to set up and run the Laravel project. Follow the steps below to get the project up and running.

## Prerequisites

Before setting up the project, make sure you have the following installed on your system:

- PHP >= 8.2
- Composer
- MySQL or any other compatible database
- Laravel CLI

## Setup Instructions

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/kirtdeshwal/ems_assignment.git
cd ems_assignment
```
### 2. Configure the Environment

Copy the .env.example file to .env and configure your database settings:

```bash
cp .env.example .env
```
### 3. Install Dependencies

Install all required PHP packages using Composer:

```bash
composer install
```

### 4. Generate Application Key

Generate the application key to secure your application:

```bash
php artisan key:generate
```

### 5. Run Migrations

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### 6. Seed the Database

Seed the database with initial data:

```bash
php artisan db:seed
```

### 7. Serve the Application

You can now serve the application locally using Laravel's built-in server:

```bash
php artisan serve
```

### 7. Access the Finance Dashboard

After completing the setup, you can access the finance dashboard by visiting:

Use the following credentials to log in:

Email: financeuser@gmail.com
Password: welcome@123