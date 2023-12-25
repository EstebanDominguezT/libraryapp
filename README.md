# Technical Challenge: Building a Library Management System

The library management system is a platform created based on the requirements of the challenge sent last Friday. This system enables end-users to perform essential tasks such as book registration, loan management, and returns. Furthermore, it provides end-users with the ability to self-manage the loan of a specific book.
## Project Setup

### 1. Duplicate the `.env.example` File

Duplicate the `.env.example` file and adjust the configurations as needed for your environment. You can copy it and name it `.env`, for example.

### 2. Install Dependencies with Composer

Run the following command to install PHP dependencies: <br>

`composer install`

### 3. Generate Application Key
Run the following command to generate the application key: <br>

`php artisan key:generate`

### 4. Generate JWT Secret Key
Run the following command to generate the secret key required for JWT: <br>

`php artisan jwt:secret`

**Note: This step will invalidate all existing tokens. Are you sure you want to override the secret key? (yes/no) [no]: (y)**

### 5. Install Dependencies with npm
Run the following command to install npm dependencies:

`npm install`

## Migration and Seeding

### 6. Run Migrations and Seeds
**If the database does not exist, the system will ask if you want to create it. Answer "yes (y)" to continue.**

`php artisan migrate --seed`

## Running the Project
### 7. Run the Project

In one terminal, run the following command to compile assets:

`npm run dev`

In another tab, run the following command to start the server:

`php artisan serve`

## Credentials
### Admin Credentials:

Email: admin@admin.com <br>
Password: admin1234

### Member Credentials:

Email: member@member.com <br>
Password: member1234

The application will be available at http://localhost:8000 by default.

# Postman Collection for API Testing
This repository includes a collection of Postman that you can use to test your requested API capabilities. As well as a link to review its documentation
#### URL: https://documenter.getpostman.com/view/9688314/2s9Ykt4duJ