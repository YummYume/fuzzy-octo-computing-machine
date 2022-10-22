FROM debian:11-slim

USER root

RUN apt update && \
    apt upgrade -y && \
    apt install dirmngr ca-certificates software-properties-common gnupg gnupg2 apt-transport-https curl -y && \
    curl -sSL https://packages.sury.org/php/README.txt | bash -x && \
    apt update && \
    apt upgrade -y && \
    apt install php8.2 php8.2-fpm php8.2-cli php8.2-dom -y && \
    mkdir /run/php

COPY api/www.conf /etc/php/8.2/fpm/pool.d/www.conf

EXPOSE 9000

CMD [ "php-fpm8.2", "-F", "-R" ]
