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
            $_SESSION['nom_utilisateur'] = $nom_utilisateur; // Stocker le nom d'utilisateur dans la session

            // Redirection vers la page d'accueil
            header("Location: ./accueil.php");
            exit();
        } else {
            // Gérer le cas où le mot de passe soumis est incorrect
            $erreur = "Mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        // Gérer le cas où aucun utilisateur correspondant n'est trouvé
        $erreur = "Nom d'utilisateur incorrect. Veuillez réessayer.";
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
        body {
            font-family: Arial, sans-serif;
            background-image: url("theos_innovation.jpg");
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

       

        .container {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            width: 300px;
            max-width: 400px;
            margin-top: 80px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            background-color: #fff;
        }

        button {
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #000;
        }

        .inscription-section {
            color: yellow;

            margin-top: 20px;
        }

        .inscription-section a {
            color: yellow;
            text-decoration: none;
            font-weight: bold;
        }

        .inscription-section a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

<<<<<<< HEAD
        <button type="submit">Se connecter</button>
    </form>
</div>

<div class="inscription-section">
    <p>Vous n'avez pas de compte ? <a href="./register.php">Inscrivez-vous ici</a>.</p>
</div>
</div>
=======
            <button type="submit">Se connecter</button>
        </form>
        <?php
        // Afficher les erreurs s'il y en a
        if (isset($erreur)) {
            echo "<p>$erreur</p>";
        }
        ?>
    </div>
>>>>>>> release/0.0.3
</body>
</html>
