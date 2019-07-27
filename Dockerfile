FROM php:7.3-apache as base

WORKDIR /var/www/

RUN rm -rf /var/www/html /etc/apache2/conf-enabled/security.conf && \
    apt-get update && \
    apt-get install -y libzip-dev libpng-dev jpegoptim optipng pngquant gifsicle mariadb-client libmagickwand-dev && \
    docker-php-ext-install gd pdo_mysql zip exif && \
    pecl install imagick && \
    a2enmod rewrite remoteip headers && \
    rm -rf /var/lib/apt/lists/*

COPY docker/webserver/000-default.conf /etc/apache2/sites-available/
COPY docker/webserver/apache2.conf /etc/apache2/
COPY src /var/www/

RUN chown -R www-data:www-data storage


FROM base as dev

COPY docker/lb/certs/ca.crt /usr/local/share/ca-certificates/

RUN update-ca-certificates
