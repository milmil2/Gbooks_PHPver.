<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php'); 
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];


//3．データ取得SQLを作成（SELECT文）
// SQL文を作る
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id=:id');
$stmt -> bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';

if ($status == false){
    sql_error($stmt);
}else{
    $result = $stmt->fetch();   
}


?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <label>題名：<input type="text" name="title" value="<?= $result['title'] ?>"></label><br>
                <label>著者：<input type="text" name="author" value="<?= $result['author'] ?>"></label><br>
                <label>コメント<textarea name="comment" rows="4" cols="40"><?= $result['comment'] ?></textarea></label><br>
                <!-- ユーザーには見えないが、どこのidの情報を更新するかを指定できる -->
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>