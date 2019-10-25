<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ぬるトーク</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <style>
    #main {
      width: 100vw;
      height: auto;
    }
  </style>
</head>

<body>
  <div id="header">
    <a id="title" href="index.php">ぬるトーク</a>
    <ul id="menu">
      <li><a href="index.php">ホーム</a></li>
      <li><a href="myList.php">趣味の閲覧</a></li>
      <li><a href="addList.php">趣味の追加</a></li>
      <li><a href="matching.php">マッチング</a></li>
    </ul>
  </div>
  <div id="main">
  <h1>
    共通の趣味はこちらです
  </h1>
    <?php
      $url = parse_url(getenv("DATABASE_URL"));
      $con = pg_connect("host=" . $url['host'] . " port=" 
        . $url['port'] . " dbname=" . substr($url['path'], 1)
        . " user=" . $url['user'] . " password=" . $url['pass']);

      $password = $_POST["password"];

      if (isset($password)) {
        $res = pg_query($con, "SELECT uid FROM rooms WHERE password='".$password."'");
        $uid1 = pg_fetch_row($res)[0];
        $uid2 = pg_fetch_row($res)[0];

        $res = pg_query($con, "SELECT hid FROM user_hobbies WHERE uid=".$uid1." 
          INTERSECT SELECT hid FROM user_hobbies WHERE uid=".$uid2);
        while($hid = pg_fetch_row($res)) {
          $hobby_name = pg_query($con, "SELECT hobby_name FROM hobbies WHERE hid=".$hid[0]); 
          echo '<a style="font-size: 20px ">';
          echo pg_fetch_row($hobby_name)[0];
          echo '</a><br>';
        }
      }
    ?>
  <a href="index.php">戻る</a>
  </div>
  <div id="footer">
    <span id="footer_text">Copyright&copy; 2019 ぬるんちゅ All Rights Reserved.</span>
  </div>
</body>

</html>