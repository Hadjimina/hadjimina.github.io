<?php
/*ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(E_ALL);*/

header('Content-Type: application/json;charset=utf-8');
include ("/var/secure.php");

$a_usr = $_POST["auth_usr"];
$a_pwd = $_POST["auth_pwd"];

if($a_usr == $auth_usr && $a_pwd==$auth_pwd)
{
$mysqli = new mysqli($loc,$usr,$pwd,'Kochdb');
$mysqli->set_charset("utf8");
$myArray = array();
if ($result = $mysqli->query("SELECT * FROM teachers")) {

    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);

$result->close();
$mysqli->close();
}
}
else{
echo "Not allowed";
}

?>
