<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>NewRegistation</title>
</head>
<body>
<?php
require 'Header.php';

require 'Init.php';

  try{
$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);
//変数になってるやつをInit.phpなどで宣言しておく
//データベースアクセス用変数

//$stmt = $pdo->prepare('select * from store');
//SQL文
/*
$ret = $pdo->query("select * from store");


echo "num  name<br>";
if( $ret != null ){
	while($a = $ret->fetch(PDO::FETCH_ASSOC)){
		echo $a['Store_Num']." ".$a['Store_Name']."<br>"; //結果取得
	}
}
*/
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//DBアクセス
}catch(\Exception $e){
  echo $e -> getMessage() . PHP_EOL;
}

?>
新規登録画面<br>
<form method="POST" action="/AMS/php/The_Finish_OSIMAIDAYO.php">
  <p>名前:<input type="text" value="" name="Name_k" maxlength="12"></p>
  <p>よみがな:<input type="text" value="" name="Name_y" maxlength="12"></p>
  <p>電話番号:<input type~"text" value"" name="Tel" maxlength="11"></p>
  <p>社員種別:<select name="Permissions" >
    <option value="General"> 社員 </option>
    <option value="Manager"> マネージャー</option>
  </select>
  </p>
  <p>所属店舗:<select name="BelongStoreNum">
    <?php
  $ret = $pdo->query("select * from store");
    while($a = $ret->fetch(PDO::FETCH_ASSOC)){
      echo $a['Store_Num']." ".$a['Store_Name']."<br>";
      echo "<option value=\"" . $a['Store_Num'] ."\">". $a['Store_Name']."</option>";
    }
      ?>
    </select>
  </p>



  <input type="submit" value="登録">
</form>
<?php
if(isset($_SESSION["ErrLog"])){
  echo $_SESSION["ErrLog"];
  unset($_SESSION["ErrLog"]);
}
?>

</body>
</html>
