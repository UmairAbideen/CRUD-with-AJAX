# Laravel 10 AJAX CRUD with jQuery & Bootstrap
This repository demonstrates a simple AJAX-based CRUD system using Laravel 10, jQuery, and Bootstrap. Users can be created, listed, edited, and deleted without page reloads, offering a seamless user experience.

🚀 Features

Full AJAX CRUD operations (Create, Read, Update, Delete)
Bootstrap modal form for adding/editing users
jQuery for dynamic DOM updates and API calls
Real-time table updates
Alert messages for success and errors

🛠️ Tech Stack

Tech	Description
Framework	Laravel 10
Frontend	Bootstrap 3 + jQuery
AJAX	    jQuery AJAX
Database	MySQL

📁 Folder Structure

routes/web.php — Laravel route definitions
app/Http/Controllers/UserController.php — Controller logic
resources/views — Blade view files (modals + table)

💡 Concept

AJAX
By using AJAX, users interact with the app without page reloads, making the experience faster and smoother.

jQuery + Bootstrap = Rapid Frontend Development
Classic combo that allows quick development with clean modals, buttons, and alerts.

Laravel Backend
All data operations are securely handled via Laravel routes, controllers, and CSRF protection.

📦 Artisan Commands Used
php artisan make:controller UserController
php artisan make:model User -m
php artisan migrate
