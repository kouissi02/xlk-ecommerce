
<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Accueil";
include 'includes/header.php';
?>

<h1>Bienvenue sur XLK</h1>
<div class="row">
    <?php foreach(getUnivers() as $univers): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= sanitize($univers) ?></h5>
                <a href="univers.php?name=<?= urlencode($univers) ?>" class="btn btn-primary">Voir les factions</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
