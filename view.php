<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require('dbconnect.php');

if (empty($_REQUEST['id'])) {
  header('Location: index.php');
  exit();
}

$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id = p.member_id AND p.id = ?');
$posts->execute(array($_REQUEST['id']));
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ひとこと掲示板</title>

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css" />
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ひとこと提示版</a>
      <div style="text-align: right"><a class="btn btn-outline-success" href="logout.php">ログアウト</a></div>
    </div>
  </nav>
  <div class="container">
    <p>&laquo;<a href="index.php">一覧にもどる</a></p>

    <?php if ($post = $posts->fetch()) : ?>
      <div class="msg">
        <img width="100" height="100" src="member_picture/<?php print(htmlspecialchars($post['picture'])); ?>" />
        <p><?php print(htmlspecialchars($post['message'])); ?><span class="name">（<?php print(htmlspecialchars($post['name'])); ?>）</span></p>
        <p class="day"><?php print(htmlspecialchars($post['created'])); ?></p>
      </div>
    <?php else : ?>
      <p>その投稿は削除されたか、URLが間違えています</p>
    <?php endif; ?>
  </div>
</body>

</html>
