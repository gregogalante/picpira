# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose ports
EXPOSE 80
