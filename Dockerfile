FROM php:8.0-cli-alpine3.13

RUN apk update && \
    apk add --no-cache \
        libzip-dev \
        openssl-dev && \
    docker-php-ext-install -j$(nproc) \
        zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN apk add --no-cache --virtual .phpize_deps $PHPIZE_DEPS && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb && \
    rm -rf /usr/share/php7 && \
    apk del .phpize_deps

ENV PATH /var/app/bin:/var/app/vendor/bin:$PATH

WORKDIR /var/app
