FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www