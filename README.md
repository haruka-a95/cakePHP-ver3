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

### 3. Webコンテナに入る
```bash
docker exec -it cakephp-web bash

```
### 4. 依存ライブラリのインストール

```bash
composer install
```
インストール中にメッセージが表示された場合、内容を確認のうえ、問題なければ「Y」で進んでください。
例：Set Folder Permissions ? (Default to Y) [Y,n]? Y

## 使い方
Webアクセス: http://localhost:81

phpMyAdmin: http://localhost:8081

## 注意
CakePHP 3系はPHP8未対応のため、DockerfileでPHP7.4を指定しています。

ext-intl など必要な拡張機能はDockerfile内でインストール済みです。