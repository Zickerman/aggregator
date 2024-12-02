FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    zip \
    unzip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/lib/postgresql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# get user id from outside and set rights to resolve permissions problems
ARG UID
ARG GID
RUN groupadd -g ${GID} usergroup && \
    useradd -u ${UID} -g usergroup -m user
RUN mkdir -p /var/www/laravel-docker/storage /var/www/laravel-docker/bootstrap/cache && \
    chown -R ${UID}:${GID} /var/www/laravel-docker/storage /var/www/laravel-docker/bootstrap/cache && \
    chmod -R 775 /var/www/laravel-docker/storage /var/www/laravel-docker/bootstrap/cache
WORKDIR /var/www/laravel-docker
USER user
