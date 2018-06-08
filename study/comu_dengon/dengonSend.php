<?php
session_start();

// ログイン状態のチェック
if (!isset($_SESSION["name"])) {
  header("Location: logout.php");
  exit;
}
?>

<html>
<head><title>みんなの伝言板</title></head>
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<?php

$personal_name = $_SESSION["name"];
$contents = $_POST['contents'];
$contents = nl2br($contents);
$tms = date('Y年m月d日（D）G時i分s秒');

//空の場合
if(empty($contents)){
    echo '
    <pre>
    投稿内容がありません！！！
    前の画面に戻ってご確認ください。
    
    <a href="javascript:history.back();">一つ前のページへ戻る</a> | <a href="dengon_log.html">投稿内容を見る</a>'." | ".' <a href="../comu">トップへ戻る</a></pre>';
    exit;
}
//データが入っている場合
else{
?>
<?php
/*
    $data = "<pre id='parent'>";
    $data = $data."<p>投稿日時:".$tms."</p>";   
    $data = $data."<p>投稿者:".$personal_name."</p>";
    $data = $data."<p>内容:</p>";
    $data = $data."<p>".$contents."</p><hr>";
*/  
/*
    $array_img = file("/images/data.txt");
    for($i=0; $i<sizeof($array_img); $i++){
        $array_img[$i] = ereg_replace("\n","",$array_img[$i]);
        print "<img src=\"$array_img[$i]\" width=\"200\" height=\"200\">";
    }
*/
/*  // 作成するファイル名の指定
    $file_name = 'open_file.html';

    $i = 1;
    wordwrap($file_name , 4 , $i , true);

    // ファイルの存在確認
    if( !file_exists($file_name) ){
        // ファイル作成
        touch( $file_name );
    }
    else{
        // すでにファイルが存在する為エラーとする
        //echo('Warning - ファイルが存在しています。 file name:['.$file_name.']');
        $i++;
            $fp = fopen($file_name, 'ab');

        if ($fp){
            if (flock($fp, LOCK_EX)){
                if (fwrite($fp,  $data) === FALSE){
                    print('ファイル書き込みに失敗しました');
                }

                flock($fp, LOCK_UN);
            }else{
                print('ファイルロックに失敗しました');
            }
        }

        $data = "</pre>";
        fclose($fp);
        echo "
        <pre>
        投稿完了しました。
        以下の投稿内容を見るのリンクを押してください。

        </pre>";
        
        exit();
    }

    // ファイルのパーティションの変更
    chmod( $file_name, 0666 );
    echo('Info - ファイル作成完了。 file name:['.$file_name.']');
     
*/  
    $keijban_file = 'dengon_log.html';
    $fp = fopen($keijban_file, 'ab');

    if ($fp){
        if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }
            flock($fp, LOCK_UN);
        }
        else{
            print('ファイルロックに失敗しました');
        }
        
    $data = "</pre>";
    fclose($fp);
    }
    
    $defualt_file = fopen('dengon_log.html','rb');

    $filename = $default_file;
/*  
    if (file_exists($filename)) {
        echo "$filename が存在します";
    } else {
        echo "$filename は存在しません";
    }
*/
    //１時ファイルを作成
    $tmp_file = fopen('dengon_log.tmp','wb');
    
    flock($defualt_file,LOCK_SH);
    flock($tmp_file,LOCK_EX);
    
    fwrite($tmp_file,'<html><head>');
    fwrite($tmp_file,'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />');
    fwrite($tmp_file,'<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">');
    fwrite($tmp_file,'</head><body>');
    fwrite($tmp_file,"<strong>投 稿 時 刻：</strong><br>".$tms."<br><br>");
    fwrite($tmp_file,"<strong>投 稿 者：</strong><br>".$personal_name."<br><br>");
    fwrite($tmp_file,"<strong>投 稿 内 容：</strong><br>".$contents."<br>"); 
    fwrite($tmp_file,"<hr>");
/*
    $filename = $tmp_file;
    if (file_exists($filename)) {
        echo "$filename が存在します";
    } else {
        echo "$filename は存在しません";
    }
*/

    while($row = fgets($defualt_file)){
        fwrite($tmp_file,$row);
    }
    
    flock($tmp_file,LOCK_UN);
    flock($defualt_file,LOCK_UN);
    
    unlink('dengon_log.html');
    rename('dengon_log.tmp','dengon_log.html');
    //header('Location: dengon_log.html');

    fclose($tmp_file);
    fclose($defualt_file);
    
    echo "
    <pre>
    投稿完了しました。
    以下の投稿内容を見るのリンクを押してください。
    </pre>";

    //header("Location: dengon.php");
}
?>
<a href="javascript:history.back();">一つ前のページへ戻る</a> | <a href="dengon_log.html">投稿内容を見る</a> | <a href="../comu">トップへ戻る</a><br> | <a href="logout.php">ログアウト</a>
</body>
</html>
</body>
</html>