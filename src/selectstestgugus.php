<?php

$dbh = new PDO('mysql:host=localhost;dbname=gemeinde', "root", "");
$strongestPartei = "SVP";
$gemeinden = array(
);
$sql = 'select distinct BFS_NR_GEMEINDE from TBevoelkerung;';
foreach ($dbh->query($sql) as $row) {
    array_push($gemeinden, $row);
}

getPointsPartei($dbh, $gemeinden,$strongestPartei);

function getPointsPartei($dbh,$gemeinden,$partei){
    foreach($gemeinden as $gemeindennr){
        $scoreboardtemp=[];
        $sqlpartei = 'select round(((select max('.$partei.') from TParteistaerke)-(select '.$partei.'
            from TParteistaerke where BFS_NR_GEMEINDE = '.$gemeindennr[0].'))*(100/(select max('.$partei.')-min('.$partei.') from TParteistaerke)));';
        foreach ($dbh->query($sqlpartei) as $var){
            echo $gemeindennr[0]." SCORE: ".$var[0]. "<br>";
            array_push($scoreboardtemp,["ID"=> $gemeindennr[0],"score"=> $var[0]]);
        }
    }
    //select * from TSteuerfuss where JAHR = "2016" and STEUERFUSS =(select min(STEUERFUSS) from TSteuerfuss where JAHR = "2016");
}