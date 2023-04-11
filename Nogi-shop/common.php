<?php
define('DB_PASS', 'hxp9zWzqzpwXTIvK');

session_start();
# カートに商品と数量を保存する必要があるのでセッションを使用

function connect() {
    return new PDO("mysql:host=localhost;dbname=e-shop;charset=utf8",'root',DB_PASS);
}
# 接続方式が変わってもこの部分のみ変更すれば良く、便利なので関数を使う

function img_tag($code) {
    if(file_exists("images/$code.jpg")) {
     # file_exists: ファイルの存在を確認
        $name = $code;
    } else {
        $name = 'noimage'; 
    }

    return '<img src="images/' . $name . '.jpg" alt="">';
}
# 「商品コード.jpg」の名前で商品画像をimageフォルダに置く

?>