<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>SignIn</title>
</head>
<body>

  <?php


session_start();


  try{
//$pdo = new PDO(DSN, DB_USER, DB_PASS);
//変数になってるやつをInit.phpなどで宣言しておく
//データベースアクセス用変数

//$stmt = $pdo->prepare('select * from userDeta where id = ?');
//SQL文

// $stmt->execute([$_POST['ID']]);
//先ほどの文にformで受け取ったIDを接続

//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//DBアクセス
}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}

//IDが一致しない場合
if (!isset($row['id'])) {
  echo 'ID又はパスワードが間違っています。';
  return false;
}

//IDに対してパスワードがあってる場合
if (password_verify($_POST['password'], $row['password'])) {
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['ID'] = $row['id'];
  echo 'ログインしました';
} else {
  echo 'ID又はパスワードが間違っています。';
  return false;
}

   echo "";
    ?>
</body>
</html>
