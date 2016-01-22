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
$id = $_POST["id"];
$mysqli = new mysqli($loc,$usr,$pwd,'Kochdb');
$myArray = array();


$mysqli->set_charset("utf8");
$sql = "SELECT * FROM schulung WHERE id LIKE $id";
$result = $mysqli->query($sql);

while($row = mysqli_fetch_assoc($result)) {
	$myArray[] = $row;
}


$myArray = array_map('array_filter', $myArray);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);
$result->close();
$mysqli->close();
}
else{
echo "Not allowed";
}
?>
