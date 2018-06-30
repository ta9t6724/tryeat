<?php

  // ここにDBに登録する処理を記述する
if (!empty($_POST)) {
	$nickname = $_POST['nickname'];
	$feed = $_POST['feed'];
}
else{
	$_POST['nickname'] = '';
	$nickname = $_POST['nickname'];
	$_POST['feed'] = '';
	$feed = $_POST['feed'];
}



require('dbconnect.php');

// ニックネームとコメントの空チェック
if (!empty($nickname) && !empty($feed) && $nickname != '' && $feed != '') {

// ニックネームとコメントが空でなければINSERTする
$sql = "INSERT INTO `feeds` SET `nickname`='".$nickname."', `feed`='".$feed."', `theme_id` = ?";

$data = array($_GET['id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

// コメント後そのページに戻る
header("Location:foodlist.php?id=".$_GET['id']);
}

// theme_idが写真のもの（photo.id）と同じコメントだけSELECTしてくる
// $sql = 'SELECT * FROM `feeds` WHERE `theme_id` = ?  ORDER BY id DESC';
$sql = 'SELECT `f`.*,`p`.* FROM `photos` AS `p` LEFT OUTER JOIN `feeds` AS `f` ON `f`.`theme_id`=`p`.`id` WHERE `p`.`id` = ? ORDER BY `f`.`id` DESC';
$data = array($_GET['id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$feeds = array();
while (1) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
        break;
    }
    $feeds[] = $rec;
}
// echo "<pre>";
// var_dump($feeds);
// echo "</pre>";


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Tryeat</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <!-- ナビゲーションバー -->
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="view.php"><span class="strong-title"><i class="fa fa-cutlery"></i> Tryeat</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <!-- Bootstrapのcontainer -->
  <div class="container">
    <!-- Bootstrapのrow -->
    <div class="row">

      <!-- 画面左側 -->
      <div class="col-md-4 content-margin-top">
          <img src="image/<?php echo $feeds[0]['photo']; ?>" style="max-width: 300px;
  max-height: auto; transform: rotate(90deg);">
          <p style="width: 300px; height:150px; background-color: #f5f5f6; margin-top: 10px"><?php echo $feeds[0]['comment'];?></p>
      </div>

      <!-- 画面右側 -->
      <div class="col-md-8 content-margin-top">
       <div class="addcomment">
        <!-- form部分 -->
        <form action="" method="post">
          <!-- nickname -->
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="nickname" class="form-control" id="validate-text" placeholder="nickname" required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- comment -->
          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="feed" id="validate-length" placeholder="食べ物に関する情報を入力してください" required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- つぶやくボタン -->
          <button type="submit" class="btn btn-primary col-xs-12" disabled>つぶやく</button>
        </form>
      </div>
        <div class="timeline-centered">
          <?php foreach ($feeds as $feed){ ?>
          <article class="timeline-entry">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon bg-success">
                      <i class="entypo-feather"></i>
                      <i class="fa fa-cogs"></i>
                  </div>
                  <div class="timeline-label">
                      <h2><a href="#"><?php echo $feed['nickname']; ?></a> <span><?php echo $feed['created'];?></span></h2>
                      <p><?php echo $feed['feed']; ?></p>
					  <a href="like.php?id=<?php echo $feed['id']; ?>" class="btn btn-primary" style="float: right;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?php echo $feed['like']; ?></a>
					  <div style="clear:both;"></div>
                  </div>
              </div>
          </article>

		<?php }?>

          <article class="timeline-entry begin">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                      <i class="entypo-flight"></i> +
                  </div>
              </div>
          </article>
        </div>
      </div>

    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>



