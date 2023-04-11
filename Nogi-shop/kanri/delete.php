<?php
require 'common.php';
$pdo = connect();

// GETパラメータで渡された商品コードの商品を削除
$stmt = $pdo->query("DELETE FROM goods WHERE code={$_GET['code']}");

header('Location: index.php');
?>