<?php
$dbhost = $_SERVER['discsync2.cyudrahusm5z.us-east-1.rds.amazonaws.com'];
$dbport = $_SERVER['3306'];
$dbname = $_SERVER['discsync2'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['admin'];
$password = $_SERVER['365DaOfAmTr'];

$pdo = new PDO($dsn, $username, $password);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DiscSync</title>
    <style>
        h1 {text-align: center;}
        .button {
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: grid;
            font-size: 16px;
            cursor: pointer;
            width: 200px;
            margin: 15px auto auto;
        }
        .input {
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: grid;
            font-size: 16px;
            cursor: pointer;
            width: 200px;
            margin: 15px auto auto;
        }
        .text {
            margin-top: 100px;
        }
    </style>
</head>
<body style ="background-color:rgb(63, 192, 235);">

<h1 class = "text"><b style="font-family: Arial"><i style ="color:white">How Many Players?</i></b></h1>

<input class = "input", type="number">

<button class = "button", type="button", style ="background-color:rgb(47, 126, 212);"><i>Start</i></button>

<h1 class = "text"><b style="font-family: Arial"><i style ="color:white">DiscSync</i></b></h1>

</body>
</html>