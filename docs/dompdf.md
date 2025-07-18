# DOMPDF 利用手順（zipをDLして利用）

Composer を使用せずに DOMPDF を zip ファイルから手動導入し、日本語対応フォント（IPAexGothic）を埋め込んで使用する方法を説明します。
※このプロジェクトでは Docker コンテナ内で PHP 実行を行います。

**composerを利用する場合は以下を参照**
[composerでのインストール](https://github.com/haruka-a95/cakePHP-ver3/blob/feat/pdf/load_font/docs/dompdf.md)

## 1. DOMPDFのインストール
以下の GitHub リリースページから DOMPDF をダウンロードします。

- https://github.com/dompdf/dompdf/releases
- 今回使用するファイル：`dompdf-3.1.0.zip`

1. ZIPをダウンロードして解凍
2. 解凍したフォルダの中身を `htdocs/vendor/dompdf/` にコピー（もしくは配置）


## 2. 日本語フォントの登録（`load_font.php`使用）

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

3. フォントを読み込むため、Webコンテナ内にて「load_font.php」を格納したディレクトリに移動し、以下コマンドを実行。

```bash
docker exec -it cakephp-web bash
cd vendor/dompdf
php load_font.php IPAexGothic ipaexg.ttf
```
`IPAexGothic` は CSSやPHPでフォントを指定する際のフォント名として使用されます。

## 3.使用例（CakePHP コントローラー内）
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

### 注意点
- 日本語の文字化け、フォントが反映されない
→`load_font.php` で正しく登録されていない可能性あり