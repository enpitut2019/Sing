<!DOCTYPE html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <title>NullTalk</title>
  <link href="reset.css" rel="stylesheet" type="text/css" />
  <link href="main.css" rel="stylesheet" type="text/css" />
  <style>
    a {
      color: white;
      text-align: center;
      padding: 14px 0px;
      text-decoration: none;
    }

    #keywordTextbox {
      width: 50%;
    }

    #form_wrapper {
      width: 100%;
    }

    #form_wrapper {
      width: 50%;
      padding-left: 25%;
    }

    #form {
      display: flex;
      width: 100%;
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
      width: 10%;
    }

    #form_button {
      width: 20%;
    }

    #submit_button {
      padding: 15px;
      font-size: 13px;
      background-color: #000;
      color: #fff;
      border-style: none;
      width: 100%;
    }

    #form_input {
      float: left;
      height: 100%;
      width: 80%;
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
    <h2>秘密の合言葉を入力してください</h2>
    <form action="waiting.php" method="post">
      <div id="form_wrapper">
        <div class="msr_text_04">
          <div id="form">
            <div class="form_parts" id="form_input"><input type="text" name="password" maxlength="4" placeholder="入力してください"/></div>
            <div class="form_parts" id="form_button"><input type="submit" name="matching" id="submit_button" value="GO!"></input></div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div id="footer">
    <span id="footer_text">Copyright&copy; 2019 ぬるんちゅ All Rights Reserved.</span>
  </div>
</body>

</html>