<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'za_zerrouk_gestion_contact');
define('DB_USER', 'za_zerrouk_gestion_contact_user');
define('DB_PASS', 'Bruhmoment@2002');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
