FROM debian:11-slim

WORKDIR /etc/nginx

RUN apt update && apt install nginx -y && rm sites-enabled/default

COPY nginx/symfony.conf conf.d/

CMD [ "/usr/sbin/nginx", "-g", "daemon off;" ]
