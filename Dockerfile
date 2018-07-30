FROM igorkamyshev/php-base

ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY . /var/www/html/

RUN composer install --no-dev

CMD ["/start.sh"]

