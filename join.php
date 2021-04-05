<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body class = "body" style ="background-color:rgb(63, 192, 235);">

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">Enter a Game ID</i></b></h1>

<?php

//Connect to DB
$conn = new mysqli('discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com',
    'admin', '365DaOfAmTr', 'discsyncdb', '3306');

//Form to get game ID
echo "<html><body class = \"body\">

<form join=\"join.php\" method=\"post\">

    <input class = \"input\" type=\"number\" name=\"id\">

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Start</i></form>";

$gameID = $_POST['id'];

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>