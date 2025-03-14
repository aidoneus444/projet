<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenue dans le tableau de bord</h1>
    </header>
    <nav>
        <a href="liste_users.php">Liste des utilisateurs</a>
        <a href="ajouter_users.html">Ajout des utilisateurs</a>
        <a href="logout.php">Se déconnecter</a>
    </nav>
    <div class="container">
        <h2>Gestion des utilisateurs</h2>
        <!-- Contenu du tableau de bord -->
    </div>
</body>
</html>