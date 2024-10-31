<?php 
session_start(); // Session starten
require_once 'db.php';
require_once 'prolib.php'; // Hier die prolib.php einbinden

// Alle Beiträge abrufen
$result = $db->query("SELECT id, autorid, datum, inhalt, parentid FROM beitrag");
$beitraege = [];
$beitraegeById = [];

// Beiträge in eine Liste und eine Map speichern
while ($beitrag = $result->fetch_object()) {
    $beitrag->antworten = []; // Liste für Antworten initialisieren
    $beitraege[] = $beitrag;
    $beitraegeById[$beitrag->id] = $beitrag; // ID => Objekt speichern
}
$result->free();

// Wurzelbeiträge sammeln
$wurzelBeitraege = [];
foreach ($beitraege as $beitrag) {
    if (empty($beitrag->parentid)) {
        $wurzelBeitraege[] = $beitrag; // Wurzelbeitrag hinzufügen
    } else {
        // Elternbeitrag finden und Antwort zuweisen
        $parent = $beitraegeById[$beitrag->parentid];
        $parent->antworten[] = $beitrag; // Antwort zum Elternbeitrag hinzufügen
    }
}

// Benutzerstatus anzeigen
if (isset($_SESSION['autor_name']) && $_SESSION['autor_name'] != null) {
    echo "Du bist eingeloggt als: " . htmlspecialchars($_SESSION['autor_name']);
} else {
    echo "Du bist nicht eingeloggt.";
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Startseite</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Willkommen zum Forum</h1>

        <?php if (isset($_SESSION['autor_id'])): ?>
            <h2>Neuen Beitrag schreiben</h2>
            <form action="beitragspeichern.php" method="POST" class="mb-4">
                <div class="mb-3">
                    <label for="inhalt" class="form-label">Inhalt:</label>
                    <textarea id="inhalt" name="inhalt" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Beitrag speichern</button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Bitte logge dich ein, um einen Beitrag zu schreiben.
            </div>
            <a href="loginformular.php" class="btn btn-success">Login</a>
        <?php endif; ?>

        <h2 class="mt-5">Neueste Beiträge</h2>
        <?php foreach ($wurzelBeitraege as $wurzelBeitrag): ?>
            <div class="mb-4">
                <?php beitrag_anzeigen($wurzelBeitrag); // Funktion aus prolib.php aufrufen ?>   
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdcP36X58ssPpA8Yb4vHt3QoTnqPpUtjVxEk07J4xOsLxP3" crossorigin="anonymous"></script>
</body>
</html>
