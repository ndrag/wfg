# Production image - not used for local development. This is used by CodeBuild to create our production image. 
# Use the official php 8.0 image with apache pre-installed & configured.
FROM php:8.1-apache 

LABEL maintainer="Nick Dragunow"

# Copy everything from the current folder to /var/www/app with www-data (apache serving user) as the owning user & owning group.
COPY --chown=www-data:www-data . /var/www/app

# Copy the default production php configuration to the appropriate folder. 
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy our Apache vhost.conf file to the correct location.
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set the work dir for all executed commands to the folder we'll server from.
WORKDIR /var/www/app

RUN a2enmod rewrite negotiation
