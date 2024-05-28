<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'functions.php';
$customCssPath = "http://localhost/KPTC/style.css";
createHeader('Home', $customCssPath);
?>

<div class="container">
    <h2>Welcome to the Customer Management System</h2>
    <p><a href="pages/login_screen.php" class="btn-custom btn btn-primary">Login</a></p>
    <p><a href="pages/register_screen.php" class="btn-custom btn btn-secondary">Register</a></p>
</div>

<?php
$customCssPath = "http://localhost/KPTC/style.css";
$footerClass = "footer-custom";
createFooter($customCssPath, $footerClass);
?>