
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

$first_name =  $_POST["first_name"];
$last_name =  $_POST["last_name"];
$street =  utf8_decode($_POST["street"]);
$plz = $_POST["plz"];
$date_of_birth = $_POST["date_of_birth"];
$ort =  $_POST["ort"];
$job =  $_POST["job"];
$teacherid =$_POST["teacherid"];

$sql="INSERT INTO $tbl_name(teacherid,first_name, last_name, street,plz,date_of_birth,ort,job)VALUES ( '$teacherid' ,'$first_name', '$last_name', '$street','$plz','$date_of_birth','$ort','$job' )";

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












