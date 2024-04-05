# Use the official PHP 8.3-fpm-alpine image as base
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk update && \
    apk add --no-cache \
    bash \
    mysql-client \
    libzip-dev \
    zlib-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    curl \
    git \
    unzip \
    $PHPIZE_DEPS \
    && docker-php-ext-install pdo_mysql zip gd exif xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Expose port 9000
EXPOSE 9000

# Start php-fpm server
CMD ["php-fpm"]
