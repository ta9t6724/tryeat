<?php
    session_start();
    require('dbconnect.php');
    $sql = 'SELECT `id`, `photo` FROM `photos';
    $data = array();
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    while (true) {
        $record = $stmt->fetch(PDO::FETCH_ASSOC); //  ここより上でfetchしてない？
        if ($record == false) {
            break;
        }
        $photos[] = $record;
    }



?>
<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する

</body>
</html> --> 

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
      <div class=content>
        <img src="image/IMG_5991.jpg">
        <h1 class="title" style="font-size: 52px; font-weight: bold;"><i class="fa fa-cutlery"></i> Tryeat</h1>
      </div>
    </div>
      <div class="post">
      <a href="post.php" type="button" class="btn btn-info">写真を投稿する</a>
      </div>
      <?php foreach ($photos as $photo) { ?>
        <div class="col-md-4 content-margin-top">
<!--         <a href="foodlist.php"><img src="image/IMG_5991.jpg" style="width:250px; height:auto;"></a>
 -->
             <a href="foodlist.php?id=<?php echo $photo['id']; ?>"><img src="image/<?php echo $photo['photo']; ?>" style="width:250px; height:auto; transform: rotate(90deg);"></a>
             <p><?php echo $photo['id']; ?></p>
        </div>
      <?php } ?>
    </div>
</body>
</html>



