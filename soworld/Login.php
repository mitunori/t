<?php
session_start();

$db['host'] = "mysql602.db.sakura.ne.jp";  // DBサーバのURL
$db['user'] = "so-world";  // ユーザー名
$db['pass'] = "drchika3232";  // ユーザー名のパスワード
$db['dbname'] = "so-world_login";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $stmt = $pdo->prepare('SELECT * FROM userData WHERE id = ?');
            $stmt->execute(array($userid));
            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $sql = "SELECT * FROM userData WHERE id = $userid";  //入力した$useridのユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["USERID"] = $row['name'];
                    header("Location: Main.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>ログイン</title>
      <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/rest.css" rel="stylesheet" type="text/css">
    <link href="css/media_queries.css" rel="stylesheet" type="text/css">
    <link href="css/hamburgers.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <!-- $_SERVER['PHP_SELF']はXSSの危険性があるので、actionは空にしておく -->
        <!-- <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST"> -->
     <form id="loginForm" name="loginForm" action="" method="POST">
       <fieldset>
        <legend>ログインフォーム</legend>
          <div><font color="#ff0000"><?php echo $errorMessage ?></font></div>
           <label for="userid">ユーザーID</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
           <br>
           <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
            <br>
            <input type="submit" id="login" name="login" value="ログイン">
        </fieldset>
     </form>
        <br>
    <!-- ここから登録のPHPに飛ばす -->
    <form action="SignUp.php">
      <fieldset>          
      <legend>新規登録フォーム</legend>
      <input type="submit" value="新規登録">
      </fieldset>
    </form>
   </body>
</html>