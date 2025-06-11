<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Panier";
include 'includes/header.php';

// Redirection si non connecté (Page 8 du cahier)
if (!isLoggedIn()) {
    redirect('login.php');
}
?>

<div class="container mt-4">
    <h1>Votre Panier</h1>
    
    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-info">Votre panier est vide</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $productId => $quantity):
                        // Récupère les infos du produit depuis la DB ou CSV
                        $product = getProductById($productId); // À implémenter dans functions.php
                        $priceTTC = $product['price_ht'] * 0.8 * 1.2; // -20% +20% TVA (Page 5)
                        $total += $priceTTC * $quantity;
                    ?>
                    <tr>
                        <td>
                            <img src="<?= $product['image1_url'] ?>" width="50" class="me-3">
                            <?= sanitize($product['name_site_a']) ?>
                        </td>
                        <td><?= number_format($priceTTC, 2) ?> €</td>
                        <td>
                            <button class="btn btn-sm btn-danger remove-from-cart" 
                                    data-id="<?= $productId ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total TTC</th>
                        <th><?= number_format($total, 2) ?> €</th>
                    </tr>
                </tfoot>
            </table>
            
            <div class="text-end">
                <a href="checkout.php" class="btn btn-primary">Valider la commande</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Gestion AJAX de la suppression
document.querySelectorAll('.remove-from-cart').forEach(btn => {
    btn.addEventListener('click', async () => {
        const productId = btn.dataset.id;
        const response = await fetch(`api/cart.php?action=remove&id=${productId}`);
        const data = await response.json();
        
        if (data.count === 0) {
            location.reload(); // Recharge si panier vide
        } else {
            // Met à jour l'interface sans rechargement
            btn.closest('tr').remove();
            document.getElementById('cart-count').textContent = data.count;
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>