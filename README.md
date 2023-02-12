<h2>画像のダミーデータ</h2>
public/imagesフォルダ内に
sample1.jpg 〜 sample6.jpg として
保存しています。

php artisan storage:link で
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に
保存すると表示されます。
(productsフォルダがない場合は作成してください。)

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し
画像を保存してください。

<h2>stripe決済</h2>
決済機能はstripeを利用しています。

<h2>swiper</h2>
userの詳細画面でjsのライブラリのswiper.jsを使用しています。

