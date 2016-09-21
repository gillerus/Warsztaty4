<?php

session_start();

if((!isset($_POST['email'])) || (!isset($_POST['password']))){
    header('Location: shop.php');
    exit();
}

require 'src/Database.php';

$conn = DataBase::conn();

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email) && isset($password)) {

    $sql = 'SELECT * FROM Users WHERE email="' . $email . '"';

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if (password_verify($password, $row['hashed_password'])) {

        $_SESSION['username'] = $row['username'];

        unset($_SESSION['error']);
        $result->free_result();
        $_SESSION['zalogowany'] = true;
        $_SESSION['id'] = $row['id'];
        
        header('location: index.php');
    } else {
        $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header('location: shop.php');
    }
}
DataBase::closeConn($conn);
