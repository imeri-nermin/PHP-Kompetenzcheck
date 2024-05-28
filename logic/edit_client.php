<?php
require '../functions.php';

if (!isLoggedIn()) {
    header('Location: ../pages/login_screen.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clientId = $_POST['client_id'];
    $companyName = $_POST['company_name'];
    $contactPerson = $_POST['contact_person'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    try {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("UPDATE clients SET company_name = ?, contact_person = ?, phone = ?, address = ?, edited_at = NOW() WHERE company_id = ?");
        $stmt->execute([$companyName, $contactPerson, $phone, $address, $clientId]);

        header('Location: ../pages/clients_overview.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>