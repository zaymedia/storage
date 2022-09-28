FROM php:8.1-fpm-alpine

RUN apk update && apk add unzip

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install exif

RUN set -xe \
    && apk add --update \
        icu \
    && apk add --no-cache --virtual .php-deps \
        make \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        zlib-dev \
        icu-dev \
        g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        intl \
    && docker-php-ext-enable intl \
    && { find /usr/local/lib -type f -print0 | xargs -0r strip --strip-all -p 2>/dev/null || true; } \
    && apk del .build-deps

RUN apk add --update --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev \
    && mkdir /var/lib/php  \
    && chown www-data:www-data /var/lib/php -R

COPY ./common/php/conf.d /usr/local/etc/php/conf.d

WORKDIR /app