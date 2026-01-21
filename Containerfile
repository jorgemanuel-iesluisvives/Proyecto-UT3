FROM php:8.4.17-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
WORKDIR /var/www/html/
COPY test/* .
RUN chown -R www-data:www-data /var/www
EXPOSE 80
