<?php

//session_start();


// データベース接続ユーザー名
define("_DB_USER", "root");

// データベース接続パスワード
define("_DB_PASS", "");

// データベースホスト名
define("_DB_HOST", "localhost");

// データベース名
define("_DB_NAME", "shift_management");

// データベースの種類
define("_DB_TYPE", "mysql");

// データソースネーム
define("_DSN", _DB_TYPE . ":host=" . _DB_HOST . ";dbname=" . _DB_NAME. ";charset=utf8");

$_SESSION["_DB_USER"] = "root";
$_SESSION["_DB_PASS"] = "";
$_SESSION["_DB_HOST"] = "localhost";
$_SESSION["_DB_NAME"] = "shift_management";
$_SESSION["_DB_TYPE"] = "mysql";
$_SESSION["_DSN"] = _DB_TYPE . ":host=" . _DB_HOST . ";dbname=" . _DB_NAME. ";charset=utf8";

 ?>
