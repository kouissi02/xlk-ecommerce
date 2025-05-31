<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'XLK' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Votre CSS personnalisé -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">XLK</a>
            <div class="ms-auto">
                <?php if (isLoggedIn()): ?>
                    <a href="cart.php" class="btn btn-outline-light position-relative">
                        Panier
                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= array_sum($_SESSION['cart'] ?? []) ?>
                        </span>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-4">