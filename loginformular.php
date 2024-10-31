<?php
session_start();
require_once 'db.php';

// Autoren abrufen
$result = $db->query("SELECT id, vorname FROM autor");
$autoren = [];

while ($autor = $result->fetch_object()) {
    $autoren[] = $autor;
}
$result->free();

// Anmeldelogik
if (isset($_GET['id'])) {
    $autorId = (int)$_GET['id']; // Benutzer-ID abrufen

    // Überprüfen, ob der Benutzer existiert (Sicherheit)
    $result = $db->query("SELECT vorname FROM autor WHERE id = $autorId");
    $autor = $result->fetch_object();

    if ($autor) {
        // Benutzer in die Session speichern
        $_SESSION['autor_id'] = $autorId;
        $_SESSION['autor_name'] = $autor->vorname;

        header('Location: index.php');
        exit();
    } else {
        echo "Autor nicht gefunden.";
    }
} 
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Autoren Login</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Autoren Login</h1>
        <div class="list-group">
            <?php foreach ($autoren as $autor): ?>
                <a href="login.php?id=<?= urlencode($autor->id) ?>" class="list-group-item list-group-item-action">
                    <?= htmlspecialchars($autor->vorname) ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Zurück zur Startseite</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdcP36X58ssPpA8Yb4vHt3QoTnqPpUtjVxEk07J4xOsLxP3" crossorigin="anonymous"></script>
</body>
</html>

