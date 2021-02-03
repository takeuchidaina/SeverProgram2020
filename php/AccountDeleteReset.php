<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>AccountD&R</title>
<link rel="stylesheet" href="../css/CSSReader.css">
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>

<h3 class="string--color--lb">アカウント管理</h3>

<?php
$storeName = $_POST["tmpStoreName"];
$KanziName = $_POST["tmpKanziName"];
?>

<div><b class="string--color--or">対象社員名</b></div>
<div>店舗：<?php echo $storeName; ?></div>
<div>名前：<?php echo $KanziName; ?></div>
<p></p>

<form method="POST" action="/AMS/php/ConfirmPasswordReset.php">
  <input type="hidden" name="tmpStoreName" value= <?php echo $storeName; ?>>
  <input type="hidden" name="tmpKanziName" value= <?php echo $KanziName; ?>>
  <button type="submit" onfocus="this.blur();" class="button--whiteLightblue" autofocus=true>パスワードリセット</button>
</form>
対象社員のパスワードをリセットします。

<p> </p>

<form method="POST" action="/AMS/php/ConfirmDelete.php">
  <input type="hidden" name="tmpStoreName" value= <?php echo $storeName; ?>>
  <input type="hidden" name="tmpKanziName" value= <?php echo $KanziName; ?>>
  <button type="submit" onfocus="this.blur();" class="button--whiteLightblue" autofocus=true>　アカウント削除　</button>
</form>
対象社員のアカウントを削除します。

</body>
</html>