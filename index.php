<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 400px;
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
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .inscription-section {
            margin-top: 20px;
        }

        .inscription-section a {
            color: #007BFF;
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
    <h2>Connexion</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Traitement du formulaire de connexion
        $nom_utilisateur = $_POST["nom_utilisateur"];
        $mot_de_passe = $_POST["mot_de_passe"];
        // Exemple basique de vérification
        if ($nom_utilisateur === "nom" && $mot_de_passe === "password") {
            echo "<p style='color: green;'>Connexion réussie !</p>";
            header("location: ./accueil.php") ;
        } else {
            header("location: ./accueil.php") ;
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

        <button type="submit">Se connecter</button>
    </form>
</div>

<div class="inscription-section">
    <p>Vous n'avez pas de compte ? <a href="./register.php">Inscrivez-vous ici</a>.</p>
</div>

</body>
</html>
