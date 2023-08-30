<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Banking System

## About Installation:
This project is dockerized.

** This project will run faster on WSL Winsows SubSystem for Linux / Linux. **

1. Please clone the project from:
https://github.com/samirraihan/mediuswareLaravel

2. git fetch origin
3. git branch dev.0.0.1 (without pulling this branch docker files will not be available)
4. cp .env.example .env
5. php artisan key:generate
6. composer install

7. Now install docker destop / docker on your pc/laptop
8. docker-compose build
9. docker-compose up -d

10. composer install/ update (if fails to install at step 6)
11. php artisan migrate
12. Run the project on http://localhost:8030/

DB details:

    DB_CONNECTION=mysql

    DB_HOST=mediusware_db

    DB_PORT=3306

    DB_DATABASE=mediuswareDB

    DB_USERNAME=mediusware

    DB_PASSWORD=mediusware93

Thank You
