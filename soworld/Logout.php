<?php
session_start();

if (isset($_SESSION["USERID"])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ログアウト</title>
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
        <h1>ログアウト画面</h1>
        <div><?php echo $errorMessage; ?></div>
        <ul>
            <li><a href="Login.php">ログイン画面に戻る</a></li>
        </ul>
    </body>
</html>