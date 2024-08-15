# Bookshelf API

Bookshelf API is a RESTful service built with Laravel 11 for managing a collection of books, including CRUD operations.

## Prerequisites

Before you get started, make sure you have the following software installed:

- [PHP](https://www.php.net/) (version 8.0 or higher)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) (or any other supported database)

## Installation

1. Clone this repository to your computer:

   `git clone https://github.com/abdulaziz27/bookshelf-api.git`
   
   `cd bookshelf-api`

2. Install PHP dependencies:

   `composer install`

3. Create a copy of the example environment file:

   `cp .env.example .env`

4. Generate a new application key:

   `php artisan key:generate`

5. Configure your `.env` file with your database credentials.

6. Run migrations to create the necessary tables:

   `php artisan migrate`


## Running the Application

Start the Laravel development server:

   `php artisan serve`

   The application will be accessible at [http://localhost:8000](http://localhost:8000).


   
