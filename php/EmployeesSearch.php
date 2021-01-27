<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>EmployeesSearch</title>
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>


  <h3>ここから内容</h3>
  <h3>社員検索</h3>

<?php

  // デバッグ用
  $_employees_name = "あど";
  $_store_num = -0000;


  $pdo = connectDB();

  // 変数の初期化
  $sql = null;  // SQL文格納
  $res = null;  // データ格納

  $sql = "
  select *
  from employees
  where Active_flag = true
  and (
    Name_Kanzi like '%$_employees_name%' or
    Name_Kana like '%$_employees_name%' or
    Belong_Store_Num = $_store_num
  )
  ";


  $res = $pdo->query($sql);

?>

  <table border = '1'>
    <tr>
      <th>名前</th>
      <th>店舗</th>
    </tr>

<?php

  foreach ($res as $value) {

    $storeName = Search_Store_Name($pdo, $value['Belong_Store_Num']);
    //if($storeName != $_store_name) break;

?>
    <tr>
      <td><?php echo "$value[Name_Kanzi]" ?></td>
      <td><?php echo "$storeName" ?></td>
    </tr>

<?php } ?>

  </table>
</body>
</html>
