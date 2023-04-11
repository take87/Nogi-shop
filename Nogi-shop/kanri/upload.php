<?php
define("FILE_DIR", "/Applications/MAMP/htdocs/");
# 仮にimages/test/にファイルをアップロードする設定
# サーバーに存在するディレクトリを指定するようにする

require 'common.php';
$error = '';
if(@$_POST['submit']) {
    $code = $_POST['code'];
    if(move_uploaded_file($_FILES['pic']['tmp_name'],FILE_DIR."images/$code.jpg")) {
        # move_uploaded_fileでファイルをアップロード(サーバーのディレクトリへ保存)
        # move_uploaded_file(移動前のパス, 移動先のパス)
        # 移動前のパス: $_FILES['項目名']['tmp_name']が基本,<input name=項目名>
        header('Location: index.php');
        exit();
    } else {
        $error .= 'ファイルを選択してください。<br>';
    }
} else {
    $code = $_GET['code'];
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>メンバー画像アップロード</title>
<link rel="stylesheet" href="kanri.css">
</head>
<body>
<div class="base">
    <?php if($error) { echo "<span class=\"error\">$error</span>"; } ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
     <!-- 画像アップロードなのでenctype="multipart/form-data"が必要 -->
        <p>
            メンバー画像(JPEGのみ)<br>
            <input type="file" name="pic">
        </p>
        <p>
            <input type="hidden" name="code" value="<?php echo $code ?>">
            <input type="submit" name="submit" value="追加">
        </p>
    </form>
</div>
<div class="base">
    <a href="index.php">一覧に戻る</a>
</div>
</body>
</html>