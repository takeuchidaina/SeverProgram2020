<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ShiftRequest</title>
</head>
<body>
<?php
require 'Header.php';
require 'DB.php';
?>

  <h3>シフト希望入力</h3>

<?php

  // デバッグ用
  $_year = '2018';
  $_month = '12';
  $_day = 0;
  $_employees_num = 7;

  $pdo = connectDB();

?>
<form action = "ShiftRequest.php" method = “get”>
  <table border="1">
    <tr>
      <th>日</th>
      <th>曜</th>
      <th>FREE</th>
      <th>OFF</th>
      <th>出勤時間</th>
      <th>退勤時間</th>
      <th>メモ</th>
    </tr>

<?php

  $shift = array(0);

  $double_check_flg = false;
  $null_check_flg = false;

  for ($i=1; $i < 31; $i++) {
    //$array[$i] = array( array('日' => $i+1, '曜' => '', 'FREE' => false, 'OFF' => false, 'IN' => '', 'UP' => '', 'メモ' => ''));
    //$array[$i] = array( array($i+1, '', false, false, '', '', ''));

    $day = $i;
    $day = str_pad((string)$day, 2, '0', STR_PAD_LEFT);

    $date = $_year .'-'. $_month .'-'. $day;
    //echo "$date";
    $now = new DateTime($date.' 00:00:00');
    //echo "$now";
    //$array = array();
    //$array[$i] = new cShiftRequest($now);
    $shift[] = new cShiftRequest($now);

    $free = null;
    if(isset($_POST['free'.(string)$i])){
      $free = '〇';
      $shift[$i]->free = true;
    }

    $off = null;
    if(isset($_POST['off'.(string)$i])){
      $off = '〇';
      $shift[$i]->off = true;
    }

    if(isset($_POST['in'.(string)$i])){
      $shift[$i]->in = $_POST['in'.(string)$i];
    }

    if(isset($_POST['up'.(string)$i])){
      $shift[$i]->up = $_POST['up'.(string)$i];
    }

    if(isset($_POST['memo'.(string)$i])){
      $shift[$i]->memo = $_POST['memo'.(string)$i];
    }

    if($free == '〇' && $off == '〇'){
      $double_check_flg = true;
    }

    if($free == null && $off == null && $shift[$i]->in == null && $shift[$i]->up == null){
      $null_check_flg = true;
    }
?>

    <tr>
      <td><?php echo$shift[$i]->day;?></td>
      <td><?php echo$shift[$i]->week;?></td>
      <td><?php echo$free;?></td>
      <td><?php echo$off;?></td>
      <td><?php echo$shift[$i]->in;?></td>
      <td><?php echo$shift[$i]->up;?></td>
      <td><?php echo$shift[$i]->memo;?></td>
    </tr>
      <?php
  }?>
  </table>
  <?php

  if($double_check_flg != true && $null_check_flg != true){

    $pdo = connectDB();

    for ($i=1; $i < 31; $i++) {

    $sql = "
    insert into shift_hope (Store_Num, Employees_ID, IN_Time, UP_Time, Memo)
      values
      (1234, 7, ".$shift[$i]->in.",".$shift[$i]->up.",".$shift[$i]->memo.")
    ";
    if($shift[$i]->free == 1){
      $sql = "
      insert into shift_hope (Store_Num, Employees_ID, IN_Time, UP_Time, Memo)
        values
        (1234, 7, 'FREE','',".$shift[$i]->memo.")
      ";
    }
    if($shift[$i]->off == 1){
      $sql = "
      insert into shift_hope (Store_Num, Employees_ID, IN_Time, UP_Time, Memo)
        values
        (1234, 7, 'OFF','',".$shift[$i]->memo.")
      ";
    }

    //$res = $pdo->query($sql);

  }

    echo "上記の内容で提出しました。";
  }
  else{
    if($double_check_flg == true){
      echo "FREEとOFFが設定されている箇所があります。<br>";
    }
    if($null_check_flg == true){
      echo "入力されていない箇所があります。<br>";
    }
  }

  ?>



</body>
</html>
