<?php
require_once('funcs.php'); 
$pdo = db_conn();


$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

// /データ表示
$view= "<table><tr><th>登録日時</th><th>タイトル</th><th>著者</th><th>コメント</th></tr>";
if($status==false) {
  sql_error($status);
}else{
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<tr>';
    $view .= '<td>'. $result['indate']. '</td>';
    $view .= '<td>'. $result['title']. '</td><td> '. $result['author']. '</td><td> '. $result['comment']. '</td>';
    $view .= '<td>';
    $view .= '<a href="detail.php?id='.$result['id'].'">[更新]</a>';
    $view .= '<a href="delete.php?id='.$result['id'].'">[削除]</a>';
    $view .= '</td>';
    $view .="</tr>";
  };
  $view .= "</table>";
};
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta title="viewport" content="width=device-width, initial-scale=1">
<title>Book Mark List</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.html">Google Booksに戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
