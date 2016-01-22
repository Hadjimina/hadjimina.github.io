
<?php
/*ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);*/

include ("/var/secure.php");

$a_usr = $_POST["auth_usr"];
$a_pwd = $_POST["auth_pwd"];
if($a_usr == $auth_usr && $a_pwd==$auth_pwd)
{
$tbl_name = "schulung";
$conn = new mysqli($loc, $usr, $pwd,'Kochdb');

$id = $_POST["id"];
$date = $_POST["date"];
$length = $_POST["length"];
$count = $_POST["count"];
$schulungid = $_POST["schulungid"];
//PUTING SQL TOGETHER
$sql = "UPDATE $tbl_name SET date='$date',length='$length'";

for($z = 1;$z <= $count;$z++){
	$type = "type";
	$type .= $z;
	$value = "value";
	$value .= $z;
	$misc = ",`$_POST[$type]`='$_POST[$value]'";
        $sql .=$misc;
}
$sql .=" WHERE schulung_id = '$schulungid' AND id ='$id'";

echo $sql;

$conn->query( utf8_decode ($sql));
mysql_close($conn);
}
else{
echo "Not allowed";
}
?>


