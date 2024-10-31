<?php
    session_start(); // Session starten
    require_once 'db.php'; // Datenbankverbindung einbinden

    // Prüfen, ob ein Autor eingeloggt ist und ob Inhalt vorhanden ist
    if (isset($_SESSION['autor_id']) && !empty($_POST['inhalt'])) {
        $autorId = $_SESSION['autor_id']; // Autor-ID aus der Session
        $inhalt = trim($_POST['inhalt']); // Inhalt des Beitrags

        // Zeilenumbrüche normalisieren
        $inhalt = str_replace(array("\r\n", "\r", "\n"), "\n", $inhalt);

        // Beitrag in die Datenbank speichern
        $stmt = $db->prepare("INSERT INTO beitrag (autorid, datum, inhalt) VALUES (?, NOW(), ?)");
        $stmt->bind_param('is', $autorId, $inhalt);
        
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
