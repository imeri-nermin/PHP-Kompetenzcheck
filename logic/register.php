<?php
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($name, $email, $password)) {
        header('Location: ../pages/login_screen.php');
        exit;
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>
