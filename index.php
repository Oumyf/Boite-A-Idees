<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include "./connexion.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur et le mot de passe du formulaire
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Requête SQL pour récupérer l'ID de l'utilisateur et son mot de passe en fonction du nom d'utilisateur
    $query = "SELECT ID, password FROM Utilsateur WHERE nom = ?";
    
    // Préparer la requête
    $stmt = $con->prepare($query);

    // Liaison des paramètres et exécution de la requête
    $stmt->bind_param("s", $nom_utilisateur);
    $stmt->execute();

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();

    // Vérifier si un utilisateur correspondant est trouvé
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_utilisateur = $row['ID']; // Récupérer l'ID de l'utilisateur
        $mot_de_passe_db = $row['password']; // Récupérer le mot de passe de l'utilisateur depuis la base de données

        // Vérifier si le mot de passe soumis correspond au mot de passe stocké dans la base de données
        if ($mot_de_passe === $mot_de_passe_db) {
            $_SESSION['utilisateur_id'] = $id_utilisateur; // Stocker l'ID de l'utilisateur dans la session
            // Redirection vers la page d'accueil
            header("Location: ./accueil.php");
            exit();
        } else {
            // Gérer le cas où le mot de passe soumis est incorrect
            echo "Mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        // Gérer le cas où aucun utilisateur correspondant n'est trouvé
        echo "Nom d'utilisateur incorrect. Veuillez réessayer.";
    }
    
    // Fermer la requête
    $stmt->close();
}

// Fermer la connexion à la base de données
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <style>
        /* Votre style CSS ici */
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nom_utilisateur">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
