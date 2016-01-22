
<?php
include ("/var/secure.php");

header('Content-Type:text/html; charset=UTF-8');

$a_usr = $_POST["auth_usr"];
$a_pwd = $_POST["auth_pwd"];
if($a_usr == $auth_usr && $a_pwd==$auth_pwd)
{

$tbl_name = "students";
$conn = mysql_connect($loc, $usr, $pwd);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('Kochdb');
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);

$id = $_POST["id"];
$first_name =  $_POST["first_name"];
$last_name =  $_POST["last_name"];
$street =  utf8_decode($_POST["street"]);
$plz = $_POST["plz"];
$date_of_birth = $_POST["date_of_birth"];
$ort =  $_POST["ort"];
$job =  $_POST["job"];
$teacherid = $_POST["teacherid"];

$sql="UPDATE $tbl_name SET teacherid='$teacherid', first_name='$first_name', last_name='$last_name', street='$street',plz='$plz',date_of_birth='$date_of_birth',ort='$ort',job='$job' WHERE id='$id'";
echo $sql;
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";

mysql_close($conn);

}
else{
echo "Not allowed";
}
?>












