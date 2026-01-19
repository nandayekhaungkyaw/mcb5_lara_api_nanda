FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose Laravel built-in server port
EXPOSE 8000

# Start Laravel built-in server (simple, no Nginx)
CMD php artisan serve --host=0.0.0.0 --port=8000
