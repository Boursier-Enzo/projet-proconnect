FROM php:8.4-fpm

# Install dependencies for intl extension
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Install intl extension
RUN docker-php-ext-install intl

# Install additional extensions if needed
# RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html
