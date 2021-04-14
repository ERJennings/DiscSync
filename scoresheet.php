<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body class = "body" style ="background-color:rgb(63, 192, 235);">

<?php
//Connect to DB
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//Get ID of match from cookie
$cookie_name = "DiscSyncMatchID";
$gameID = $_COOKIE[$cookie_name];

//Get number of players for match
$sql = "SELECT matchID, numPlayers FROM matches WHERE matchID=$gameID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$numPlayers = $row["numPlayers"];

$sqldata = "SELECT playerID, matchID, playerName, score1, score2,
       score3, score4, score5, score6, score7, score8, score9, score10, score11, score12,
        score13, score14, score15, score16, score17, score18 FROM player WHERE matchID=$gameID";
$resultdata = $conn->query($sqldata);

$mainArray = array(

);

while ($scoreData[] = mysqli_fetch_assoc($resultdata));

$mainArray[0]= array_column($scoreData, 'playerName');
$mainArray[1] = array_column($scoreData, 'score1');
$mainArray[2] = array_column($scoreData, 'score2');
$mainArray[3] = array_column($scoreData, 'score3');
$mainArray[4] = array_column($scoreData, 'score4');
$mainArray[5] = array_column($scoreData, 'score5');
$mainArray[6] = array_column($scoreData, 'score6');
$mainArray[7] = array_column($scoreData, 'score7');
$mainArray[8] = array_column($scoreData, 'score8');
$mainArray[9] = array_column($scoreData, 'score9');
$mainArray[10] = array_column($scoreData, 'score10');
$mainArray[11] = array_column($scoreData, 'score11');
$mainArray[12] = array_column($scoreData, 'score12');
$mainArray[13] = array_column($scoreData, 'score13');
$mainArray[14] = array_column($scoreData, 'score14');
$mainArray[15] = array_column($scoreData, 'score15');
$mainArray[16] = array_column($scoreData, 'score16');
$mainArray[17] = array_column($scoreData, 'score17');
$mainArray[18] = array_column($scoreData, 'score18');

//Total score for column
function columnTotal($colNum, $data) {
    $result = 0;
    for ($x = 1; $x < 19; $x++) {
        $result += $data[$x][$colNum];
    }
    return $result;
}

$totalPar = columnTotal(0, $mainArray);

$p1total = columnTotal(1, $mainArray);
$p1OverUnder = getOverUnder($p1total, $totalPar);

if($numPlayers >= 2) {
    $p2total = columnTotal(2, $mainArray);;
    $p2OverUnder = getOverUnder($p2total, $totalPar);
}

if($numPlayers >= 3) {
    $p3total = columnTotal(3, $mainArray);;
    $p3OverUnder = getOverUnder($p3total, $totalPar);
}

if($numPlayers >= 4) {
    $p4total = columnTotal(4, $mainArray);;
    $p4OverUnder = getOverUnder($p4total, $totalPar);
}

if($numPlayers >= 5) {
    $p5total = columnTotal(5, $mainArray);
    $p5OverUnder = getOverUnder($p5total, $totalPar);
}

if($numPlayers == 6) {
    $p6total = columnTotal(6, $mainArray);
    $p6OverUnder = getOverUnder($p6total, $totalPar);
}

//Make sure correct number of columns appear
//$style2 = "";
//$style3 = "";
//$style4 = "";
//$style5 = "";
//$style6 = "";

//Determine player's +/- score
function getOverUnder($playerTotal, $coursePar){
    $temp = $playerTotal - $coursePar;
    if ($temp > 0) {
        return "+".$temp;
    }
    else if ($temp == 0) {
        return "E";
    }
    else {
        return $temp;
    }
}


//if($numPlayers < 6){
//    $style6 = "style='display:none;'";
//}
//if($numPlayers < 5){
//    $style5 = "style='display:none;'";
//}
//if($numPlayers < 4){
//    $style4 = "style='display:none;'";
//}
//if($numPlayers < 3){
//    $style3 = "style='display:none;'";
//}
//if($numPlayers < 2){
//    $style2 = "style='display:none;'";
//}

//Construct header row as it does not follow the usual formula
$namerow = "
        <th>Hole</th>
        <th>Par</th>
        <th><input class = \"cell\" type=\"text\" name=\"p1\" value={$mainArray[0][1]}></th>";

