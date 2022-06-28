# Use the official php 8.0 image with apache pre-installed & configured.
FROM php:8.0-apache 

LABEL maintainer="Nick Dragunow"

# Copy everything from the current folder to /var/www/app with www-data (apache serving user) as the owning user & owning group.
COPY --chown=www-data:www-data . /var/www/app

# Copy our Apache vhost.conf file to the correct location.
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set the work dir for all executed commands to the folder we'll server from.
WORKDIR /var/www/app

RUN a2enmod rewrite negotiation
