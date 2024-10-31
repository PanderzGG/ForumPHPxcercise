<?php 
session_start(); // Session starten

// Session-Variablen löschen
$_SESSION = []; // Alle Session-Variablen leeren
session_destroy(); // Session zerstören

// Zurück zur Startseite
header("Location: index.php");
exit();
?>
