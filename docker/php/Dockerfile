FROM debian:11-slim

USER root

RUN apt update && \
    apt upgrade -y && \
    apt install dirmngr ca-certificates software-properties-common gnupg gnupg2 apt-transport-https curl librabbitmq-dev -y && \
    curl -sSL https://packages.sury.org/php/README.txt | bash -x && \
    apt update && \
    apt upgrade -y && \
    apt install php8.1 \
    php8.1-fpm \
    php8.1-mysql \
    php8.1-pdo \
    php8.1-gd \
    php8.1-cli \
    php8.1-dom \
    php8.1-mbstring \
    php8.1-simplexml \
    php8.1-phar \
    php8.1-dev \
    php8.1-amqp \
    php8.1-redis \
    wget \
    git -y && \
    mkdir /run/php

COPY .conf/php/www.conf /etc/php/8.1/fpm/pool.d/www.conf

COPY .conf/php/php.ini /etc/php/8.1/fpm

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

EXPOSE 9000

WORKDIR /app

CMD [ "php-fpm8.1", "-F", "-R" ]
