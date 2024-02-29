<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

         //connexion à la base de donnée
          include_once "connexion.php";
         //on récupère le id dans le lien
          $id = $_GET['id'];
          //requête pour afficher les infos d'un employé
          $req = mysqli_query($con , "SELECT * FROM Idee WHERE id = $id");
          $row = mysqli_fetch_assoc($req);


       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($titre) && isset($description) && $date && isset($statut)  && isset($ID_categorie)  && isset($ID_utilisateur)){
               //requête de modification
               $req = mysqli_query($con, "UPDATE Idee SET titre = '$titre' , descr
               iption = '$description' , date = '$date' , statut = '$statut' , ID_categorie = '$ID_categorie'  WHERE id = $id");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: accueil.php");
                }else {//si non
                    $message = "Idée non modifiée";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
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
            <label>date</label>
            <input type="date" name="date" value="<?=$row['date']?>">
            <label for="statut">Sélectionnez le statut de l'idée :</label>
            <select name="statut" id="statut" value="<?=$row['statut']?>">
                <option value="en_attente">En attente</option>
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminée</option>
            </select>
            <input type="hidden" name="id" value="ID">
                        <!-- Autres champs existants -->
                        <label>Catégorie</label>
    <select name="ID_categorie">
        <option value="">Sélectionner une  catégorie</option>
        <?php
            // Inclure le fichier de connexion à la base de données
            include_once "connexion.php";

            // Récupérer la liste des administrateurs depuis la base de données
            $query_categories = "SELECT ID, libelle FROM Categorie";
            $result_categories = mysqli_query($con, $query_categories);
            while ($row_categorie = mysqli_fetch_assoc($result_categories)) {
                echo "<option value='" . $row_categorie['ID'] . "'>" . $row_categorie['libelle'] . "</option>";
            }
        ?>
    </select>
   
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>