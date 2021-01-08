<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>LogIn</title>
</head>
<body>
  <h2>〇〇勤務時間調整システム</h2>
<form method="POST" action="AMS/php/SignIn.php">
  <p>ID:<input type="text" value="" name="ID" maxlength="12"></p>
  <p>パスワード:<input type="text" value="" name="Pass" maxlength="12"></p>
  <input type="submit" value="ログイン">
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
