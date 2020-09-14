FROM php:7.1-cli as base

ENV LC_ALL C.UTF-8
ENV LANG C.UTF-8

RUN sed -i 's/\(security\|deb\).debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

RUN apt-get update \
    && apt-get dist-upgrade -y \
    && apt-get autoremove -y \
    && apt-get autoclean -y \
    && apt-get install -y \
        libfreetype6-dev \
        libcurl4-openssl-dev \
        libicu-dev \
        libssl-dev \
        libmcrypt-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install -j$(nproc) \
        zip \
        mcrypt \
        bcmath \
        gettext

WORKDIR /srv/www

FROM base as prod

CMD ["composer","ci"]
ENV sm3_env=prod

FROM base as dev

RUN apt-get update \
    && apt-get install -y unzip vim htop \
    && rm -rf /var/lib/apt/lists/* \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

CMD ["composer","dev"]
ENV sm3_env=dev

