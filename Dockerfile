# Alap image
FROM php:8.2-fpm

# Munka könyvtár beállítása
WORKDIR /var/www

# Függőségek telepítése
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring gd

# Composer telepítése
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel fájlok másolása
COPY . .

# Engedélyek beállítása
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

CMD ["php-fpm"]
