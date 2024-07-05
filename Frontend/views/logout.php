<?php
session_start();
session_destroy(); // Destroy the session
header('Location: ./indexNew.php'); // Redirect to indexNew.php
exit();
?>
