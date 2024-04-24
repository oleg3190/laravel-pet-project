ARG BASE_TAG=5.0.1-php8.1-alpine

# https://hub.docker.com/r/phpswoole/swoole phpswoole/swoole:4.6-php8.0-alpine
FROM phpswoole/swoole:$BASE_TAG

RUN apk --update add \
	wget \
	curl \
	build-base \
	composer \
	nodejs \
	npm \
	libmcrypt-dev \
	libxml2-dev \
	pcre-dev \
	zlib-dev \
	autoconf \
	oniguruma-dev \
	openssl \
	openssl-dev \
	freetype-dev \
	libjpeg-turbo-dev \
	jpeg-dev \
	libpng-dev \
	imagemagick-dev \
	imagemagick \
	postgresql-dev \
	libzip-dev \
	gettext-dev \
	libxslt-dev \
	libgcrypt-dev && \
	pecl channel-update pecl.php.net && \
	pecl install mcrypt redis-5.3.4 && \
	docker-php-ext-install \
	mysqli \
	mbstring \
	pdo \
	pdo_mysql \
	xml \
	pcntl \
	bcmath \
	pdo_pgsql \
	zip \
	intl \
	gettext \
	soap \
	sockets \
	xsl && \
	docker-php-ext-configure gd --with-freetype=/usr/lib/ --with-jpeg=/usr/lib/ && \
	docker-php-ext-install gd && \
	docker-php-ext-enable redis && \
	rm -rf /tmp/pear && \
	rm /var/cache/apk/*

RUN echo "extension=swoole.so" > php.ini

#for spati
RUN docker-php-ext-configure pcntl --enable-pcntl \
	&& docker-php-ext-install \
	pcntl

RUN apk add php-pcntl php-posix
RUN apk add  php-mbstring

RUN apk add php-dom
RUN apk add php-xmlwriter
RUN apk add php-simplexml
RUN apk add php-tokenizer
RUN apk add php-fileinfo

RUN apk add --no-cache bash
RUN echo "extension=ext-pcntl" > php.ini
RUN echo "extension=dom" > php.ini

#------------------
#WORKDIR /var/www

RUN docker-php-ext-install \ 
	xml

RUN echo "extension=xml" > php.ini

RUN apk --update add nodejs \
    npm

RUN adduser -D -u 1001 www

COPY --chown=www:www data/api /var/www

#COPY /data/api /var/www

WORKDIR /var/www

RUN chmod -R ug+rwx storage bootstrap/cache



RUN php -f /usr/bin/composer.phar install
# Change current user to www
#USER www

ENTRYPOINT ["php", "-d", "variables_order=EGPCS", "artisan", "serve","--host=0.0.0.0", "--port=8000"]
#ENTRYPOINT ["php", "-d", "variables_order=EGPCS", "artisan", "octane:start","--watch","--server=swoole", "--host=0.0.0.0", "--port=8000"]
EXPOSE 8000