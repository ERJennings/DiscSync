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
    <link rel="icon" href="logo.png">
</head>
<body class = "body" style ="background-color:rgb(63, 192, 235);">

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">How Many Players?</i></b></h1>

<?php
//This array helps prevent players from overwriting each other's data
$_SESSION["oldMain"] = array();

//Connect to DB
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//Form to get the desired number of players
//6 players is the max as it is considered discourteous to play with a larger group
echo "<html><body class = \"body\">

    <form create=\"create.php\" method=\"post\">

    <input class = \"input\" type=\"number\" min=\"1\" max=\"6\" name=\"players\" placeholder=\"1-6 Players\">

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Start</i></form>";

if (isset($_POST['players'])) {

    $num = $_POST['players'];

    //Get next available match ID from DB
    $sql2 = mysqli_query($conn, "SELECT MAX(matchID) AS max FROM `matches`;");
    $res = mysqli_fetch_array($sql2);
    $nextID = $res['max'] + 1;

    //Create new match in DB
    $sql = "INSERT INTO matches(matchID, numPlayers) VALUES(\"$nextID\", \"$num\")";

    if(mysqli_query($conn, $sql)){
        echo "Starting match...";
    }
    else{
        echo "ERROR: Match database may be offline";
    }

    //Get next available player ID from DB
    $sql3 = mysqli_query($conn, "SELECT MAX(playerID) AS max FROM `player`;");
    $res2 = mysqli_fetch_array($sql3);
    $nextPlayerID = $res2['max'] + 1;

    //Create player to hold par values
    $sqlPar = "INSERT INTO player(playerID, matchID, playerName) VALUES(\"$nextPlayerID\", \"$nextID\", \"Par\")";
    mysqli_query($conn, $sqlPar);

    //Create players for each human participant (not par)
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
    //The cookie is used so that the ID is retained if browser is closed and reopened
    $cookie_name = "DiscSyncMatchID";
    setcookie($cookie_name, $nextID, time() + (86400 * 30), "/"); // 86400 = 1 day

    //$conn->close();

    header("Location: scoresheet.php");

}

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>