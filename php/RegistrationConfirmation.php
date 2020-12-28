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
}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}

//$_POST のエラーチェック処理

//新規追加のSQL文



?>
</body>
</html>
