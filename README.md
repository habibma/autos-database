﻿# Automobile Database Management System

## Overview
This project is a simple **Automobile Database Management System** built using **PHP and MySQL** with **PDO** for secure database interactions. The purpose of this project is to learn and practice **user authentication, form validation, and database operations** while following best security practices.

This project was developed as part of the **"Building Database Applications in PHP"** course by **Dr. Chuck** on **Coursera** and was an assignment in the course.

## Features
- **User Authentication**: Secure login system using hashed passwords.
- **CRUD Operations**: Add and view automobile records.
- **Form Validation**: Ensures proper user input with error handling.
- **SQL Injection Prevention**: Uses PDO prepared statements for database queries.
- **HTML Injection Protection**: Sanitizes user input with `htmlentities()`.
- **Deployed on InfinityFree**: Hosted on a free PHP hosting platform.
- **Tailwind CSS**: Used for styling and learning modern CSS utility-first framework.

## Technologies Used
- **PHP** (for server-side scripting)
- **PDO (PHP Data Objects)** (for secure database access)
- **MySQL** (for data storage)
- **Tailwind CSS** (for styling and responsive design)
- **HTML & CSS** (for the frontend)
- **InfinityFree** (for deployment)
- **Git & GitHub** (for version control)

## What I Learned
Throughout this project, I gained hands-on experience with:  
✔ Using **PHP PDO** for secure database interactions.  
✔ Managing a **MySQL database** on **InfinityFree**.  
✔ Preventing **SQL Injection** using **prepared statements**.  
✔ Sanitizing user input to prevent **HTML Injection**.  
✔ Implementing **login authentication** with hashed passwords.  
✔ Deploying a **PHP project** on a live server.  
✔ Debugging errors using `error_log()` and troubleshooting permissions.  
✔ Working with **Tailwind CSS** to design and improve UI styling efficiently.

## Setup & Installation
1. **Clone the repository:**  
   ```bash
   git clone https://github.com/your-username/your-repository.git
   ```
2. **Upload the files to InfinityFree:** Use the **File Manager** or FTP.
3. **Create a MySQL Database on InfinityFree** and update `pdo.php` with your credentials:
   ```php
   <?php
   $host = 'sqlXXX.epizy.com';
   $dbname = 'epiz_12345678_mydb';
   $username = 'epiz_12345678';
   $password = 'your_password';
   $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   ?>
   ```
4. **Visit the website** and test the login system and database interactions.

## Live Website
You can access the live version of the project here: 
[Live Website URL](https://autos-database.ct.ws/login.php)

## Future Improvements
- Add user registration and role-based authentication.
- Implement an update and delete feature for automobile records.
- Improve UI with a better frontend framework.
- Enhance responsiveness and styling with **advanced Tailwind CSS techniques**.

## Author
Habib Mote

---
This project was created as a learning exercise in PHP, database management, and modern frontend styling with Tailwind CSS.
