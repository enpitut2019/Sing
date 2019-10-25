<?php
  $url = parse_url(getenv("DATABASE_URL"));
  $con = pg_connect("host=" . $url['host'] . " port=" 
    . $url['port'] . " dbname=" . substr($url['path'], 1)
    . " user=" . $url['user'] . " password=" . $url['pass']);

  $password = $_POST["password"];
  $res = pg_query($con, "SELECT COUNT(*) FROM rooms WHERE password = '".$password."' 
                    and current_timestamp - insert_time < interval '1 minute'") ;
  $cnt = pg_fetch_row($res)[0];
  if($cnt>=2) {
    $arr["val"] = "success";
  } else {
    $arr["val"] = "failure";
  }
  $res = pg_query($con, "DELETE FROM rooms WHERE current_timestamp - insert_time > interval '1 minute'");
// 配列をjson形式にデコードして出力, 第二引数は、整形するための定数
print json_encode($arr, JSON_PRETTY_PRINT);