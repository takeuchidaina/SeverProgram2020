<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>MyPage</title>
<link rel="stylesheet" href="../css/CSSReader.css">
<link rel="stylesheet" href="../css/Graph.css">
<link rel="stylesheet" href="../css/pulldownList.css">
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>


  <h3 class="string--color--lb">シフト一覧</h3>


  <?php

  $year = date('Y');
  $month = date("m");	 // 今日の月を取得する
  $day = date("d");	 // 今日の日を取得する
  //echo "$year 年 $month 月 $day 日<br>"; /*表示*/

  //debug
  //$month = 12;

  $month += 0;
  for($i=1 ; $i<4 ; $i++){
    if($month > 12){
      $year++;
      $month -= 12;
    }
    $pullDownName[$i] = $year . '年' . $month . '月';
    $pullDownValueY[$i] = $year;
    $pullDownValueM[$i] = $month;
    $month++;
  }
  echo '<form method="POST" action="/AMS/php/MyPage.php">';
  echo '<select class="pulldown-lb" name="YM"> ';
  for($i=1 ; $i<4 ; $i++){
  //  echo $pullDownName[$i] ."<br>";
  $tmp = $pullDownValueY[$i] . sprintf('%02d', $pullDownValueM[$i]);
    echo "<option value=\"" . $tmp ."\">". $pullDownName[$i] ."</option>";
  }
  echo '</select>';
  echo '<button type="submit" onfocus="this.blur();" class="button--orange" autofocus=true> 表示  </button></form>';
  echo '<br>';

  //var_dump($pullDownValueY);

  if(isset($_POST['YM'])){
    $_year = substr($_POST['YM'] ,0,4);
    $_month = substr($_POST['YM'] ,4);
  }else{
    if(isset($pullDownValueY[0]) && isset($pullDownValueM[0])){
    $_year = $pullDownValueY[0];
    $_month = $pullDownValueM[0];
  }else{
    $_year = $year;
    $_month = $month - 3;
  }
  }


  // デバッグ用  {$_SESSION['ID']}
  //$_month = '12';
  //$_year = '2020';

  $pdo = connectDB();

  $id = $_SESSION['ID'];
  $sql = "
  select *
  from shift
  where Active_flag = true
  and Employees_ID = $id
  ORDER BY shift.IN_Time ASC";

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
    if($month != $_month) continue;

    $year = substr($value['IN_Time'], 0, 4);
    if($year != $_year) continue;

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
