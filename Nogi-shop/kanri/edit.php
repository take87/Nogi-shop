<?php
require 'common.php';
$error = '';
$pdo = connect();
if(@$_POST['code']) {
    $code = $_POST['code'];
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
    if(preg_match('/\D/', $price)) {
        $error .= '価格が不正です。<br>';
    }
    if(!$error) {
        $pdo->query("UPDATE goods SET name='$name', comment='$comment',
        price='$price' WHERE code=$code ");
        header('Location: index.php');
        exit();
    }
} else {
    $code = $_GET['code'];
    $stmt = $pdo->query("SELECT * FROM goods WHERE code=$code");
    $row = $stmt->fetch();
    $name = $row['name'];
    $comment = $row['comment'];
    $price = $row['price'];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>メンバー修正</title>
<link rel="stylesheet" href="kanri.css">
</head>
<body>
<div class="base">
    <?php if($error) { echo "<span class=\"error\">$error</span>"; } ?>
    <form action="edit.php" method="post">
        <p>
            メンバー名<br>
            <input type="text" name="name" value="<?php echo $name; ?>">
        </p>
        <p>
            メンバー説明<br>
            <textarea name="comment" rows="10" cols="60"><?php echo $comment; ?></textarea>
        </p>
        <p>
            価格<br>
            <input type="text" name="price" value="<?php echo $price; ?>">
        </p>
        <p>
            <input type="hidden" name="code" value="<?php echo $code; ?>">
            <!-- 隠しフィールドに商品コードを格納して、どの商品を修正しているかを判別 -->
            <input type="submit" name="submit" value="更新">
        </p>
    </form>
</div>
<div class="base">
    <a href="index.php">一覧に戻る</a>
</div>
</div>
</body>
</html>