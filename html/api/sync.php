<?php


    header('Content-Type: application/json; charset=utf-8'); 
    include ("/var/secure.php");

    $db = mysql_connect($loc,$usr,$pwd);
    if (!$db) {
        die('Could not connect to db: ' . mysql_error());
    }

    mysql_select_db("WallpaperSync",$db);

    $data = mysql_query("SELECT * FROM `data` WHERE 1", $db);  

$json_response = array();

while ($r = mysql_fetch_array($data, MYSQL_ASSOC)) {    
          $rows["name"] = $r["name"];
	  $rows["url"] = $r["url"];
	array_push($json_response,$rows);
     }
  echo json_encode($json_response,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>
