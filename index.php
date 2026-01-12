<?php
require 'config/database.php';
require 'includes/header.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Tri
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'date_creation';
$ordre = isset($_GET['ordre']) ? $_GET['ordre'] : 'DESC';
$allowed_tri = ['nom', 'prenom', 'date_creation'];
if (!in_array($tri, $allowed_tri)) $tri = 'date_creation';
$ordre = ($ordre === 'ASC') ? 'ASC' : 'DESC';
$next_ordre = ($ordre === 'ASC') ? 'DESC' : 'ASC';

// Total contacts
$total = $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
$pages = ceil($total / $limit);

// Récupérer contacts
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY $tri $ordre LIMIT $limit OFFSET $offset");
$contacts = $stmt->fetchAll();
?>

<h3>Liste des contacts</h3>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th><a href="?tri=nom&ordre=<?= $next_ordre ?>">Nom</a></th>
            <th><a href="?tri=prenom&ordre=<?= $next_ordre ?>">Prénom</a></th>
            <th>Email</th>
            <th>Téléphone</th>
            <th><a href="?tri=date_creation&ordre=<?= $next_ordre ?>">Date d'ajout</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nom']) ?></td>
                <td><?= htmlspecialchars($c['prenom']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['telephone']) ?></td>
                <td><?= $c['date_creation'] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                    <a href="modifier.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="supprimer.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce contact ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>&tri=<?= $tri ?>&ordre=<?= $ordre ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<?php require 'includes/footer.php'; ?>
