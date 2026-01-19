FROM php:8.3-cli

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl git unzip libzip-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer

# Copy project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start server with public/ as root
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
