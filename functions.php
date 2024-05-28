<?php 
 session_start();

 function createHeader($pageTitle, $customCss = "", $bootstrapCss = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css", $headerClass = "") {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='$bootstrapCss' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
        <link rel='stylesheet' href='$customCss'>
        <title>$pageTitle</title>
    </head>
    <body>
        <header class='$headerClass'><h1>$pageTitle</h1></header>
        <div class='content'>
    ";
}

function createFooter($footerClass = "") {
    $currentYear = date("Y");
    echo "
        </div> <!-- close content div -->
        <footer class='$footerClass'> 
            &copy; $currentYear PHP is so much fun
        </footer>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' crossorigin='anonymous'></script>
    </body>
    </html>
    ";
}

function dbConnect() {
    $type = 'mysql';
    $server = 'localhost';
    $db = 'customer_management';
    $port = '3306';
    $charset = 'utf8mb4';

    $username = 'root';
    $password = '';

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
    try {
        return new PDO($dsn, $username, $password, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function registerUser($name, $email, $password) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    return $stmt->execute([$name, $email, $passwordHash]);
}

function loginUser($email, $password) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        return true;
    }
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function createClient($companyName, $contactPerson, $phone, $address) {
    if (!isLoggedIn()) return false;
    $pdo = dbConnect();
    $stmt = $pdo->prepare('INSERT INTO clients (company_name, contact_person, phone, address, created_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
    return $stmt->execute([$companyName, $contactPerson, $phone, $address, $_SESSION['user_id']]);
}

function getClients() {
    if (!isLoggedIn()) return [];
    $pdo = dbConnect();
    $stmt = $pdo->query('SELECT * FROM clients');
    return $stmt->fetchAll();
}

function getClientById($id) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare('SELECT * FROM clients WHERE company_id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateClient($id, $companyName, $contactPerson, $phone, $address) {
    if (!isLoggedIn()) return false;
    $pdo = dbConnect();
    $stmt = $pdo->prepare('UPDATE clients SET company_name = ?, contact_person = ?, phone = ?, address = ?, edited_at = NOW() WHERE company_id = ? AND created_by = ?');
    return $stmt->execute([$companyName, $contactPerson, $phone, $address, $id, $_SESSION['user_id']]);
}

function deleteClient($id) {
    if (!isLoggedIn()) return false;
    $pdo = dbConnect();
    $stmt = $pdo->prepare('DELETE FROM clients WHERE company_id = ? AND created_by = ?');
    return $stmt->execute([$id, $_SESSION['user_id']]);
}