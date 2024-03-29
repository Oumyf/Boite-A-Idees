<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
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
            width: 90%;
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
    <?php

include "header.php" ;


?>


<table>
            <tr id="items">
                <th>Libelle</th>
                <th>Description</th>
                <!-- <th>Modifier</th>
                <th>Supprimer</th> -->
            </tr>
            <?php 
                //inclure la page de connexion
                include_once "connexion.php";
                //requête pour afficher la liste des employés
                // Récupérer les informations sur les idées avec les noms des administrateurs et des utilisateurs
                $query = "SELECT * FROM Categorie" ;

                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) == 0){
                    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore d'idée ajoutée !" ;
                    
                }else {
                    //si non , affichons la liste de tous les employés
                    while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?=$row['libelle']?></td>
                            <td><?=$row['description']?></td>
                           
                        </tr>
                        <?php
                    }
                    
                }
            ?>
      
         
        </table>
        </div>
   
</body>
</html>