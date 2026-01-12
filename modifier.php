<?php
require 'config/database.php';

$message = "";
$contact = null;

// Récupérer le contact
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch();
}

if (!$contact) {
    header("Location: index.php");
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $adresse = trim($_POST['adresse']);
    $date_naissance = $_POST['date_naissance'] ?: null;
    $notes = trim($_POST['notes']);

    // Vérifier unicité email (sauf si même email)
    $check = $pdo->prepare("SELECT id FROM contacts WHERE email = ? AND id != ?");
    $check->execute([$email, $id]);

    if ($check->rowCount() > 0) {
        $message = "<div class='alert alert-danger'>Cet email est déjà utilisé.</div>";
    } else {
        $stmt = $pdo->prepare("
            UPDATE contacts SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?, date_naissance = ?, notes = ?
            WHERE id = ?
        ");
        $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $date_naissance, $notes, $id]);
        $message = "<div class='alert alert-success'>Contact modifié avec succès.</div>";
        
        // Recharger les données
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        $contact = $stmt->fetch();
    }
}

require 'includes/header.php';
?>

<h3>Modifier le contact</h3>

<?= $message ?>

<form method="POST" class="row g-3">
    <input type="hidden" name="id" value="<?= $contact['id'] ?>">
    
    <div class="col-md-6">
        <label class="form-label">Nom *</label>
        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($contact['nom']) ?>" required>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Prénom *</label>
        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($contact['prenom']) ?>" required>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($contact['email']) ?>">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Téléphone</label>
        <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($contact['telephone']) ?>">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Date de naissance</label>
        <input type="date" name="date_naissance" class="form-control" value="<?= $contact['date_naissance'] ?>">
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Adresse</label>
        <input type="text" name="adresse" class="form-control" value="<?= htmlspecialchars($contact['adresse'] ?? '') ?>">
    </div>
    
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($contact['notes'] ?? '') ?></textarea>
    </div>
    
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>
    </div>
    
    <div class="col-12">
        <small class="text-muted">Dernière modification : <?= $contact['date_modification'] ?></small>
    </div>
</form>

<?php require 'includes/footer.php'; ?>