FROM php:7.2-cli
MAINTAINER pavel@musil-it.eu
RUN docker-php-ext-install pdo pdo_mysql
# RUN pecl install xdebug
COPY . /var/www
