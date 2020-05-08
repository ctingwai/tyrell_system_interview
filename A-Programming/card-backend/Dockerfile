# start with our base image - php apache
FROM php:7.3-apache

# build arguments
ARG DB_HOST
ARG DB_USER
ARG DB_PASS
ARG DB_NAME

# install all the system dependencies and enable PHP modules
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      libzip-dev \
      #mysql-client \
      git \
      zip \
      unzip \
    && rm -r /var/lib/apt/lists/*
RUN pecl install mcrypt
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-install \
      intl \
      mbstring \
      pcntl \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      zip \
      opcache

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# change the web_root to cakephp /var/www/html/webroot folder
RUN sed -i -e "s/html/html\/webroot/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
RUN a2enmod rewrite

# copy source files and run composer
COPY . /var/www/html

# work directory
WORKDIR /var/www/html

# install all PHP dependencies
RUN composer install --no-interaction

#change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# update configurations
RUN sed -i "s#__DB_HOST__#${DB_HOST}#" /var/www/html/config/app_local.php \
    && sed -i "s#__DB_NAME__#${DB_NAME}#" /var/www/html/config/app_local.php \
    && sed -i "s#__DB_USER__#${DB_USER}#" /var/www/html/config/app_local.php \
    && sed -i "s#__DB_PASS__#${DB_PASS}#" /var/www/html/config/app_local.php
