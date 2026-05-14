Leave Request System

A mini leave request management system built with Laravel and MySQL, 
developed as part of the NaiBnB IT Internship Stage 2 Technical Assessment.

Features
- Submit leave requests (name, start date, end date, reason)
- Server-side validation with clear error messages
- Approve / Reject requests with status badges
- Filter requests by status (All / Pending / Approved / Rejected)
- Feature tests covering validation logic

Requirements
- PHP 7.4+
- Composer
- MySQL
- WAMP / XAMPP or any local server

## Tech Stack
- **Framework:** Laravel 8 (PHP)
- **Database:** MySQL with Eloquent ORM
- **Frontend:** Blade templating engine with custom CSS
- **Testing:** PHPUnit feature tests
- **Version Control:** Git with feature branches

## How It Works
- Leave requests are stored in MySQL via Laravel's Eloquent ORM
- Server-side validation uses Laravel's built-in `validate()` with 
  `after_or_equal:start_date` rule for date checking
- Approve/Reject actions use a PATCH route with route model binding
- Status filter uses query strings passed to the controller

Installation

1. Clone the repository:
   git clone https://github.com/VinceyLincey/Leave_Req.git

2. Install dependencies:
   composer install

3. Copy the environment file:
   cp .env.example .env

4. Generate application key:
   php artisan key:generate

5. Create a MySQL database named `leave_req` and update `.env`:
   DB_DATABASE=leave_req
   DB_USERNAME=root
   DB_PASSWORD=

6. Run migrations:
   php artisan migrate

7. Visit:
   http://localhost/Leave_Req/public/leave_requests

Running Tests
    php artisan test

Screenshot
[Leave Request System] Screenshot is in root folder