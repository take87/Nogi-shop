<?php
require 'common.php';
# require: 外部ファイルを読み込んで実行する
$pdo = connect();
$stmt = $pdo->query("SELECT * FROM goods");
$goods = $stmt->fetchAll();
# goodsテーブルの情報をすべて配列として取得し、$goodsに代入
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Nogi-shop</title>
<link rel="stylesheet" href="shop.css">
</head>
<body>
<h1>Nogi-shop</h1>
<table>
<?php foreach($goods as $g) :?>
<tr>
    <td>
        <?php echo img_tag($g['code']) ?>
        <!-- goodsテーブルのcode -->
    </td>
    <td>
        <p class="goods"><?php echo $g['name'] ?></p>
        <p><?php echo nl2br($g['comment']) ?></p>
        <!-- nl2br: \nを改行として出力してくれる -->
    </td>
    <td width="80">
        <p><?php echo $g['price'] ?> 円</p>
        <form action="cart.php" method="post">
            <select name="num">
                <?php 
                // 0~9までの選択肢を作成(商品の個数指定)
                for($i=0; $i<=9; $i++) {
                    echo "<option>$i</option>";
                }
                ?>
            </select>
            <input type="hidden" name="code" value="<?php echo $g['code'] ?>">
            <input type="submit" name="submit" value="カートへ">
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>