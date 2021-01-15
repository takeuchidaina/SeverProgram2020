<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>LogIn</title>
</head>
<body>
  <h2>〇〇勤務時間調整システム</h2>
<form method="POST" action="AMS/php/SignIn.php">
  <p><b class="string--bg">ID</b><input type="text" value="" name="ID" maxlength="12"></p>
  <p><b class="string--bg">パスワード</b><input type="text" value="" name="Pass" maxlength="12"></p>
  <b><button type="submit" onfocus="this.blur();" class="button--orange" autofocus=true>ログイン </button></b>

</form>

  <?php
  session_start();
  if(isset($_SESSION["LoginErr"])){
    echo $_SESSION["LoginErr"];
    unset($_SESSION["LoginErr"]);
  }
   echo "";
    ?>
</body>
</html>
