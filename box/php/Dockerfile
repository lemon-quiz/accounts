FROM php:7.4-fpm

RUN apt-get update && apt-get install supervisor git zip -y
RUN docker-php-ext-install pdo pdo_mysql sockets
RUN pecl install -o -f redis \
  &&  rm -rf /tmp/pear \
  &&  docker-php-ext-enable redis

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/sbin/composer

ARG USER_ID
ARG GROUP_ID

RUN addgroup --gid $GROUP_ID user
RUN adduser --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID user
RUN adduser user root
RUN chmod g+w -R /var/log/supervisor

COPY ./conf /usr/local/etc/
COPY ./supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./supervisor/conf.d /etc/supervisor/conf.d
USER user

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
