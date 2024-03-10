FROM php:8.3-fpm-alpine

RUN docker-php-ext-install pdo_mysql sqlite3

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
