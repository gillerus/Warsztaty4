<?php
session_start();

if(!isset($_SESSION['zalogowany'])){
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Sklep [R] [S] [I]</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <center>
                <h4>[R] [S] [I] SHOP | <a href="loguot.php">Wyloguj</a></h4>               
            <center>
        </div>
    </body>
</html>