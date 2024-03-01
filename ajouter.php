
<?php
session_start(); // Démarrer la session
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            /* background-color: #fff; */
            background-image: url('boite-a-idee.jpg');
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 50px;
            width: 100%;
            margin-top: -1000px;
            margin: 20px ; /* Centrer le contenu */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        
        .add-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .add-button:hover {
            background-color: #45a049;
        }
form{
    display: flex;
    flex-direction: column;
    align-items: center;
}

        form label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

form input[type="text"],
form input[type="date"],
form select {
    width: 70%;
    align-items: center;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

form select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url("arrow-down.svg") no-repeat right;
    background-size: 10px;
    padding-right: 25px;
}

form input[type="submit"] {
    width: 70%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
  
    <div class="container">
    <div class="header">
  <?php
    include "header.php" ;
    ?>
  </div>
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
                <option value="en_attente">Approuver</option>
                <option value="en_cours">Refuser</option>
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