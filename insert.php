<?php

header('Content-type: application/json; charset=utf-8'); // ヘッダ（データ形式、文字コードなど指定）
$title = $_POST['title'];
$author = $_POST['author'];
$param = $title. $author; //　やりたい処理
 //　echoするとデータを返せる（JSON形式に変換して返す）
echo json_encode($param);

$comment = "お試し";

//  DB接続します
require_once('funcs.php'); 
$pdo = db_conn();
  
  
  // ３．SQL文を用意(データ登録：INSERT)
  $stmt = $pdo->prepare(
    "INSERT INTO  gs_bm_table(id, title, author, comment, indate)
    VALUES( NULL, :title, :author, :comment, sysdate() )"
  );
  
  // 4. バインド変数を用意
  $stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  
  // 5. 実行
  $status = $stmt->execute();
  
  // 6．データ登録処理後
  if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
  };


?>


