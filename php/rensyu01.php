<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>サンプル</title>
</head>
<body>
<?php
$month = date("m");	 // 今日の月を取得する
$day = date("d");	 // 今日の日を取得する
echo "今日は $month 月 $day 日です<br>"; /*表示*/

echo password_hash("yda474", PASSWORD_DEFAULT);

?>
</body>
</html>
