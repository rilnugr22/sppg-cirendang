FROM php:8.2-apache

# Install ekstensi sistem & MySQL yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd

# Aktifkan mod_rewrite Apache untuk routing Laravel agar tidak 404
RUN a2enmod rewrite

# Tentukan direktori kerja di dalam server
WORKDIR /var/www/html
COPY . .

# Install Composer secara otomatis
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Atur hak akses folder storage agar tidak error Permission Denied
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ubah DocumentRoot Apache agar mengarah ke folder public Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Definisikan port dinamis bawaan Railway
ENV PORT=8080
EXPOSE 8080

# Perintah utama saat server dinyalakan
CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && apache2-foreground