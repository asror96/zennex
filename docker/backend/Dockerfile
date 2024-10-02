FROM php:8.3-fpm AS base

# Установка временной зоны
RUN ln -sf /usr/share/zoneinfo/Asia/Krasnoyarsk /etc/localtime && \
    echo 'Asia/Krasnoyarsk' > /etc/timezone

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка PHP Extension Installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Установка системных зависимостей и PHP расширений
RUN apt-get update && \
    apt-get install -y libpq-dev unzip cron && \
    docker-php-ext-install pdo pdo_pgsql pgsql

RUN install-php-extensions intl zip soap gd

# Установка дополнительных зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    build-essential \
    libpng-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    curl \
    zip \
    unzip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    git

# Создание пользователя
RUN groupadd --gid 1000 user && \
    useradd --uid 1000 --gid user --shell /bin/bash --create-home user

RUN su user -c 'mkdir -p /home/user/.composer/'

# Dev образ для разработки
FROM base AS dev

USER root

# Копирование конфигураций PHP
COPY php/conf.d /usr/local/etc/php/conf.d
COPY php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Установка рабочей директории
WORKDIR /app/

# Копирование кода приложения
COPY . .

# Переключение на пользователя
USER user

# Добавление алиаса для удобства
RUN echo 'alias art="php artisan"' >> /home/user/.bashrc
