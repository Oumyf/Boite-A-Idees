<?php
session_start(); // Démarrer la session

// Inclure le fichier de connexion à la base de données
include_once "connexion.php";

// Récupérer l'ID de l'utilisateur à partir de la session
$id_utilisateur = $_SESSION['utilisateur_id'];

// Requête SQL pour récupérer le nom de l'utilisateur à partir de son ID
$sql = "SELECT prenom FROM Utilsateur WHERE ID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_utilisateur);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si un utilisateur correspondant est trouvé
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nom_utilisateur = $row['prenom']; // Récupérer le prénom de l'utilisateur
} else {
    $nom_utilisateur = "Utilisateur inconnu"; // Gérer le cas où aucun utilisateur correspondant n'est trouvé
}

// Fermer la requête
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* padding: 20px; */
            width: 100%;
            margin-top: -1000px;
            margin: 20px auto; /* Centrer le contenu */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>

    <div class="container">
    <?php include "./header.php" ; ?>

        <a href="./ajouter.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        
        <table>
            <tr id="items">
                <th>Titre</th>
                <th>Description</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Categorie</th>
                <th>Utilisateur</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php 
                // Requête pour afficher la liste des idées avec le nom de l'utilisateur
                $query = "SELECT Idee.ID, Idee.titre, Idee.description, Idee.date, Idee.statut, Categorie.libelle
                          FROM Idee 
                          LEFT JOIN Categorie ON Idee.ID_categorie = Categorie.ID
                          WHERE Idee.ID_utilisateur = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("i", $id_utilisateur);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['titre'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['statut'] . "</td>";
                        echo "<td>" . $row['libelle'] . "</td>";
                        echo "<td>" . $nom_utilisateur . "</td>";
                        echo "<td><a href='modifier.php?id=" . $row['ID'] . "'><img src='images/pen.png'></a></td>";
                        echo "<td><a href='supprimer.php?id=" . $row['ID'] . "'><img src='images/trash.png'></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Aucune idée trouvée pour cet utilisateur.</td></tr>";
                }

                // Fermer la requête
                $stmt->close();
            ?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
