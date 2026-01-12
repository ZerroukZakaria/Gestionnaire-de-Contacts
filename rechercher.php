<?php
require 'config/database.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q !== '') {
    $search = "%$q%";
    $stmt = $pdo->prepare("
        SELECT * FROM contacts 
        WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? OR telephone LIKE ?
        ORDER BY nom ASC
        LIMIT 20
    ");
    $stmt->execute([$search, $search, $search, $search]);
    $contacts = $stmt->fetchAll();

    // Si requête AJAX
    if (isset($_GET['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode($contacts);
        exit;
    }
} else {
    $contacts = [];
}

require 'includes/header.php';
?>

<h3>Rechercher un contact</h3>

<div class="mb-4">
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom, prénom, email ou téléphone..." autofocus>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="resultats">
        <tr><td colspan="5" class="text-center text-muted">Tapez pour rechercher...</td></tr>
    </tbody>
</table>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value;
    const tbody = document.getElementById('resultats');
    
    if (q.length < 2) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Tapez au moins 2 caractères...</td></tr>';
        return;
    }
    
    fetch('rechercher.php?ajax=1&q=' + encodeURIComponent(q))
        .then(r => r.json())
        .then(data => {
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center">Aucun résultat</td></tr>';
                return;
            }
            tbody.innerHTML = data.map(c => `
                <tr>
                    <td>${escapeHtml(c.nom)}</td>
                    <td>${escapeHtml(c.prenom)}</td>
                    <td>${escapeHtml(c.email || '')}</td>
                    <td>${escapeHtml(c.telephone || '')}</td>
                    <td>
                        <a href="modifier.php?id=${c.id}" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="supprimer.php?id=${c.id}" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
                    </td>
                </tr>
            `).join('');
        });
});

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>

<?php require 'includes/footer.php'; ?>