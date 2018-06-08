<?php
$bgcolor = "#F5F5F5";
$textcolor = "#737373";
?>
<?php
session_start();

/*
$img_name = $_FILES["img_path"]["name"];
$img_size = $_FILES["img_path"]["size"];
$img_type = $_FILES["img_path"]["type"];
$img_tmp = $_FILES["img_path"]["tmp_name"];


if($_REQUEST["up"] != ""){
    if($img_tmp != "" and $img_size <= 500000000){
        $img_message = "名前は： $img_name <br>サイズは： $img_size <br>MIMEタイプは： $img_type <br>一時的に保存されているパスは： $img_tmp <br>";

        $FilePath = "/images/".date("Ymdhis").".".GetExt($img_name);
        $fname = basename($_FILES['userfile']['name']);
        $fname_sjis = mb_convert_encoding( $fname, 'sjis', 'utf-8');
        $uploadfile = $uploaddir .$fname_sjis;
        move_uploaded_file($img_tmp,$FilePath);
        $fp = fopen("/images/data.txt","a");
        fputs($fp,$FilePath."\n");
        fclose($fp);

    }
    else{
        $size_error = "サイズが大きすぎます。ファイルサイズは500メガバイト以下です。";
    }
} 


// GetExt
// ファイルの拡張子を取得します。

function GetExt($FilePath){
    $f=strrev($FilePath);
    $ext=substr($f,0,strpos($f,"."));
    return strrev($ext);
}
<?php print($_SERVER['SCRIPT_NAME']) ?> ENCTYPE="MULTIPART/FORM-DATA"
*/
?>

<html>
<head>
<title>みんなの伝言板</title>
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<style type="text/css">

p {
width: 400px;
padding-left: 0em;
}

</style>
</head>
<CENTER>
<body bgcolor="<?php print $bgcolor; ?>" text="<?php print $textcolor; ?>">
<h2>みんなの伝言板</h2>
<form method="POST" action="dengonSend.php">
<?php
echo "ようこそ！".$_SESSION["name"]."さん";
?>
<p><br><a href="logout.php" onclick="return confirm('ログアウトしてもよろしいですか？')">ログアウト</a> | <A href="#shita">下へ</A> | <a href="mailto:xxx@xxx.com?subject=問い合わせ&amp;body=以下にご記入ください 。<br><hr><br>担当者様<br><br>○○です。お疲れ様です。<br><br>本文ココ！！">問い合わせ</a></p>
<p><pre>今日の伝えたいことを記入してください。</pre></p>
<pre>


</pre>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
<td>伝えたいこと：</td></tr>
<br>
<tr>
<td>
<textarea name="contents" id="link" rows="7" cols="40"></textarea>
</td>
</tr>


</table>
<hr />
<!--
<input type="button" value="リンクタグ" onclick="reLink()">
<input type="button" value="強調タグ１" onclick="reLink2()">
<input type="button" value="強調タグ２" onclick="reLink3()"><br />
<input type="button" value="見出しタグ" onclick="reLink4()">
<input type="button" value="文字縮小タグ" onclick="reLink5()"><br />
<input type="button" value="(。・∀・)ノ゛おはようございますっ！" onclick="reLink6()"><br />
<input type="button" value="o(*^ｰ^*)o お疲れ様でした！" onclick="reLink7()">
<br>
-->
<!--<input type="text" id="link" size="30" />-->

<script language="javascript"><!--
/*
function reLink(){
    var a = document.getElementById('link');
    a.value = '<a href="アドレス">テキスト</a>';
}
function reLink2(){
    var a = document.getElementById('link');
    a.value = '<strong>テキスト</strong>';
}
function reLink3(){
    var a = document.getElementById('link');
    a.value = '<em>テキスト</em>';
}
function reLink4(){
    var a = document.getElementById('link');
    a.value = '<h1>テキスト</h1>';
}
function reLink5(){
    var a = document.getElementById('link');
    a.value = '<small>テキスト</small>';
}
function reLink6(){
    var a = document.getElementById('link');
    a.value = '(。・∀・)ノ゛おはようございますっ！';
}
function reLink7(){
    var a = document.getElementById('link');
    a.value = 'o(*^ｰ^*)o お疲れ様でした！';
}
*/
//-->
</script>
<!--画像添付：<input name="img_path" type="file" size="40"><br>-->
<!--<input name="up" type="submit" value="画像をアップロードする"><br>-->
<A name="shita"></A>
<input type="submit" name="btn1" value="投稿する" onclick="return confirm('この内容で投稿してもよろしいですか？見直す場合はキャンセルを押してください')">
<input type="reset" name="reset" value="リセット" onclick="return confirm('今ある投稿内容を全て消してもよろしいですか？')">
<hr>
<!--<font color="#FF0000"><pre>※ 画像添付は現在使用できません。お恐れ入ります。</pre></font>-->
<!--<font color="#FF0000"><strong><?= $size_error ?></font></strong><?= $img_message ?>-->
</form>

<?php
/*
$personal_name = $_SESSION["name"];
$contents = $_POST['contents'];
$contents = nl2br($contents);
$tms = date('Y年m月d日（D）G時i分s秒');

//空の場合
if(empty($personal_name)&&empty($contents)){
    echo '<a href="dengon_log.php">投稿内容を見る</a>'." | ".' <a href="/comu">トップへ戻る</a>';
    exit;
}
//データが入っている場合
else{
    $data = "<pre>";
    $data = $data."<p>投稿日時:".$tms."</p>";   
    $data = $data."<p>投稿者:".$personal_name."</p>";
    $data = $data."<p>内容:</p>";
    $data = $data."<p>".$contents."</p><hr>";
    
    $keijban_file = 'dengon_log.php';
    $fp = fopen($keijban_file, 'ab');

    $array_img = file("/images/data.txt");
    for($i=0; $i<sizeof($array_img); $i++){
        $array_img[$i] = ereg_replace("\n","",$array_img[$i]);
        print "<img src=\"$array_img[$i]\" width=\"200\" height=\"200\">";
    }

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
}
*/
?>
<a href="dengon_log.html">投稿内容を見る</a> | <a href="logout.php" onclick="return confirm('ログアウトしてもよろしいですか？')">ログアウト</a>

</body>
</CENTER>
</html>