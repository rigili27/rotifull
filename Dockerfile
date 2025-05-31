# Usa una imagen base con PHP 8.3
FROM php:8.3-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    libicu-dev \
    g++ \
    libmagickwand-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el proyecto
WORKDIR /var/www
COPY . .

# Instala las dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Da permisos correctos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expone el puerto para Laravel
EXPOSE 8000

# Comando de inicio (usamos el servidor interno de Laravel)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
