<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>SignIn</title>
</head>
<body>

  <?php


session_start();

require 'Init.php';

  try{
$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);
//変数になってるやつをInit.phpなどで宣言しておく
//データベースアクセス用変数

$stmt = $pdo->prepare('select * from employees where Employees_Num = ?');
//SQL文


 $stmt->execute([$_POST['ID']]);
//先ほどの文にformで受け取ったIDを接続

$row = $stmt->fetch(PDO::FETCH_ASSOC);
//DBアクセス
}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}

//IDが一致しない場合
if (!isset($row['Employees_Num'])) {
  echo 'ID又はパスワードが間違っています。1';
  header('Location: http://localhost/index.php');
  //require '../../Index.php';
  return false;
}

//IDに対してパスワードがあってる場合
//if (password_verify($_POST['Pass'], $row['Password'])) {
if(password_verify($_POST['Pass'],$row['Password'])){
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['ID'] = $row['ID'];
  require 'MyPage.php';
} else {
  echo 'ID又はパスワードが間違っています。2';
  header('Location: http://localhost/index.php');
  //require '../../Index.php';
  return false;
}

   echo "";
    ?>
</body>
</html>
