<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() 
function db_conn(){
    try {
        // よく変わりそうなところを関数化する
        $db_name = "book_db";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホストURL
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; 
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)←このファイルには存在しない変数を、引数として（）内に置く
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: " .$file_name);
    exit();
}