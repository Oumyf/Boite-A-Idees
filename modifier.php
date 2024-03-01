<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

include_once "connexion.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête pour récupérer les informations de l'idée à modifier
    $req_idee = mysqli_query($con, "SELECT * FROM Idee WHERE id = $id");
    $row = mysqli_fetch_assoc($req_idee);

    if(isset($_POST['button'])){
        extract($_POST);
        if(isset($titre) && isset($description) && isset($date) && isset($statut) && isset($ID_categorie)){
            // Requête de modification sécurisée contre les injections SQL
            $stmt = $con->prepare("UPDATE Idee SET titre = ?, description = ?, date = ?, statut = ?, ID_categorie = ? WHERE id = ?");
            $stmt->bind_param("ssssii", $titre, $description, $date, $statut, $ID_categorie, $id);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                header("location: accueil.php");
                exit();
            } else {
                $message = "Idée non modifiée";
            }
        } else {
            $message = "Veuillez remplir tous les champs !";
        }
    }
} else {
    $message = "Aucun identifiant d'idée fourni.";
}
?>

<div class="form">
    <a href="accueil.php" class="back_btn"><img src="images/back.png"> Retour</a>
    <h2>Modifier l'idée : <?=$row['titre']?> </h2>
    <p class="erreur_message">
        <?php 
            if(isset($message)){
                echo $message ;
            }
        ?>
    </p>
    <form action="" method="POST">
        <label>Titre</label>
        <input type="text" name="titre" value="<?=$row['titre']?>">
        <label>Description</label>
        <input type="text" name="description" value="<?=$row['description']?>">
        <label>Date</label>
        <input type="date" name="date" value="<?=$row['date']?>">
        <label for="statut">Sélectionnez le statut de l'idée :</label>
        <select name="statut" id="statut">
            <option value="en_attente" <?=($row['statut'] == 'en_attente') ? 'selected' : ''?>>En attente</option>
            <option value="en_cours" <?=($row['statut'] == 'en_cours') ? 'selected' : ''?>>En cours</option>
            <option value="terminee" <?=($row['statut'] == 'terminee') ? 'selected' : ''?>>Terminée</option>
        </select>
        <!-- Champ caché pour l'ID -->
        <input type="hidden" name="id" value="<?=$id?>">
        <label>Catégorie</label>
        <select name="ID_categorie">
            <option value="">Sélectionner une catégorie</option>
            <?php
                $query_categories = "SELECT ID, libelle FROM Categorie";
                $result_categories = mysqli_query($con, $query_categories);
                while ($row_categorie = mysqli_fetch_assoc($result_categories)) {
                    $selected = ($row['ID_categorie'] == $row_categorie['ID']) ? 'selected' : '';
                    echo "<option value='" . $row_categorie['ID'] . "' $selected>" . $row_categorie['libelle'] . "</option>";
                }
            ?>
        </select>
        <input type="submit" value="Modifier" name="button">
    </form>
</div>
</body>
</html>
