<header>
  <link rel="stylesheet" href="../css/header.css">
  <!--ヘッダー部分-->
  <div class="header">
    <!--ヘッダー部分上-->
    <div class="headline">
      <span class="left">

        ログインID:<?php echo $_SESSION['NUM']; ?><br> <!--ID-->
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
        <td> 1 </td>
        <td> 2 </td>
        <td> 3 </td>
        <td> 4 </td>
      </tr>
      <tr>
        <td> 5 </td>
        <td> 6 </td>
        <td> 7 </td>
        <td class="logout"> ログアウト </td>
      </tr>
    </table>

  </div>
  <!--ヘッダー部分終了-->
</header>
