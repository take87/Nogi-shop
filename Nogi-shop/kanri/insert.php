<?php
require 'common.php';
$error  = $name = $comment = $price = '';
# フォームで使う各変数を初期化
$pdo = connect();
if(@$_POST['submit']) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $price = $_POST['price'];
    if(!$name) {
        $error .= '商品名がありません。<br>';
    }
    if(!$comment) {
        $error .= '商品説明がありません。<br>';
    }
    if(!$price) {
        $error .= '価格がありません。<br>';
    }
    if(preg_match('/\D/',$price)) {
        $error .= '価格が不正です。<br>';
    }
    # 正規表現を使用し、数値以外を認めない
    if(!$error) {
        $pdo->query("INSERT INTO goods(name,comment,price)
        VALUES('$name','$comment',$price)");

        header('Location: index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<tilte>メンバー追加</tilte>
<link rel="stylesheet" href="kanri.css">
</head>
<body>
<div class="base">
    <?php if($error) { echo "<span class=\"error\">$error</span>"; } ?>
    <form action="insert.php" method="post">
        <p>
            メンバー名<br>
            <input type="text" name="name" value="<?php echo $name ?>">
        </p>
        <p>
            メンバー説明<br>
            <textarea name="comment" rows="10" cols="60"><?php echo $comment
            ?></textarea>
        </p>
        <p>
            価格<br>
            <input type="text" name="price" value="<?php echo $price; ?>">
        </p>
        <p>
            <input type="submit" name="submit" value="追加">
        </p>
    </form>
</div>
<div class="base">
    <a href="index.php">一覧に戻る</a>
</div>
</body>
</html>