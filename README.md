# Tasks Management System

A project and task management dashboard built with **Laravel 7**. Organize employees by department and skills, group work into projects, and assign tasks to employees while tracking their status.

![Laravel](https://img.shields.io/badge/Laravel-7-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-7.2%2B-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-0769AD?logo=jquery&logoColor=white)

## Features

- **Departments**: organize employees
- **Employees**: profiles with department and skills, active / inactive status
- **Skills**: assign many skills to each employee
- **Projects**: group related tasks, with status
- **Tasks**: assign one task to several employees and track its status
- AJAX create / update / delete and status toggles without page reloads
- Server-side DataTables (Yajra) for every listing
- Authentication with Laravel UI

## Data Model

```
Department ─< Employee >─< Skill
                 │
                 >─< Task >── Project
```

Many-to-many tables: `employee_skill`, `employee_task`.

## Tech Stack

| Layer | Tools |
|---|---|
| Back end | Laravel 7, PHP, MySQL |
| Front end | Blade, Bootstrap, jQuery (AJAX), Laravel Mix |
| Packages | yajra/laravel-datatables-oracle, laravel/ui |

## Getting Started

**Prerequisites:** PHP 7.2.5+, Composer, Node.js, MySQL

```bash
git clone https://github.com/mostfaswaisi93/tasks.git
cd tasks
composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
# set DB_DATABASE / DB_USERNAME / DB_PASSWORD in .env
php artisan migrate
php artisan serve      # http://localhost:8000
```

The admin area is under `/admin` (tasks, employees, projects, departments, skills).

## Author

**Mustafa T. Al-Swaisi** · [LinkedIn](https://www.linkedin.com/in/mostfaswaisi93/) · [GitHub](https://github.com/mostfaswaisi93)
