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

//Temporary, will be correctly determined later
$gameID = 2;

//Get number of players for match
$sql = "SELECT matchID, numPlayers FROM matches WHERE matchID=$gameID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$numPlayers = $row["numPlayers"];

//Put DB data into array
$scoreData = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
);

$sqldata = "SELECT playerID, matchID, playerName, score1, score2,
       score3, score4, score5, score6, score7, score8, score9, score10, score11, score12,
        score13, score14, score15, score16, score17, score18 FROM player WHERE matchID=$gameID";
$resultdata = $conn->query($sqldata);

while ($scoreData[] = mysqli_fetch_assoc($resultdata));

$names = array_column($scoreData, 'playerName');
$hole1scores = array_column($scoreData, 'score1');
$hole2scores = array_column($scoreData, 'score2');
$hole3scores = array_column($scoreData, 'score3');
$hole4scores = array_column($scoreData, 'score4');
$hole5scores = array_column($scoreData, 'score5');
$hole6scores = array_column($scoreData, 'score6');
$hole7scores = array_column($scoreData, 'score7');
$hole8scores = array_column($scoreData, 'score8');
$hole9scores = array_column($scoreData, 'score9');
$hole10scores = array_column($scoreData, 'score10');
$hole11scores = array_column($scoreData, 'score11');
$hole12scores = array_column($scoreData, 'score12');
$hole13scores = array_column($scoreData, 'score13');
$hole14scores = array_column($scoreData, 'score14');
$hole15scores = array_column($scoreData, 'score15');
$hole16scores = array_column($scoreData, 'score16');
$hole17scores = array_column($scoreData, 'score17');
$hole18scores = array_column($scoreData, 'score18');

$totalPar = $hole1scores[0]+$hole2scores[0]+$hole3scores[0]+$hole4scores[0]+$hole5scores[0]+$hole6scores[0]+$hole7scores[0]+
    $hole8scores[0]+$hole9scores[0]+$hole10scores[0]+$hole11scores[0]+$hole12scores[0]+$hole13scores[0]+$hole14scores[0]+
    $hole15scores[0]+$hole16scores[0]+$hole17scores[0]+$hole18scores[0];

$p1total = $hole1scores[1]+$hole2scores[1]+$hole3scores[1]+$hole4scores[1]+$hole5scores[1]+$hole6scores[1]+$hole7scores[1]+
    $hole8scores[1]+$hole9scores[1]+$hole10scores[1]+$hole11scores[1]+$hole12scores[1]+$hole13scores[1]+$hole14scores[1]+
    $hole15scores[1]+$hole16scores[1]+$hole17scores[1]+$hole18scores[1];
$p1OverUnder = getOverUnder($p1total, $totalPar);

$p2total = $hole1scores[2]+$hole2scores[2]+$hole3scores[2]+$hole4scores[2]+$hole5scores[2]+$hole6scores[2]+$hole7scores[2]+
    $hole8scores[2]+$hole9scores[2]+$hole10scores[2]+$hole11scores[2]+$hole12scores[2]+$hole13scores[2]+$hole14scores[2]+
    $hole15scores[2]+$hole16scores[2]+$hole17scores[2]+$hole18scores[2];
$p2OverUnder = getOverUnder($p2total, $totalPar);

$p3total = $hole1scores[3]+$hole2scores[3]+$hole3scores[3]+$hole4scores[3]+$hole5scores[3]+$hole6scores[3]+$hole7scores[3]+
    $hole8scores[3]+$hole9scores[3]+$hole10scores[3]+$hole11scores[3]+$hole12scores[3]+$hole13scores[3]+$hole14scores[3]+
    $hole15scores[3]+$hole16scores[3]+$hole17scores[3]+$hole18scores[3];
$p3OverUnder = getOverUnder($p3total, $totalPar);

$p4total = $hole1scores[4]+$hole2scores[4]+$hole3scores[4]+$hole4scores[4]+$hole5scores[4]+$hole6scores[4]+$hole7scores[4]+
    $hole8scores[4]+$hole9scores[4]+$hole10scores[4]+$hole11scores[4]+$hole12scores[4]+$hole13scores[4]+$hole14scores[4]+
    $hole15scores[4]+$hole16scores[4]+$hole17scores[4]+$hole18scores[4];
$p4OverUnder = getOverUnder($p4total, $totalPar);

