FROM php:8.2-apache

# Install required system packages for Composer and MongoDB extension
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Install MongoDB PHP extension via PECL
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Grant required permissions to web server if needed (optional but good practice)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
