<?php

$dbh = new PDO('mysql:host=localhost;dbname=gemeinde', "root", "");
$sql = 'select distinct BFS_NR_GEMEINDE from TBevoelkerung;';
$gemeinden = array();
$gemeinden2 = [];
$scoreboard = [];

foreach ($dbh->query($sql) as $row) {
    array_push($gemeinden, $row);
}

foreach ($gemeinden as $row) {
    $sql2 = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE = ' . $row[0] . ';';
    foreach ($dbh->query($sql2) as $var) {
        array_push($gemeinden2,["ID"=> $row[0],"sum"=> $var[0]]);
    }

}


foreach ($gemeinden2 as $row) {

    $ziel = 10000;
    $id = $row["ID"];
    $sqlMaxDist = 'Select MAX(ANZAHL_PERSONEN) From (select BFS_NR_GEMEINDE, SUM(ANZAHL_PERSONEN) AS ANZAHL_PERSONEN from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE =4566) AS HALLO;';
    $sqlMinDist = 'select min(ANZAHL_PERSONEN) from TBevoelkerung where JAHR = "2016"';
    $sqlThisAnz = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE = ' . $id . ';';
    foreach ($dbh->query($sqlMaxDist) as $var) {

        $distanz = abs($var[0] - $ziel);
    }
    foreach ($dbh->query($sqlMinDist) as $var) {
        if($distanz < abs($var[0] - $ziel))
        {
            $distanz = abs($var[0] - $ziel);
        }
    }
    $point = $distanz / 100;

    foreach ($dbh->query($sqlThisAnz) as $var) {
        $thispoint = ($var[0] - $ziel) / $point;
        $anz = $var[0];
    }
    array_push($scoreboard,["ID"=> $id,"score"=> abs($thispoint), "bev" => $anz]);
}



function sortByOrder($a, $b) {
    return $a['score'] - $b['score'];
}

usort($scoreboard, 'sortByOrder');

foreach ($scoreboard as $row){
    echo $row["ID"]." : " . $row["score"] . " : ".$row["bev"];
    echo "</br> ";
}