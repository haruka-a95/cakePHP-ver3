<?php
const DB_HOST = 'php8.1-db-host'; // .envファイルの DB_HOST_NAME を参照
const DB_PORT = 3306; // docker-compose.ymlファイルの services.db.ports を参照 （右側に記載されているポート番号）
const DB_DATABASE = 'php_db'; // docker/db/sql/init.sql を参照
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root'; // .envファイルの DB_ROOT_PASSWORD を参照
const DB_CHARSET = 'utf8mb4';

$dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE . ';charset=' . DB_CHARSET;
$dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

echo 'DB接続成功';
// PHP の設定情報を出力
phpinfo();
