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

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">Enter a Game ID</i></b></h1>

<?php
//This array helps prevent players from overwriting each other's data
$_SESSION["oldMain"] = array();

//Connect to DB
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//Get highest existing ID (all lower IDs will always exist
$sqlmax = mysqli_query($conn, "SELECT MAX(matchID) AS max FROM `matches`;");
$res = mysqli_fetch_array($sqlmax);
$maxID = $res['max'];

//Form to get ID of desired game
echo "<html><body class = \"body\">

<form join=\"join.php\" method=\"post\">

    <input class = \"input\" type=\"number\" min=\"1\" max=\"$maxID\" name=\"id\" placeholder=\"Ex: 50\">

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Start</i></form>";



if (isset($_POST['id'])) {

    $gameID = $_POST['id'];

    //Set match ID in cookie
    //The cookie is used so that the ID is retained if browser is closed and reopened
    $cookie_name = "DiscSyncMatchID";
    setcookie($cookie_name, $gameID, time() + (86400 * 30), "/"); // 86400 = 1 day

    //$conn->close();

    header("Location: scoresheet.php");

}

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>