<?php
require 'config/database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $adresse = trim($_POST['adresse'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?: null;
    $notes = trim($_POST['notes'] ?? '');

    // Validation serveur
    if (empty($nom) || empty($prenom)) {
        $message = "<div class='alert alert-danger'>Le nom et prénom sont obligatoires.</div>";
    } else {
        $check = $pdo->prepare("SELECT id FROM contacts WHERE email = ?");
        $check->execute([$email]);

        if ($email && $check->rowCount() > 0) {
            $message = "<div class='alert alert-danger'>Cet email est déjà utilisé.</div>";
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO contacts (nom, prenom, email, telephone, adresse, date_naissance, notes)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $date_naissance, $notes]);
            header("Location: index.php?success=1");
            exit;
        }
    }
}

require 'includes/header.php';
?>

<h3>Ajouter un contact</h3>

<?= $message ?>

<form method="POST" class="row g-3" id="formContact" novalidate>
    <div class="col-md-6">
        <label class="form-label">Nom *</label>
        <input type="text" name="nom" class="form-control" required>
        <div class="invalid-feedback">Le nom est obligatoire.</div>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Prénom *</label>
        <input type="text" name="prenom" class="form-control" required>
        <div class="invalid-feedback">Le prénom est obligatoire.</div>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
        <div class="invalid-feedback">Email invalide.</div>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Téléphone</label>
        <input type="text" name="telephone" class="form-control">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Date de naissance</label>
        <input type="date" name="date_naissance" class="form-control">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Adresse</label>
        <input type="text" name="adresse" class="form-control">
    </div>
    
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" rows="3"></textarea>
    </div>
    
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<script>
// Validation côté client
document.getElementById('formContact').addEventListener('submit', function(e) {
    if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
    }
    this.classList.add('was-validated');
});
</script>

<?php require 'includes/footer.php'; ?>
