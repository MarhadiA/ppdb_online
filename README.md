# PPDB Online System

A web-based Student Admission System built with Laravel, PostgreSQL, and Cloudinary to streamline the entire admission process—from student registration and document submission to verification, selection, and announcement publishing.

**Live Demo:**  
https://ppdb.marhadiakbar.com

---

## About The Project

PPDB Online is a web application designed to digitalize the student admission process. The system provides role-based access for administrators, committee members, and applicants while supporting online document uploads, registration verification, quota-based admission selection, and announcement publishing.

This project was developed as a portfolio project to demonstrate full-stack web development skills using the Laravel framework.

---

## Features

### Student

- User Registration and Login
- Student Registration Form
- Upload Required Documents
- Registration Status Tracking
- View Admission Announcement

### Committee

- Verify Student Documents
- Validate Registration Data
- Monitor Applicant Registrations

### Administrator

- Dashboard Analytics
- Manage Students
- Manage Committee Accounts
- Manage Admission Paths
- Configure Admission Quotas
- Publish Announcements
- Execute Admission Selection

---

## Tech Stack

### Backend

- Laravel 12
- PHP 8.4

### Frontend

- Blade
- Tailwind CSS
- JavaScript

### Database

- PostgreSQL

### Cloud Storage

- Cloudinary

### Deployment

- Apache
- cPanel

---

## Installation

```bash
git clone https://github.com/YOUR_USERNAME/ppdb-online.git

cd ppdb-online

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

npm run build

php artisan serve
```

---

## Live Demo

https://ppdb.marhadiakbar.com

---

## Project Structure

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
vendor/
```

---

## Admission Workflow

1. Student Registration
2. Complete Personal Information
3. Upload Required Documents
4. Committee Verification
5. Admission Selection Process
6. Announcement Publication

---

## Main Technologies

- Laravel
- PostgreSQL
- Cloudinary
- Tailwind CSS
- Blade
- Role-Based Access Control (RBAC)

---

## Developer

**Marhadi Akbar**

GitHub: https://github.com/YOUR_USERNAME

LinkedIn: https://linkedin.com/in/YOUR_USERNAME

Portfolio / Live Demo: https://ppdb.marhadiakbar.com

---

## License

This project was developed for educational and portfolio purposes.
