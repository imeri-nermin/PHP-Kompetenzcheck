<?php
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($email, $password)) {
        header('Location: ../pages/clients_overview.php');
        exit;
    } else {
        echo "Login failed. Please try again.";
    }
}
?>
