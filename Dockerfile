FROM php:8.3-apache

RUN apt-get update && apt-get install -y git unzip libzip-dev libicu-dev libpng-dev nodejs npm \
    && docker-php-ext-install pdo_mysql zip intl gd bcmath

RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
RUN chown -R www-data:www-data storage bootstrap/cache

CMD php artisan migrate --force && apache2-foreground
