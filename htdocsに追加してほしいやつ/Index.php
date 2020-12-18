<?php
//define('_ROOT_DIR', __DIR__ . '/');
session_start();

//デバッグ用
//var_dump($_COOKIE["PHPSESSID"]);
//var_dump(session_id());//セッションID表示

//$_SESSION["aaa"] = 1;

require 'LogIn.php';
/*
unset($_SESSION["aaa"]);
$_SESSION = array(); //データ消去
setcookie($_COOKIE[session_name()],'',time()-1);//クッキー消去
session_destroy();//セッション消去
*/
?>
