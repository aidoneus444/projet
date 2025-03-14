<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM utilisateurs WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["name"];
    $prenom = $_POST["prenom"];
    $login = $_POST["login"];
    $photo = $user["photo"];

    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file;
        }
    }

    $sql = "UPDATE utilisateurs SET nom='$nom', prenom='$prenom', login='$login', photo='$photo' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Utilisateur mis à jour !'); window.location.href='liste_users.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier utilisateur</title>
</head>
<body>

<header>
    <h1>Modifier l'utilisateur</h1>
</header>

<nav>
    <a href="liste_users.php">Liste des utilisateurs</a>
    <a href="ajouter_users.html">Ajout des utilisateurs</a>
</nav>

<div class="container">
    <div class="content">
        <h2>Modifier les informations</h2>
        <form action="" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="content">
    
    <div class="form-group">
    <label>Nom</label>
    <input type="text" name="name" value="<?= $user['nom'] ?>" required>
    </div>
    
    <div class="form-group">
    <label>Prénom</label>
    <input type="text" name="prenom" value="<?= $user['prenom'] ?>" required>
    </div>
    
    <div class="form-group">
    <label>Login</label>
    <input type="text" name="login" value="<?= $user['login'] ?>" required>
    </div>

    <div class="form-group">
    <div class="form-group">
    <label> Profile</label>
    <input type="file" name="photo">
    <img src="<?= $user['photo'] ?>" width="50" height="50">
    </div>

    <button type="submit">Mettre à jour</button>
    </form>
    </div>
</div>

</body>
</html>