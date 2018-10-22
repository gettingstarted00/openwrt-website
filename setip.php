<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING );
session_start();
$_SESSION["ip"] = $_POST[ip];
header('Location: token.php');
?>
