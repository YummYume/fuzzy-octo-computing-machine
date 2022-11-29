FROM debian:11-slim

ENV PHP_VERSION=8.1
ENV PHP_PORT=9000

RUN apt update && \
    apt upgrade -y && \
    apt install dirmngr software-properties-common gnupg gnupg2 curl librabbitmq-dev -y && \
    curl -sSL https://packages.sury.org/php/README.txt | bash -x && \
    apt update && \
    apt upgrade -y && \
    apt install php${PHP_VERSION} \
    php${PHP_VERSION}-fpm \
    php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-pdo \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-cli \
    php${PHP_VERSION}-dom \
    php${PHP_VERSION}-mbstring \
    php${PHP_VERSION}-simplexml \
    php${PHP_VERSION}-phar \
    php${PHP_VERSION}-dev \
    php${PHP_VERSION}-amqp \
    php${PHP_VERSION}-redis \
    git -y && \
    mkdir /run/php

COPY .conf/php/www.conf /etc/php/8.1/fpm/pool.d/www.conf

COPY .conf/php/php.ini /etc/php/8.1/fpm

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

EXPOSE ${PHP_PORT}

WORKDIR /app

CMD [ "php-fpm8.1", "-F", "-R" ]
