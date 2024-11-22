FROM php:8.2-fpm

ARG user
ARG uid

WORKDIR /var/www

RUN apt-get update && apt-get install -qq \
git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    npm \
    nodejs

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-install zip pdo pdo_mysql mysqli mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
EXPOSE 8000
