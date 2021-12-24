FROM php:8.0.11-fpm-alpine

RUN apk add --no-cache icu-dev autoconf build-base $PHPIZE_DEPS \    
    && pecl install redis \
    && docker-php-ext-enable redis \
    && pecl clear-cache

RUN docker-php-ext-install pdo_mysql intl opcache

RUN apk add vim

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY codebase /

WORKDIR /var/www/producer
CMD php-fpm 
EXPOSE 9001 9003