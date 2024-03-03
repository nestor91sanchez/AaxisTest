FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zlib1g-dev \
    g++ \
    git \
    libicu-dev \
    zip \
    libzip-dev \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/framework

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer