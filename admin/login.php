<?php
// xlk-ecommerce/login.php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Connexion";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));
            
            $stmt = $pdo->prepare("INSERT INTO login_tokens (user_id, token, ip, expires_at) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $user['id'],
                $token,
                $_SERVER['REMOTE_ADDR'],
                $expires
            ]);
            
            $loginLink = "http://{$_SERVER['HTTP_HOST']}/verify.php?token=$token";
            $_SESSION['debug_link'] = $loginLink;
            redirect('debug_link.php');
        } else {
            $error = "Email non enregistré. <a href='register.php'>Créer un compte</a>";
        }
    } else {
        $error = "Email invalide";
    }
}

include 'includes/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Connexion</h2>
                    <?php if ($error): ?>
                        <div class="alert alert-info"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Recevoir le lien</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>