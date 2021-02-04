<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>削除確認</title>
<link rel="stylesheet" href="../css/CSSReader.css">
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>

<h3 class="string--color--lb">アカウント削除確認</h3>

<?php
$storeName = $_POST["tmpStoreName"];
$KanziName = $_POST["tmpKanziName"];
$StoreNum = $_POST["tmpStoreNum"];
?>

<p>下記社員のデータを削除します</p>
<div>店舗：<?php echo $storeName; ?></div>
<div>名前：<?php echo $KanziName; ?></div>
<p></p>

<form method="POST" action="/AMS/php/AccountDeleteProcess.php"  style="display: inline">
  <input type="hidden" name="tmpKanziName" value= <?php echo $KanziName; ?>>
  <input type="hidden" name="tmpStoreNum" value= <?php echo $StoreNum; ?>>
  <button type="submit" onfocus="this.blur();" class="button--orange" autofocus=true>　確認　</button>
</form>

<form method="POST" action="/AMS/php/AccountDeleteReset.php" style="display: inline">
  <button type="submit" onfocus="this.blur();" class="button--whiteOrange" autofocus=true>　戻る　</button>
</form>

<?php
  if(isset($_SESSION["ErrLog"])){
    echo $_SESSION["ErrLog"];
    unset($_SESSION["ErrLog"]);
  }
?>

</body>
</html>