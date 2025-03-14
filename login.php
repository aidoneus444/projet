<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Remplacez ces valeurs par celles de votre base de données
    $adminLogin = "admin"; // Login administrateur
    $adminPassword = "passer"; // Mot de passe administrateur (hashé en production)

    // Vérification des identifiants
    if ($login === $adminLogin && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: redirection.php"); // Redirection vers le tableau de bord
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion Administrateur</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Connexion Administrateur</h1>
    </header>

    <div class="container">
        <div class="content">
            <form action="" method="post">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" name="login" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Se connecter</button>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>