$p5total = $hole1scores[5]+$hole2scores[5]+$hole3scores[5]+$hole4scores[5]+$hole5scores[5]+$hole6scores[5]+$hole7scores[5]+
    $hole8scores[5]+$hole9scores[5]+$hole10scores[5]+$hole11scores[5]+$hole12scores[5]+$hole13scores[5]+$hole14scores[5]+
    $hole15scores[5]+$hole16scores[5]+$hole17scores[5]+$hole18scores[5];
$p5OverUnder = getOverUnder($p5total, $totalPar);

$p6total = $hole1scores[6]+$hole2scores[6]+$hole3scores[6]+$hole4scores[6]+$hole5scores[6]+$hole6scores[6]+$hole7scores[6]+
    $hole8scores[6]+$hole9scores[6]+$hole10scores[6]+$hole11scores[6]+$hole12scores[6]+$hole13scores[6]+$hole14scores[6]+
    $hole15scores[6]+$hole16scores[6]+$hole17scores[6]+$hole18scores[6];
$p6OverUnder = getOverUnder($p6total, $totalPar);

//Make sure correct number of columns appear
$style2 = "";
$style3 = "";
$style4 = "";
$style5 = "";
$style6 = "";

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


if($numPlayers < 6){
    $style6 = "style='display:none;'";
}
if($numPlayers < 5){
    $style5 = "style='display:none;'";
}
if($numPlayers < 4){
    $style4 = "style='display:none;'";
}
if($numPlayers < 3){
    $style3 = "style='display:none;'";
}
if($numPlayers < 2){
    $style2 = "style='display:none;'";
}

//Form containing scoresheet
echo "<html>

<body class = \"body\">

<h2 class = \"h2\"><b style=\"font-family: Arial\"><i style =\"color:white\">Match ID: $gameID</i></b></h2>

