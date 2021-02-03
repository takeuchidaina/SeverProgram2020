<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>サンプル</title>
</head>
<body>
<?php
$year = date('Y');
$month = date("m");	 // 今日の月を取得する
$day = date("d");	 // 今日の日を取得する
echo "$year 年 $month 月 $day 日<br>"; /*表示*/

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
echo '<form method="POST" action="/AMS/php/rensyu01.php">';
echo '<select name="YM"> ';
for($i=1 ; $i<4 ; $i++){
//  echo $pullDownName[$i] ."<br>";
$tmp = $pullDownValueY[$i] . sprintf('%02d', $pullDownValueM[$i]);
  echo "<option value=\"" . $tmp ."\">". $pullDownName[$i] ."</option>";
}
echo '</select>';
echo '<input type="submit" value="表示"></form>';
echo '<br>';

var_dump($pullDownValueY);

if(isset($_POST['YM'])){
  $_year = substr($_POST['YM'] ,0,4);
  $_month = substr($_POST['YM'] ,4);
}else{
  $_year = $pullDownValueY[0];
  $_month = $pullDownValueM[0];
}
echo '<br>'. $_year . '<br>';
echo $_month . '<br>';

//echo $pullDownName;

/*//pass
echo password_hash("yda474", PASSWORD_DEFAULT);
*/
?>
</body>
</html>
