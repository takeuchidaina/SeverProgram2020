<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>初期化確認</title>
<link rel="stylesheet" href="../css/CSSReader.css">
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>

<h3 class="string--color--lb">パスワード初期化確認</h3>

<?php
$storeName = $_POST["tmpStoreName"];
$KanziName = $_POST["tmpKanziName"];
?>

<p>下記社員のパスワードを初期化します</p>
<div>店舗：<?php echo $storeName; ?></div>
<div>名前：<?php echo $KanziName; ?></div>
<p></p>

<form method="POST" action="/AMS/php/PasswordResetProcess.php" style="display: inline">
  <input type="hidden" name="tmpStoreName" value= <?php echo $storeName; ?>>
  <input type="hidden" name="tmpKanziName" value= <?php echo $KanziName; ?>>
  <button type="submit" onfocus="this.blur();" class="button--orange" autofocus=true>　確認　</button>
</form>

<form method="POST" action="/AMS/php/AccountDeleteReset.php" style="display: inline">
  <button type="submit" onfocus="this.blur();" class="button--whiteOrange" autofocus=true>　戻る　</button>
</form>

<p></p>
<div class="string--color--lb">パスワードがリセットされるとデフォルトのパスワードに</div>
<div class="string--color--lb">設定されデフォルトのパスワードは「PW社員番号6桁」になります。</div>

</body>
</html>