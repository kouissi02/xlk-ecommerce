<?php
// xlk-ecommerce/register.php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Inscription";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Vérifier si email existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if (!$stmt->fetch()) {
            // Upload photo (exemple simplifié)
            if (isset($_FILES['photo'])) {
                $uploadDir = 'assets/uploads/';
                $filename = uniqid() . '.jpg';
                move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $filename);
                
                // Enregistrement en DB (attente validation manuelle)
                $stmt = $pdo->prepare("INSERT INTO users (email, registration_photo, ip_registration) VALUES (?, ?, ?)");
                $stmt->execute([$email, $filename, $_SERVER['REMOTE_ADDR']]);
                
                $error = "Demande envoyée. Vous recevrez un email après vérification.";
            }
        } else {
            $error = "Email déjà enregistré. <a href='login.php'>Se connecter</a>";
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
                    <h2 class="card-title text-center">Inscription</h2>
                    <?php if ($error): ?>
                        <div class="alert alert-info"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo de vérification</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                            <small class="text-muted">Photo de votre impression 3D avec email manuscrit</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>