<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body style ="background-color:rgb(63, 192, 235);">

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">Enter a Game ID</i></b></h1>

<?php

$conn = new mysqli($_SERVER['discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com'],
    $_SERVER['admin'], $_SERVER['365DaOfAmTr'], $_SERVER['discsyncdb'], $_SERVER['3306']);

echo "<html><body>

<form join=\"join.php\" method=\"post\">

    <input class = \"input\", type=\"number\" name=\"id\">

    <br> <p>

    <button class = \"button\" type=\"submit\" name=\"submit\"><i>Start</i></form>";

$num = $_POST['id'];

?>

<h1 class = "h1"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>