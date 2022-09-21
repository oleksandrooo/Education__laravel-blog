FROM php:8.1-fpm-alpine as backend

# Import extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Install extensions
RUN install-php-extensions pdo_mysql bcmath opcache redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install extra packages
RUN apk --no-cache add bash mysql-client mariadb-connector-c-dev nodejs npm

# Configure PHP
COPY .docker/php.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY .docker/error_reporting.ini $PHP_INI_DIR/conf.d/error_reporting.ini
COPY .docker/xdebug.ini $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

# Use the default development configuration
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# Install Xdebug 3
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}

# Create user based on provided user ID
RUN adduser --disabled-password --gecos "" --uid 1000 demo

# Switch to that user
USER demo


FROM backend as worker

# Start worker
CMD ["php", "/var/www/backend/artisan", "queue:work"]