<form scoresheet=\"scoresheet.php\" method=\"post\">
      
    <table class = \"table\" border='1'>
    <!--Headers-->
    <tr class = \"tr\">
        <th>Hole</th>
        <th>Par</th>
        <th><input class = \"cell\" type=\"text\" name=\"p1\" value=$names[1]></th>
        <th <?php echo $style2;?><input class = \"cell\" type=\"text\" name=\"p2\" value=$names[2]></th>
        <th <?php echo $style3;?><input class = \"cell\" type=\"text\" name=\"p3\" value=$names[3]></th>
        <th <?php echo $style4;?><input class = \"cell\" type=\"text\" name=\"p4\" value=$names[4]></th>
        <th <?php echo $style5;?><input class = \"cell\" type=\"text\" name=\"p5\" value=$names[5]></th>
        <th <?php echo $style6;?><input class = \"cell\" type=\"text\" name=\"p6\" value=$names[6]></th>
    </tr>
    <!--First Row-->
    <tr class = \"tr\">
        <th>1</th>
        <td><input class = \"cell\" type=\"number\" name=\"par1\" value = $hole1scores[0]></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h1\" value = $hole1scores[1]></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h1\" value = $hole1scores[2]></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h1\" value = $hole1scores[3]></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h1\" value = $hole1scores[4]></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h1\" value = $hole1scores[5]></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h1\" value = $hole1scores[6]></td>
    </tr>
    <!--Second Row-->
    <tr class = \"tr\">
        <th>2</th>
        <td><input class = \"cell\" type=\"number\" name=\"par2\" value = $hole2scores[0]></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h2\" value = $hole2scores[1]></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h2\" value = $hole2scores[2]></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h2\" value = $hole2scores[3]></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h2\" value = $hole2scores[4]></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h2\" value = $hole2scores[5]></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h2\" value = $hole2scores[6]></td>
    </tr>
    <!--Third Row-->
    <tr class = \"tr\">
        <th>3</th>
        <td><input class = \"cell\" type=\"number\" name=\"par3\" value = $hole3scores[0]></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h3\" value = $hole3scores[1]></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h3\" value = $hole3scores[2]></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h3\" value = $hole3scores[3]></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h3\" value = $hole3scores[4]></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h3\" value = $hole3scores[5]></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h3\" value = $hole3scores[6]></td>
    </tr>
    <!--Fourth Row-->
    <tr class = \"tr\">
        <th>4</th>
        <td><input class = \"cell\" type=\"number\" name=\"par4\" value = $hole4scores[0]></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h4\" value = $hole4scores[1]></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h4\" value = $hole4scores[2]></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h4\" value = $hole4scores[3]></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h4\" value = $hole4scores[4]></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h4\" value = $hole4scores[5]></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h4\" value = $hole4scores[6]></td>
    </tr>
    <!--Fifth Row-->
    <tr class = \"tr\">
        <th>5</th>
        <td><input class = \"cell\" type=\"number\" name=\"par5\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h5\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h5\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h5\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h5\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h5\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h5\"></td>
    </tr>
    <!--Sixth Row-->
    <tr class = \"tr\">
        <th>6</th>
        <td><input class = \"cell\" type=\"number\" name=\"par6\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h6\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h6\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h6\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h6\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h6\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h6\"></td>
    </tr>
    <!--Seventh Row-->
    <tr class = \"tr\">
        <th>7</th>
        <td><input class = \"cell\" type=\"number\" name=\"par7\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h7\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h7\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h7\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h7\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h7\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h7\"></td>
    </tr>
    <!--Eighth Row-->
    <tr class = \"tr\">
        <th>8</th>
        <td><input class = \"cell\" type=\"number\" name=\"par8\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h8\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h8\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h8\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h8\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h8\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h8\"></td>
    </tr>
    <!--Ninth Row-->
    <tr class = \"tr\">
        <th>9</th>
        <td><input class = \"cell\" type=\"number\" name=\"par9\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h9\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h9\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h9\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h9\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h9\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h9\"></td>
    </tr>
    <!--Tenth Row-->
    <tr class = \"tr\">
        <th>10</th>
        <td><input class = \"cell\" type=\"number\" name=\"par10\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h10\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h10\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h10\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h10\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h10\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h10\"></td>
    </tr>
    <!--Eleventh Row-->
    <tr class = \"tr\">
        <th>11</th>
        <td><input class = \"cell\" type=\"number\" name=\"par11\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h11\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h11\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h11\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h11\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h11\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h11\"></td>
    </tr>
    <!--Twelfth Row-->
    <tr class = \"tr\">
        <th>12</th>
        <td><input class = \"cell\" type=\"number\" name=\"par12\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h12\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h12\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h12\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h12\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h12\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h12\"></td>
    </tr>
    <!--Thirteenth Row-->
    <tr class = \"tr\">
        <th>13</th>
        <td><input class = \"cell\" type=\"number\" name=\"par13\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h13\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h13\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h13\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h13\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h13\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h13\"></td>
    </tr>
    <!--Fourteenth Row-->
    <tr class = \"tr\">
        <th>14</th>
        <td><input class = \"cell\" type=\"number\" name=\"par14\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h14\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h14\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h14\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h14\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h14\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h14\"></td>
    </tr>
    <!--Fifteenth Row-->
    <tr class = \"tr\">
        <th>15</th>
        <td><input class = \"cell\" type=\"number\" name=\"par15\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h15\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h15\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h15\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h15\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h15\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h15\"></td>
    </tr>
    <!--Sixteenth Row-->
    <tr class = \"tr\">
        <th>16</th>
        <td><input class = \"cell\" type=\"number\" name=\"par16\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h16\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h16\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h16\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h16\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h16\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h16\"></td>
    </tr>
    <!--Seventeenth Row-->
    <tr class = \"tr\">
        <th>17</th>
        <td><input class = \"cell\" type=\"number\" name=\"par17\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h17\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h17\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h17\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h17\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h17\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h17\"></td>
    </tr>
    <!--Eighteenth Row-->
    <tr class = \"tr\">
        <th>18</th>
        <td><input class = \"cell\" type=\"number\" name=\"par18\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h18\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h18\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h18\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h18\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h18\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h18\"></td>
    </tr>
    <!--Totals-->
    <tr class = \"tr\">
        <th >Total</th>
        <th>$totalPar</th>
        <th>$p1OverUnder</th>
        <th <?php echo $style2;?>$p2OverUnder</th>
        <th <?php echo $style3;?>$p3OverUnder</th>
        <th <?php echo $style4;?>$p4OverUnder</th>
        <th <?php echo $style5;?>$p5OverUnder</th>
        <th <?php echo $style6;?>$p6OverUnder</th>
    </tr>
    </table>
    
    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Update</i></form>";

?>

</body>
</html>