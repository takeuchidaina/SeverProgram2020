<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>EmployeePage</title>
<link rel="stylesheet" href="../css/CSSReader.css">
<link rel="stylesheet" href="../css/Graph.css">
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>


  <h3 class="string--color--lb">社員の個人ページ</h3>


  <?php

  // デバッグ用  {$_SESSION['ID']}
  $_month = '12';
  $_year = '2020';


  $pdo = connectDB();

  $sql = "
  select *
  from shift
  where Active_flag = true
  and Employees_ID = 7
  ";

  $res = $pdo->query($sql);

  ?>
  <table class="graph-n-l">
    <tr>
      <th>日</th>
      <th>曜</th>
      <th>店舗</th>
      <th>出勤時間</th>
      <th>退勤時間</th>
      <th>入力者</th>
      <th>登録日時</th>
    </tr>

    <?php

  foreach ($res as $value) {

    $month = substr($value['IN_Time'], 5, 2);
    if($month != $_month) break;

    $year = substr($value['IN_Time'], 0, 4);
    if($year != $_year) break;

    $date = substr($value['IN_Time'], 8, 2);

    $datetime = new DateTime($value['IN_Time']);
    $week = (int)$datetime->format('w');
    $weeks = array("日", "月", "火", "水", "木", "金", "土");
    $week = $weeks[$week];

    $storeName = Search_Store_Name($pdo, $value['Store_Num']);
    $inTime = substr($value['IN_Time'], 11, 5);
    $upTime = substr($value['UP_Time'], 11, 5);
    $employeesName = Search_Employees_Name($pdo, $value['Input_Employees_ID']);

    ?>


    <tr>
      <td><?php echo "$date"; ?></td>
      <td><?php echo "$week"; ?></td>
      <td><?php echo "$storeName"; ?></td>
      <td><?php echo "$inTime"; ?></td>
      <td><?php echo "$upTime"; ?></td>
      <td><?php echo "$employeesName"; ?></td>
      <td><?php echo "$value[Date_Time]"; ?></td>
    </tr>

    <?php
  }
  ?>

  </table>
</body>
</html>
