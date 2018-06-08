<?php
    //[API Key]と[API Secret] ([API Secret]はついでにURLエンコード)
    $api_key = 'TuBfss9AetCE6mTjmio7wwqTj';
    $api_secret = rawurlencode('lbkXgUKv7cwcKywbAQaFMWI90bV3Nwx1qBX2gcbGUianijUWzI');
    
    //[アクセストークンシークレット] (まだないので空白)
    $access_token_secret = 's1wky3oP8pKv8XP22Vpd21Lb7SsNlBxfwZ8BiTnuTtIYA';
    
    //Callback URL(このファイルを設置するURL)
    $callback_url = 'http://kenriki.php.xdomain.jp/comu_dengon/dengon.php';
    
    //リクエストURL
    $request_url = 'https://api.twitter.com/oauth/request_token';
    
    //リクエストメソッド
    $request_method = 'POST';
    
    //キーを作成する
    $signature_key = "{$api_secret}&{$access_token_secret}";
    
    
    //パラメータ([oauth_signature]を除く)を連想配列で指定
    $params = array(
                    'oauth_callback' => $callback_url,
                    'oauth_consumer_key' => $api_key,
                    'oauth_signature_method' => 'HMAC-SHA1',
                    'oauth_timestamp' => time(),
                    'oauth_nonce' => microtime(),
                    'oauth_version' => '1.0'
                    );
    
    //配列の各パラメータをURLエンコード
    foreach($params as $key => $value){
        if($key == 'oauth_callback') continue;  //コールバックURLだけはここでエンコードしちゃダメ
        $params[$key] = rawurlencode($value);
    }
    
    //連想配列をアルファベット順に並び替え
    ksort($params);
    
    //パラメータの連想配列を[キー=値&キー=値...]の文字列に変換
    $request_params = http_build_query($params,'','&');
    
    //変換した文字列をURLエンコードする
    $request_params = rawurlencode($request_params);
    
    //リクエストメソッドをURLエンコードする
    $encoded_request_method = rawurlencode($request_method);
    
    //リクエストURLをURLエンコードする
    $encoded_request_url = rawurlencode($request_url);
    
    //リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
    $signature_data = "{$encoded_request_method}&{$encoded_request_url}&{$request_params}";

    
    //キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
    $hash = hash_hmac('sha1',$signature_data,$signature_key,TRUE);
    
    //base64エンコードして、署名[$signature]が完成する
    $signature = base64_encode($hash);
    
    
