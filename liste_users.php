<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des utilisateurs</title>
</head>
<body>

<header>
    <h1>Liste des utilisateurs</h1>
</header>

<nav>
    <a href="liste_users.php">Liste des utilisateurs</a>
    <a href="ajouter_users.html">Ajout des utilisateurs</a>
</nav>

<div class="container">
    <div class="content">
        <h2>Utilisateurs inscrits</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT id, nom, prenom, login, photo FROM utilisateurs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $photo = !empty($row["photo"]) ? htmlspecialchars($row["photo"]) : "uploads/default-avatar.png";
                        echo "<tr>
                                <td>" . htmlspecialchars($row["id"]) . "</td>
                                <td><img src='" . $photo . "' width='50' height='50' style='border-radius: 50%;'></td>
                                <td>" . htmlspecialchars($row["nom"]) . "</td>
                                <td>" . htmlspecialchars($row["prenom"]) . "</td>
                                <td>" . htmlspecialchars($row["login"]) . "</td>
                                <td>
                                    <a href='modifier_utilisateurs.php?id=" . htmlspecialchars($row["id"]) . "'>✏ Modifier</a> |
                                    <a href='delete_utilisateurs.php?id=" . htmlspecialchars($row["id"]) . "' onclick='return confirm(\"Voulez-vous vraiment supprimer cet utilisateur ?\");'>🗑 Supprimer</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Aucun utilisateur trouvé</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>