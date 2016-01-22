<?php
/*  ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(E_ALL);*/

    header('Content-Type: application/json; charset=utf-8'); 
    include ("/var/secure.php");

    $db = mysql_connect($loc,$usr,$pwd);
    if (!$db) {
        die('Could not connect to db: ' . mysql_error());
    }

    mysql_select_db("Kochdb",$db);

    $schulung = mysql_query("select * from schulung", $db);  
    $hours = mysql_query("select * from drivinghour", $db);  
    $bills = mysql_query("select* from bills", $db);
   $result = mysql_query("select * from students", $db);  

    $Total = mysql_query("SELECT count(*) from students;");
    $TotalCount = mysql_result($Total, 0);
    $One = 0;
    $FuckingCounter =0;
    $trutz = array();

    $json_response = array();
    $jsonbill_response = array();
    $jsonhour_response = array();
    $jsonschulung_response = array();
    $potato = array();


    $uniqueDates = array();
    $stack = array("orange", "banana");
    $stack1 = array("potato", "apple");
    $finaly = array();
    array_push($finaly, $stack, $stack1);


echo "[";
    //*****************************SCHULUNG************************************
 while ($schulungrow = mysql_fetch_array($schulung, MYSQL_ASSOC)) {

$schulungrow_array['id'] = $schulungrow['id'];
        $schulungrow_array['date'] = $schulungrow['date'];

        //Vorschulung
        $schulungrow_array['Lenkradbedienung'] = $schulungrow['1'];
        $schulungrow_array['Anfahren/Anhalten'] = $schulungrow['2'];
        $schulungrow_array['Schalten 1/2/3/4/5/6/R'] = $schulungrow['3'];
        $schulungrow_array['Gas/Kupplung/Bremse'] = $schulungrow['4'];
        $schulungrow_array['Sichern/Fahrhofübung'] = $schulungrow['5'];

        //Grundschulung
        $schulungrow_array['Blicktech./Blinker/Spiegel'] = $schulungrow['6'];
        $schulungrow_array['Anfahren/Bremsen/Handbr.'] = $schulungrow['7'];
        $schulungrow_array['Anpassen der Geschw.'] = $schulungrow['8'];
        $schulungrow_array['Einspuren/Spurwechsel'] = $schulungrow['9'];

        //Hauptschulung
        $schulungrow_array['Beobachtung/Voraussicht'] = $schulungrow['10'];
        $schulungrow_array['Fahrbahnbenützung'] = $schulungrow['11'];
        $schulungrow_array['Vortrittsrecht/Bremsber.'] = $schulungrow['12'];
        $schulungrow_array['Abstand'] = $schulungrow['13'];
        $schulungrow_array['Diverenzieren'] = $schulungrow['14'];
        $schulungrow_array['Kreisverkehr'] = $schulungrow['15'];
        $schulungrow_array['Fussgänger'] = $schulungrow['16'];
        $schulungrow_array['Einsp.Tram / Ausnahmen'] = $schulungrow['17'];
        $schulungrow_array['Lichtsig.'] = $schulungrow['18'];
        $schulungrow_array['Autobahn'] = $schulungrow['19'];


        //Perfektionsschulung
        $schulungrow_array['Lückenben./Einfädeln'] = $schulungrow['20'];
        $schulungrow_array['Geschw.gest./Mithalten'] = $schulungrow['21'];
        $schulungrow_array['Wegweiser/Voraussicht'] = $schulungrow['22'];
        $schulungrow_array['Eco'] = $schulungrow['23'];
        $schulungrow_array['Schub'] = $schulungrow['24'];
        $schulungrow_array['Gänge'] = $schulungrow['25'];

        //Manöver
        $schulungrow_array['Bergsichern'] = $schulungrow['26'];
        $schulungrow_array['Anfahren am Berg'] = $schulungrow['27'];
        $schulungrow_array['Rückwärtsfahren '] = $schulungrow['28'];
        $schulungrow_array['Park.rückw.'] = $schulungrow['29'];
        $schulungrow_array['Park.vorw.'] = $schulungrow['30'];
        $schulungrow_array['Korrektur'] = $schulungrow['31'];
        $schulungrow_array['Parkieren seitw.'] = $schulungrow['32'];
        $schulungrow_array['Korrektur nah'] = $schulungrow['33'];
        $schulungrow_array['Korrektur weit'] = $schulungrow['34'];
        $schulungrow_array['Wenden'] = $schulungrow['35'];
        $schulungrow_array['3-Punkt'] = $schulungrow['36'];
        $schulungrow_array['Vollbr.'] = $schulungrow['37'];

        array_push($jsonschulung_response,array_filter($schulungrow_array));

        unset($schulungrow_array);
       $schulungrow_array = array();

}
    //****************************BILLS************************************
    while ($billrow = mysql_fetch_array($bills, MYSQL_ASSOC)) {
        $billrow_array['studentid'] = $billrow['studentid'];
        $billrow_array['date'] = $billrow['date'];
        $billrow_array['amount'] = $billrow['amount'];
        $billrow_array['confirmation'] = $billrow['confirmation'];
        array_push($jsonbill_response,$billrow_array);
        
    }

    //*****************************HOURS************************************
    while ($hourrow = mysql_fetch_array($hours, MYSQL_ASSOC)) {

        $hourrow_array['hour_id'] = $hourrow['id'];
        $hourrow_array['date'] = $hourrow['date'];
        $hourrow_array['duration'] = $hourrow['length'];
       //$hourrow_array["schulung"] = $finaly;

  //**************************ADDING HOUR*****************************
        $finalSchlung = array();
       $finalSchlung = array();
        $SchulungArray = array();
        $NumOfObjectsSchulung = count($jsonschulung_response);
        $workaround = $NumOfObjectsSchulung -1;

        for ($i=0; $i < $NumOfObjectsSchulung; $i++) { 
            if (/*$hourrow_array["hour_id"] == $jsonschulung_response[$i]["id"] && */ $hourrow_array["date"] == $jsonschulung_response[$i]["date"]) {
                array_push($SchulungArray, $jsonschulung_response[$i]);
            }
        }

        $NumOfPotatos = count($SchulungArray);
        for ($a=0; $a < $NumOfPotatos; $a++) { 
            array_push($finalSchlung, $SchulungArray[$a]);
        }
        //echo json_encode($SchulungArray);
        $hourrow_array["Schulung"] = $SchulungArray;
        array_push($jsonhour_response,$hourrow_array);
        //echo json_encode($finalSchlung);
       
        //***************************END ADDING HOUR************************

        

    }

   //****************************FINAL ROWS**********************************
   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['id'] = $row['id'];
        $row_array['first_name'] = $row['first_name'];
        $row_array['last_name'] = $row['last_name'];
               $row_array['street'] = $row['street'];
        $row_array['plz'] = $row['plz'];
        $row_array['date_of_birth'] = $row['date_of_birth'];
        $row_array['ort'] = $row['ort'];
        $row_array['job'] = $row['job'];
        array_push($trutz, $row_array);

        //************************ADDING BILLS********************************
        $finalBill = array();
        $bill = array();
        $NumOfObjectsBill = count($jsonbill_response);

        for ($asdf=0;$asdf<$NumOfObjectsBill;$asdf++){
            if ($row_array['id']==$jsonbill_response[$asdf]['studentid']) {
                array_push($bill, $jsonbill_response[$asdf]);
            }
        }
        $NumOfHoursBill = count($bill);

        for ($potata=0;$potata<$NumOfHoursBill;$potata++)
        {
            array_push($finalBill,$bill[$potata]);

        } 

        $row_array['bills'] = $finalBill;
        //**************************END ADDING BILLS*************************

         //**************************ADDING HOUR*****************************
        $finalHour = array();
        $hour = array();
        $NumOfObjectsHour = count($jsonhour_response);

        for ($asdf1=0;$asdf1<$NumOfObjectsHour;$asdf1++){
           if ($row_array['id']==$jsonhour_response[$asdf1]['hour_id'] ) {
                array_push($hour, $jsonhour_response[$asdf1]);
            }
        }

        $NumOfHoursHour = count($hour);
        for ($potata1=0;$potata1<$NumOfHoursHour;$potata1++)
        {
            array_push($finalHour,$hour[$potata1]);
        } 
        $row_array['hours'] = $finalHour;
       
       echo json_encode($row_array,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        array_push($json_response,$row_array);

        if (count($json_response)!= $One && count($json_response)!= $TotalCount) {
            echo ",";
        }
        unset($row_array);

        //***************************END ADDING HOUR************************
    }
    // echo json_encode($json_response);
    echo "]";

    fclose($db);
?>


