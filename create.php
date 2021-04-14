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
    //$result = $conn->query($sql);
    if(mysqli_query($conn, $sql)){
        echo "Starting match...";
    }
    else{
        echo "ERROR: Match database may be offline";
    }

    //header("Location: scoresheet.php");

}

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>