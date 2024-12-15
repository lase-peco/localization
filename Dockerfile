# Define PHP version argument before the FROM instruction
ARG PHP_VERSION=8.1
FROM php:${PHP_VERSION}-cli

# Accept UID and GID as build arguments
ARG UID
ARG GID

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libmcrypt-dev \
    libssl-dev \
    zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        soap \
        intl \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install and enable PCOV for code coverage (preferred for performance)
RUN pecl install pcov && \
    docker-php-ext-enable pcov

# Alternatively, install and enable Xdebug for code coverage and debugging (optional)
# RUN pecl install xdebug && \
#     docker-php-ext-enable xdebug && \
#     echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Add a non-root user with UID and GID from arguments
RUN groupadd -g $GID appgroup && \
    useradd -u $UID -g appgroup -m appuser

# Switch to the non-root user
USER appuser

# Set working directory
WORKDIR /app

# Set Git safe directory for the host-mounted folder
RUN git config --global --add safe.directory /app

# Default command
CMD ["php", "-a"]
