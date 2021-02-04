<?php
session_start();
require 'Init.php';

//SQL文
require 'DB.php';
$name = $_POST["tmpKanziName"];
$StoreNum = $_POST["tmpStoreNum"];

try{
$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);
$sql = 'UPDATE employees SET Active_Flag = 0 WHERE Name_Kanzi = "' .$name. '" AND Belong_Store_Num = '.$StoreNum.';';
$qry = $pdo->query($sql);
}
catch(\Exception $e){
    echo $e -> getMessage() . PHP_EOL;
    $_SESSION["ErrLog"] = $e -> getMessage() . PHP_EOL;
    header('Location: http://localhost/AMS/php/EmployeeSearch.php');
}

//php切り替え
header('Location: http://localhost/AMS/php/EmployeeSearch.php');
exit();

?>