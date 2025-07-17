# DOMPDF 利用手順（zipをDLして利用）

このブランチでは、すでにインストール済、フォント指定まで実施済です。

## 1. インストール
以下のサイトから最新のzipファイルをインストール。
今回は「dompdf-3.1.0.zip」を使用。
https://github.com/dompdf/dompdf/releases


## 2. フォントの登録（load_font.php使用）

1. 「load_font.php」を以下からダウンロード
https://github.com/dompdf/utils/blob/master/load_font.php

ダウンロードしたファイルを以下ディレクトリに配置。
```bash
htdocs/vendor/dompdf
```

2. 使用したいフォントをダウンロード
今回はIPAフォントを以下からダウンロード。
IPAexゴシック(Ver.004.01)
https://moji.or.jp/ipafont/ipaex00401/


ダウンロードしたzipファイルを展開し、.ttfファイルをload_font.phpと同じ以下ディレクトリに配置。
```bash
htdocs/vendor/dompdf
```

3. フォントを読み込むため、Webコンテナ内にて「load_font.php」を格納したディレクトリに移動し、以下コマンドを実行。

```bash
docker exec -it cakephp-web bash
cd vendor/dompdf
php load_font.php IPAexGothic ipaexg.ttf
```
「IPAexGothic」はフォント指定する際の名前になる

## 3.使用例（CakePHP コントローラー内）
実際の使用例はInvoiceコントローラー内のprintメソッド参照
```bash
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml('<h1>Hello PDF</h1>');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// PDF をブラウザで表示
$dompdf->stream("document.pdf", ["Attachment" => false]);
```
