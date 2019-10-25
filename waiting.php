<?php
  $check = session_start();

  if(!isset($check)){
    print("セッションの確立に失敗しましたよ");
  }
  $session_id = session_id();
  $url = parse_url(getenv("DATABASE_URL"));
  $con = pg_connect("host=" . $url['host'] . " port=" 
    . $url['port'] . " dbname=" . substr($url['path'], 1)
    . " user=" . $url['user'] . " password=" . $url['pass']);
    
  $res = pg_query($con, "SELECT uid FROM users WHERE session_id = '".$session_id."'"); #or die("クエリ実行エラーです" . pg_last_error());
  $uid = pg_fetch_row($res)[0];
  $password = $_POST["password"];
  
  $res = pg_query($con, "INSERT INTO rooms(password, uid, insert_time) VALUES('".$password."', '".$uid."', current_timestamp)"); #or die("クエリ実行エラーです" . pg_last_error());
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ぬるトーク</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
    <h1>相手を待っています...</h1>
    <img src="gif-load.gif">
  </div>
  <div id="footer">
    <span id="footer_text">Copyright&copy; 2019 ぬるんちゅ All Rights Reserved.</span>
  </div>
  <script>
    $(function() {
      var POLLLING_INVERVAL_TIME_IN_MILLIS = 1000;//1s
      (function polling() {
        getCountUp();
        window.setTimeout(polling, POLLLING_INVERVAL_TIME_IN_MILLIS);
      }());
      function getCountUp() {
        $.ajax({
          type : "POST",
          url : "waitingUser.php",
          content : "application/json",
          dataType : "json",
          data:{
            "password": '<?php echo $password ?>',
            "uid": <?php echo $uid ?>
          }
        }).done(function(data1) {
          if(data1['val'] == 'success'){
            //window.location.href = 'result.php';
            var f = document.forms["to_result"];
            f.method = "POST";
            f.submit();
          }
        }).fail(function(jqXHR, textStatus) {
          console.log('failed');
        });
      }
    });
  </script>

  <form name="to_result" action="result.php" method="post">
    <input type="hidden" name="password" value= <?php echo $password ?> >
  </form>
</body>

</html>