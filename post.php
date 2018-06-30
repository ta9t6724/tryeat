<?php 
    require('dbconnect.php');

    $photo = '';
    $comment = '';
     // 登録ボタンが押された時のみ処理するif文
     // fileを選択するときは$_FILES
    if (!empty($_POST)) {
        $photo = $_FILES['input_image'];
        $comment = $_POST['input_comment'];

        $file_name = ''; // ①
        if (!isset($_REQUEST['action'])) { // ②
        $file_name = $_FILES['input_image'];
        }
        // エラーがなかった時の処理
        if (empty($errors)) {

            date_default_timezone_set('Asia/Manila');
            $date_str = date('YmdHis'); // YmdHisを指定することで取得フォーマットを指定
            $submit_file_name = $date_str . $file_name['name'];
            move_uploaded_file($_FILES['input_image']['tmp_name'], 'image/' . $submit_file_name);
        }
        $sql = 'INSERT INTO `photos` SET `photo`=?, `comment`=?';
        $data = array($submit_file_name, $comment);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // unset()で入れるの中身を削除する
        // unset()文は指定した変数もしくは配列を破棄することができる
        header('Location: view.php');
        exit();
    }
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
        <div class="col-xs-8 col-xs-offset-2">
            <h2 class="text-center content_header" style="margin-top: 60px">写真を投稿する</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                   <div class="form-group">
                      <label>食べ物の画像</label>
                      <input type="file" name="input_image" accept="image/*">
                      <br>
                      <label>コメント</label>
                      <textarea name="input_comment" class="form-control" rows="3" placeholder="食べ物の特徴などを書いてください" style="font-size: 16px;"></textarea>
                   </div>
                  <input type="submit" class="btn btn-primary" value="確認">
                </form>
            </div>
        </div>
    </div>
</body>
</html>








