<?php

session_start();
    // ログイン状態のチェック
    if (!isset($_SESSION["name"])) {
      header("Location: logout.php");
      exit;
    }
    header("Content-Type: text/html; charset=UTF-8");
    session_start();
    $userNumber = $_POST["user_num"];
    $passWord = $_POST["pass"];
    //$link = mysql_connect('localhost', 'root', 'root');
    $link = mysql_connect('mysql1.php.xdomain.ne.jp', 'kenriki_database@sv1.php.xdomain.ne.jp', 'rk0823');
    //$db_selected = mysql_select_db('sample', $link);
    $db_selected = mysql_select_db('kenriki_sample', $link);
    mysql_set_charset('utf8');
    $result = mysql_query('SELECT * FROM login_info');

    while ($row = mysql_fetch_assoc($result)) {
        if(!isset($_SERVER['PHP_AUTH_USER'])){
            header("WWW-Authenticate: Basic realm='Private Page'");
            header("HTTP/1.0 401 Unauthorized");
            die('このページを見るにはログインが必要です');

        }
        else{

            if(($row["user_number"] != $_SESSION["user_num"] ) && ($row["password"] != $_SESSION["pass"])){

                header("WWW-Authenticate: Basic realm='Private Page'");
                header("HTTP/1.0 401 Unauthorized");
                die('このページを見るにはログインが必要です');

        }
    }




?>
