# Работа с проектом
1. Выполните команду docker-compose up -d
2. Подключитесь к docker: docker exec -it kemerovo bash
3. Выполните команду: php artisan migrate --seed
4. Если не загружен vendor, то composer install

## Тесты
Выполнения тестирования
```shell
php artisan test
```

## OpenAPI
Файл с описанием Swagger Open API: <a href='./openapi3_1.json'>openapi3_1.json</a>