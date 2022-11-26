FROM debian:11-slim

USER root

RUN apt update && \
    apt upgrade -y && \
    apt install dirmngr ca-certificates software-properties-common gnupg gnupg2 apt-transport-https curl -y && \
    curl -sSL https://packages.sury.org/php/README.txt | bash -x && \
    apt update && \
    apt upgrade -y && \
    apt install php8.2 \
    php8.2-fpm \
    php8.2-mysql \
    php8.2-pdo \
    php8.2-gd \
    php8.2-cli \
    php8.2-dom \
    php8.2-mbstring \
    php8.2-simplexml \
    php8.2-phar \
    php8.2-dev \
    wget \
    git -y && \
    mkdir /run/php

COPY .conf/php/www.conf /etc/php/8.2/fpm/pool.d/www.conf

COPY .conf/php/php.ini /etc/php/8.2/fpm

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN wget https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar && \
    printf "\n" | php pickle.phar install redis

EXPOSE 9000

WORKDIR /app

CMD [ "php-fpm8.2", "-F", "-R" ]
