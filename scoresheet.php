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
$numPlayers = 3;
$totalPar = 60;

$p1total = 61;
$p1OverUnder = getOverUnder($p1total, $totalPar);

$p2total = 58;
$p2OverUnder = getOverUnder($p2total, $totalPar);

$p3total = 80;
$p3OverUnder = getOverUnder($p3total, $totalPar);

$p4total = 52;
$p4OverUnder = getOverUnder($p4total, $totalPar);

$p5total = 60;
$p5OverUnder = getOverUnder($p5total, $totalPar);

$p6total = 61;
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
        <th><input class = \"cell\" type=\"text\" name=\"p1\" value=\"Player 1\"></th>
        <th <?php echo $style2;?><input class = \"cell\" type=\"text\" name=\"p2\" value=\"Player 2\"></th>
        <th <?php echo $style3;?><input class = \"cell\" type=\"text\" name=\"p3\" value=\"Player 3\"></th>
        <th <?php echo $style4;?><input class = \"cell\" type=\"text\" name=\"p4\" value=\"Player 4\"></th>
        <th <?php echo $style5;?><input class = \"cell\" type=\"text\" name=\"p5\" value=\"Player 5\"></th>
        <th <?php echo $style6;?><input class = \"cell\" type=\"text\" name=\"p6\" value=\"Player 6\"></th>
    </tr>
    <!--First Row-->
    <tr class = \"tr\">
        <th>1</th>
        <td><input class = \"cell\" type=\"number\" name=\"par1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h1\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h1\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h1\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h1\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h1\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h1\"></td>
    </tr>
    <!--Second Row-->
    <tr class = \"tr\">
        <th>2</th>
        <td><input class = \"cell\" type=\"number\" name=\"par2\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h2\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h2\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h2\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h2\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h2\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h2\"></td>
    </tr>
    <!--Third Row-->
    <tr class = \"tr\">
        <th>3</th>
        <td><input class = \"cell\" type=\"number\" name=\"par3\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h3\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h3\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h3\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h3\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h3\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h3\"></td>
    </tr>
    <!--Fourth Row-->
    <tr class = \"tr\">
        <th>4</th>
        <td><input class = \"cell\" type=\"number\" name=\"par4\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h4\"></td>
        <td <?php echo $style2;?><input class = \"cell\" type=\"number\" name=\"p2h4\"></td>
        <td <?php echo $style3;?><input class = \"cell\" type=\"number\" name=\"p3h4\"></td>
        <td <?php echo $style4;?><input class = \"cell\" type=\"number\" name=\"p4h4\"></td>
        <td <?php echo $style5;?><input class = \"cell\" type=\"number\" name=\"p5h4\"></td>
        <td <?php echo $style6;?><input class = \"cell\" type=\"number\" name=\"p6h4\"></td>
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