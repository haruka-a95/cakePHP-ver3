# CakePHP 3.x Docker環境セットアップ

Dockerを使ってCakePHP 3系の開発環境を構築します。

## セットアップ手順

### 1. リポジトリをクローン

```bash
git clone https://github.com/haruka-a95/cakePHP-ver3.git
cd cakePHP-ver3
```

### 2. Dockerイメージのビルド＆起動
```bash
docker-compose up -d --build
```

phpmyadmin コンテナはphpMyAdminを起動し、http://localhost:8081 でアクセス可

### 3. Webコンテナに入る
```bash
docker exec -it cakephp-web bash

```
### 4. CakePHPプロジェクトの作成（初回のみ）
```bash
cd /var/www/html
composer create-project --prefer-dist cakephp/app:^3.10 .
```

### 5.依存ライブラリのインストール

```bash
composer install
```

## 使い方
Webアクセス: http://localhost:81

phpMyAdmin: http://localhost:8081

## 注意
CakePHP 3系はPHP8未対応のため、DockerfileでPHP7.4を指定しています。

ext-intl など必要拡張はDockerfile内でインストール済みです。