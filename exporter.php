<?php
require 'config/database.php';

// En-têtes pour téléchargement CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=contacts_' . date('Y-m-d') . '.csv');

$output = fopen('php://output', 'w');

// En-têtes CSV
fputcsv($output, ['Nom', 'Prénom', 'Email', 'Téléphone', 'Adresse', 'Date de naissance', 'Notes', 'Date création']);

// Récupérer les contacts
$stmt = $pdo->query("SELECT nom, prenom, email, telephone, adresse, date_naissance, notes, date_creation FROM contacts ORDER BY nom ASC");

while ($row = $stmt->fetch()) {
    fputcsv($output, $row);
}

fclose($output);
exit;