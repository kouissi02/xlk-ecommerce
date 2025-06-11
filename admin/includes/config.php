<?php
$db_host = 'localhost'; // Ou l'adresse de votre serveur DB
$db_name = 'xlk_db';    // Doit correspondre au nom de votre DB
$db_user = 'root';      // À remplacer par un utilisateur dédié
$db_pass = '';          // Mot de passe si configuré

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur DB: " . $e->getMessage());
}