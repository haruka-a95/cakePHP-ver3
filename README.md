# CakePHP 3.x Docker環境セットアップ

Dockerを使ってCakePHP 3系の開発環境を構築します。
- PHPバージョン　7.3.33
- CakePHP バージョン　3.6.14


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


### 5. ディレクトリのパーミッション設定
```bash
chown -R www-data:www-data logs tmp
chmod -R 775 logs tmp
```
## 使い方
Webアクセス: http://localhost:81

phpMyAdmin: http://localhost:8081

