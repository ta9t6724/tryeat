<?php
// GET送信
// urlの最後 ?id=○○　の○○の取り出し方
$id = $_GET['id'];
echo $id . "<br>";
// var_dump($_GET);

require('dbconnect.php');

// ２．SQL文を実行する オーダー
// $sqlの''の中身に入れる
$sql = "SELECT `like` FROM `feeds` WHERE `id` = ?";

// ?に入れたい変数名を入れる
$data = array($id);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

// $fav = intval();

while (1) {
  	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
  	var_dump($rec)."<br>";
  	echo "<br>";
  	if ($rec == false) {
    break;
  	}
 	$fav = $rec['like'];
 	echo $fav."<br>";
}
 	$fav += 1;
 	echo $fav."<br>";


$sql = "UPDATE `feeds` SET `like` = ? WHERE `id` = ?";
// ?に入れたい変数名を入れる
$data = array($fav,$id);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

// ３．データベースを切断する 電話切る


// 一覧であるview.phpに転送
// header("Location: foodlist.php?id=".$_GET['id']);

?>