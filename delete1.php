<?php
// GET送信
// urlの最後 ?id=○○　の○○の取り出し方
$id = $_GET['id'];
// var_dump($_GET);

// １．データベースに接続する 電話かける
// phpmyadminの繋ぎたいデータベース名を=のあとに入れる
// ZAMPPの場合は$userは"root"で$passwordは''空でも大丈夫
$dsn = 'mysql:dbname=online_bbs;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

// ２．SQL文を実行する オーダー
// $sqlの''の中身に入れる

// SQLインジェクション対策 ? を入れる
$sql = 'DELETE FROM `bbs_table` WHERE `id` = ?';

// ?に入れたい変数名を入れる
$data = array($id);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

// ３．データベースを切断する 電話切る
$dbh = null;

// 一覧であるview.phpに転送
header("Location: bbs_no_css.php");

?>