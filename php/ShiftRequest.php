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

?>
  <form action="ShiftRequestCheck.php" method="post">
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

?>

    <tr>
      <td><?php echo$shift[$i]->day;?></td>
      <td><?php echo$shift[$i]->week;?></td>
      <td><input type="checkbox" name="free<?php echo (string)$i;?>" value="1"></td>
      <td><input type="checkbox" name="off<?php echo (string)$i;?>" value="1"></td>
      <td><input type="time" name = "in<?php echo (string)$i;?>"></td>
      <td><input type="time" name = "up<?php echo (string)$i;?>"></td>
      <td><input type="text" name = "memo<?php echo (string)$i;?>"></td>
    </tr>

      <?php
  }?>
  </table>
  <input type="submit" value="送信">
</body>
</html>
