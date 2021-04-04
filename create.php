<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body style ="background-color:rgb(63, 192, 235);">

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">How Many Players?</i></b></h1>

<?php

//$conn = new mysqli($_SERVER['discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com'],
    //$_SERVER['admin'], $_SERVER['365DaOfAmTr'], $_SERVER['discsyncdb'], $_SERVER['3306']);

$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

echo "<html><body>

<form create=\"create.php\" method=\"post\">

    <input class = \"input\" type=\"number\" name=\"players\">

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Start</i></form>";

//$id = 1;
$num = $_POST['players'];

//$sql = "INSERT INTO match (numPlayers)
//VALUES ($num)";
//if (isset($_POST['submit'])) {

    //$sql = "INSERT INTO 'matches'(matchID, numPlayers) VALUES('{$id}','{$num}')";

    //$sql = "INSERT INTO 'matches'(numPlayers) VALUES({$num})";
    //$result = $conn->query($sql);

    //$sql = "INSERT INTO matches(numPlayers) VALUES(\"$num\")";
//}

if (isset($_POST['players'])) {

    $sql = "INSERT INTO matches(numPlayers) VALUES(\"$num\")";
    $result = $conn->query($sql);

    //$sql = "INSERT INTO 'matches'(matchID, numPlayers) VALUES('{$id}','{$num}')";
    //$result = $conn->query($sql);
}

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>