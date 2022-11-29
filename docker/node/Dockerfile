FROM alpine:3.16

ENV NODE_VERSION=16.18.0
ENV NODE_PORT=5000

RUN apk update && \
    apk add --no-cache curl && \
    curl -fsSL https://deb.nodesource.com/setup_$NODE_VERSION | /bin/sh -x && \
    apk add nodejs npm && \
    npm install -g yarn

EXPOSE ${NODE_PORT}

WORKDIR /app

CMD ["node"]
