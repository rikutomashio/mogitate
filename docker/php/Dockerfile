FROM php:8.4-fpm

# PHP拡張
RUN docker-php-ext-install pdo pdo_mysql mysqli

# 作業ディレクトリ
WORKDIR /var/www

# git, unzip, curl, zip を入れる（Laravel依存用）
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    && rm -rf /var/lib/apt/lists/*

# composer をインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

