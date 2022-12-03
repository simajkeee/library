FROM php:8.0-apache

RUN apt-get update \
    && apt-get -y upgrade \
    && apt-get -y install vim \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./_deploy/apache2/library-site.conf /etc/apache2/sites-available/library-site.conf

RUN a2enmod rewrite && \
    a2dissite 000-default && \
    a2ensite library-site && \
    service apache2 restart


COPY ./_deploy/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./_deploy/php/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini

WORKDIR /var/www/html
