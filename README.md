# Automobile Database Management System (v3)

## Overview
This project is a **web-based Automobile Database Management System** built using **PHP and MySQL** with **PDO** for secure database interactions. The project follows best practices for **authentication, CRUD operations, validation, and security**, implementing the **POST-Redirect-GET** pattern and **flash messages** to improve user experience.

This project was developed as part of the **"Building Database Applications in PHP"** course by **Dr. Chuck** on **Coursera** and was an assignment in the course.

## Features
- **User Authentication**: Secure login system using hashed passwords.
- **CRUD Operations**: Create, Read, Update, and Delete automobile records.
- **Form Validation**: Ensures proper user input with error handling.
- **SQL Injection Prevention**: Uses PDO prepared statements for secure database queries.
- **HTML Injection Protection**: Sanitizes user input with `htmlentities()`.
- **POST-Redirect-GET Pattern**: Prevents form resubmissions and improves navigation.
- **Flash Messages**: Displays success and error messages using sessions.
- **Deployed on InfinityFree**: Hosted on a free PHP hosting platform.
- **Styled with Tailwind CSS**: Experimented with Tailwind for modern UI improvements.

## Technologies Used
- **PHP** (for server-side scripting)
- **PDO (PHP Data Objects)** (for secure database access)
- **MySQL** (for data storage)
- **HTML & Tailwind CSS** (for the frontend styling)
- **InfinityFree** (for deployment)
- **Git & GitHub** (for version control)

## What I Learned
Throughout this project, I gained hands-on experience with:  
✔ Implementing **secure authentication** with session-based login.  
✔ Using **PHP PDO** for safer database interactions.  
✔ Managing a **MySQL database** on **InfinityFree**.  
✔ Preventing **SQL Injection** using **prepared statements**.  
✔ Implementing **flash messages** for better UX.  
✔ Enforcing the **POST-Redirect-GET pattern** to avoid duplicate form submissions.  
✔ Styling with **Tailwind CSS** to enhance the UI.  
✔ Debugging issues using `error_log()` and troubleshooting hosting-related errors.  

## Setup & Installation
1. **Clone the repository:**  
   ```bash
   git clone https://github.com/your-username/your-repository.git
   ```
2. **Upload the files to InfinityFree:** Use the **File Manager** or FTP.
3. **Create a MySQL Database on InfinityFree** and update `pdo.php` with your credentials:
   ```php
   <?php
   $host = '[your_host]';
   $dbname = '[your_database_name]';
   $username = 'user@example.com';
   $password = 'php_123';
   $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   ?>
   ```
4. **Visit the website** and test authentication, CRUD operations, and flash messages.

## Live Website
You can access the live version of the project here:  
[Live Website URL](https://autos-database.ct.ws)

## Future Improvements
- Implement user registration and role-based authentication.
- Improve UI responsiveness and accessibility.
- Add search and filter functionality for automobiles.
- Enhance validation and error handling.
- Implement AJAX for a smoother user experience.

## Author
Habib Mote

---
This project was created as a learning exercise in PHP, MySQL, and web security.