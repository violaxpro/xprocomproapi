# Gunakan base image PHP + Apache
FROM php:8.2-apache

# Install extension PHP yang dibutuhkan Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file ke container
COPY . .

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Copy vhost config Apache (opsional, kalau mau custom)
# COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Allow override .htaccess
RUN a2enmod rewrite

# Set permission storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port Apache
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
