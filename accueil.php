<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Idées</title>
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
        <div class="header">
<<<<<<< HEAD
        <?php     include "header.php" ;
?></div>
=======
            <?php include "header.php"; ?>
        </div>
        <?php
            session_start();
            if(isset($_SESSION['nom_utilisateur'])) {
                echo "<h2>Bienvenue, " . $_SESSION['nom_utilisateur'] . "!</h2>";
            } else {
                echo "<h2>Bienvenue!</h2>";
            }
        ?>
>>>>>>> release/0.0.3
        <h2>Liste des Idées</h2>
        <a href="./ajouter.php" class="add-button">Ajouter une Idée</a>
        
        <table>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Categorie</th>
                <th>Prénom Utilisateur</th>
                <th>Nom Utilisateur</th>
            
            </tr>
<<<<<<< HEAD
            <?php 
            //inclure la page de connexion
            
            include_once "connexion.php";
            //requête pour afficher la liste des employés
            // Récupérer les informations sur les idées avec les noms des administrateurs et des utilisateurs
            $query = "SELECT Idee.ID, Idee.titre, Idee.description, Idee.date, Idee.statut, Categorie.libelle, Utilsateur.prenom , Utilsateur.nom 
            FROM Idee 
            LEFT JOIN Categorie ON idee.ID_categorie = Categorie.ID 
            LEFT JOIN Utilsateur ON idee.ID_utilisateur = utilsateur.ID";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) == 0){
                //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                echo "Il n'y a pas encore d'idée ajoutée !" ;
                
            }else {
                //si non , affichons la liste de tous les employés
                while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?=$row['titre']?></td>
                        <td><?=$row['description']?></td>
                        <td><?=$row['date']?></td>
                        <td><?=$row['statut']?></td>
                        <td><?=$row['libelle']?></td>
                        <td><?=$row['prenom']?></td>
                        <td><?=$row['nom']?></td>


                        <!--Nous alons mettre l'id de chaque employé dans ce lien -->

                    </tr>
                    <?php
                }
                
            }
=======
            <?php
//inclure la page de connexion
include_once "connexion.php";

// Définir un tableau associatif de couleurs pour chaque catégorie
$couleurs_categories = array(
    "rouge" => "#FF5733",
    "vert" => "#33FF57",
    "bleu" => "#3366FF",
    "blanc" => "#FFFFFF"
);

//requête pour afficher la liste des employés
// Récupérer les informations sur les idées avec les noms des administrateurs et des utilisateurs
$query = "SELECT Idee.ID, Idee.titre, Idee.description, Idee.date, Idee.statut, Categorie.libelle, Categorie.couleur, Utilsateur.prenom , Utilsateur.nom 
FROM Idee 
LEFT JOIN Categorie ON idee.ID_categorie = Categorie.ID 
LEFT JOIN Utilsateur ON idee.ID_utilisateur = utilsateur.ID";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) == 0){
    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
    echo "Il n'y a pas encore d'idée ajoutée !" ;
}else {
    //si non , affichons la liste de tous les employés
    while($row=mysqli_fetch_assoc($result)){
        // Récupérer la couleur correspondante à la catégorie
        $couleur_categorie = isset($couleurs_categories[$row['couleur']]) ? $couleurs_categories[$row['couleur']] : "#000000"; // Couleur par défaut si la catégorie n'est pas définie

        ?>
        <tr style="background-color: <?=$couleur_categorie?>;">
            <td><?=$row['titre']?></td>
            <td><?=$row['description']?></td>
            <td><?=$row['date']?></td>
            <td><?=$row['statut']?></td>
            <td><?=$row['libelle']?></td>
            <td><?=$row['prenom']?></td>
            <td><?=$row['nom']?></td>
        </tr>
        <?php
    }
}

>>>>>>> release/0.0.3
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
