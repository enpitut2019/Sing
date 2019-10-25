<?php
  $check = session_start();
  if(!isset($check)){
    print("セッションの確立に失敗しました");
  }
  $session_id = session_id();
  $url = parse_url(getenv("DATABASE_URL"));
  $con = pg_connect("host=" . $url['host'] . " port=" 
  . $url['port'] . " dbname=" . substr($url['path'], 1)
  . " user=" . $url['user'] . " password=" . $url['pass']);

  $res = pg_query($con, "INSERT INTO users(session_id) VALUES('".$session_id."')"); #or die("クエリ実行エラーです" . pg_last_error());
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <title>ぬるトーク</title>
  <link href="reset.css" rel="stylesheet" type="text/css" />
  <link href="main.css" rel="stylesheet" type="text/css" />
  <style>
    a {
      color: white;
      text-align: center;
      padding: 14px 0px;
      text-decoration: none;
    }

    #how_to_use_div_wrapper {
      width: 100%;
      text-align: center;
    }

    #how_to_use_div {
      width: 40%;
      padding-left: 30%;
      display: block-inline;
    }

    .how_to_use {
      padding: 14px 16px;
      margin: 20px;
      font-size: 20px;
      text-align: left;
    }

    #form_input_sample {
      pointer-events: none;
      border: 5px solid #000000;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      color: #000000;
      font-size: 13px;
      padding: 10px;
      width: 150px;
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
    <h2>ぬるトークへようこそ！</h2>
    <div id="how_to_use_div_wrapper">
      <div id="how_to_use_div">
        <div class="how_to_use">1. <div class="button_sample"><a href="addList.php">趣味の追加</a></div> から趣味を追加しましょう！<br></div>
        <div class="how_to_use">2. お友達を誘って、<div class="button_sample"><a href="matching.php">マッチング</a></div> を押してください<br></div>
      </div>
    </div>
  </div>
  <div id="footer">
    <span id="footer_text">Copyright&copy; 2019 ぬるんちゅ All Rights Reserved.</span>
  </div>
</body>

</html>