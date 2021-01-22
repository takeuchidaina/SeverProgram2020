<?php
session_start();
if(!isset($_SESSION['ID'])){
  $_SESSION["LoginErr"] = 'タイムアウトエラー';
  header('Location: http://localhost/index.php');
}

 ?>
<header>
  <link rel="stylesheet" href="../css/header.css">
  <!--ヘッダー部分-->
  <div class="header">
    <!--ヘッダー部分上-->
    <div class="headline">
      <span class="left">

        ログインID:<?php echo sprintf("%06d",$_SESSION['ID']); ?><br> <!--ID-->
        名前：<?php echo $_SESSION['NAME']; ?>      <!--name-->
      </span>

      <span class="center">
        AMS勤務時間管理システム
      </span>

      <span class="right">
        ページ更新<br>
        <?php
        date_default_timezone_set('Asia/Tokyo');
        echo date("Y/m/d H:i");
        ?>
      </span>
    </div>

    <!--ヘッダー部分下-->
    <table class="header_table">
      <tr>
        <td> <a href= "MyPage.php" >マイページ</a> </td>
        <td> <a href= "NewRegistration.php" >新規会員登録</a> </td>
        <td> <a href= "AccountSetting.php" >アカウント管理</a> </td>
        <td> 4 </td>
      </tr>
      <tr>
        <td> 5 </td>
        <td> 6 </td>
        <td> 7 </td>
        <td class="logout"> <a href= "LogOut.php" >ログアウト</a> </td>
      </tr>
    </table>

  </div>
  <!--ヘッダー部分終了-->
</header>
