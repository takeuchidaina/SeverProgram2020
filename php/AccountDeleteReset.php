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

<div><b class="string--color--or">対象社員名</b></div>
<div>店舗：<?php echo $_SESSION['tmpStoreName'] ?></div>
<div>名前：<?php echo $_SESSION['tmpKanziName'] ?></div>
<p></p>

<form method="POST" action="/AMS/php/ConfirmPasswordReset.php">
  <button type="submit" onfocus="this.blur();" class="button--whiteLightblue" autofocus=true>パスワードリセット</button>
</form>
対象社員のパスワードをリセットします。

<p> </p>

<form method="POST" action="/AMS/php/ConfirmDelete.php">
  <button type="submit" onfocus="this.blur();" class="button--whiteLightblue" autofocus=true>　アカウント削除　</button>
</form>
対象社員のアカウントを削除します。

</body>
</html>