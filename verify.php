<?php
// xlk-ecommerce/verify.php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$token = $_GET['token'] ?? '';

if (!empty($token)) {
    $stmt = $pdo->prepare("SELECT user_id FROM login_tokens WHERE token = ? AND expires_at > NOW() AND ip = ?");
    $stmt->execute([$token, $_SERVER['REMOTE_ADDR']]);
    $validToken = $stmt->fetch();
    
    if ($validToken) {
        $_SESSION['user_id'] = $validToken['user_id'];
        $pdo->prepare("DELETE FROM login_tokens WHERE token = ?")->execute([$token]);
        redirect('index.php');
    }
}

die("Lien invalide ou expiré. <a href='login.php'>Nouvel essai</a>");