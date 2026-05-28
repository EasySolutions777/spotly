FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    netcat-openbsd \
    $PHPIZE_DEPS

RUN pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Даем права на исполнение скрипту прямо внутри папки docker/
RUN chmod +x docker/entrypoint.sh

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 8000

# Запускаем скрипт из его физического подкаталога
ENTRYPOINT ["docker/entrypoint.sh"]