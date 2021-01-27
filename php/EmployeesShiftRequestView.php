<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ShiftRequestView</title>
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>


  <h3>ここから内容</h3>
  <h3>社員毎のシフト希望一覧</h3>


<?php
  //$_day = '18';
  $_month = '12';
  $_year = '2020';
  $_employees_num = 7;


  $pdo = connectDB();

  $sql = "
  select *
  from shift_hope
  where Active_flag = true
  and Employees_ID = $_employees_num
  ";

  $res = $pdo->query($sql);

  ?>

  <table border="1">
    <tr>
      <th>日</th>
      <th>曜</th>
      <th>店舗</th>
      <th>出勤時間</th>
      <th>退勤時間</th>
      <th>登録日時</th>
    </tr>

<?php

  foreach ($res as $value) {

    $day = substr($value['IN_Time'], 8, 2);
    //if($day != $_day) break;

    $month = substr($value['IN_Time'], 5, 2);
    if($month != $_month) break;

    $year = substr($value['IN_Time'], 0, 4);
    if($year != $_year) break;

    $datetime = new DateTime($value['IN_Time']);
    $week = (int)$datetime->format('w');
    $weeks = array("日", "月", "火", "水", "木", "金", "土");
    $week = $weeks[$week];

    $employeesName = Search_Employees_Name($pdo, $value['Employees_ID']);

    $storeName = Search_Store_Name($pdo, $value['Store_Num']);

    $inTime = substr($value['IN_Time'], 11, 5);
    $upTime = substr($value['UP_Time'], 11, 5);

 ?>

    <tr>
      <td><?php echo "$day"; ?></td>
      <td><?php echo "$week"; ?></td>
      <td><?php echo "$storeName"; ?></td>
      <td><?php echo "$inTime"; ?></td>
      <td><?php echo "$upTime"; ?></td>
      <td><?php echo "$value[Date_Time]"; ?></td>
    </tr>
<?php
  }

 ?>
</table>
</body>
</html>
