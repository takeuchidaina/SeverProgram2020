<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>The_Finish_OSIMAIDAYO</title>
</head>
<body>
testetttttt
  <?php

session_start();
if($_POST["Name_k"] == '' || $_POST["Name_y"] == '' || $_POST["Permissions"] == '' || $_POST["Tel"] == ''){
  $_SESSION["ErrLog"] = '必須項目未記入';
  header('Location: http://localhost/AMS/php/NewRegistration.php');
}



require 'Init.php';

  try{
$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);
//変数になってるやつをInit.phpなどで宣言しておく
//データベースアクセス用変数
$pass = password_hash("abc123", PASSWORD_DEFAULT);

$sqlstr = 'insert into employees values(0,"' .
  $_POST["Name_k"] .
  '","'.
  $_POST["Name_y"] .
  '","'.
  $pass .
  '","'.
  $_POST["Permissions"] .
  '",'.
  $_POST["BelongStoreNum"].
  ',1,"' .
  $_POST["Tel"].
  '",cast(now() as datetime),1' .
  ');';


$result = $pdo->query($sqlstr);
//SQL文

echo $sqlstr;
 //$stmt->execute([$_POST['ID']]);
//先ほどの文にformで受け取ったIDを接続
/*
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//DBアクセス
}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}
*/

//成功時IDPW表示用！
$sqlstr2 = "select ID from employees ORDER BY ID DESC LIMIT 1";
$result2 = $pdo->query($sqlstr2);
foreach ($result2 as $val) {
  $resultStr = $val['ID'];
}

$_SESSION["SuccessFlg"] = "Success!<br>IDは[$resultStr]、<br>初期PWは[abc123]です。";

}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}
header('Location: http://localhost/AMS/php/NewRegistration.php');
return false;



/*
//IDが一致しない場合
if (!isset($row['Employees_Num'])) {
  echo 'ID又はパスワードが間違っています。1';
  require 'LogIn.php';
  return false;
}

//IDに対してパスワードがあってる場合
//if (password_verify($_POST['Pass'], $row['Password'])) {
if($_POST['Pass'] == $row['Password']){
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['ID'] = $row['ID'];
  require 'MyPage.php';
} else {
  echo 'ID又はパスワードが間違っています。2';
  require 'LogIn.php';
  return false;
}
*/
   echo "";
    ?>
</body>
</html>
