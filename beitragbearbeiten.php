<?php
session_start(); // Session starten
require_once 'db.php';

// Überprüfen, ob der Benutzer eingeloggt ist und die Beitrags-ID übergeben wurde
if (!isset($_SESSION['autor_id']) || !isset($_GET['id'])) {
    die("Zugriff verweigert. Bitte logge dich ein.");
}

// Beitrags-ID aus dem GET-Parameter abrufen
$beitragId = intval($_GET['id']);

// Den Beitrag aus der Datenbank abrufen
$stmt = $db->prepare("SELECT id, autorid, inhalt FROM beitrag WHERE id = ?");
$stmt->bind_param("i", $beitragId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Beitrag nicht gefunden.");
}

$beitrag = $result->fetch_object();

// Überprüfen, ob der eingeloggte Benutzer der Autor des Beitrags ist
if ($beitrag->autorid != $_SESSION['autor_id']) {
    die("Du hast keine Berechtigung, diesen Beitrag zu bearbeiten.");
}

// Wenn das Formular abgeschickt wurde, den Beitrag aktualisieren
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inhalt = $_POST['inhalt'];

    
    $updateStmt = $db->prepare("UPDATE beitrag SET inhalt = ? WHERE id = ?");
    $updateStmt->bind_param("si", $inhalt, $beitragId);

    if ($updateStmt->execute()) {
        echo "Beitrag erfolgreich aktualisiert.";
        header("Location: index.php");
        exit;
    } else {
        echo "Fehler beim Aktualisieren des Beitrags.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beitrag bearbeiten</title>
</head>
<body>
    <h1>Beitrag bearbeiten</h1>

    <form action="" method="POST">
        <label for="inhalt">Inhalt:</label><br>
        <textarea id="inhalt" name="inhalt" rows="5" cols="40" required><?php echo htmlspecialchars($beitrag->inhalt); ?></textarea><br>
        <input type="submit" value="Beitrag aktualisieren">
    </form>
    <button onclick="window.location.href='index.php'">Zurück zur Startseite</button>
</body>
</html>
