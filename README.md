# Basic Registration and Password Reset Form

A simple PHP-based registration and password reset system using MySQL. This project demonstrates how to implement user registration, secure password updates, and form validation using plain PHP and MySQL.

## 📚 Features

- User Registration with hashed passwords.
- Password Reset via email verification.
- Password hashing using `password_hash()` for security.
- Bootstrap CSS for clean UI design.
- Success confirmation pages for user feedback.

## 📂 Project Structure

Basic-registeration-form/
├── index.html # Login Page
├── reset.html # Password Reset (Email Input)
├── success_update.html # Success Confirmation Page
├── update_password.php # PHP Logic for Password Reset & Update
├── connect.php
├── reg.html
├── success_login.html
└── css/
└── bootstrap.css # CSS Styling

## ⚙️ Setup Instructions

1. Clone this repository:

```bash
git clone https://github.com/Amogh017/Basic-registeration-form.git
Import the regform database in your MySQL server and create a reg table with at least the following fields:

email (VARCHAR, PRIMARY KEY or UNIQUE)

password (VARCHAR)

Update the database connection details in update_password.php if needed:
$conn = new mysqli('localhost', 'root', '', 'regform');

Run the project using XAMPP or any local web server.

✅ Usage Flow
User visits reset.html and submits their registered email.

The system prompts for a new password.

After submitting, the password is updated and the user is redirected to a success page.

The user can return to the login page via a button.

📖 License
This project is open-source and free to use for learning and development purposes.

