<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

<?php
  //POST送信が行われたら、下記の処理を実行
  if(isset($_POST)&&!empty($_POST)){//なぜnicknameだけでいいのか？
    //データベースに接続
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
  
  $nickname = $_POST['nickname'];
  $comment = $_POST['comment'];
    //SQL文作成(INSERT文)
  $sql = 'INSERT INTO `oneline_bbs`.`posts` (`id`, `nickname`, `comment`, `created`) VALUES (NULL, "'.$nickname.'", "'.$comment.'", now())';
    //'".の使い方がわからない
    //INSERT文実行
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

    //データベースから切断
   $dbh = null;
   }
 ?>

<?php

  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
  

  $nickname = $_POST['nickname'];
  $comment = $_POST['comment'];

  $sql = 'SELECT * FROM `oneline_bbs`.`posts` WHERE 1';
  
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
while(1)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
    echo $rec['id'];
    echo '&nbsp;';
    echo $rec['nickname'];
    echo '&nbsp;';
    echo $rec['comment'];
    echo '&nbsp;';
    echo $rec['created'];
    echo '<br />';
  }

    //データベースから切断
  $dbh = null;

?>


 <!--    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p> -->
</body>
</html>
