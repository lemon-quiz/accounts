FROM php:7.4-fpm

#Get the user_id and group_id 'id -u' and 'id -g'
RUN addgroup --gid 1000 user
RUN adduser --disabled-password --gecos '' --uid 1000 --gid 1000 user

RUN apt-get update && apt-get install supervisor git zip -y
RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install -o -f redis \
  &&  rm -rf /tmp/pear \
  &&  docker-php-ext-enable redis

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/sbin/composer
COPY ./supervisor/conf.d /etc/supervisor/conf.d
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]

# USER user
# service supervisor start
#RUN supervisorctl reread \
#  && supervisorctl update # \
 # && supervisorctl start laravel-queue:*
