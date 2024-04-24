## Тестовое задание

### Инструкция как запустить
- Склонировать репозиторий
- заполнить env для подключнеия к бд в ./src/.env и в env/mysql.env(DB_HOST=mysql DB_PORT=localhost)
- создать сеть **docker network create working_hands_app**
- docker-compose up -d
- docker-compose run composer install
- docker exec -it bash working-hands_php
#### Внутри контейнера php-fpm 
- php artisan key:generate
- php artisan migrate (для миграций)
- php artisan db:seed (для записи моковых данных в бд)
#### Как запустить frontend
- npm install
- npm run dev
- зайти на http://localhost:8000