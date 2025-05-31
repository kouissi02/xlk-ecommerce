<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Récupère l'univers depuis l'URL et sécurise
$univers = sanitize($_GET['name'] ?? '');
if (empty($univers)) {
    redirect('index.php'); // Redirige si aucun univers spécifié
}

// Charge les factions depuis le CSV
$factions = getFactions($univers);

// Entête de page
$page_title = "XLK - " . $univers;
include 'includes/header.php';
?>

<!-- Titre dynamique -->
<h1 class="my-4"><?= $univers ?></h1>

<!-- Grille Bootstrap pour les factions -->
<div class="row">
    <?php foreach ($factions as $faction): ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $faction ?></h5>
                    <a href="products.php?univers=<?= urlencode($univers) ?>&faction=<?= urlencode($faction) ?>" 
                       class="btn btn-primary mt-auto">
                        Voir les produits
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>