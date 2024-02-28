<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- <div class="header">
    <nav class="">
        <a href="#"><img src="./images/Innovatech-Logo.png" alt=""></a>

</nav>
    </div> -->
    <div class="container">
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
                //inclure la page de connexion
                include_once "connexion.php";
                //requête pour afficher la liste des employés
                // Récupérer les informations sur les idées avec les noms des administrateurs et des utilisateurs
                $query = "SELECT Idee.ID, Idee.titre, Idee.description, Idee.date, Idee.statut, Categorie.libelle, Utilsateur.prenom 
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
                            <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                            <td><a href="modifier.php?id=<?=$row['ID']?>"><img src="images/pen.png"></a></td>
                            <td><a href="supprimer.php?id=<?=$row['ID']?>"><img src="images/trash.png"></a></td>
                        </tr>
                        <?php
                    }
                    
                }
            ?>
      
         
        </table>
   
   
   
   
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>