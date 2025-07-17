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
chown -R www-data:www-data /var/www/html/logs /var/www/html/tmp
chmod -R 775 /var/www/html/logs /var/www/html/tmp
```
### 6. 環境設定ファイルの準備
`.gitignore` により Git 管理対象外となっている`app_local.php`を設定。
ひな形ファイルからコピー。
```bash
cp config/app_local.example.php config/app_local.php
```

### 7. マイグレーションの実行
```bash
bin/cake migrations migrate
```

### 8. サンプルデータ投入
```bin
bin/cake migrations seed
```

### 9. DOMPDFの使用方法については以下でご確認ください。
[load_font.phpを使用する方法](docs/dompdf.md)

## 使い方
Webアクセス: http://localhost:81

phpMyAdmin: http://localhost:8081
