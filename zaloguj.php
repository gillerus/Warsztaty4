<?php

session_start();

require 'src/Database.php';

$conn = DataBase::conn();

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email) && isset($password)) {

    $sql = 'SELECT * FROM Users WHERE email="' . $email . '"';

    $result = $conn->query($sql);
    $user_amm = $result->num_rows;


    $row = $result->fetch_assoc();

    if (password_verify($password, $row['hashed_password'])) {

        $_SESSION['username'] = $row['username'];

        unset($_SESSION['error']);
        $result->free_result();

        header('location: shop.php');
    } else {
        $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header('location: index.php');
    }
}
DataBase::closeConn($conn);
