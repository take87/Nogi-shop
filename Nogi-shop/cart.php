<?php
require 'common.php';
$rows = array();
# $rows配列にカートに入れた商品データ(各カラムの値と数量が入る)を格納
$sum = 0;
# $sumにカートの合計金額が入る

// データベースに接続
$pdo = connect();

// $_SESSION['cart']に配列として、キーが商品コードで値が数量のカート情報が入る
if(empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(@$_POST['submit']) {
    # @: @付きの式で生成されたエラーは返り値が0(false,Null)になる

    // $_SESSION['cart'][商品コード]に、その商品の数量を入れる
    @$_SESSION['cart'][$_POST['code']] += $_POST['num'];
}

// カートに入っている商品の数だけループする
foreach($_SESSION['cart'] as $code => $num) {
    # 商品コードが$codeに、商品の個数が$numに入る
    $stmt = $pdo->prepare("SELECT * FROM goods WHERE code = ?");
    $stmt->execute(array($code));
    $row = $stmt->fetch();  # 配列型式でデータを一つ取得し、$rowsに代入する

    $stmt->closeCursor();  
    # closeCursor: 再びSQL文を発行できるようにサーバへの接続を解放する。
    # これを行わないと環境によってはエラーが起きる場合がある

    $row['num'] = strip_tags($num);
    $sum += $num * $row['price']; # 合計 = 数 × 価格 
    $rows[] = $row; # 商品データの入った配列($row)を$rows配列に追加
    # ループするのでどんどん追加されていく
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>カート | Nogi-shop</title>
<link rel="stylesheet" href="shop.css">
</head>
<body>
<h1>cart</h1>
<table>
    <tr><th>商品名</th><th>単価</th><th>数量</th><th>小計</th></tr>
    <?php foreach($rows as $r): ?>
        <tr>
            <td><?php echo $r['name'] ?></td>
            <td><?php echo $r['price'] ?></td>
            <td><?php echo $r['num'] ?></td>
            <td><?php echo $r['price'] * $r['num'] ?>円</td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan='2'> </td>
        <td><strong>合計</strong></td>
        <td><?php echo $sum ?>円</td>
    </tr>
</table>
<div class="base">
    <a href="index.php">お買い物に戻る</a>
    <a href="cart_empty.php">カートを空にする</a>
    <a href="buy.php">購入する</a>
</div>
</body>
</html>