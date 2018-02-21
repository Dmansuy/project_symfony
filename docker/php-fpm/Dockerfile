FROM php:7.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    wget \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql

RUN echo 'alias sf="php app/console"' >> ~/.bashrc



# Allowed user to write
RUN usermod -u 1000 www-data

WORKDIR /var/www/symfony