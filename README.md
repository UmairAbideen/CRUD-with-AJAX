🌐 Laravel 10 AJAX CRUD with jQuery & Bootstrap
This repository demonstrates a simple AJAX-based CRUD system using Laravel 10, jQuery, and Bootstrap. Users can be created, listed, edited, and deleted without any page reloads — providing a smooth, modern user experience.

🚀 Features

🔄 Full AJAX CRUD operations (Create, Read, Update, Delete)
🧾 Bootstrap modal form for adding/editing users
⚡ jQuery for real-time DOM updates and AJAX calls
📊 Dynamic table updates without reloads
🔔 User feedback with alert messages (success/error)

🛠️ Tech Stack

Tech	    Description
Framework	Laravel 10
Frontend	Bootstrap + jQuery
AJAX	    jQuery AJAX
Database	MySQL

📁 Folder Structure
Path	Description
routes/web.php	Laravel route definitions
app/Http/Controllers/UserController.php	Controller logic
resources/views	Blade view files (modals + table)

💡 Concept
🧠 AJAX 
AJAX allows users to interact with the application without full page reloads, leading to faster, smoother experiences.
🧰 jQuery + Bootstrap
This combination enables quick setup of modals, buttons, and forms with minimal effort.

🔒 Laravel Backend
Data operations are securely handled using routes, controllers, and CSRF tokens to ensure safe AJAX calls.

📦 Artisan Commands Used
php artisan make:controller UserController
php artisan make:model User -m
php artisan migrate
