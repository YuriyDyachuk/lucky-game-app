FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    bash \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    mysql-client \
    gcc \
    g++ \
    make \
    autoconf \
    libc-dev \
    libffi-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-interaction \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

RUN apk add --no-cache supervisor

COPY ./supervisord.conf /etc/supervisord.conf

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
