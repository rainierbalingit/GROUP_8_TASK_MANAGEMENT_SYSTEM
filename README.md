# Task Management System

This is a PHP-based task management system built with MySQL, HTML, CSS, and JavaScript. It allows users to manage tasks, upload submissions, and admins to grade them. The system emphasizes security, responsiveness, and role-based access.

## 1. Setup and Database

### 1.1 Setup
- **XAMPP/Server Installed**: Requires XAMPP or similar server with Apache and MySQL. Place the project in `htdocs/task_management_system`.
- **Database Created**: Create a database named `task_manager_db` (configured in `config.php`).
- **Points**: 5

### 1.2 Users Table
- **Creation**: The `users` table includes fields for `username`, `password` (hashed), `role` (Admin/Regular User), `email`, and `created_at`.
- **Code Reference**: Defined in `includes/db.php`.
- **Points**: 5

### 1.3 Tasks Table
- **Creation**: The `tasks` table includes fields for `title`, `description`, `deadline`, `priority`, `status`, `assigned_to` (User ID), `created_by`, and `project_id`.
- **Code Reference**: Defined in `includes/db.php`.
- **Points**: 5

### 1.4 Projects Table
- **Creation**: The `projects` table (optional but implemented) includes `name`, `description`, `created_by`, and `created_at`, linked to tasks via `project_id`.
- **Code Reference**: Defined in `includes/db.php`.
- **Points**: 5

### 1.5 SQL Queries
- **Implementation**: Uses PDO for SELECT, INSERT, UPDATE, DELETE queries (e.g., in `user/tasks.php` for submissions, `admin/grade_tasks.php` for grading).
- **Example**: `INSERT INTO submissions (task_id, user_id, file_path) VALUES (?, ?, ?)` in `user/tasks.php`.
- **Points**: 5

## 2. Frontend Structure

### 1.6 HTML Structure
- **Organization**: Logical sections include header (`includes/header.php`), main content (e.g., task lists in `user/tasks.php`), and footer (`includes/footer.php`).
- **Points**: 5

### 1.7 Forms and Tables
- **Forms**: Login (`login.php`), task creation (`admin/create_task.php`), task editing (status updates in `user/tasks.php`).
- **Tables/Lists**: Task lists displayed in cards (e.g., in `user/tasks.php` and `admin/grade_tasks.php`).
- **Points**: 5

### 1.8 Mobile-First CSS
- **Design**: CSS in `css/style.css` starts with mobile styles, using responsive units.
- **Points**: 5

### 1.9 Layout Techniques
- **Flexbox/Grid**: Uses Flexbox for task cards and dashboard layout (e.g., `.card` in `css/style.css`).
- **Points**: 5

### 1.10 Responsiveness
- **Media Queries**: CSS includes media queries for different screen sizes (e.g., in `css/style.css` for tablets/desktops).
- **Points**: 5

## 3. Backend and Security

### 1.11 User Authentication
- **Login/Logout**: Uses PHP sessions (`session_start()`) in `login.php` and `logout.php`.
- **Points**: 5

### 1.12 Password Security
- **Hashing**: Passwords hashed with `password_hash()` during registration (`register.php`).
- **Points**: 5

### 1.13 Input Sanitization
- **Validation**: Uses prepared statements and `sanitize()` function (in `includes/functions.php`) for all inputs.
- **Points**: 5

### 1.14 Role-Based Sessions
- **Access Controls**: Session checks enforce Admin (e.g., `admin/manage_users.php`) and User roles (e.g., `user/tasks.php`).
- **Points**: 5

### 1.15 CRUD Operations (PHP)
- **Handling**: PHP scripts process forms for Create (task creation), Read (task lists), Update (status changes via AJAX in `js/script.js`), Delete (implied in admin functions).
- **Points**: 5

### 1.16 File Upload
- **System**: Users upload files to tasks (e.g., in `user/tasks.php`), validated for type/size, stored in `uploads/`.
- **Points**: 5

### 1.17 Error Handling
- **Robustness**: Uses try-catch in `includes/db.php` and custom error messages (e.g., in `user/tasks.php`).
- **Points**: 5

## 4. Key Features

### 1.18 Task Creation
- **Functionality**: Users/Admins create tasks with title, description, deadline, priority (e.g., in `admin/create_task.php`).
- **Points**: 5

### 1.19 Task Assignment
- **Assignment**: Tasks assigned via `assigned_to` field, tracked in database (e.g., in task creation forms).
- **Points**: 5

### 1.20 Progress Tracking
- **Updates**: Users update status (Pending, In Progress, Completed) via dropdown in `user/tasks.php`, saved via AJAX (`update_task_status.php`).
- **Points**: 5

## Installation and Usage
1. Install XAMPP and start Apache/MySQL.
2. Create database `task_manager_db` and run `database.sql`.
3. Place project in `htdocs/task_management_system`.
4. Access via `http://localhost/task_management_system`.
5. Register/Login as user or admin.

## Technologies Used
- PHP (Backend)
- MySQL (Database)
- HTML/CSS/JavaScript (Frontend)
- PDO (Database Interaction)

This README outlines the project's compliance with the rubric for easy presentation.
