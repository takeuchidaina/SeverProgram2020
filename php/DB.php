<?php

Main();

function Main(){
  $pdo = null;  // データベース接続
  $pdo = connectDB();

  $tmp = 1234;
  Employees_Name($pdo, 'アド', '', $tmp);
}

/*****************************************************************************
関数：ShiftHope_Employees($pdo, $_employees_num, $_year, $_month)
概要：社員の名前検索
引数：データベース, 社員番号, 年, 月
戻値：なし
*****************************************************************************/
function Employees_Name($pdo, $_employees_name, $_store_name, $_store_num){

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

  echo "
  <table border = '1'>
    <tr>
      <th>名前</th>
      <th>店舗</th>
    </tr>
  ";

  foreach ($res as $value) {

    $storeName = Search_Store_Name($pdo, $_store_num);
    if($storeName != $_store_name) break;


    echo "
    <tr>
      <td>$value[Name_Kanzi]</td>
      <td>$storeName</td>
    </tr>
    ";
  }

  echo "</table>";

}

/*****************************************************************************
関数：ShiftHope_Employees($pdo, $_employees_num, $_year, $_month)
概要：指定社員番号のシフト希望一覧を表示
引数：データベース, 社員番号, 年, 月
戻値：なし
*****************************************************************************/
function ShiftHope_Employees($pdo, $_employees_num, $_year, $_month){

  // 変数の初期化
  $sql = null;  // SQL文格納
  $res = null;  // データ格納

  $sql = "
  select *
  from shift_hope
  where Active_flag = true
  and ID = $_employees_num
  ";

  $res = $pdo->query($sql);

  echo "
  <table border = '1'>
    <tr>
      <th>日</th>
      <th>曜</th>
      <th>店舗</th>
      <th>出勤時間</th>
      <th>退勤時間</th>
      <th>登録日時</th>
    </tr>
  ";

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

    echo "
    <tr>
      <td>$date</td>
      <td>$week</td>
      <td>$storeName</td>
      <td>$inTime</td>
      <td>$upTime</td>
      <td>$value[Date_Time]</td>
    </tr>
    ";
  }

  echo "</table>";

}

/*****************************************************************************
関数：Shift_Employees($pdo, $_employees_num, $_year, $_month)
概要：指定社員番号のシフト一覧を表示
引数：データベース, 社員番号, 年, 月
戻値：なし
*****************************************************************************/
function Shift_Employees($pdo, $_employees_num, $_year, $_month){

  // 変数の初期化
  $sql = null;  // SQL文格納
  $res = null;  // データ格納

  $sql = "
  select *
  from shift
  where Active_flag = true
  and ID = $_employees_num
  ";

  $res = $pdo->query($sql);

  echo "
  <table border = '1'>
    <tr>
      <th>日</th>
      <th>曜</th>
      <th>店舗</th>
      <th>出勤時間</th>
      <th>退勤時間</th>
      <th>入力者</th>
      <th>登録日時</th>
    </tr>
  ";

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
    $employeesName = Search_Employees_Name($pdo, $value['Input_Employees_Num']);

    echo "
    <tr>
      <td>$date</td>
      <td>$week</td>
      <td>$storeName</td>
      <td>$inTime</td>
      <td>$upTime</td>
      <td>$employeesName</td>
      <td>$value[Date_Time]</td>
    </tr>
    ";
  }

  echo "</table>";

}

/*****************************************************************************
関数：Search_Employees_Name($pdo, $_employees_num)
概要：店舗番号から店舗名を検索する
引数：データベース, 店舗番号
戻値：店舗名
*****************************************************************************/
function Search_Store_Name($pdo, $_store_num){
  $sql = "select * from store where Store_Num = $_store_num";
  $res = $pdo->query($sql);
  $value = null;
  foreach ($res as $tmp_value) {
    $value = $tmp_value['Store_Name'];
  }

  return $value;
}

/*****************************************************************************
関数：Search_Employees_Name($pdo, $_employees_num)
概要：社員番号から社員名を検索する
引数：データベース, 社員番号
戻値：社員名（漢字）
*****************************************************************************/
function Search_Employees_Name($pdo, $_employees_num){
  $sql = "select * from employees where ID = $_employees_num";
  $res = $pdo->query($sql);
  $value = null;
  foreach ($res as $tmp_value) {
    $value = $tmp_value['Name_Kanzi'];
  }

  return $value;
}

/*****************************************************************************
関数：Search_Employees_Name($pdo, $_employees_num)
概要：社員番号から社員名を検索する
引数：データベース, 社員番号
戻値：社員名（漢字）
*****************************************************************************/
function Search_Store_Num($pdo, $_store_name){
  $sql = "select * from store where Active_flag = true and Store_Name like '%$_store_name%'";
  $res = $pdo->query($sql);
  $value = null;
  foreach ($res as $tmp_value) {
    $value = $tmp_value['Store_Num'];
  }

  return $value;
}

/////////////////////////// PDO MySQL接続
function connectDB(){

//ユーザ名やDBアドレスの定義
    $dsn = 'mysql:dbname=shift_management;host=localhost;charset=utf8';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);

        //echo "接続！！";
    } catch (PDOException $e) {
        exit('' . $e->getMessage());
    }

    return $pdo;
}
