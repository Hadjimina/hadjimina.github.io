<?php
include ("/var/secure.php");

$tbl_name = "bills";


$a_usr = $_POST["auth_usr"];
$a_pwd = $_POST["auth_pwd"];
if($a_usr == $auth_usr && $a_pwd==$auth_pwd)
{

$conn = mysql_connect($loc, $usr, $pwd);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$id = $_POST["studentid"];
$date = $_POST["date"];
$amount = $_POST["amount"];
$confirmation = $_POST["confirmation"];
$billid = $_POST["billid"];

$sql="UPDATE $tbl_name SET date='$date', amount='$amount', confirmation='$confirmation' WHERE studentid='$id' AND bill_id='$billid'";

mysql_select_db('Kochdb');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else{
echo "Entered data successfully\n";
}
mysql_close($conn);
}
else{
echo "Not allowed";
}
?>


