<?php
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyName = $_POST['company_name'];
    $contactPerson = $_POST['contact_person'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (createClient($companyName, $contactPerson, $phone, $address)) {
        header('Location: ../pages/clients_overview.php');
        exit;
    } else {
        echo "Client creation failed. Please try again.";
    }
}
?>
