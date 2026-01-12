# Gestionnaire de Contacts

Application web de gestion de contacts développée en PHP avec Bootstrap.

## 🌐 Démo en ligne

[https://zerrouk.dwm.ma](https://zerrouk.dwm.ma)

## 📋 Fonctionnalités

- **Liste des contacts** : Tableau responsive avec pagination (10/page) et tri par colonnes
- **Ajout** : Formulaire avec validation côté client (JS) et serveur (PHP)
- **Modification** : Pré-remplissage du formulaire, historique de modification
- **Suppression** : Confirmation avant suppression
- **Recherche** : Recherche en temps réel avec AJAX (nom, prénom, email, téléphone)
- **Export CSV** : Téléchargement de tous les contacts au format CSV

## 🛠️ Technologies utilisées

- PHP 8+
- MySQL / MariaDB
- Bootstrap 5
- JavaScript (AJAX)

## 📦 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/ZerroukZakaria/Gestionnaire-de-Contacts.git
cd Gestionnaire-de-Contacts
```

### 2. Créer la base de données

Importer le fichier `database.sql` dans MySQL :

```bash
mysql -u root -p < database.sql
```

Ou via phpMyAdmin : importer le fichier `database.sql`

### 3. Configurer la connexion

Modifier le fichier `config/database.php` avec vos identifiants :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestion_contacts');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');
```

### 4. Lancer l'application

Placer les fichiers dans votre serveur web (Apache, Nginx) et accéder via le navigateur.

## 📁 Structure du projet

```
├── index.php          # Liste des contacts (pagination + tri)
├── ajouter.php        # Formulaire d'ajout
├── modifier.php       # Formulaire de modification
├── supprimer.php      # Suppression de contact
├── rechercher.php     # Recherche AJAX
├── exporter.php       # Export CSV
├── database.sql       # Structure + données de test
├── config/
│   └── database.php   # Configuration BDD
└── includes/
    ├── header.php     # En-tête + navigation
    └── footer.php     # Pied de page
```

## 👤 Auteur

**Zakaria Zerrouk**  
ENSET Mohammedia - DWM

## 📄 Licence

Ce projet est réalisé dans le cadre d'un TP académique.
