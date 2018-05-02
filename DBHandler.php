<?php
$dbh = new PDO('mysql:host=sql110.unaux.com;dbname=unaux_21386369_ogd4', "unaux_21386369", "gemeinde123");
$sql = 'select distinct BFS_NR_GEMEINDE from TBevoelkerung;';
$gemeinden = array();
session_start();
foreach ($dbh->query($sql) as $row) {
    array_push($gemeinden, $row[0]);
}
$_SESSION["scores"] = [];
foreach ($gemeinden as $gemeindennr) {
    array_push($_SESSION["scores"], ["ID" => $gemeindennr, "score" => 0]);
}

if($_POST['ps'] != "Keine Angabe")
$partei = $_POST['ps'];
foreach ($gemeinden as $gemeindennr) {
    $sqlpartei = 'select distinct round(((select distinct max(' . $partei . ') from TParteistaerke)-(select distinct ' . $partei . '
    from TParteistaerke where BFS_NR_GEMEINDE = ' . $gemeindennr . '))*(100/(select distinct max(' . $partei . ')-min(' . $partei . ') from TParteistaerke)));';
	
    foreach ($dbh->query($sqlpartei) as $var) {
        for($i = 0; $i < 80; $i++)
        {
            if($_SESSION["scores"][$i]["ID"] == $gemeindennr)
            {
                $_SESSION["scores"][$i]["score"] = $_SESSION["scores"][$i]["score"] + $var[0];
                //echo $_SESSION["scores"][$i]["score"] . "x";
            }
        }
    }
}

//var_dump($_SESSION["scores"]);
if( $_POST['age'] != "Keine Angabe") {
    $age = $_POST['age'];
    $min = 38;
    $max = 48;
    if($max - $age > $age - $min)
    {
        $dist = $max -$age;
    }
    else {
        $dist = $age -$min;
    }
    foreach ($gemeinden as $gemeindennr) {
        $classen = array(0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90);
        foreach ($classen as $cl) {
            $sqlGS = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $gemeindennr . ' and ALTERSKLASSEN_CODE = ' . $cl . ' and JAHR = 2016';
            foreach($dbh->query($sqlGS) as $var) {
                $sum = $sum + $var[0] * $cl;
            }
        }
        $sqlGS = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $gemeindennr . ' and JAHR = 2016';
        foreach($dbh->query($sqlGS) as $var) {
            $sum = round($sum / $var[0]) + 2;
        }
        $score = round((ABS($sum - $age)) / ($dist / 100));
        for ($i = 0; $i < 80; $i++) {
            if ($_SESSION["scores"][$i]["ID"] == $gemeindennr) {
                $_SESSION["scores"][$i]["score"] = $_SESSION["scores"][$i]["score"] + $score;
                //echo $_SESSION["scores"][$i]["score"] . "x";
            }
        }
    }
}

if( $_POST['gs'] != "Keine Angabe") {
    $gs = $_POST['gs'];
    if ($gs == 'Weiblich') {
        $gs = 2;
    } else {
        $gs = 1;
    }
    foreach ($gemeinden as $gemeindennr) {
        $sqlanteil = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $gemeindennr . ' and JAHR = 2016 and GESCHLECHT_CODE = ' . $gs . ';';
        //echo $sqlanteil;
        $sql2 = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE = ' . $gemeindennr . ';';
        foreach ($dbh->query($sql2) as $var) {
            $anzahl = $var[0];
        }
        foreach ($dbh->query($sqlanteil) as $anteil) {
            $gesant = $anteil[0];
        }
        $prozent = round($gesant / ($anzahl / 100), 2);
        if($prozent == 51.75 || $prozent == 51.81)
        {
            $score = 0;
            if($prozent > 51)
            {
                $score = 20;
            }
        }
        else {
            $score = 50;
        }
        for ($i = 0; $i < 80; $i++) {
            if ($_SESSION["scores"][$i]["ID"] == $gemeindennr) {
                $_SESSION["scores"][$i]["score"] = $_SESSION["scores"][$i]["score"] + $score;
                //echo $_SESSION["scores"][$i]["score"] . "x";
            }
        }
    }
}

