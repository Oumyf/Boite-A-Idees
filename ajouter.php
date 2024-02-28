<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<?php
// Vérifier si le formulaire a été soumis
if(isset($_POST['button'])) {
    // Extraction des données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $statut = $_POST['statut'];
    $id_administrateur = $_POST['ID_administrateur'];
    $id_utilisateur = $_POST['ID_utilisateur'];

    // Vérification des champs obligatoires
    if(!empty($titre) && !empty($description) && !empty($date) && !empty($statut) && !empty($id_administrateur) && !empty($id_utilisateur)) {
        // Inclure le fichier de connexion à la base de données
        include_once "connexion.php";

        // Requête d'insertion avec des colonnes spécifiées
        $req = mysqli_query($con, "INSERT INTO Idee (titre, description, date, statut, ID_administrateur, ID_utilisateur) VALUES ('$titre', '$description', '$date', '$statut', $id_administrateur, $id_utilisateur)");

        // Vérifier si l'insertion a réussi
        if($req) {
            header("location: accueil.php");
            exit(); // Terminer le script après la redirection
        } else {
            $message = "Erreur lors de l'insertion de l'idée.";
        }
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}
?>


        <form action="" method="POST">
            <label>Titre</label>
            <input type="text" name="titre">
            <label>Description</label>
            <input type="text" name="description">
            <label>Date</label>
            <input type="date" name="date">
            <label for="statut">Sélectionnez le statut de l'idée :</label>
            <select name="statut" id="statut">
                <option value="en_attente">En attente</option>
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminée</option>
            </select>
            <input type="hidden" name="id" value="ID_DE_VOTRE_IDEE">
             <!-- Autres champs existants -->
    <label>Administrateur</label>
    <select name="ID_administrateur">
        <option value="">Sélectionner un administrateur</option>
        <?php
            // Inclure le fichier de connexion à la base de données
            include_once "connexion.php";

            // Récupérer la liste des administrateurs depuis la base de données
            $query_administrateurs = "SELECT ID, nom FROM Administrateur";
            $result_administrateurs = mysqli_query($con, $query_administrateurs);
            while ($row_administrateur = mysqli_fetch_assoc($result_administrateurs)) {
                echo "<option value='" . $row_administrateur['ID'] . "'>" . $row_administrateur['nom'] . "</option>";
            }
        ?>
    </select>
    <label>Utilisateur</label>
    <select name="ID_utilisateur">
        <option value="">Sélectionner un utilisateur</option>
        <?php
            // Récupérer la liste des utilisateurs depuis la base de données
            $query_utilisateurs = "SELECT ID , nom FROM Utilsateur";
            $result_utilisateurs = mysqli_query($con, $query_utilisateurs);
            while ($row_utilisateur = mysqli_fetch_assoc($result_utilisateurs)) {
                echo "<option value='" . $row_utilisateur['ID'] . "'>" . $row_utilisateur['nom'] . "</option>";
            }
        ?>
    </select>
            <input type="submit" value="Ajouter" name="button">

        </form>
    </div>
</body>
</html>