<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>AccountSetting</title>
<link rel="stylesheet" href="../css/CSSReader.css">
</head>
<body>
<?php
require 'Header.php';
?>

  <h3 class="string--color--lb">アカウント管理</h3>
  <form method="POST" action="AccountSet.php">
    <p><b class="string--bg--fit">現在のパスワード</b><input type="text" value="" name="OldPass" maxlength="12"></p>
    <p><b class="string--bg--fit">新しいパスワード</b><input type="text" value="" name="NewPass1" maxlength="12"></p>
    <p><b class="string--bg--fit">新しいパスワード</b><input type="text" value="" name="NewPass2" maxlength="12"></p>
    <b><button type="submit" onfocus="this.blur();" class="button--orange" autofocus=true>　変更　 </button></b>
  </form>


  <?php
  if(isset($_SESSION["ErrLog"])){
    echo $_SESSION["ErrLog"];
    unset($_SESSION["ErrLog"]);
  }
    ?>
</body>
</html>
