/*document.addEventListener('DOMContentLoaded', function() {
    // Gestion du panier
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            toggleCart(productId, this);
        });
    });
});

function toggleCart(productId, button) {
    fetch('includes/cart_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=toggle&product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const isInCart = data.action === 'added';
            button.querySelector('span').textContent = 
                isInCart ? 'Retirer du panier' : 'Ajouter au panier';
            
            // Mise à jour du compteur
            document.querySelectorAll('.cart-count').forEach(el => {
                el.textContent = data.cart_count;
            });
        }
    });
}*/
// Gestion du panier
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', async (e) => {
        const productId = e.target.dataset.id;
        const response = await fetch('api/cart.php?action=add&id=' + productId);
        const data = await response.json();
        document.getElementById('cart-count').textContent = data.count;
    });
});