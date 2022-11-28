FROM alpine:3.16

ENV NODE_VERSION=16.18.0

RUN apk update && \
    apk add --no-cache curl && \
    curl -fsSL https://deb.nodesource.com/setup_$NODE_VERSION | /bin/sh -x && \
    apk add nodejs npm && \
    npm install -g yarn

EXPOSE 5000

WORKDIR /app

CMD ["node"]
