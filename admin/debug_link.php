<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Lien de debug";
include 'includes/header.php';
?>

<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Lien de connexion (simulation locale)</h4>
        <a href="<?= $_SESSION['debug_link'] ?? '#' ?>" class="btn btn-primary mt-2">
            Cliquez ici pour vous connecter
        </a>
        <div class="mt-3">
            <small>Copiez ce lien si besoin :</small>
            <input type="text" class="form-control" value="<?= $_SESSION['debug_link'] ?? '' ?>" readonly>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>