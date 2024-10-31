<?php
    session_start();
    require_once 'db.php';

    if (!isset($_SESSION['autor_id']) || !isset($_GET['id'])){
        die("Zugriff verweigert. Bitte logge dich ein.");
    }

    $beitragId = intval($_GET['id']);
    $stmt=$db->prepare("DELETE FROM beitrag WHERE id = ?");
    $stmt->bind_param("i", $beitragId);
    $stmt->execute();

    header('Location: index.php');
    echo "Beitrag erfolgreich gelöscht";
    exit;


?>