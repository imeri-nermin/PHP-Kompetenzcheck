<?php
session_start();
session_unset();
session_destroy();
echo "Session destroyed. Redirecting to login...";
header("Location: ../pages/login_screen.php");
exit();
?>