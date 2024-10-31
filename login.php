<?php 
    session_start();
    require_once 'db.php';

    if (isset($_GET['id']) && !isset($_SESSION['autor_id'])) { // Überprüfen, ob die ID existiert und kein Benutzer eingeloggt ist
        $autorId = (int)$_GET['id'];

        
        $result = $db->query("SELECT vorname FROM autor WHERE id = $autorId");
        $autor = $result->fetch_object();

        if ($autor) {
            // Session-Variablen setzen
            $_SESSION['autor_id'] = $autorId;
            $_SESSION['autor_name'] = $autor->vorname;

            header('Location: index.php');
            exit();
        } else {
            echo "Autor nicht gefunden.";
        }
    } elseif (isset($_SESSION['autor_id'])) {
        // Wenn der Benutzer bereits eingeloggt ist, direkt zur Startseite
        header('Location: index.php');
        exit();
    } else {
        echo "Bitte wähle einen Autor.";
    }
?>