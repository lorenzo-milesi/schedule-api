FROM php:7.4-apache

RUN apt-get update && apt-get install -y texlive-full && \
    apt-get clean

COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/composer.sh /usr/local/bin/composer-installer

RUN a2enmod headers rewrite negotiation

RUN apt-get -yqq update && apt-get install -yqq \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libpq-dev \
    wget
RUN docker-php-ext-install pdo_mysql pdo_pgsql opcache mbstring zip gd exif mbstring intl
RUN apt-get -yqq update \
	&& apt-get install -yqq --no-install-recommends zip unzip \
	&& chmod +x /usr/local/bin/composer-installer \
	&& composer-installer \
	&& mv composer.phar /usr/local/bin/composer \
	&& chmod +x /usr/local/bin/composer \
	&& composer --version

EXPOSE 80
