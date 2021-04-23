<?php
// Start the session
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body class = "body" style ="background-color:rgb(63, 192, 235);">

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">How Many Players?</i></b></h1>

<?php
$_SESSION["oldMain"] = array();

//Connect to DB
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//Form for inputting number of players
echo "<html><body class = \"body\">

    <form create=\"create.php\" method=\"post\">

    <input class = \"input\" type=\"number\" name=\"players\">

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Start</i></form>";

//Add new match to DB
if (isset($_POST['players'])) {

    $num = $_POST['players'];

    $sql2 = mysqli_query($conn, "SELECT MAX(matchID) AS max FROM `matches`;");
    $res = mysqli_fetch_array($sql2);
    $nextID = $res['max'] + 1;

    $sql = "INSERT INTO matches(matchID, numPlayers) VALUES(\"$nextID\", \"$num\")";

    if(mysqli_query($conn, $sql)){
        echo "Starting match...";
    }
    else{
        echo "ERROR: Match database may be offline";
    }

    $sql3 = mysqli_query($conn, "SELECT MAX(playerID) AS max FROM `player`;");
    $res2 = mysqli_fetch_array($sql3);
    $nextPlayerID = $res2['max'] + 1;

    $sqlPar = "INSERT INTO player(playerID, matchID, playerName) VALUES(\"$nextPlayerID\", \"$nextID\", \"Par\")";
    mysqli_query($conn, $sqlPar);

    for ($x = 0; $x < $num; $x++) {
        $pName = "P" . ($x+1);
        $nextPlayerID += 1;
        $sqlLoop = "INSERT INTO player(playerID, matchID, playerName) VALUES(\"$nextPlayerID\", \"$nextID\", \"$pName\")";
        if (mysqli_query($conn, $sqlLoop)) {
            //echo $pName . "Added";
        }
        else {
            echo "ERROR: Match database may be offline";
        }
    }

    //Set match ID in cookie
    $cookie_name = "DiscSyncMatchID";
    setcookie($cookie_name, $nextID, time() + (86400 * 30), "/"); // 86400 = 1 day

    //$conn->close();

    header("Location: scoresheet.php");

}

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>