<?php

if(mktime() == mktime( 7, 32, 0, 7, 31, 2014)){
    //ファイルを読み込む
    $defualt_file = fopen('dengon_log.html','rb');

//  $filename = $default_file;
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
    
    fwrite($tmp_file,"投稿時刻：<br>".$tms."<br>");
    fwrite($tmp_file,"投稿者：".$personal_name."<br>");
    fwrite($tmp_file,"投稿内容：<br>".$contents."<br>"); 
    fwrite($tmp_file,"<hr>"); 
/*
    $filename = $tmp_file;
    if (file_exists($filename)) {
        echo "$filename が存在します";
    } else {
        echo "$filename は存在しません";
    }
*/
    //読み込んだものをtmpファイルに書き込む
    while($row = fgets($defualt_file)){
        fwrite($tmp_file,$row);
    }
    
    flock($tmp_file,LOCK_UN);
    flock($defualt_file,LOCK_UN);
    
    $file = 'dengon_log.tmp';
    $newfile = 'backupFile.html';

    if (!copy($file, $newfile)) {
        error_log ("failed to copy $file...\n",0);
    }else{
        //削除
        unlink('dengon_log.html');
        unlink('dengon_log.tmp');
    
        // 作成するファイル名の指定
        $file_name = 'dengon_log.html';

        // ファイルの存在確認
        if( !file_exists($file_name) ){
            // ファイル作成
            touch( $file_name );
            fwrite($faile_name,'<html><head><title>みんなの伝言板</title>');
            fwrite($file_name,'<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">'); 
            fwrite($file_name,'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>'); 
        }
        else{
            error_log("ファイルが作成されませんでした。",0);
            exit;
        }
    }
    /*
    //ファイル名を変更
    //rename('dengon_log.tmp','dengon_log.html');
    //header('Location: dengon_log.html');
    */
    
    fclose($tmp_file);
    fclose($defualt_file);
    
    echo "
    <pre>
    投稿完了しました。
    以下の投稿内容を見るのリンクを押してください。
    </pre>";
    
}
?>
