<?php
session_start();
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
                <h4>Witamy na stronie [R] [S] [I]<br/> czyli Randomowego Sklepu Internetowego<br/>
                    <br/>--> zaloguj się </h4>
                <form action="zaloguj.php" method="post">
                    Email: <input type="text" name="email">
                    <!-- password pole txt żebym widział co testowo wpisuje, później do poprawy !!!!  -->
                    Password: <input type="text" name="password"><br><br>
                    <input type="submit" value="Zaloguj się">
                </form>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                }
                ?>
                <br/><br/><hr/>
                <h4>--> lub zarejestruj</h4>
                <form>
                    Username: <input type="text" name="username_reg">
                    Email: <input type="text" name="email_reg">
                    Password: <input type="password" name="password_reg"><br><br>
                    <input type="submit" value="Zarejestruj się">
                </form>
                </form>
                <center>
                    </div>
    </body>
</html>