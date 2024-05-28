<?php
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['company_id'];

    if (deleteClient($id)) {
        header('Location: ../pages/clients_overview.php');
        exit;
    } else {
        echo "Client deletion failed. Please try again.";
    }
}
?>
