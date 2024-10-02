# Zennex
## Backend
___
## Описание

Backend часть **Zennex** написано на фреймворке [Laravel 10.](https://laravel.com/docs/10.x)

## Используемые технологии

### Основные

- [Laravel 11;](https://laravel.com/docs/11.x)
- [PostgresSQL 15;](https://www.postgresql.org/docs/)
- Админка на [Filament 3;](https://filamentphp.com/docs/3.x/panels/installation)
- [Pint](https://laravel.com/docs/11.x/pint) - исправление кодстайла.
- [Telescope](https://laravel.com/docs/11.x/telescope) - для отладки.
- [MailPit](https://github.com/axllent/mailpit) - для тестов email.
- [Swagger](https://swagger.io/docs/specification/about/) - для документации.

## Установка и запуск
### 1. Клонирование репозитория

Подключитесь к гитлабу через SSH и склонируйте проект себе

```bash
https://github.com/asror96/zennex.git
cd zennex
```
### 2. Запуск docker compose для скачивания с помощью docker-compose.yml всех образов с dockerhub и запуск контейнеров
```bash
make build
```

### 3. Вход в контейнер
```bash
docker exec -it zennex-backend-1 bash
```
### 4. Миграция всех таблиц
```bash
art migrate
```

### 5. Создание администратора для доступа к админ панелью(почта админа обязательно должно быть с окончанием @zennex.ru)
```bash
art make:filament-user
```

## Для удобства имеется Makefile с командами
### 1. Запуск проекта и установка зависимостей
```bash
make init
```
### 2. Запуск контейнеров
```bash
make up
```
### 3. Остановка контейнеров
```bash
make down
```
### 4. Сборка контейнеров
```bash
make build
```

### 5. Копирование файла .env
```bash
make copy-env
```

### 6. Установка пакетов Composer
```bash
make composer-install
```

### 7. Валидация файла composer.json
```bash
make composer-validate
```

### 8. Аудит пакетов Composer
```bash
make composer-audit
```

### 9. Очистка кеша приложения
```bash
make cache-clear
```

### 10. Проверка стиля написания кода
```bash
make fixer-check
```

### 11. Исправление стиля написания кода
```bash
make fixer-fix
```

### 12. Справка по командам
```bash
make help
```
