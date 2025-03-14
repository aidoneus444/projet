<?php 
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["name"];
    $prenom = $_POST["prenom"];
    $mdp = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $login = $_POST["login"];
    
    $photo = "uploads/default-avatar.png"; // Valeur par défaut

    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier si c'est une vraie image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $photo = $target_file;
            }
        }
    }

    $sql = "INSERT INTO utilisateurs (id, nom, prenom, login, password, photo) 
            VALUES (UUID(), '$nom', '$prenom', '$login', '$mdp', '$photo')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Utilisateur ajouté avec succès !'); window.location.href='ajouter_users.html';</script>";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
    }

    $conn->close();
}
?>