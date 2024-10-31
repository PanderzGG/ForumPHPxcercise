<?php
session_start();
require_once 'db.php'; // Stelle sicher, dass du die DB-Verbindung hast

if (isset($_SESSION['autor_id']) && isset($_POST['antwort']) && isset($_POST['parentid'])) {
    $antwort = $db->real_escape_string($_POST['antwort']);
    $parentid = (int)$_POST['parentid'];
    $autorid = $_SESSION['autor_id'];

    $inhalt = str_replace(array("\r\n", "\r", "\n"),"\n", $inhalt);

    $stmt = $db->prepare("INSERT INTO beitrag (autorid, datum, inhalt, parentid) VALUES (?, NOW(), ?, ?)");
    $stmt->bind_param('isi', $autorid, $antwort, $parentid);

    if ($stmt->execute()) {
        // Erfolgreich gespeichert, Weiterleitung zur Startseite
        header("Location: index.php");
        exit();
    } else {
        echo "Fehler beim Speichern des Beitrags: " . $stmt->error;
    }

    $stmt->close();
    } else {
    // Kein eingelogter Autor oder kein Inhalt, Weiterleitung zur Startseite
    header("Location: index.php");
    exit();
    }
?>
