FROM php:7.4-apache
#Install git
RUN apt-get update \
    && apt-get install -y git libpng-dev libgmp-dev libjpeg-dev libxpm-dev libfreetype6-dev libzip-dev libicu-dev g++ zlib1g-dev iputils-ping vim locales
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql mysqli zip gd intl gmp
RUN locale-gen tr_TR
RUN update-locale

RUN a2enmod rewrite


#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
COPY . /var/www/html/

#document_rootu public dizinine set eder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

EXPOSE 80
EXPOSE 3306
