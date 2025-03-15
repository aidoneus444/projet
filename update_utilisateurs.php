<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $login = $_POST["login"];

    if ($_FILES["photo"]["name"] != "") {
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        $extensions_autorisees = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $extensions_autorisees)) {
            die("Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
        }

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            die("Erreur lors de l'upload de l'image.");
        }

        
        $sql = $conn->prepare("UPDATE utilisateurs SET nom=?, prenom=?, login=?, photo=? WHERE id=?");
        $sql->bind_param("sssssi", $nom, $prenom, $login, $target_file, $id);
    } else {

        $sql = $conn->prepare("UPDATE utilisateurs SET nom=?, prenom=?, login=?, profile=? WHERE id=?");
        $sql->bind_param("ssssi", $nom, $prenom, $login, $profile, $id);
    }

    if ($sql->execute()) {
        echo "<script>alert('Utilisateur mis à jour avec succès !'); window.location.href='liste_users.php';</script>";
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }

    $sql->close();
    $conn->close();
}
?>
