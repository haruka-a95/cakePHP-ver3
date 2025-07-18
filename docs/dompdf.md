# DOMPDF 利用手順

## composerを利用する場合

### 1. DOMPDFのインストール

このブランチではすでに `composer.json` に `dompdf/dompdf` が含まれているため、  
**ブランチを```feat/pdf```に切り替えた後に以下を実行するだけで DOMPDF が利用可能になります：**
```bash
composer install
```

- main ブランチを使用する場合
```composer.json```に ```dompdf/dompdf``` の記述がない場合は、
webコンテナ内で以下のコマンドを実行し、DOMPDF を追加インストールしてください。

```bash
composer require dompdf/dompdf
```
この操作により composer.json と composer.lock が更新され、
vendor/ 以下に dompdf がインストールされます。

日本語フォントの登録に進んでください。

## ZIPを使用する場合
### 1. DOMPDFのインストール
以下の GitHub リリースページから DOMPDF をダウンロードします。

- https://github.com/dompdf/dompdf/releases
- 今回使用するファイル：`dompdf-3.1.0.zip`

1. ZIPをダウンロードして解凍
2. 解凍したフォルダの中身を `htdocs/vendor/dompdf/` にコピー（もしくは配置）


### 2. 日本語フォントの登録（`load_font.php`使用）

1. `load_font.php` のダウンロード
以下から `load_font.php` をダウンロードします。
- https://github.com/dompdf/utils/blob/master/load_font.php

ダウンロードしたファイルを以下ディレクトリに配置。
```bash
htdocs/vendor/dompdf/load_font.php
```

2. フォントの準備
今回はIPAフォントを以下からダウンロード。
IPAexゴシック(Ver.004.01)
- https://moji.or.jp/ipafont/ipaex00401/


ZIPファイルを展開し、`ipaexg.ttf`ファイルを`load_font.php`と同じディレクトリに配置。
```bash
htdocs/vendor/dompdf/ipaexg.ttf
```

3. フォントを読み込むため、Webコンテナ内にて、以下コマンドを実行。

```bash
docker exec -it cakephp-web bash
php vendor/dompdf/load_font.php IPAexGothic vendor/dompdf/ipaexg.ttf
```
`IPAexGothic` は CSSやPHPでフォントを指定する際のフォント名として使用されます。

### 3.使用例（CakePHP コントローラー内）
基本的な使い方は以下の通りです。
実際の使用例は`src/Controller/InvoiceController.php`の`print`メソッド参照。

```bash
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true); // 外部フォント読み込みを有効にする

$dompdf = new Dompdf($options);

// HTMLをロード（日本語を含む場合はUTF-8）
$html = '<html><meta charset="UTF-8"><style>body{font-family: IPAexGothic;}</style><body>Hellow World!</body></html>';
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// ブラウザにPDF表示（ダウンロードさせない場合）
$dompdf->stream("document.pdf", ["Attachment" => false]);

```

## 注意点
- 日本語の文字化け、フォントが反映されない
→`load_font.php` で正しく登録されていない可能性あり