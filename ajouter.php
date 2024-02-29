
<?php
session_start(); // Démarrer la session
include "./header.php" ;
// Vérifier si le formulaire a été soumis
if(isset($_POST['button'])) {
    // Extraction des données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $statut = $_POST['statut'];
    $id_categorie = $_POST['ID_categorie'];

    // Vérification des champs obligatoires
    if(!empty($titre) && !empty($description) && !empty($date) && !empty($statut) && !empty($id_categorie)) {
        // Inclure le fichier de connexion à la base de données
        include_once "./connexion.php";

        // Vérifier si l'ID de l'utilisateur est présent dans la session
        if(isset($_SESSION['utilisateur_id'])) {
            // Récupérer l'ID de l'utilisateur connecté à partir de la session
            $id_utilisateur = $_SESSION['utilisateur_id'];

            // Requête d'insertion avec des requêtes préparées pour éviter les injections SQL
            $stmt = $con->prepare("INSERT INTO Idee (titre, description, date, statut, ID_categorie, ID_utilisateur) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssii", $titre, $description, $date, $statut, $id_categorie, $id_utilisateur);
            $stmt->execute();

            // Vérifier si l'insertion a réussi
            if($stmt->affected_rows > 0) {
                $stmt->close(); // Fermer la requête préparée
                $con->close(); // Fermer la connexion à la base de données
                header("location: accueil.php");
                exit(); // Terminer le script après la redirection
            } else {
                $message = "Erreur lors de l'insertion de l'idée.";
            }
        } else {
            $message = "Erreur: L'utilisateur n'est pas connecté.";
        }
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}
?>

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
    <div class="container">
        <h2>Ajouter une idée</h2>
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
            <!-- Autres champs existants -->
            <label>Catégorie</label>
            <select name="ID_categorie">
                <option value="">Sélectionner une catégorie</option>
                <?php
                    // Inclure le fichier de connexion à la base de données
                    include_once "connexion.php";

                    // Récupérer la liste des catégories depuis la base de données
                    $query_categories = "SELECT ID, libelle FROM Categorie";
                    $result_categories = mysqli_query($con, $query_categories);
                    while ($row_categorie = mysqli_fetch_assoc($result_categories)) {
                        echo "<option value='" . $row_categorie['ID'] . "'>" . $row_categorie['libelle'] . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>

</body>
</html>