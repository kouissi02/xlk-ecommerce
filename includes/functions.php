<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function getUnivers(): array {
    // Version temporaire (à remplacer par CSV/DB plus tard)
    return ['Warhammer 40K', 'Age of Sigmar', 'Necromunda'];
    
    /* Version CSV (à décommenter quand le fichier existe) :
    $univers = [];
    if (($handle = fopen("csv/products.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (!empty($data[3])) { // Index 3 = Univers
                $univers[] = sanitize($data[3]);
            }
        }
        fclose($handle);
    }
    return array_unique($univers);
    */
}

function getFactions(string $univers): array {
    // Version temporaire (exemple pour Warhammer 40K)
    if ($univers === 'Warhammer 40K') {
        return ['Adepta Sororitas', 'Adeptus Custodes', 'Chaos'];
    }
    return [];

    /* Version CSV (à décommenter après création du fichier) :
    $factions = [];
    if (($handle = fopen("csv/products.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (!empty($data[3]) && $data[3] === $univers && !empty($data[4])) {
                $factions[] = sanitize($data[4]); // Index 4 = Faction
            }
        }
        fclose($handle);
    }
    return array_unique($factions);
    */
}

function getProductById(int $id): array {
    // Version CSV (adaptez l'index selon votre structure)
    if (($handle = fopen("csv/products.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0] == $id) { // Supposons que l'ID est en colonne 0
                return [
                    'id' => $id,
                    'name_site_a' => $data[1],
                    'image1_url' => $data[2],
                    'price_ht' => (float)$data[5]
                ];
            }
        }
        fclose($handle);
    }
    return [];
}