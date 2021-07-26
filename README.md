## Настройка проекта

1. Комируем файл `cp .env.example .env` и настраиваем коннект к бд и прописываем настройку для отправки почты
  
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=api-blog
DB_USERNAME=root
DB_PASSWORD=password
```

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=***
MAIL_PASSWORD=***
MAIL_ENCRYPTION=ssl
```

2. Подымаем контейнера в докере `sudo docker-compose up -d`
3. Загружаем покеты композера `sudo docker-compose exec app composer install`
4. Делаем миграцию базы `sudo docker-compose exec app php artisan migrate`
5. Добавляем сиды `sudo docker-compose exec app php artisan db:seed`
6. Генерируем ключ `sudo docker-compose exec app php key:generate`

## Роуты
| Method|URI|Body|
|-------|---|----|
|POST|api/auth/register/|["name": "name", "email": "email", "password": "password"]
|POST|api/auth/login/|["email": "email", "password": "password"]
|POST|api/auth/logout
|GET|api/profile/|
|PUT|api/profile/update-avatar| ["_method": "PUT", "file": "file"]
|GET|api/profile/{id}|
|GET|api/post/|
|GET|api/post/my-post|
|GET|api/post/post-without-comments
|GET|api/post/most-view-post
|POST|api/post/|["title": "title", "body": "body", "category_name": "category_name"]
|GET|api/post/{id}
|PUT|api/post/update/{id}|["title": "title", "body": "body", "category_name": "category_name"]
|POST|api/comment/create|["body": "body", "post_id": "post_id", "parent_id": "parent_id"]
