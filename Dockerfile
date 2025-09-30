# syntax=docker/dockerfile:1

FROM composer:2 AS vendor
WORKDIR /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install production dependencies without running composer scripts
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress --no-scripts

# Copy application source (excluding vendor/node_modules at build context level)
COPY artisan ./
COPY app ./app
COPY bootstrap ./bootstrap
COPY config ./config
COPY database ./database
COPY lang ./lang
COPY public ./public
COPY resources ./resources
COPY routes ./routes
COPY storage ./storage
COPY .env.example ./.env.example
RUN rm -rf public/build && rm -f public/hot

FROM node:20-alpine AS assets
WORKDIR /var/www/html
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY tailwind.config.js vite.config.js postcss.config.js ./
RUN npm run build

FROM php:8.2-fpm-alpine AS app
WORKDIR /var/www/html

# Install system packages and PHP extensions required by Laravel + PostgreSQL
RUN apk add --no-cache bash libpq \
    && apk add --no-cache --virtual .build-deps postgresql-dev \
    && docker-php-ext-install pdo_pgsql \
    && apk del .build-deps

COPY --from=vendor /var/www/html ./
COPY --from=assets /var/www/html/public/build ./public/build

RUN chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

FROM nginx:1.27-alpine AS web
WORKDIR /var/www/html

COPY --from=app /var/www/html /var/www/html
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80