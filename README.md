# もぎたて


## 環境構築 
Dockerビルド
docker-compose up -d --build
Laravel環境構築
docker-compose exec php bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed

## 使用技術 
・PHP php:7.4.9-fpm 
・Laravel:8 
・mysql:8.0.26

## ER図 
https://drive.google.com/file/d/1yoJgUbd6jIpeefNquMzdxI7EYWrAeh1l/view?usp=sharing

## URL 
開発環境：http://localhost/
