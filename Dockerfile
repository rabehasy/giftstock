FROM php:8.0-fpm
RUN apt-get update
RUN apt-get -y install autoconf pkg-config libssl-dev libzip-dev git make libc-dev vim unzip
RUN docker-php-ext-install bcmath pdo pdo_mysql mysqli sockets zip

RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/composer

WORKDIR /home/giftstock

ENTRYPOINT ["php", "-S", "0.0.0.0:8088", "-t", "/home/giftstock/public"]