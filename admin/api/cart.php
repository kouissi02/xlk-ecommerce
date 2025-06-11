<?php
// xlk-ecommerce/api/cart.php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

session_start();

// Blocage des requêtes non-AJAX
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(403);
    die(json_encode(['error' => 'Accès interdit']));
}

$action = $_GET['action'] ?? '';
$productId = (int)($_GET['id'] ?? 0);

try {
    switch ($action) {
        case 'add':
            $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
            break;
            
        case 'remove':
            if (isset($_SESSION['cart'][$productId])) {
                unset($_SESSION['cart'][$productId]);
            }
            break;
            
        default:
            throw new Exception('Action invalide');
    }

    echo json_encode([
        'count' => array_sum($_SESSION['cart'] ?? []),
        'items' => $_SESSION['cart'] ?? []
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}