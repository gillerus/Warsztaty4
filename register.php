<?php

session_start();

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

    




    if ($allOK) {
        //wszystkie testy zaliczone
    }
} else {
    header('Location: index.php');
    exit();
}
require 'src/Database.php';
require 'src/Users.php';

$name = $_POST['name_reg'];
$surname = $_POST['surname_reg'];
$address = $_POST['address_reg'];


$user = new Users();

$user->setName($name);
$user->setSurname($surname);
$user->setEmail($email);
$user->setAddress($address);
$user->setHashedPassword($password);

$conn = DataBase::conn();

$user->saveToDB($conn);

DataBase::closeConn($conn);
