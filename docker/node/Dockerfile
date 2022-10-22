FROM alpine:3.16

RUN apk update && \
    apk add --no-cache curl && \
    curl -fsSL https://deb.nodesource.com/setup_16.18 | /bin/sh -x && \
    apk add nodejs npm && \
    npm install -g yarn