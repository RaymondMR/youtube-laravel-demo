# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

This is a Laravel 9 YouTube demo application - a simple blog platform with user authentication and post management. The application demonstrates basic Laravel concepts including MVC architecture, Eloquent relationships, authentication, and frontend integration with Vite and TailwindCSS.

## Architecture & Key Components

### Core Application Structure
- **Models**: `User` and `Post` with a one-to-many relationship (users can have multiple posts)
- **Controllers**: 
  - `UserController`: Handles authentication (register, login, logout)
  - `PostController`: Manages CRUD operations for posts (create, read, update, delete)
- **Authentication**: Uses Laravel's built-in session-based authentication
- **Database**: Uses Eloquent ORM with migrations for users and posts tables
- **Frontend**: Blade templates with TailwindCSS for styling, Vite for asset building

### Key Relationships & Business Logic
- Posts belong to users via `user_id` foreign key
- Users can only edit/delete their own posts (ownership validation in controllers)
- Custom relationship method: `User::usersCoolPosts()` returns user's posts
- Input sanitization: All post content is sanitized with `strip_tags()`

### Frontend Architecture
- **Views**: Located in `resources/views/` (home.blade.php, register.blade.php, edit-post.blade.php)
- **Assets**: Vite configuration for CSS/JS bundling
- **Styling**: TailwindCSS with content purging configured for Blade templates
- **JavaScript**: Basic Axios and Lodash setup via npm

## Development Commands

### PHP/Laravel Commands
```bash
# Install PHP dependencies
composer install

# Generate application key (required for new installations)
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed the database
php artisan db:seed

# Start development server
php artisan serve

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate new migration
php artisan make:migration create_table_name

# Generate new controller
php artisan make:controller ControllerName

# Generate new model
php artisan make:model ModelName

# Run interactive tinker shell
php artisan tinker
```

### Frontend Commands
```bash
# Install npm dependencies
npm install

# Start Vite development server (hot reload)
npm run dev

# Build for production
npm run build
```

### Testing Commands
```bash
# Recommended: run tests via Artisan (auto-loads Laravel config)
php artisan test

# Run a single suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run a single file or directory
php artisan test tests/Feature/ExampleTest.php

# Run a specific test method (supports patterns)
php artisan test --filter=method_name

# Generate HTML coverage (requires Xdebug or PCOV installed)
php artisan test --coverage-html coverage

# Direct PHPUnit invocation (Windows path example)
.\vendor\bin\phpunit
```

### Code Quality Commands
```bash
# Format code with Laravel Pint
php -d detect_unicode=0 .\vendor\bin\pint
# Or (Unix-like path)
./vendor/bin/pint

# Check formatting without fixing
./vendor/bin/pint --test
```

### Local Dev Tips (Windows / PowerShell)
- Run the PHP server and Vite in separate terminals:
  - Terminal 1: `php artisan serve`
  - Terminal 2: `npm run dev`
- Some vendor binaries on Windows use backslashes: `.\vendor\bin\phpunit`, `.\vendor\bin\pint`.
- If tests fail to discover due to path issues, prefer `php artisan test`.

## Database Schema

### Users Table
- `id` (primary key)
- `name` (unique, 3-10 characters)
- `email` (unique)
- `password` (hashed)
- `email_verified_at`
- `remember_token`
- `created_at`, `updated_at`

### Posts Table  
- `id` (primary key)
- `title` (string)
- `body` (long text)
- `user_id` (foreign key to users)
- `created_at`, `updated_at`

## Route Structure

### Web Routes (`routes/web.php`)
- `GET /` - Homepage (shows user's posts if authenticated)
- `GET /register` - Registration form
- `POST /register` - Process registration
- `POST /login` - Process login
- `POST /logout` - Process logout
- `POST /create-post` - Create new post
- `GET /edit-post/{post}` - Show edit form
- `PUT /edit-post/{post}` - Update post
- `DELETE /delete-post/{post}` - Delete post

### API Routes (`routes/api.php`)
- `GET /api/user` - Get authenticated user (Sanctum middleware)

## Environment Setup

### Required Environment Variables
- `APP_KEY` - Application encryption key
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` - Database configuration
- Standard Laravel environment variables in `.env`

### Development Setup
1. Copy `.env.example` to `.env`
2. Run `composer install`
3. Run `npm install`
4. Run `php artisan key:generate`
5. Configure database in `.env`
6. Run `php artisan migrate`
7. Start servers: `php artisan serve` and `npm run dev`

## Key Laravel Concepts Demonstrated

- **Eloquent Relationships**: User hasMany Posts, Post belongsTo User
- **Route Model Binding**: Controllers automatically resolve Post models from route parameters
- **Request Validation**: Form validation with custom rules and unique constraints
- **Authentication Guards**: Session-based authentication with middleware
- **Mass Assignment Protection**: Fillable attributes defined in models
- **Blade Templating**: Server-side rendering with Blade templates
- **Asset Compilation**: Modern asset pipeline with Vite replacing Laravel Mix

## Security Features Implemented

- CSRF protection on all forms
- Input sanitization with `strip_tags()`
- Password hashing with bcrypt
- Ownership validation for post operations
- Mass assignment protection via fillable attributes