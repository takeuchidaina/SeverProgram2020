<?php
session_start();

//SQL文
require 'DB.php';
$name = $_POST["tmpKanziName"];
$storeName = $_POST["tmpStoreName"];
$newPW = "newPW";

echo $name;
echo $storeName;

$pdo = new PDO($_SESSION["_DSN"], $_SESSION["_DB_USER"], $_SESSION["_DB_PASS"]);
$sql = "UPDATE employees SET Employees_Password = $newPW WHERE Name_Kanzi = $name AND Belong_Store_Num = $storeName";
$qry = $pdo->prepare($sql);

//php切り替え
header('Location: http://localhost/AMS/php/EmployeeSearch.php');
exit();

?>