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

require 'Init.php';

  try{
$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);
//変数になってるやつをInit.phpなどで宣言しておく
//データベースアクセス用変数
$pass = password_hash("abc123", PASSWORD_DEFAULT);

$sqlstr = 'insert into employees values(0,444444,"' .
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
}catch(\Exception $e){

}

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