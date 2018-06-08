<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();

// ログイン状態のチェック
if (!isset($_SESSION["name"])) {
  header("Location: logout.php");
  exit;
}

if(!isset($_SERVER['PHP_AUTH_USER'])){
header("WWW-Authenticate: Basic realm='Private Page'");
header("HTTP/1.0 401 Unauthorized');
die('このページを見るにはログインが必要です');

}else{

if(($_SERVER["PHP_AUTH_USER"] != $_SESSION["user_num"] ) || ($_SERVER["PHP_AUTH_USER"] != $_SESSION["pass"])){

header("WWW-Authenticate: Basic realm='Private Page'");
header("HTTP/1.0 401 Unauthorized");
die('このページを見るにはログインが必要です');

}

}




?>