<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>EmployeeSearch</title>
<link rel="stylesheet" href="../css/CSSReader.css">
<link rel="stylesheet" href="../css/Graph.css">
</head>
<body>
<?php
require 'Header.php';
?>

  <h3 class="string--color--lb">社員検索</h3>
  <form method="POST" action="EmployeeSearch.php">
    <p><b class="string--bg--fit">名前</b><input type="text" value="" name="Name" maxlength="12"></p>
    <p><b class="string--bg--fit">店舗</b><input type="text" value="" name="Store" maxlength="12"></p>
    <b><button type="submit" onfocus="this.blur();" class="button--orange" autofocus=true>　検索　 </button></b>
  </form>
  <p> </p>


  <?php
  if(isset($_SESSION["ErrLog"])){
    echo $_SESSION["ErrLog"];
    unset($_SESSION["ErrLog"]);
  }
/*
if($_POST['Name'] == '' && $_POST['Store'] == ''){
  $_SESSION["ErrLog"] = '必須項目未記入';
  header('Location: '. $_SERVER['PHP_SELF']);
  return false;
}
*/
if(isset($_POST['Store'])){
  if(!is_numeric ( $_POST['Store'] ) && $_POST['Store'] != ''){
    echo '現在店舗は店舗番号にしか対応していません。';
    return false;
  }
}

if(isset($_POST['Name']) && isset($_POST['Store']))
if($_POST['Name'] != '' || $_POST['Store'] != ''){
  require 'Init.php';
  try{
    $pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);

  if($_POST['Name'] != '' && $_POST['Store'] != ''){
    $name = $_POST['Name'] ;
    $store = $_POST['Store'];

    $sqlstr = "
    select *
    from employees
    where Active_flag = true
    and (
      Name_Kanzi like '%$name%' or
      Name_Kana like '%$name%' or
      Belong_Store_Num = $store
    )
    ";

  } else if($_POST['Name'] != ''){
    //名前検索
    $name = $_POST['Name'] ;

    $sqlstr = "
    select *
    from employees
    where Active_flag = true
    and (
      Name_Kanzi like '%$name%' or
      Name_Kana like '%$name%'
    )
    ";
  } else if($_POST['Store'] != ''){
    //店舗検索
    $store = $_POST['Store'];

    $sqlstr = "
    select *
    from employees
    where Active_flag = true
    and (
      Belong_Store_Num = $store
    )
    ";
  }

  }catch(\Exception $e){
      echo $e -> getMessage() . PHP_EOL;
  }

  $result = $pdo->query($sqlstr);

  //debug
  //echo $sqlstr;
/*
  if(!isset($result)){
    $_SESSION["ErrLog"] = '見つかりませんでした';
    header('Location: '. $_SERVER['PHP_SELF']);
    return false;
  }
*/
$tmp = 0;
?>
  <table class="graph-n-l">
    <tr>
      <th>名前</th>
      <th>店舗</th>
      <th>　　</th>
      <th>　　</th>
    </tr>
<?php

  $res = $pdo->query($sqlstr);

  foreach ($res as $value) {
    $tmp++;
    $storeName = Search_Store_Name($pdo, $value['Belong_Store_Num']);
    //if($storeName != $_store_name) break;
    $KanziName = $value['Name_Kanzi'];

    ?>
      <tr>
        <td><?php echo $KanziName ?></td>
        <td><?php echo $storeName ?></td>
        <td>
          <form method="POST" action="/AMS/php/MyPage.php">
            <button type="submit" onfocus="this.blur();" class="button--whiteOrange" autofocus=true>閲覧</button>
          </form>
        </td>

        <td>
          <form method="POST" action="/AMS/php/AccountDeleteReset.php">
            <input type="hidden" name="tmpStoreName" value= <?php echo $storeName; ?>>
            <input type="hidden" name="tmpKanziName" value= <?php echo $KanziName; ?>>
            <input type="hidden" name="tmpStoreNum" value= <?php echo $value['Belong_Store_Num']; ?>>
            <button type="submit" onfocus="this.blur();" class="button--whiteLightblue" autofocus=true>編集</button>
          </form>
        </td>
      </tr>
    <?php
  }
  
  echo "</table>";
  echo $tmp.'件見つかりました';
}

//デバッグでIDを表示したい
//そのIDで色々やる

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
関数：Search_Employees_Num($pdo, $_employees_name)
概要：社員名から社員番号を検索する
引数：データベース, 社員名前
戻値：社員番号
*****************************************************************************/
function Search_Employees_Num($pdo, $_employees_name){
  $sql = "select * from employees where Name_kanzi = $_employees_name";
  $res = $pdo->query($sql);
  $value = null;
  foreach ($res as $tmp_value) {
    $value = $tmp_value['ID'];
  }

  return $value;
}

?>
</body>
<?php
  if(isset($_SESSION["ErrLog"])){
    echo $_SESSION["ErrLog"];
    unset($_SESSION["ErrLog"]);
  }
?>
</html>