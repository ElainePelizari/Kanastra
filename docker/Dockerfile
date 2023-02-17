FROM php:8.1.0-fpm

ARG SERVICE_PORT=8000

ENV SERVICE_PORT=$SERVICE_PORT

# Install system dependencies
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE ${SERVICE_PORT}

# Set working directory
WORKDIR /app

COPY composer.json composer.lock ./

# Run server/application with params
CMD composer install && php artisan serve \
    --host 0.0.0.0 \
    --port ${SERVICE_PORT}