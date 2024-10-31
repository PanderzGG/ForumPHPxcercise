<?php 

function beitrag_anzeigen($beitrag) {
    // Unterscheidung zwischen Wurzelbeitrag und Antwort
    $isAntwort = !empty($beitrag->parentid);
    $cardClass = $isAntwort ? 'card mb-3 bg-light text-dark' : 'card mb-3 bg-info text-dark'; // Unterschiedliche Hintergründe und schwarzer Text

    echo "<div class='$cardClass'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>Autor: " . htmlspecialchars($beitrag->autorid) . "</h5>";
    echo "<h6 class='card-subtitle mb-2 text-muted'>Datum: " . htmlspecialchars($beitrag->datum) . "</h6>";
    echo "<p class='card-text'>" . nl2br(htmlspecialchars($beitrag->inhalt)) . "</p>";
    
    // Überprüfen, ob der Benutzer eingeloggt ist
    if (isset($_SESSION['autor_name']) && $_SESSION['autor_name'] != null) {
        // Antwortformular
        echo "<form action='antwortspeichern.php' method='POST' class='mt-3'>";
        echo "<input type='hidden' name='parentid' value='" . $beitrag->id . "'>";
        echo "<div class='mb-3'>";
        echo "<label for='antwort' class='form-label'>Antwort:</label>";
        echo "<textarea id='antwort' name='antwort' class='form-control' rows='3' required></textarea>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Antwort speichern</button>";
        echo "</form>";
        
        if ($beitrag->autorid == $_SESSION['autor_id']) {
            echo "<div class='mt-2'>";
            echo "<a href='beitragbearbeiten.php?id=" . $beitrag->id . "' class='btn btn-warning'>Beitrag bearbeiten</a>";
            echo "<a href='beitragloeschen.php?id=" . $beitrag->id . "' class='btn btn-danger'>Beitrag löschen</a>";
            echo "</div>";
        }
    }

    // Überprüfen, ob der Beitrag Antworten hat
    if (!empty($beitrag->antworten)) {
        echo "<strong>Antworten:</strong><br>";
        foreach ($beitrag->antworten as $antwort) {
            beitrag_anzeigen($antwort); // Rekursive Funktion aufrufen
        }
    }
    echo "</div></div>";
}
?>
