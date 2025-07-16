# CakePHP 3.x Docker環境セットアップ

Dockerを使ってCakePHP 3系の開発環境を構築します。
- PHPバージョン　8.2.26
- CakePHP バージョン　


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
### 4. ディレクトリのパーミッション設定
```bash
chown -R www-data:www-data logs tmp
chmod -R 775 logs tmp
```

### 5. 依存ライブラリのインストール

```bash
composer install
```
インストール中にメッセージが表示された場合、内容を確認のうえ、問題なければ「Y」で進んでください。
例：Set Folder Permissions ? (Default to Y) [Y,n]? Y

## 使い方
Webアクセス: http://localhost:81

phpMyAdmin: http://localhost:8081

## 注意
CakePHP 3系はPHP8未対応ですが、実際のプロジェクトにあわせてDockerfileでPHP 8.2.26を指定しています。

ext-intl など必要な拡張機能はDockerfile内でインストール済みです。
