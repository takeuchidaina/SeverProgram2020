<?php

session_start();
if($_POST["OldPass"] == '' || $_POST["NewPass1"] == '' || $_POST["NewPass2"] == ''){
$_SESSION["ErrLog"] = '必須項目未記入';
header('Location: http://localhost/AMS/php/AccountSetting.php');
}

if($_POST["NewPass1"] != $_POST["NewPass2"]){
  $_SESSION["ErrLog"] = '新しいパスワードが一致しません';
  header('Location: http://localhost/AMS/php/AccountSetting.php');
}



?>
