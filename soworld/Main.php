<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["USERID"])) {
    header("Location: Logout.php");
    exit;
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/rest.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/material.css"> <!-- material専用 -->
    <link href="css/media_queries.css" rel="stylesheet" type="text/css">
    <link href="css/hamburgers.css" rel="stylesheet">
    .<link href="css/slick.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
    <div class="test">
        <h1>メイン画面</h1>
        <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
        <p>はじめまして！<u><?php echo htmlspecialchars($_SESSION["USERID"], ENT_QUOTES); ?></u>さん</p>  <!-- ユーザー名をechoで表示 -->
        <ul>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
        </div>


    </body>
</html>