FROM php:8.0-apache
COPY ./php/php.ini /usr/local/etc/php
COPY ./apache/vhost.conf /etc/apache2/sites-enabled/vhost.conf
ENV TZ=Asia/Tokyo
RUN a2enmod headers
RUN apt-get update \
	&& apt-get install -y zlib1g-dev \
	&& apt-get install -y zip unzip \
	&& apt-get -y install libzip-dev \
	&& apt-get -y install  libonig-dev\
	&& apt-get -y install libpng-dev \
	&& apt-get -y install  libjpeg62-turbo-dev \
	&& apt-get -y install  libfreetype6-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install pdo_mysql mysqli mbstring zip gd\
	&& docker-php-ext-enable mysqli \
	&& a2enmod rewrite

RUN rm /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html