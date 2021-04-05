<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body class = "body" style ="background-color:rgb(63, 192, 235);">

<?php
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

$gameID = 2;
$numPlayers = 2;

echo "<html>

<body class = \"body\">

<h2 class = \"h2\"><b style=\"font-family: Arial\"><i style =\"color:white\">Match ID: $gameID</i></b></h2>

<form scoresheet=\"scoresheet.php\" method=\"post\">
    
    <!--
    <table class = \"table\">
    <tr class = \"tr\">
        <th>Hole</th>
        <th>Par</th>
        <th><input class = \"cell\" type=\"text\" name=\"p1\" value=\"P1\"></th>
    </tr>
    </table>
    -->
    
    
    <table class = \"table\">
    
    <tr class = \"tr\">
        <th>Hole</th>
        <th>Par</th>
        <th><input class = \"cell\" type=\"text\" name=\"p1\" value=\"P1\"></th>
        <th><input class = \"cell\" type=\"text\" name=\"p2\" value=\"P2\"></th>
        <th><input class = \"cell\" type=\"text\" name=\"p3\" value=\"P3\"></th>
        <th><input class = \"cell\" type=\"text\" name=\"p4\" value=\"P4\"></th>
        <th><input class = \"cell\" type=\"text\" name=\"p5\" value=\"P5\"></th>
        <th><input class = \"cell\" type=\"text\" name=\"p6\" value=\"P6\"></th>
    </tr>
    
    <tr class = \"tr\">
        <td>1</td>
        <td><input class = \"cell\" type=\"number\" name=\"par1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p1h1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p2h1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p3h1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p4h1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p5h1\"></td>
        <td><input class = \"cell\" type=\"number\" name=\"p6h1\"></td>
    </tr>
    </table>
    

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Update</i></form>";

?>
<!--
<table class = "table">
    <tr class = "tr">
        <th>Hole</th>
        <th>Par</th>
        <th>P1</th>
        <th>P2</th>
    </tr>
    <tr class = "tr">
        <td>1</td>
        <td>3</td>
        <td>3</td>
        <td>3</td>
    </tr>
    <tr class = "tr">
        <td>2</td>
        <td>4</td>
        <td>3</td>
        <td>4</td>
    </tr>
</table>
-->
</body>
</html>