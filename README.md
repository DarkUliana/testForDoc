## Розгортання проєкту

####Requirements
- PHP >= 7.3
- MySQL database utf8mb4_general_ci
- Composer

Для запуску потрібно створити  та налаштувати файл .env подібний до .env.example

####Запуск

- ```composer install```
- ```php artisan key:generate```
- ```php artisan migrate```
- ```php artisan serve --port=8080```

