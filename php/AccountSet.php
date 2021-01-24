<?php

session_start();
if($_POST["OldPass"] == '' || $_POST["NewPass1"] == '' || $_POST["NewPass2"] == ''){
$_SESSION["ErrLog"] = '必須項目未記入';
header('Location: http://localhost/AMS/php/AccountSetting.php');
return false;
}

if($_POST['NewPass1'] != $_POST['NewPass2']){
  $_SESSION['ErrLog'] = '新しいパスワードが一致しません';
  header('Location: http://localhost/AMS/php/AccountSetting.php');
  return false;
}
require 'Init.php';

  try{
$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);

$sqlstr = 'select * from employees where ID = ?';

$stmt = $pdo->prepare($sqlstr);

$stmt->execute([$_SESSION['ID']]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
  $_SESSION["LoginErr"] = $e -> getMessage() . PHP_EOL;
  header('Location: http://localhost/index.php');
}

if (!isset($row['ID'])) {
  $_SESSION["ErrLog"] = 'aaaa';
  header('Location: http://localhost/AMS/php/AccountSetting.php');
  //require '../../Index.php';
  return false;
}



//if(password_verify($pass,$row['Password'])){
  if(password_verify($_POST['OldPass'],$row['Employess_Password'])){
  $pass = password_hash($_POST['NewPass1'], PASSWORD_DEFAULT);
  $sqlstr = 'update employees set First_Flag = false , Employess_Password = "' . $pass . '" where ID = '.$_SESSION['ID'].';';
  $result = $pdo->query($sqlstr);
  $_SESSION["ErrLog"] = 'パスワードの変更完了';
  header('Location: http://localhost/AMS/php/AccountSetting.php');
  echo $sqlstr;
}else{
  $_SESSION["ErrLog"] = 'パスワードが一致しません';
  header('Location: http://localhost/AMS/php/AccountSetting.php');
}





//SQL文

 //$stmt->execute([$_POST['ID']]);
//先ほどの文にformで受け取ったIDを接続
/*
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//DBアクセス
}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}
*/




?>
