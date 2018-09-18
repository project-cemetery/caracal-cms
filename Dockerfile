FROM igorkamyshev/php-base:latest
LABEL maintainer="Igor Kamyshev"

ENV APP_ENV=prod
ENV APP_DEBUG=0

RUN apk add --update nodejs nodejs-npm
RUN npm i -g yarn

COPY . /var/www/html/

RUN composer install --no-dev

RUN yarn && yarn build && rm -rf node_modules

CMD ["/start.sh"]

