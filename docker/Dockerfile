FROM php:7.1.8-apache

MAINTAINER Arif Iqbal
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y
RUN docker-php-ext-install mysqli pdo pdo_mysql  
RUN apt-get install wget unzip -y
RUN wget https://releases.hashicorp.com/terraform/0.12.18/terraform_0.12.18_linux_amd64.zip
RUN  unzip ./terraform_0.12.18_linux_amd64.zip -d /usr/local/bin/
RUN terraform --version 
COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app \
    && a2enmod rewrite

RUN composer install -d /srv/app
