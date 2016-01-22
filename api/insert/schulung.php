
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
//Add to types array
$types = array();
for ($x = 0; $x < $count; $x++) {
echo "value for x";
echo $x;   
echo  "\n";
   $numericType = $x;
   $numericType = ++$numericType;
   $typeNr = "type";
   $typeNr .= strval($numericType);  
   $types[$x] = $_POST[$typeNr];
} 


$values = array();
for ($y = 0; $y < $count; $y++) {

   $numericValue= $y;
   $numericValue=++$numericValue;
   $valueNr = "value";
   $valueNr .= strval($numericValue);  
   $values[$y] = $_POST[$valueNr];
   echo $values[$y];
} 

//$workaround_type = "`".$type."`";

//PUTING SQL TOGETHER
$sql = "INSERT INTO $tbl_name(id,date,length";

for($z = 0;$z < $count;$z++){
        $miscZ = ",`";
        $stringToAdd = $types[$z];
        $miscZZ = "`";
        $miscZ .= $stringToAdd;
        $miscZ .= $miscZZ;
echo $types[$z];
        $sql .=$miscZ;
}
$sql .=")VALUES( '$id','$date','$length'";
for($a = 0;$a < $count;$a++){
        $miscA = ",'";
        $stringToAddA = $values[$a];
        $miscAA = "'";
        $miscA .= $stringToAddA;
        $miscA .= $miscAA;
        $sql .=$miscA;
}
$sql.=")";

//echo $sql;

$conn->query( utf8_decode ($sql));
mysql_close($conn);
}
else{
echo "Not allowed";
}
?>

