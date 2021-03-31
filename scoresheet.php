<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DiscSync</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>
<body style ="background-color:rgb(63, 192, 235);">

<?php
$conn = new mysqli($_SERVER['discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com'],
    $_SERVER['admin'], $_SERVER['365DaOfAmTr'], $_SERVER['discsyncdb'], $_SERVER['3306']);

$rows = 19;
$columns = 4;
?>

<table class = "table">
    <tr class = "tr">
        <th>Hole</th>
        <th>Par</th>
        <th>Eric</th>
        <th>John</th>
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

</body>
</html>