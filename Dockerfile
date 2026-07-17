FROM php:8.1-apache

# Install PHP extensions used by the app
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module (if needed by the app)
RUN a2enmod rewrite

# Copy application code into the container
COPY . /var/www/html/
WORKDIR /var/www/html

# Give the www-data user ownership (useful when running with mounted volumes)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

# Default command is the Apache run in the base image
