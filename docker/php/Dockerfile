FROM php:7.3.33-apache
# composer php.iniをコピー
COPY ./php.ini /usr/local/etc/php/
# composer インストール (マルチステージビルド)
COPY --from=composer:2.3.10 /usr/bin/composer /usr/bin/composer
# apt(Advanced Package Tool) パッケージインストール
# PDO driver インストール(mysql)
# mod_rewrite 有効化
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    vim \
    zip \
    libicu-dev \
    # intl用ライブラリ追加
    && docker-php-ext-configure intl \
    # pdo_mysql と intl をインストール
    && docker-php-ext-install pdo_mysql intl \
    && docker-php-ext-install pdo_mysql \
    && a2enmod rewrite
