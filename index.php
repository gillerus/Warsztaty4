<?php
session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: shop.php');
    exit();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Sklep [R] [S] [I]</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">

            <h4>Witamy na stronie [R] [S] [I] czyli Randomowego Sklepu Internetowego</h4>
            <br/>
            <h4>Zaloguj się:</h4>
            <form action="zaloguj.php" method="post">
                <table class="table table-striped">
                    <tr>
                        <td> Email:</td><td> <input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <!-- password pole txt żebym widział co testowo wpisuje, później do poprawy !!!!  -->
                        <td> Password:</td><td> <input type="text" name="password"></td>
                    </tr>
                    <tr>
                        <td> <input type="submit" value="Zaloguj się"></td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
            }
            ?>
            <hr/>
            <h4>Zarejestruj się:</h4>
            <form action="register.php" method="post">
                <table class="table table-striped">
                    <tr>
                        <td>Name:</td> <td><input type="text" name="name_reg"></td>
                    </tr>
                    <tr>
                        <td>Surname:</td> <td><input type="text" name="surname_reg"></td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td><input type="text" name="email_reg"></td>
                        <td>
                            <?php
                            if (isset($_SESSION['e_email'])) {
                                echo $_SESSION['e_email'];
                                unset($_SESSION['e_email']);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address:</td> <td><input type="text" name="address_reg"></td>
                    </tr>
                    <!-- password pole txt żebym widział co testowo wpisuje, później do poprawy !!!!  -->
                    <tr>
                        <td>Password:</td> <td><input type="text" name="password_reg"></td>
                    </tr>

                    <tr>
                        <td>Confirm password:</td> <td><input type="text" name="confirm_password_reg"></td>
                        <td>
                            <?php
                            if (isset($_SESSION['e_pass'])) {
                                echo $_SESSION['e_pass'];
                                unset($_SESSION['e_pass']);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="g-recaptcha" data-sitekey="6Lc8UAcUAAAAADntDCNiamqoA7q0N6cAmWWSWhHm"></div></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Zarejestruj się"></td>
                    </tr>
                </table>
            </form>

        </div>
    </body>
</html>