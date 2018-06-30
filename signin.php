<?php
  // ここにDBに登録する処理を記述する
if (!empty($_POST)) {
	$nickname = $_POST['nickname'];
	$password = $_POST['password'];
}
	// if ($password == 6724) {
	// header('Location: view.php');
	// exit();
 //  }else if($password != 6724 && !empty($password)){
 //  	echo "wrong password!!!!<br>";
 //  }
// １．データベースに接続する 電話かける
// phpmyadminの繋ぎたいデータベース名を=のあとに入れる
// ZAMPPの場合は$userは"root"で$passwordは''空でも大丈夫
if (!empty($nickname) && !empty($password) && $nickname != '' && $password != '') {

$dsn = 'mysql:dbname=online_bbs;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

// ２．SQL文を実行する オーダー
// $sqlの''の中身に入れる
$sql = "INSERT INTO `bbs_table` SET `nickname`='".$nickname."', `password`='".$password."'";

$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

header('Location:bbs_no_css.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
	        <form action="" method="post">
          <!-- nickname -->
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="nickname" class="form-control" id="validate-text" placeholder="nickname" required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- password -->
          <div class="form-group">
            <div class="input-group">
              <input type="password" name="password" class="form-control" id="validate-text" placeholder="password" required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- つぶやくボタン -->
          <button type="submit" class="btn btn-primary col-xs-12" disabled>登録</button>
        </form>
</body>
</html>
