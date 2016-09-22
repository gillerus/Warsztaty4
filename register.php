<?php

session_start();

require 'src/Users.php';
require 'src/Database.php';

$name = $_POST['name_reg'];
$surname = $_POST['surname_reg'];
$address = $_POST['address_reg'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //udana walidacja
    $allOK = true;

    //poprawnosc email  
    $email = $_POST['email_reg'];
    $email_b = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email_b, FILTER_VALIDATE_EMAIL) == false || ($email_b != $email)) {
        $allOK = false;
        $_SESSION['e_email'] = "Podaj poprawny email";
        header('Location: index.php');
    }

    //poprawnosc hasla
    $password = $_POST['password_reg'];
    $confirm_password = $_POST['confirm_password_reg'];

    if (strlen($password) < 8) {
        $allOK = false;
        $_SESSION['e_pass'] = "Hasło musi posiadać ponad 8 znaków";
        header('Location: index.php');
    }

    if ($password != $confirm_password) {
        $allOK = false;
        $_SESSION['e_pass'] = "Podane hasła muszą być równe";
        header('Location: index.php');
    }

    //sprawdzenie recaptcha
    $secretKey = '6LfEWQcUAAAAAPHe6L8at48FaNEKhN-FCE_Xdnlu';

    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response']);

    $respon = json_decode($check);

    if ($respon->success == false) {
        $allOK = false;
        $_SESSION['e_bot'] = "Potwierdź, że nie jesteś botem";
        header('Location: index.php');
    }

    //sprawdzanie unikalności danych w bazie
    $sql = "SELECT id FROM Users WHERE email='$email'";

    $conn = DataBase::conn();
    $res = $conn->query($sql);
    DataBase::closeConn($conn);

    if ($res->num_rows > 0) {
        $allOK = false;
        $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu email";
        header('Location: index.php');
    }


    //ewentualna waidacja reszty danych (isset/isnum)
    if ($allOK) {
        //obiekt
        $user = new Users();

        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $user->setAddress($address);
        $user->setHashedPassword($password);

        $conn = DataBase::conn();

        $user->saveToDB($conn);

        DataBase::closeConn($conn);




        //wszystkie testy zaliczone
//        $sql = "INSERT INTO Users VALUES (NULL, '$name', '$surname', '$email', '$password', '$address')";
//
//        $conn = DataBase::conn();
//        $res = $conn->query($sql);
//        DataBase::closeConn($conn);

        $_SESSION['reg_succes'] = true;
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
    exit();
}





