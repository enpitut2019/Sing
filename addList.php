<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ぬるトーク</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <style type='text/css'>
    input {
      text-align: left;
      padding-left: 100px;
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
  <h1>興味のある事柄を選んでください</h1>
  <form action="addListResult.php" method="post">
    <div class="addHobbyList">
    <?php
      $url = parse_url(getenv("DATABASE_URL"));
      $con = pg_connect("host=" . $url['host'] . " port=" 
        . $url['port'] . " dbname=" . substr($url['path'], 1)
        . " user=" . $url['user'] . " password=" . $url['pass']);

      $res = pg_query($con, "SELECT hobby_name FROM hobbies");
      while($hobby_name = pg_fetch_row($res)) {
        echo '<label><input type="checkbox" name="hobbyAdd[]" value="';
        echo $hobby_name[0];
        echo '">';
        echo $hobby_name[0];
        echo '</input><br /></label>';
        
      }
    ?>
      <!--
      <label><input type="checkbox" name="hobbyAdd[]" value="ゴルフ">ゴルフ</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="アニメ">アニメ</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="刀">刀</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="フィギュア">フィギュア</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="ランニング">ランニング</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="プログラミング">プログラミング</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="野球">野球</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="VTuber">VTuber</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="enPiT">enPiT</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="お酒">お酒</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="レンズ">レンズ</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="ラーメン">ラーメン</input><br /></label>
      <label><input type="checkbox" name="hobbyAdd[]" value="音MAD">音MAD</input><br /></label>
    -->
    </div>
    <input class="addButton" type="submit" name="addList" value="追加">
  </form>
  </div>
  <div id="footer">
    <span id="footer_text">Copyright&copy; 2019 ぬるんちゅ All Rights Reserved.</span>
  </div>
</body>

</html>