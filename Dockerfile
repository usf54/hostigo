FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpng-dev libonig-dev libxml2-dev \
    zip nodejs npm default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

WORKDIR /var/www

# Copy project
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Install JS deps & build assets
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
