<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body style ="background-color:rgb(63, 192, 235);">

<?php
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//$gameID = 1;
$numPlayers = 2;

echo "<html>

<body>

<form scoresheet=\"scoresheet.php\" method=\"post\">
    
    <table class = \"table\">
    <!--Headings-->
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
    <!--Hole 1-->
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