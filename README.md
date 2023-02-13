こちらのアプリはマルチログイン対応の簡易的なECサイトになります。
自身のアウトプット用に作成したもので今後、今後インプットしたものを効率よくアウトプットして行くために作成いたしました。

phpのバージョンはPHP 8.2.1
laravelのバージョンは8.75
stripeのバージョンは10.5
を使用し、CSSはtailwind.cssを使用しています。


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

<h2>swiper.js</h2>
userの詳細画面でjsのライブラリのswiper.jsを使用しています。
stripe決済について、決済自体が完了しリダイレクトの挙動は確認できるが、deleteメソッドが実行されない。原因模索中

<h2>micromodal.js</h2>
ownerとuserの部分でJavaScriptのライブラリのmicromodalを使用しています。