for ($x = 2; $x <= $numPlayers; $x++) {
    $cellName = "p" . $x;
    $namerow = $namerow . "<th><input class = \"cell\" type=\"text\" name=\"$cellName\" value={$mainArray[0][$x]}></th>";
}

function rowGenerator($rn, $playerCount, $dataArray) {
    $buildRow = "<th>$rn</th>";
    $parName = "par" . $rn;
    $buildRow = $buildRow . "<td><input class = \"cell\" type=\"number\" name=\"$parName\" value = {$dataArray[$rn][0]}></td>";

    for ($x = 1; $x <= $playerCount; $x++) {
        $scoreName = "p".$x."h".$rn;
        $buildRow = $buildRow . "<td><input class = \"cell\" type=\"number\" name=\"$scoreName\" value = {$dataArray[$rn][$x]}></td>";
    }
    return $buildRow;
}

$row1 = rowGenerator(1,$numPlayers,$mainArray);
$row2 = rowGenerator(2,$numPlayers,$mainArray);
$row3 = rowGenerator(3,$numPlayers,$mainArray);
$row4 = rowGenerator(4,$numPlayers,$mainArray);
$row5 = rowGenerator(5,$numPlayers,$mainArray);
$row6 = rowGenerator(6,$numPlayers,$mainArray);
$row7 = rowGenerator(7,$numPlayers,$mainArray);
$row8 = rowGenerator(8,$numPlayers,$mainArray);
$row9 = rowGenerator(9,$numPlayers,$mainArray);
$row10 = rowGenerator(10,$numPlayers,$mainArray);
$row11 = rowGenerator(11,$numPlayers,$mainArray);
$row12 = rowGenerator(12,$numPlayers,$mainArray);
$row13 = rowGenerator(13,$numPlayers,$mainArray);
$row14 = rowGenerator(14,$numPlayers,$mainArray);
$row15 = rowGenerator(15,$numPlayers,$mainArray);
$row16 = rowGenerator(16,$numPlayers,$mainArray);
$row17 = rowGenerator(17,$numPlayers,$mainArray);
$row18 = rowGenerator(18,$numPlayers,$mainArray);

$totalrow = "
        <th>Total</th>
        <th>$totalPar</th>
        <th>$p1OverUnder</th>";
if ($numPlayers >= 2) {
    $totalrow = $totalrow . "<th>$p2OverUnder</th>";
}
if ($numPlayers >= 3) {
    $totalrow = $totalrow . "<th>$p3OverUnder</th>";
}
if ($numPlayers >= 4) {
    $totalrow = $totalrow . "<th>$p4OverUnder</th>";
}
if ($numPlayers >= 5) {
    $totalrow = $totalrow . "<th>$p5OverUnder</th>";
}
if ($numPlayers == 6) {
    $totalrow = $totalrow . "<th>$p6OverUnder</th>";
}

//Form containing scoresheet
echo "<html>

<body class = \"body\">

<h2 class = \"h2\"><b style=\"font-family: Arial\"><i style =\"color:white\">Match ID: $gameID</i></b></h2>

<form scoresheet=\"scoresheet.php\" method=\"post\">
      
    <table class = \"table\" border='1'>
    <!--Headers-->
    <tr class = \"tr\">
        $namerow
    </tr>
    
    <!--Hole Scores-->
    <tr class = \"tr\">$row1</tr>
    <tr class = \"tr\">$row2</tr>
    <tr class = \"tr\">$row3</tr>
    <tr class = \"tr\">$row4</tr>
    <tr class = \"tr\">$row5</tr>
    <tr class = \"tr\">$row6</tr>
    <tr class = \"tr\">$row7</tr>
    <tr class = \"tr\">$row8</tr>
    <tr class = \"tr\">$row9</tr>
    <tr class = \"tr\">$row10</tr>
    <tr class = \"tr\">$row11</tr>
    <tr class = \"tr\">$row12</tr>
    <tr class = \"tr\">$row13</tr>
    <tr class = \"tr\">$row14</tr>
    <tr class = \"tr\">$row15</tr>
    <tr class = \"tr\">$row16</tr>
    <tr class = \"tr\">$row17</tr>
    <tr class = \"tr\">$row18</tr>
    
    <!--Totals-->
    <tr class = \"tr\">
        $totalrow
    </tr>
    </table>
    
    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Update</i></form>";

?>

</body>
</html>