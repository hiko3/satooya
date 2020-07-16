# イメージの指定
FROM php:7.4-fpm-buster

# composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# root /スーパーユーザーとしてのコマンドの実行に関する警告を無効
ENV COMPOSER_ALLOW_SUPERUSER 1

# Laravelの実行に必要なライブラリのインストール
# OSの言語設定
# PHP拡張ライブラリのインストール
# Composerの高速化設定
RUN apt-get update && \
  apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  locale-gen en_US.UTF-8 && \
  localedef -f UTF-8 -i en_US en_US.UTF-8 && \
  mkdir /var/run/php-fpm && \
  mkdir /var/log/php && \
  docker-php-ext-install intl pdo_mysql mbstring zip bcmath && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo

# ホスト側に置いているPHPの設定ファイルのコピー
# COPY ./docker/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

ADD . /var/www
RUN chown -R www-data:www-data /var/www