if($_POST['Einw'] != "Keine Angabe") {

    $einwz = $_POST['Einw'];

    foreach ($gemeinden as $gemeindennr) {
        $sql2 = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE = ' . $gemeindennr . ';';
        foreach ($dbh->query($sql2) as $var) {
            $anzahl = $var[0];
        }
        $sqlMaxDist = 'Select MAX(ANZAHL_PERSONEN) From (select BFS_NR_GEMEINDE, SUM(ANZAHL_PERSONEN) AS ANZAHL_PERSONEN from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE =4566) AS HALLO;';
        $sqlMinDist = 'Select MIN(ANZAHL_PERSONEN) From (select BFS_NR_GEMEINDE, SUM(ANZAHL_PERSONEN) AS ANZAHL_PERSONEN from TBevoelkerung where JAHR = "2016" and BFS_NR_GEMEINDE =4651) AS HALLO;';
        foreach ($dbh->query($sqlMaxDist) as $var) {
            $maxanzahl = $var[0];
        }

        foreach ($dbh->query($sqlMinDist) as $var) {

            $minanzahl = $var[0];

        }

        if (($maxanzahl - $einwz) > ($einwz - $minanzahl)) {

            $score = ABS(round(($maxanzahl - $anzahl) / (($maxanzahl - $einwz) / 100))-100);

        } else {

            $score = ABS(round(($anzahl - $minanzahl) / (($einwz - $minanzahl) / 100))-100);

        }

        for ($i = 0; $i < 80; $i++) {

            if ($_SESSION["scores"][$i]["ID"] == $gemeindennr) {

                //echo $maxanzahl - $anzahl . "x";

                $_SESSION["scores"][$i]["score"] = $_SESSION["scores"][$i]["score"] + $score;

                //echo $_SESSION["scores"][$i]["score"] . "x";

            }

        }

    }

}


if($_POST["sf"] != "Keine Angabe") {
    $steuerfuss = $_POST["sf"];
    $maxdistselect = 'select (select max(STEUERFUSS) FROM TSteuerfuss WHERE JAHR = 2016) - (' . $steuerfuss . ') from TSteuerfuss';
    $mindistselect = 'select ABS((' . $steuerfuss . ') - (select min(STEUERFUSS) FROM TSteuerfuss  WHERE JAHR = 2016)) from TSteuerfuss';
	 
    foreach ($dbh->query($maxdistselect) as $var) {
        $maxdist = $var[0];
    }
    foreach ($dbh->query($mindistselect) as $var) {
        $mindist = $var[0];
    }
    foreach ($gemeinden as $gemeindennr) {

        //print_r($_SESSION["scores"]);
        if ($maxdist > $mindist) {
            $scoreSelect = 'select distinct round(((select STEUERFUSS from TSteuerfuss where BFS_NR_GEMEINDE = ' . $gemeindennr . ' and JAHR = 2016) - ' . $steuerfuss . ') / (' . $maxdist . '/100)) from TSteuerfuss';
        } else {
            $scoreSelect = 'select distinct round(ABS(' . $steuerfuss . ' - (select STEUERFUSS from TSteuerfuss where BFS_NR_GEMEINDE = ' . $gemeindennr . ' and JAHR = 2016)) / (' . $mindist . '/100)) from TSteuerfuss';
        }
        foreach ($dbh->query($scoreSelect) as $var) {
            for ($i = 0; $i < 80; $i++) {
                if ($_SESSION["scores"][$i]["ID"] == $gemeindennr) {
                    $_SESSION["scores"][$i]["score"] = $_SESSION["scores"][$i]["score"] + $var[0];
                    //echo $_SESSION["scores"][$i]["score"] . "x";
                }
            }
        }
        $_SESSION["reset"] = true;
        //print_r($_SESSION["scores"]);
    }
}
usort($_SESSION["scores"], 'sortByOrder');
$seeanstoss = array(4421,4401,4411,4441,4436,4451,4426,4656,4641,4691,4643,4671,4696,4651,4646,4851,4801,4864,4826,4806);
usort($_SESSION["scores"], 'sortByOrder');
$id = $_SESSION["scores"][0]["ID"];
$score = $_SESSION["scores"][0]["score"];
if($_POST["Sa"] == 1){
    $get = 1;
    $i = 0;
    while($get == 1)
    {
        foreach ($seeanstoss as $gem)
        {
            if($gem == $_SESSION["scores"][$i]["ID"])
            {
                $get = 0;
                $id = $gem;
            }
        }
        $i++;
    }
    $sa = "Hat Anschluss zum Bodensee";
}
$get = 1;
$i = 0;
$sa = "Hat keinen Anschluss zum Bodensee";
foreach ($seeanstoss as $gem)
{
    if($gem == $id)
    {
        $get = 0;
        $sa = "Hat Anschluss zum Bodensee";
    }
}


