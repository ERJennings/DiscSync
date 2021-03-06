<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
    <link rel="icon" href="logo.png">
</head>
<body class = "body" style ="background-color:rgb(63, 192, 235);">

<?php

//Connect to DB
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//Get the ID of the match from the cookie
$cookie_name = "DiscSyncMatchID";
$gameID = $_COOKIE[$cookie_name];

//Get number of players in match
$sql = "SELECT matchID, numPlayers FROM matches WHERE matchID=$gameID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$numPlayers = $row["numPlayers"];

//Pull data for all players in the match
$sqldata = "SELECT playerID, matchID, playerName, score1, score2,
       score3, score4, score5, score6, score7, score8, score9, score10, score11, score12,
        score13, score14, score15, score16, score17, score18 FROM player WHERE matchID=$gameID";
$resultdata = $conn->query($sqldata);

//Will hold names and scores
$mainArray = array();

//Put DB data into easily manageable format
while ($scoreData[] = mysqli_fetch_assoc($resultdata));

//Holds player IDs to be used when entering scores later
$playerIDArray = array_column($scoreData, 'playerID');

//Populate array that will be used to populate scorecard
$mainArray[0]= array_column($scoreData, 'playerName');
for ($i = 1; $i <= 18; $i++) {
    $scoreName = "score" . $i;
    $mainArray[$i] = array_column($scoreData, $scoreName);
}

//Store main array in session variable
//Will be used when checking to see if cell has been changed and prevent overwriting
if (count($_SESSION['oldMain'])==0) {
    $_SESSION['oldMain'] = $mainArray;
}

//Calculate the total score for a column
function columnTotal($colNum, $data) {
    $result = 0;
    for ($x = 1; $x < 19; $x++) {
        $result += $data[$x][$colNum];
    }
    return $result;
}

//Get the total par to be used in scoresheet generation
$totalPar = columnTotal(0, $mainArray);

//Get each players over/under score for scoresheet generation
$p1OverUnder = getOverUnder(1, $mainArray);
if($numPlayers >= 2) {
    $p2OverUnder = getOverUnder(2, $mainArray);
}
if($numPlayers >= 3) {
    $p3OverUnder = getOverUnder(3, $mainArray);
}
if($numPlayers >= 4) {
    $p4OverUnder = getOverUnder(4, $mainArray);
}
if($numPlayers >= 5) {
    $p5OverUnder = getOverUnder(5, $mainArray);
}
if($numPlayers == 6) {
    $p6OverUnder = getOverUnder(6, $mainArray);
}

//Determine how far each player is over or under par
//Only count the score for a hole if both the score and par have been entered
function getOverUnder($playerNum, $scoreArray) {
    $result = 0;
    for ($i = 1; $i <= 18; $i++) {
        $holePar = $scoreArray[$i][0];
        $holeScore = $scoreArray[$i][$playerNum];
        if ($holePar > 0 and $holeScore > 0) {
            $result += ((int)$holeScore-(int)$holePar);
        }
    }
    if ($result > 0) {
        return "+".$result;
    }
    else if ($result == 0) {
        //E means even, or a score of 0
        return "E";
    }
    else {
        return $result;
    }
}

//Construct the header row for the table
//Requires separate code as it does not follow the usual formula
$namerow = "
        <th>Hole</th>
        <th>Par</th>
        <th><input class = \"cell\" type=\"text\" name=\"p1\" value={$mainArray[0][1]}></th>";

//Build the rest of the header row
for ($x = 2; $x <= $numPlayers; $x++) {
    $cellName = "p" . $x;
    $namerow = $namerow . "<th><input class = \"cell\" type=\"text\" name=\"$cellName\" value={$mainArray[0][$x]}></th>";
}

//Generate the HTML for a singular row of the table
function rowGenerator($rn, $playerCount, $dataArray) {
    $buildRow = "<th>$rn</th>";
    $parName = "par" . $rn;
    $buildRow = $buildRow . "<td><input class = \"cell\" type=\"number\" min=\"1\" name=\"$parName\" value = {$dataArray[$rn][0]}></td>";

    for ($x = 1; $x <= $playerCount; $x++) {
        $scoreName = "p".$x."h".$rn;
        $buildRow = $buildRow . "<td><input class = \"cell\" type=\"number\" min=\"1\" name=\"$scoreName\" value = {$dataArray[$rn][$x]}></td>";
    }
    return $buildRow;
}

//Build the HTML for each row
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

//Create the row of totals using the over/under values calculated earlier
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

//This form contains the entire scoresheet
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

if (isset($_POST['submit'])) {

    //Retrieve old values for comparison
    $tempArray = $_SESSION['oldMain'];

    //Check name values to see if any have changed, if so update them
    for ($x = 0; $x < $numPlayers; $x++) {
        $currentNum = $x + 1;
        $currentField = "p" . $currentNum;
        $currentData = $_POST[$currentField];
        $currentPlayer = $playerIDArray[$x+1];
        if ($currentData != $tempArray[0][$x+1]) {
            $nameString = "UPDATE player SET playerName='$currentData' WHERE playerID=$currentPlayer";
            if ($conn->query($nameString) == TRUE) {

            } else {
                echo "ERROR: Match database may be offline";
            }
        }
    }

    //Check score values to see if any have changed, if so update them
    for ($y = 1; $y <= 18; $y++) {
        for ($z = 0; $z <= $numPlayers; $z++) {

            if ($z == 0) {
                $currentField = "par" . $y;
            }
            else {
                $currentField = "p" . $z . "h" . $y;
            }

            $currentData = $_POST[$currentField];
            $currentPlayer = $playerIDArray[$z];

            if ($currentData != $tempArray[$y][$z]) {

                $holeName = "score". $y;
                $scoreString = "UPDATE player SET $holeName=$currentData WHERE playerID=$currentPlayer";

                if ($conn->query($scoreString) == TRUE) {

                } else {
                    echo "ERROR: Match database may be offline";
                }
            }
        }
    }

    //Set session variable to current data for later comparison
    $_SESSION['oldMain'] = $mainArray;

    $conn->close();

    //Refresh the page to populate table with current scores
    $URL="scoresheet.php";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

}

?>

</body>
</html>