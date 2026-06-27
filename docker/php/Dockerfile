FROM php:8.3-fpm-alpine

# Install system dependencies (added shadow for user mapping and linux-headers for pcntl)
RUN apk add --no-cache \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    shadow \
    linux-headers

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 1. Accept the host UID and GID from docker-compose (defaulting to 1000)
ARG UID=1000
ARG GID=1000

# 2. Modify the existing www-data user/group inside Alpine to match your WSL user IDs
RUN groupmod -g ${GID} www-data \
    && usermod -u ${UID} -g ${GID} www-data

# 3. Adjust permissions of the working directory so www-data owns it natively
RUN chown -R www-data:www-data /var/www

# 4. Drop privileges down to www-data so all artisan/composer processes run as this user
USER www-data