$sqlname = 'select distinct GEMEINDE_Name from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id;
$sqlPS = 'select distinct ' . $partei . ' from TParteistaerke where BFS_NR_GEMEINDE = ' . $id;
$sqlGS = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and GESCHLECHT_CODE = ' . $gs . ' and JAHR = 2016';
$sqlAlter = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and ALTERSKLASSEN_CODE = ' . $age . ' and JAHR = 2016';
$sqlein = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and JAHR = 2016';
$sqlst = 'select STEUERFUSS from TSteuerfuss where BFS_NR_GEMEINDE = ' . $id . ' and JAHR = 2016';

foreach($dbh->query($sqlPS) as $var) {
    $pas = $partei . " " . $var[0] . '%';
}
foreach($dbh->query($sqlAlter) as $var) {
    $ges = "Personen im angegebenen Geschlecht: " . $var[0];
}
foreach($dbh->query($sqlein) as $var) {
    $ein = $var[0];
}
foreach($dbh->query($sqlst) as $var) {
    $st = $var[0];
}

$classen = array(0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90);
foreach ($classen as $cl) {
    $sqlGS = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and ALTERSKLASSEN_CODE = ' . $cl . ' and JAHR = 2016';
    foreach($dbh->query($sqlGS) as $var) {
        $sum = $sum + $var[0] * $cl;
    }
}
$sqlGS = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and JAHR = 2016';
foreach($dbh->query($sqlGS) as $var) {
    $sum = round($sum / $var[0]) + 2;
}
$alter = "Durchschnittsalter: " . $sum;
$sqlAlter = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and GESCHLECHT_CODE = 1 and JAHR = 2016';
$sqlAlter2 = 'select sum(ANZAHL_PERSONEN) from TBevoelkerung where BFS_NR_GEMEINDE = ' . $id . ' and GESCHLECHT_CODE = 2 and JAHR = 2016';
foreach($dbh->query($sqlAlter) as $var) {
    $m = $var[0];
}
foreach($dbh->query($sqlAlter2) as $var) {
    $ges = "Anzahl Personen: Männlich: " . $m . " Weiblich: " . $var[0];
}
$sqlPS = 'select distinct EDU, EVP, GP, SP, CVP, FDP, SVP, GLP, BDP from TParteistaerke where BFS_NR_GEMEINDE = ' . $id;

    foreach($dbh->query($sqlPS) as $var) {
        $pas = "SVP: " . $var[SVP] . '% SP: ' . $var[SP] . '% EDU: ' . $var[EDU] . '% EVP: ' . $var[EVP] . '% GP: ' . $var[GP] . '% CVP: ' . $var[CVP] . '% FDP: ' . $var[FDP] . '% GLP: ' . $var[GLP] . '% BDP: ' . $var[BDP] .'%';
    }

//r_dump($_SESSION["scores"]);
foreach($dbh->query($sqlname) as $var)
{
    echo utf8_encode($var[0] . ',' . $pas . ',');
    echo ($ges . ',' . $alter . ',' . $ein . ',' . $st . '%,' . $sa);
}

//Name,ps,alter,gs,ewz,sf

function sortByOrder($a, $b) {
    return $a['score'] - $b['score'];
}
